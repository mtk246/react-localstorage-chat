<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claims\NoteRequestWrapper;
use App\Models\Claims\Claim;
use Illuminate\Support\Facades\DB;

final class CreateNoteAction
{
    public function invoke(Claim $claim, NoteRequestWrapper $claimData): Claim
    {
        return DB::transaction(function () use (&$claim, $claimData) {
            $claim->setPrivateNote($claimData->getPrivateNote());

            return $claim->load(['demographicInformation', 'service', 'insurancePolicies']);
        });
    }
}
