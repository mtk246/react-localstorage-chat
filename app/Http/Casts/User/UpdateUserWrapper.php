<?php

declare(strict_types=1);

namespace App\Http\Casts\User;

use App\Http\Casts\CastsRequest;
use App\Roles\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class UpdateUserWrapper extends CastsRequest
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
            'language' => $this->get('language') ?? 'en',
            'status' => true,
        ]);
    }

    public function getRoles(): Collection
    {
        return $this->getCollect('roles')
            ->filter(fn (string $name) => 'Patient' !== $name || 'Health Professional' !== $name)
            ->map(fn (string $name) => Role::whereName($name)->first());
    }

    public function getEmail(): string
    {
        return $this->getCollect('profile')->get('email');
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
