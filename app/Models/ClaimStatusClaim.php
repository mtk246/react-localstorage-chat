<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClaimStatusClaim extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        "claim_id",
        "claim_status_id"
    ];
}
