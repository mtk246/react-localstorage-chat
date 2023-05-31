<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\TypeCatalog;

final class GetPatientStatusesAction
{
    public function all()
    {
        $response = TypeCatalog::query()->whereHas('type', function ($q) {
            $q->where('description', 'Patient status code');
        })->select('id', 'code', 'description as name')->get()->toArray();

        return $response;
    }
}
