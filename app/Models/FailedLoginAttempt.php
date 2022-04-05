<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class FailedLoginAttempt extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'status',
        'user_id',
    ];

    /**
     * Attributes to exclude from the Audit.
     * @var array
     */
    protected $auditExclude = [
        'status',
    ];

    /**
     * FailedLoginAttempt belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
