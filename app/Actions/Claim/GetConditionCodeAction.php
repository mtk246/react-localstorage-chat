<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\TypeCatalog;

final class GetConditionCodeAction
{
    public function all(array $data)
    {
        $search = $data['search'] ?? null;
        $response = isset($search)
            ? TypeCatalog::query()->whereHas('type', function ($q) {
                $q->where('description', 'Condition code');
            })->where('code', 'LIKE', strtoupper("%$search%"))->orWhereRaw('LOWER(description) LIKE (?)', [strtolower("%$search%")])->select('id', 'code', 'description as name')->get()->toArray()
            : TypeCatalog::query()->whereHas('type', function ($q) {
                $q->where('description', 'Condition code');
            })->select('id', 'code', 'description as name')->get()->toArray();

        return $response;
    }
}
