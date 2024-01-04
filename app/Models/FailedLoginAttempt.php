<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\FailedLoginAttempt.
 *
 * @property int $id
 * @property bool $status
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt query()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedLoginAttempt whereUserId($value)
 *
 * @mixin \Eloquent
 */
class FailedLoginAttempt extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'status',
        'user_id',
    ];

    /**
     * Attributes to exclude from the Audit.
     *
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
