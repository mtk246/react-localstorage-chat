<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimStatusClaim
 *
 * @property int $id
 * @property int $claim_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $claim_status_type
 * @property int|null $claim_status_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Claim $claim
 * @property-read Model|\Eloquent $claimStatus
 * @property-read mixed $last_modified
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read int|null $private_notes_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereClaimStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereClaimStatusType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusClaim whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @mixin \Eloquent
 */
class ClaimStatusClaim extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = "claim_status_claim";
    
    protected $fillable = [
        "claim_id",
        "claim_status_type",
        "claim_status_id"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

    /**
     * ClaimStatusClaim belongs to Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claim(): BelongsTo
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * ClaimStatusClaim belongs to ClaimStatus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
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
            'user'  => '',
            'roles' => [],
        ];
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return [
                'user'  => 'Console',
                'roles' => [],
            ];
        } else {
            $user = User::with(['profile', 'roles'])->find($lastModified->user_id);
            return [
                'user'  => $user->profile->first_name . ' ' . $user->profile->last_name,
                'roles' => $user->roles,
            ];
        }
    }
}
