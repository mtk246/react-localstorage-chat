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
            ->map(fn (array $service) => [
                'id' => $service['id'],
                'from_service' => $service['from_service'],
                'to_service' => $service['to_service'],
                'procedure_id' => $service['procedure_id'],
                'revenue_code_id' => $service['revenue_code_id'],
                'price' => $service['price'],
                'days_or_units' => $service['days_or_units'],
                'total_charge' => $service['total_charge'],
                'copay' => $service['copay'],
            ]);
    }

    public function getDiagnoses(): Collection
    {
        return $this->getCollect('diagnoses')
            ->mapWithKeys(fn (array $diagnosis) => [
                $diagnosis['diagnosis_id'] => [
                    'item' => $diagnosis['item'],
                    'admission' => $diagnosis['admission'],
                    'poa' => $diagnosis['poa'],
                ],
            ]);
    }
}
