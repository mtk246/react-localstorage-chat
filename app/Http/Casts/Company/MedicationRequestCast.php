<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;

final class MedicationRequestCast extends CastsRequest
{
    public function getId(): ?int
    {
        return array_key_exists('id', $this->inputs)
            ? (int) $this->inputs['id']
            : null;
    }

    public function getDrugCode(): string
    {
        return $this->get('drug_code');
    }

    public function getMeasurementUnitId(): int
    {
        return (int) $this->inputs['measurement_unit_id'];
    }

    public function getUnits(): float
    {
        return (float) $this->inputs['units'];
    }

    public function getUnitsLimit(): ?int
    {
        return array_key_exists('units_limit', $this->inputs)
            ? (int) $this->inputs['units_limit']
            : null;
    }

    public function getLinkSequenceNumber(): ?string
    {
        return array_key_exists('link_sequence_number', $this->inputs)
            ? $this->inputs['link_sequence_number']
            : null;
    }

    public function getPharmacyPrescriptionNumber(): ?string
    {
        return array_key_exists('pharmacy_prescription_number', $this->inputs)
            ? $this->inputs['pharmacy_prescription_number']
            : null;
    }

    public function getRepackagedNDC(): bool
    {
        return array_key_exists('repackaged_NDC', $this->inputs)
            ? (bool) $this->inputs['repackaged_NDC']
            : false;
    }

    public function getCodeNDC(): string
    {
        return $this->getRepackagedNDC()
            ? ($this->get('code_NDC') ?? '')
            : '';
    }

    public function getClaimNoteRequired(): bool
    {
        return array_key_exists('claim_note_required', $this->inputs)
            ? (bool) $this->inputs['claim_note_required']
            : false;
    }

    public function getNote(): ?string
    {
        return $this->getClaimNoteRequired()
            ? $this->get('note')
            : '';
    }
}
