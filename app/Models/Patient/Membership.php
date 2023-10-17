<?php

declare(strict_types=1);

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Relations\Pivot;

final class Membership extends Pivot
{
    public $incrementing = true;

    protected $table = 'patient_memberships';
}
