<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimBatch extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "status",
        "shipping_date",
        "fake_transmission",
        "claims_reconciled",
        "company_id",
        "billing_company_id",
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
        return 0;
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
