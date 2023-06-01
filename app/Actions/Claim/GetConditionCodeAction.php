<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class GetConditionCodeAction
{
    public function all(?string $search): Collection
    {
        return TypeCatalog::query()
            ->whereHas('type', function (Builder $query) {
                $query->where('description', 'Condition code');
            })
            ->when(isset($search), function (Builder $query) use ($search) {
                $query->where('code', 'LIKE', strtoupper("%$search%"))
                    ->orWhere('description', 'ILIKE', [strtolower("%$search%")]);
            })
            ->get(['id', 'code', 'description as name']);
    }
}
