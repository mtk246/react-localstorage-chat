<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\PrivateNote;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimStatusClaim.
 *
 * @property int $id
 * @property int $claim_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $claim_status_type
 * @property int|null $claim_status_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Claims\Claim $claim
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimCheckStatus> $claimCheckStatus
 * @property int|null $claim_check_status_count
 * @property Model|\Eloquent $claimStatus
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereClaimStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereClaimStatusType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ClaimStatusClaim extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'claim_status_claim';

    protected $fillable = [
        'claim_id',
        'claim_status_type',
        'claim_status_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

    /**
     * ClaimStatusClaim belongs to Claim.
     */
    public function claim(): BelongsTo
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * Get all of the claimCheckStatus for the ClaimStatusClaim.
     */
    public function claimCheckStatus(): HasMany
    {
        return $this->hasMany(ClaimCheckStatus::class);
    }

    /**
     * ClaimStatusClaim belongs to ClaimStatus.
     */
    public function claimStatus(): BelongsTo
    {
        return $this->morphTo();
    }

    /**
     * ClaimStatusClaim morphs many privateNotes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function privateNotes()
    {
        return $this->morphMany(PrivateNote::class, 'publishable');
    }

    public function getLastModifiedAttribute()
    {
        $record = [
            'user' => '',
            'roles' => [],
        ];
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return [
                'user' => 'Console',
                'roles' => [],
            ];
        } else {
            $user = \App\Models\User::find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles()?->get(['name'])->pluck('name'),
            ];
        }
    }
}
