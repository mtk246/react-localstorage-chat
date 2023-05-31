<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\TypeCatalog;

final class GetDiagnosisRelatedGroupAction
{
    public function all(array $data)
    {
        /** @todo Agregar relación de la calisificacion entre el diagnostico principal y los DRG */
        $diagnosis = $data['diagnosis_id'] ?? null;
        $response = TypeCatalog::query()->whereHas('type', function ($q) {
            $q->where('description', 'Diagnosis related groups');
        })->select('id', 'code', 'description as name')->get()->toArray();

        return $response;
    }
}
