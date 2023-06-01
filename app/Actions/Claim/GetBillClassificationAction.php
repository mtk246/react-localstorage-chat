<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\TypeCatalog;

final class GetBillClassificationAction
{
    public function all()
    {
        $response = TypeCatalog::query()->whereHas('type', function ($q) {
            $q->where('description', 'Bill classification');
        })->select('id', 'code', 'description as name')->get()->toArray();

        return $response;
    }
}
