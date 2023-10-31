<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Enums\User\UserType;
use App\Http\Casts\User\UpdateUserWrapper;
use App\Http\Resources\User\UserResource;
use App\Models\BillingCompany\Membership;
use App\Models\Profile;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class UpdateUserAction
{
    public function invoke(UpdateUserWrapper $userWrapper, User $user): UserResource
    {
        return DB::transaction(function () use ($userWrapper, $user) {
            $this->getProfile($userWrapper, $user);
            $user->update($userWrapper->getData()->toArray());

            $userRoles = $user->roles();
            $rollableType = User::class;

            $user->billingCompany()->disassociate();

            if (UserType::BILLING === $userWrapper->getType()) {
                $user->billingCompany()->associate($userWrapper->getBillingCompanyId());
                $user->billingCompanies()->syncWithoutDetaching($userWrapper->getBillingCompanyId());

                /** @var MorphToMany $userRoles */
                $userRoles = $user
                    ->billingCompanies()
                    ->wherePivot('billing_company_id', $userWrapper->getBillingCompanyId())
                    ->first()
                    ->membership
                    ->roles();

                $rollableType = Membership::class;
            }

            $userRoles?->syncWithPivotValues($userWrapper->getRoles(), ['rollable_type' => $rollableType]);

            $user->touch();

            return new UserResource($user);
        });
    }

    private function getProfile(UpdateUserWrapper $userWrapper, User $user): ?Profile
    {
        return tap($user->profile, function (Profile $profile) use ($userWrapper) {
            $profile->update($userWrapper->getProfileData());
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
