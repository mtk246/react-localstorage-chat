<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;

final class PaymentAddressCast extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->get('id')
            ? (int) $this->get('id')
            : null;
    }

    public function getAddress(): ?string
    {
        return $this->get('address');
    }

    public function getCity(): ?string
    {
        return $this->get('city');
    }

    public function getState(): ?string
    {
        return $this->get('state');
    }

    public function getZip(): ?string
    {
        return $this->get('zip');
    }

    public function getCountry(): ?string
    {
        return $this->get('country');
    }

    public function getCountrySubdivisionCode(): ?string
    {
        return $this->get('country_subdivision_code');
    }
}
