<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;

final class ContactCast extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->get('id')
            ? (int) $this->get('id')
            : null;
    }

    public function getContactName(): ?string
    {
        return $this->get('contact_name');
    }

    public function getPhone(): ?string
    {
        return $this->get('phone');
    }

    public function getMobile(): ?string
    {
        return $this->get('mobile');
    }

    public function getFax(): ?string
    {
        return $this->get('fax');
    }

    public function getEmail(): ?string
    {
        return $this->get('email');
    }

    public function getContactData(): array
    {
        return
            ($this->getId() ? ['id' => $this->getId()] : [])
            + ($this->getContactName() ? ['contact_name' => $this->getContactName()] : [])
            + ($this->getPhone() ? ['phone' => $this->getPhone()] : [])
            + ($this->getMobile() ? ['mobile' => $this->getMobile()] : [])
            + ($this->getFax() ? ['fax' => $this->getFax()] : [])
            + ($this->getEmail() ? ['email' => $this->getEmail()] : []);
    }
}
