<?php

declare(strict_types=1);

namespace App\Http\Casts\Company;

use App\Http\Casts\CastsRequest;

final class MedicationRequestCast extends CastsRequest
{
    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function getDrugCode(): ?string
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
        return $this->getInt('units_limit');
    }

    public function getLinkSequenceNumber(): ?string
    {
        return $this->get('link_sequence_number');
    }

    public function getPharmacyPrescriptionNumber(): ?string
    {
        return $this->get('pharmacy_prescription_number');
    }

    public function getRepackagedNDC(): bool
    {
        return $this->getBool('repackaged_NDC');
    }

    public function getCodeNDC(): string
    {
        return $this->getRepackagedNDC()
            ? ($this->get('code_NDC') ?? '')
            : '';
    }

    public function getClaimNoteRequired(): bool
    {
        return $this->getBool('claim_note_required');
    }

    public function getNote(): ?string
    {
        return $this->get('note');
    }
}
