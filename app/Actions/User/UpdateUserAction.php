<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Http\Casts\User\UpdateUserWrapper;
use App\Http\Resources\User\UserResource;
use App\Models\Profile;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
use App\Models\User;
use App\Roles\Models\Role;
use Illuminate\Support\Facades\DB;

final class UpdateUserAction
{
    public function invoke(UpdateUserWrapper $userWrapper, User $user): UserResource
    {
        return DB::transaction(function () use ($userWrapper, $user) {
            $this->getProfile($userWrapper, $user);

            $user->update($userWrapper->getData()->toArray());

            $user->billingCompany()->attach($userWrapper->getBillingCompanyId());

            $user->billingCompanies()->syncWithPivotValues(
                $userWrapper->getBillingCompanyId(),
                $userWrapper->getBillingCompanyData(),
                false,
            );

            $roles = $userWrapper->getRoles()
                ->map(function (Role $role) use ($user) {
                    $role->permissions->each(function ($permission) use ($user) {
                        $user->attachPermission($permission);
                    });

                    return $role->id;
                })
                ->toArray();
            $user->syncRoles($roles);

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
