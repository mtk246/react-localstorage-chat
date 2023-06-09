<?php

declare(strict_types=1);

namespace App\Models\v2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

final class ClaimBatch extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'code',
        'name',
        'shipping_date',
        'fake_transmission',
        'claims_reconciled',
        'company_id',
        'billing_company_id',
        'claim_batch_status_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'total_processed', 'claim_ids', 'total_claims', 'total_accepted',
        'total_denied', 'total_accepted_by_clearing_house', 'total_denied_by_clearing_house',
        'total_accepted_by_payer', 'total_denied_by_payer', 'last_modified',
    ];

    /**
     * ClaimBatch belongs to Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * ClaimBatch belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * ClaimBatch belongs to ClaimBatchStatus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimBatchStatus()
    {
        return $this->belongsTo(ClaimBatchStatus::class);
    }

    /**
     * The claims that belong to the ClaimBatch.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function claims()
    {
        return $this->belongsToMany(Claim::class)->withTimestamps();
    }

    public function getTotalProcessedAttribute()
    {
        $statuses = ClaimStatus::where('status', 'Approved')
            ->orWhere('status', 'Rejected')
            ->orWhere('status', 'Submitted')
            ->get()->pluck('id')->toArray();
        $data = $this->claims()->whereHas('claimStatusClaims', function ($query) use ($statuses) {
            $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                ->whereIn('claim_status_claim.claim_status_id', $statuses)
                ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
        });

        return count($data->get());
    }

    public function getTotalClaimsAttribute()
    {
        return count($this->claims ?? []);
    }

    public function getTotalAcceptedAttribute()
    {
        return 0;
    }

    public function getTotalDeniedAttribute()
    {
        return 0;
    }

    public function getTotalAcceptedByClearingHouseAttribute()
    {
        return 0;
    }

    public function getTotalDeniedByClearingHouseAttribute()
    {
        return 0;
    }

    public function getTotalAcceptedByPayerAttribute()
    {
        return 0;
    }

    public function getTotalDeniedByPayerAttribute()
    {
        return 0;
    }

    public function getclaimIdsAttribute()
    {
        $ids = [];
        foreach ($this->claims as $claim) {
            array_push($ids, $claim->id);
        }

        return $ids;
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
