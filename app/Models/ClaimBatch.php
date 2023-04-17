<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimBatch
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $shipping_date
 * @property bool $fake_transmission
 * @property int $company_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $claims_reconciled
 * @property int|null $claim_batch_status_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @property-read \App\Models\ClaimBatchStatus|null $claimBatchStatus
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claim> $claims
 * @property-read int|null $claims_count
 * @property-read \App\Models\Company $company
 * @property-read mixed $last_modified
 * @property-read mixed $total_accepted
 * @property-read mixed $total_accepted_by_clearing_house
 * @property-read mixed $total_accepted_by_payer
 * @property-read mixed $total_claims
 * @property-read mixed $total_denied
 * @property-read mixed $total_denied_by_clearing_house
 * @property-read mixed $total_denied_by_payer
 * @property-read mixed $total_processed
 * @property-read mixed $claim_ids
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereClaimBatchStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereClaimsReconciled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereFakeTransmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereShippingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claim> $claims
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claim> $claims
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claim> $claims
 * @mixin \Eloquent
 */
class ClaimBatch extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "shipping_date",
        "fake_transmission",
        "claims_reconciled",
        "company_id",
        "billing_company_id",
        "claim_batch_status_id",
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'total_processed', 'claim_ids', 'total_claims', 'total_accepted',
        'total_denied', 'total_accepted_by_clearing_house', 'total_denied_by_clearing_house',
        'total_accepted_by_payer', 'total_denied_by_payer', 'last_modified'
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
            ->get()->pluck('id')->toArray();
        $data = $this->claims()->whereHas("claimStatusClaims", function ($query) use ($statuses) {
            $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                ->whereIn("claim_status_claim.claim_status_id", $statuses)
                ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
        });
        return count($data);
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
