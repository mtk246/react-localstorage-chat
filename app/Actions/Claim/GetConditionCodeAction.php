<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class GetConditionCodeAction
{
    public function all(?string $search): Collection
    {
        return TypeCatalog::query()
            ->whereHas('type', function (Builder $query) {
                $query->where('description', 'Condition code');
            })
            ->when(isset($search), function (Builder $query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('code', 'LIKE', strtoupper("%$search%"))
                        ->orWhere(DB::Raw('LOWER(description)'), 'LIKE', [strtolower("%$search%")]);
                });
            })
            ->get(['id', 'code', DB::Raw("CONCAT(code, ' - ', description) AS name")]);
    }
}
