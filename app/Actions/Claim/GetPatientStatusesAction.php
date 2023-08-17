<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class GetPatientStatusesAction
{
    public function all(): Collection
    {
        return TypeCatalog::query()->whereHas('type', function ($q) {
            $q->where('description', 'Patient status code');
        })
        ->get(['id', 'code', DB::Raw("CONCAT(code, ' - ', description) AS name")]);
    }
}
