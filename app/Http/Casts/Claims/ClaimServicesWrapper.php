<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;

final class ClaimServicesWrapper extends CastsRequest
{
    public function getData(): array
    {
        return [
            'diagnosis_related_group_id' => $this->get('diagnosis_related_group_id'),
            'non_covered_charges' => $this->get('non_covered_charges'),
        ];
    }

    public function getService(): Collection
    {
        return $this->getCollect('services')
            ->map(function (array $service) {
                $model = [
                    'from_service' => $service['from_service'],
                    'to_service' => $service['to_service'],
                    'procedure_id' => $service['procedure_id'],
                    'revenue_code_id' => $service['revenue_code_id'] ?? null,
                    'price' => $service['price'],
                    'days_or_units' => $service['days_or_units'],
                    'total_charge' => $service['total_charge'] ?? 0,
                    'copay' => $service['copay'],
                    'modifier_ids' => json_encode($service['modifier_ids'] ?? []),
                    'place_of_service_id' => $service['place_of_service_id'] ?? null,
                    'type_of_service_id' => $service['type_of_service_id'] ?? null,
                    'diagnostic_pointers' => json_encode($service['diagnostic_pointers'] ?? []),
                    'emg' => $service['emg'] ?? null,
                    'epsdt_id' => $service['epsdt_id'] ?? null,
                    'family_planning_id' => $service['family_planning_id'] ?? null,
                ];
                if (!empty($service['id'])) {
                    $model['id'] = $service['id'];
                }

                return $model;
            });
    }

    public function getDiagnoses(): Collection
    {
        return $this->getCollect('diagnoses')
            ->mapWithKeys(fn (array $diagnosis) => [
                $diagnosis['diagnosis_id'] => [
                    'item' => $diagnosis['item'],
                    'admission' => $diagnosis['admission'] ?? null,
                    'poa' => $diagnosis['poa'] ?? null,
                ],
            ]);
    }
}
