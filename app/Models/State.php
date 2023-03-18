<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

final class State extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    /** @var string[] */
    protected $fillable = [
        'code',
        'name',
        'country_id',
    ];
}
