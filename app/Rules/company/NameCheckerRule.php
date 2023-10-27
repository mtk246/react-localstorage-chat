<?php

declare(strict_types=1);

namespace App\Rules\company;

use App\Models\Company;
use Illuminate\Contracts\Validation\Rule;

final class NameCheckerRule implements Rule
{
    public function __construct(
        private readonly ?string $npiCompany,
        private readonly string $npi,
        private readonly string $firstName,
        private readonly ?string $lastName,
        private readonly ?Company $excludedCompany,
    ) {
    }

    /**
     * @param string $attribute
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_null($value) && is_null($this->npiCompany)) {
            return false;
        }

        $name = $this->npiCompany
            ? $value
            : $this->firstName.' '.($this->lastName ?? '').' '.$this->npi;

        return !Company::query()
                ->where('name', $name)
                ->whereNot('id', $this->excludedCompany?->id)
                ->exists();
    }

    /** @return string */
    public function message()
    {
        return 'Company provider name already exist';
    }
}
