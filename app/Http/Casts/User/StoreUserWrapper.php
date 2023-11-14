<?php

declare(strict_types=1);

namespace App\Http\Casts\User;

use App\Enums\User\UserType;
use App\Http\Casts\CastsRequest;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class StoreUserWrapper extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->has('billing_company_id')
            ? $this->getInt('billing_company_id')
            : $this->user->billing_company_id;
    }

    public function getMembershipRoles(): array
    {
        return $this->getCollect('roles')->contains(3)
            ? $this->get('memberships')
            : [];
    }

    public function getData(): Collection
    {
        return collect([
            'usercode' => generateNewCode('US', 5, date('Y'), User::class, 'usercode'),
            'email' => $this->get('email'),
            'language' => $this->get('language') ?? 'en',
            'status' => true,
            'userkey' => encrypt(uniqid('', true)),
            'type' => $this->get('user_type'),
            'billing_company_id' => $this->getBillingCompanyId(),
        ]);
    }

    public function getType(): UserType
    {
        return UserType::tryFrom($this->getInt('user_type'));
    }

    public function getRoles(): Collection
    {
        return $this->getCollect('roles');
    }

    public function getEmail(): ?string
    {
        return $this->get('email');
    }

    public function getProfileData(): array
    {
        return $this->getCollect('profile')
            ->only([
                'ssn',
                'first_name',
                'middle_name',
                'last_name',
                'sex',
                'date_of_birth',
            ])
            ->toArray();
    }

    public function getProfileId(): ?int
    {
        return $this->getCollect('profile')->get('id');
    }

    public function getSocialMedias(): Collection
    {
        return collect($this->getCollect('profile')
            ->get('social_medias'));
    }

    public function getContact(): Collection
    {
        return $this->getCollect('contact');
    }

    public function getAddress(): Collection
    {
        return $this->getCollect('address');
    }
}
