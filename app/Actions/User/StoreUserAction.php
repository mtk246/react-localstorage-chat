<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Enums\User\UserType;
use App\Events\User\StoreEvent;
use App\Http\Casts\User\StoreUserWrapper;
use App\Http\Resources\User\UserResource;
use App\Mail\GenerateNewPassword;
use App\Models\BillingCompany\Membership;
use App\Models\Profile;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

final class StoreUserAction
{
    public function invoke(StoreUserWrapper $userWrapper): UserResource
    {
        /* @return array<key, string> */
        return DB::transaction(function () use ($userWrapper) {
            $profile = $this->getProfile($userWrapper);
            $userData = $userWrapper->getData()->merge(['profile_id' => $profile->id]);

            return new UserResource(tap(User::query()->create($userData->toArray()), function (User $user) use ($profile, $userWrapper) {
                $rollableType = User::class;

                if (UserType::BILLING === $userWrapper->getType()) {
                    $user->billingCompany()->associate($userWrapper->getBillingCompanyId());
                    $user->billingCompanies()->syncWithoutDetaching($userWrapper->getBillingCompanyId());

                    $rollableType = Membership::class;
                }

                $user->roles()->syncWithPivotValues($userWrapper->getRoles(), ['rollable_type' => $rollableType], false);
                $token = encrypt($user->id.'@#@#$'.$user->email);
                $user->token = $token;
                $user->save();

                Mail::to($user->email)->send(
                    new GenerateNewPassword(
                        $profile->first_name.' '.$profile->last_name,
                        $user->email,
                        \Crypt::decrypt($user->userkey),
                        env('URL_FRONT').'/#/newCredentials?mcctoken='.$token
                    )
                );

                event(new StoreEvent($user, $user->userkey));
            })->refresh());
        });
    }

    private function getProfile(StoreUserWrapper $userWrapper): ?Profile
    {
        if (
            Profile::query()
                ->where('id', $userWrapper->getProfileId())
                ->whereDoesntHave(
                    'contacts',
                    function (Builder $query) use ($userWrapper) {
                        $query->where('email', $userWrapper->getEmail());
                    }
                )
                ->exists()
        ) {
            throw new \Exception('Profile id does not match email');
        }

        return tap(Profile::query()->updateOrCreate(['id' => $userWrapper->getProfileId()],
            $userWrapper->getProfileData(),
        ), function (Profile $profile) use ($userWrapper) {
            $socialMedias = $profile->socialMedias;
            /* Delete socialMedia */
            foreach ($socialMedias as $socialMedia) {
                $validated = false;
                $socialNetwork = $socialMedia->SocialNetwork;
                if (isset($socialNetwork)) {
                    $userWrapper->getSocialMedias()->each(function ($socialM) use (&$validated, $socialNetwork) {
                        if ($socialM['name'] == $socialNetwork->name) {
                            $validated = true;
                        }
                    });
                }
                if (!$validated) {
                    $socialMedia->delete();
                }
            }

            /* update or create new social medias */
            $userWrapper->getSocialMedias()->each(function ($socialM) use ($profile, $userWrapper) {
                $socialNetwork = SocialNetwork::whereName($socialM['name'])->first();
                if (isset($socialNetwork)) {
                    SocialMedia::updateOrCreate([
                        'profile_id' => $profile->id,
                        'social_network_id' => $socialNetwork->id,
                        'billing_company_id' => $userWrapper->getBillingCompanyId(),
                    ], [
                        'link' => $socialM['link'],
                    ]);
                }
            });

            $profile->contacts()->updateOrCreate([
                'contactable_id' => $profile->id,
                'contactable_type' => Profile::class,
                'billing_company_id' => $userWrapper->getBillingCompanyId(),
            ], $userWrapper->getContact()->toArray());

            $profile->addresses()->updateOrCreate([
                'addressable_id' => $profile->id,
                'addressable_type' => Profile::class,
                'billing_company_id' => $userWrapper->getBillingCompanyId(),
            ], $userWrapper->getAddress()->toArray());
        });
    }
}
