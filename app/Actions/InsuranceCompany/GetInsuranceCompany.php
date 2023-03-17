<?php

declare(strict_types=1);

namespace App\Actions\InsuranceCompany;

use App\Models\InsuranceCompany;
use Illuminate\Database\Eloquent\Collection;

final class GetInsuranceCompany
{
    public function filtered(array $request): Collection
    {
        return InsuranceCompany::query()
            ->whereNotIn('id', $request['ids'])
            ->get(['id', 'name'])
            ->setHidden([
                'last_modified',
                'contact',
                'address',
                'contacts',
                'addresses',
            ]);
    }
}
