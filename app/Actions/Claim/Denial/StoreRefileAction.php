<?php

declare(strict_types=1);

namespace App\Actions\Claim\Denial;

use App\Http\Casts\Claims\DenialRefileWrapper;
use App\Models\Claims\DenialRefile;
use Illuminate\Support\Facades\DB;

final class StoreRefileAction
{
    public function invoke(DenialRefileWrapper $data): DenialRefile
    {
        return DB::transaction(fn () => tap(
            DenialRefile::query()->create($data->getData()),
            function (DenialRefile $refile) {
                $claim = $refile->claim;
                $note = $claim->setStates(2, 1, __('claim.denial.refile.store.note', [
                    'refile_type' => $refile->refile_type,
                    'status' => $claim->status->last()->status,
                    'sub_status' => $claim->subStatus->last()->status,
                ]));

                $refile->privateNotes()->associate($note->id);
            },
        )->refres());
    }
}
