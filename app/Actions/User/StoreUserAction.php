<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Http\Casts\User\StoreUserWrapper;
use App\Http\Resources\User\UserResource;
use App\Mail\GenerateNewPassword;
use App\Models\Profile;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
use App\Models\User;
use App\Roles\Models\Role;
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
                $user->billingCompany()->associate($userWrapper->getBillingCompanyId());

                $user->billingCompanies()->syncWithPivotValues(
                    $userWrapper->getBillingCompanyId(),
                    $userWrapper->getBillingCompanyData(),
                    false,
                );

                $roles = $userWrapper->getRoles()
                    ->map(function (Role $role) use ($user) {
                        $user->attachPermission($role->permissions);

                        return $role->id;
                    })
                    ->toArray();
                $user->syncRoles($roles);

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
            }));
        });
    }

    private function getProfile(StoreUserWrapper $userWrapper): ?Profile
    {
        $profile = Profile::query()
            ->whereHas(
                'contacts',
                function (Builder $query) use ($userWrapper) {
                    $query->where('email', $userWrapper->getEmail());
                }
            )
            ->first(['id']);

        return tap(Profile::query()->updateOrCreate(['id' => $profile?->id],
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
            $userWrapper->getSocialMedias()->each(function ($socialM) use ($profile) {
                $socialNetwork = SocialNetwork::whereName($socialM['name'])->first();
                if (isset($socialNetwork)) {
                    SocialMedia::updateOrCreate([
                        'profile_id' => $profile->id,
                        'social_network_id' => $socialNetwork->id,
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