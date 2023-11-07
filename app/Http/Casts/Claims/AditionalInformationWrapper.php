<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;

final class AditionalInformationWrapper extends CastsRequest
{
    public function getData(): array
    {
        return [
            'from' => $this->get('from'),
            'to' => $this->get('to'),
            'diagnosis_related_group_id' => $this->get('diagnosis_related_group_id'),
            'non_covered_charges' => $this->get('non_covered_charges'),
        ];
    }

    public function getExtraInformation(): Collection
    {
        return $this->getCollect('extra_information');
    }

    public function getDateInformation(): array
    {
        return $this->getArray('claim_date_informations');
    }

    public function getPatientInformation(): array
    {
        return $this->getArray('patient_information');
    }

    public function getId(): ?int
    {
        return $this->get('id');
    }
}
