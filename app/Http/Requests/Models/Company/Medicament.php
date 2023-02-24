<?php

declare(strict_types = 1);

namespace App\Http\Requests\Models\Company;

final class Medicament
{
    public function __construct(
        private array $medicament,
    ){ }

}
