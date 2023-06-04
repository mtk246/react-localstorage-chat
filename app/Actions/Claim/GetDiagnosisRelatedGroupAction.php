<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class GetDiagnosisRelatedGroupAction
{
    public function all(array $data): Collection
    {
        /** @todo Agregar relación de la calisificacion entre el diagnostico principal y los DRG */
        $diagnosis = $data['diagnosis_id'] ?? null;

        return TypeCatalog::query()->whereHas('type', function ($q) {
            $q->where('description', 'Diagnosis related groups');
        })
        ->get(['id', 'code', DB::Raw("CONCAT(code, ' - ', description) AS name")]);
    }
}
