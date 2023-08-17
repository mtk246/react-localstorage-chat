<?php

declare(strict_types=1);

namespace App\Actions\InsuranceCompany;

use App\Models\InsuranceCompany;
use Illuminate\Database\Eloquent\Collection;

final class GetInsuranceCompany
{
    public function search(array $request): Collection
    {
        $query = InsuranceCompany::query();

        if (isset($request['name'])) {
            $query->where('name', 'like', "%{$request['name']}%");
        }

        if (isset($request['exclude'])) {
            $query->whereNotIn('id', $request['exclude']);
        }

        return $query->get(['id', 'name'])
            ->setHidden(['status', 'last_modified']);
    }
}
