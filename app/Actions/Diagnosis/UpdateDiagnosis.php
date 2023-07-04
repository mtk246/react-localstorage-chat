<?php

declare(strict_types=1);

namespace App\Actions\Diagnosis;

use App\Http\Resources\Diagnoses\NotesResource;
use App\Models\Diagnosis;


final class UpdateDiagnosis
{
    public function notes(Diagnosis $diagnosis, $data): NotesResource
    {
        $diagnosis->publicNote()->updateOrCreate([
            'publishable_id' => $diagnosis->id,
            'publishable_type' => Diagnosis::class,
        ], [
            'note' => $data['public_note'],
        ]);

        return new NotesResource($diagnosis);
    }
}
