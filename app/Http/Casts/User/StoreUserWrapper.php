<?php

declare(strict_types=1);

namespace App\Http\Casts\User;

use App\Http\Casts\CastsRequest;
use App\Models\User;
use App\Roles\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class StoreUserWrapper extends CastsRequest
{
    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->get('billing_company_id')
            ? (int) $this->get('billing_company_id')
            : $this->user->billingCompany->id;
    }

    public function getBillingCompanyData(): array
    {
        return $this->getCollect('roles')->contains('Billing Worker')
            ? ['memberships' => $this->get('memberships')]
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
        ]);
    }

    public function getRoles(): Collection
    {
        return $this->getCollect('roles')
            ->map(fn (string $id) => Role::query()
                ->whereId($id)
                ->whereNotIn('name', ['Patient', 'Health Professional'])
                ->first()
            )
            ->filter(fn (?Role $role) => !is_null($role));
    }

    public function getEmail(): string
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
