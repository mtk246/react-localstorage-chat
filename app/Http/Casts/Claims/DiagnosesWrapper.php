<?php

declare(strict_types=1);

namespace App\Http\Casts\Claims;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;

final class DiagnosesWrapper extends CastsRequest
{
    public function getSyncData(): Collection
    {
        return collect([
            'item' => $this->get('item'),
            'diagnosis_id' => $this->get('diagnosis_id'),
            'admission' => $this->get('admission'),
            'poa' => $this->get('poa'),
        ]);
    }
}
