<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

final class ContractFeePatient extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     *
     * @phpcs:disable SlevomatCodingStandard.Classes.ForbiddenPublicProperty
     */
    public $incrementing = true;

    /** @var string[] */
    protected $fillable = [
        'start_date',
        'end_date',
    ];

    /** @var string[] */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
