<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BillingCompanyKeyboardShortcut extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        "key",
        "billing_company_id",
        "keyboard_shortcut_id"
    ];
}
