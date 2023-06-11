<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

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
            $user = \App\Models\User::with(['profile', 'roles'])->find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles,
            ];
        }
    }
}
