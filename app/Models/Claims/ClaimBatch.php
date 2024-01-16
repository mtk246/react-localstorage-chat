<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\BillingCompany;
use App\Models\Company;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimBatch.
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
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property BillingCompany|null $billingCompany
 * @property \App\Models\Claims\ClaimBatchStatus|null $claimBatchStatus
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\Claim> $claims
 * @property int|null $claims_count
 * @property Company $company
 * @property mixed $last_modified
 * @property mixed $total_accepted
 * @property mixed $total_accepted_by_clearing_house
 * @property mixed $total_accepted_by_payer
 * @property mixed $total_claims
 * @property mixed $total_denied
 * @property mixed $total_denied_by_clearing_house
 * @property mixed $total_denied_by_payer
 * @property mixed $total_processed
 * @property mixed $claim_ids
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatch search($search)
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
 *
 * @mixin \Eloquent
 */
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
                ->whereRaw(
                    'claim_status_claim.created_at = (
                        SELECT MAX(created_at)
                        FROM claim_status_claim
                        WHERE claim_status_claim.claim_id = claims.id AND claim_status_claim.claim_status_type = ?)',
                    [
                        ClaimStatus::class,
                    ]
                );
        });

        return count($data->get());
    }

    public function getTotalClaimsAttribute()
    {
        return count($this->claims ?? []);
    }

    public function getTotalAcceptedAttribute()
    {
        $statuses = ClaimStatus::where('status', 'Approved')
            ->orWhere('status', 'Submitted')
            ->get()->pluck('id')->toArray();
        $data = $this->claims()->whereHas('claimStatusClaims', function ($query) use ($statuses) {
            $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                ->whereIn('claim_status_claim.claim_status_id', $statuses)
                ->whereRaw(
                    'claim_status_claim.created_at = (
                        SELECT MAX(created_at)
                        FROM claim_status_claim
                        WHERE claim_status_claim.claim_id = claims.id AND claim_status_claim.claim_status_type = ?)',
                    [
                        ClaimStatus::class,
                    ]
                );
        });

        return count($data->get());
    }

    public function getTotalDeniedAttribute()
    {
        $statuses = ClaimStatus::where('status', 'Rejected')
            ->get()->pluck('id')->toArray();
        $data = $this->claims()->whereHas('claimStatusClaims', function ($query) use ($statuses) {
            $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                ->whereIn('claim_status_claim.claim_status_id', $statuses)
                ->whereRaw(
                    'claim_status_claim.created_at = (
                        SELECT MAX(created_at)
                        FROM claim_status_claim
                        WHERE claim_status_claim.claim_id = claims.id AND claim_status_claim.claim_status_type = ?)',
                    [
                        ClaimStatus::class,
                    ]
                );
        });

        return count($data->get());
    }

    public function getTotalAcceptedByClearingHouseAttribute()
    {
        $statuses = ClaimStatus::where('status', 'Approved')
            ->orWhere('status', 'Submitted')
            ->get()->pluck('id')->toArray();
        $data = $this->claims()->whereHas('claimStatusClaims', function ($query) use ($statuses) {
            $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                ->whereIn('claim_status_claim.claim_status_id', $statuses)
                ->whereRaw(
                    'claim_status_claim.created_at = (
                        SELECT MAX(created_at)
                        FROM claim_status_claim
                        WHERE claim_status_claim.claim_id = claims.id AND claim_status_claim.claim_status_type = ?)',
                    [
                        ClaimStatus::class,
                    ]
                );
        });

        return count($data->get());
    }

    public function getTotalDeniedByClearingHouseAttribute()
    {
        $statuses = ClaimStatus::where('status', 'Rejected')
            ->get()->pluck('id')->toArray();
        $data = $this->claims()->whereHas('claimStatusClaims', function ($query) use ($statuses) {
            $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                ->whereIn('claim_status_claim.claim_status_id', $statuses)
                ->whereRaw(
                    'claim_status_claim.created_at = (
                        SELECT MAX(created_at)
                        FROM claim_status_claim
                        WHERE claim_status_claim.claim_id = claims.id AND claim_status_claim.claim_status_type = ?)',
                    [
                        ClaimStatus::class,
                    ]
                );
        });

        return count($data->get());
    }

    public function getTotalAcceptedByPayerAttribute()
    {
        $statuses = ClaimStatus::where('status', 'Complete')
            ->get()->pluck('id')->toArray();
        $data = $this->claims()->whereHas('claimStatusClaims', function ($query) use ($statuses) {
            $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                ->whereIn('claim_status_claim.claim_status_id', $statuses)
                ->whereRaw(
                    'claim_status_claim.created_at = (
                        SELECT MAX(created_at)
                        FROM claim_status_claim
                        WHERE claim_status_claim.claim_id = claims.id AND claim_status_claim.claim_status_type = ?)',
                    [
                        ClaimStatus::class,
                    ]
                );
        });

        return count($data->get());
    }

    public function getTotalDeniedByPayerAttribute()
    {
        $statuses = ClaimStatus::where('status', 'Denied')
            ->get()->pluck('id')->toArray();
        $data = $this->claims()->whereHas('claimStatusClaims', function ($query) use ($statuses) {
            $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                ->whereIn('claim_status_claim.claim_status_id', $statuses)
                ->whereRaw(
                    'claim_status_claim.created_at = (
                        SELECT MAX(created_at)
                        FROM claim_status_claim
                        WHERE claim_status_claim.claim_id = claims.id AND claim_status_claim.claim_status_type = ?)',
                    [
                        ClaimStatus::class,
                    ]
                );
        });

        return count($data->get());
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
            $user = \App\Models\User::find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles()?->get(['name'])->pluck('name'),
            ];
        }
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            return $query
                ->where(function ($query) use ($search) {
                    $this->searchByBatch($query, $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $this->searchByCompany($query, $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $this->searchByStatus($query, $search);
                });
        });
    }

    protected function searchByBatch($query, $search)
    {
        $isDate = true;
        $formattedDate = '';
        try {
            $formattedDate = Carbon::createFromFormat('m/d/Y', $search)?->format('Y-m-d');
        } catch (\Throwable $th) {
            $isDate = false;
        }

        $query->where('code', 'LIKE', "%$search%")
            ->orWhereRaw('LOWER(name) LIKE ?', [strtolower("%$search%")])
            ->orWhere(function ($query) use ($formattedDate, $isDate) {
                $query->when($isDate, function ($query) use ($formattedDate) {
                    $query->where('shipping_date', 'LIKE', "%$formattedDate%");
                });
            })
            ->orWhere(function ($query) use ($search) {
                $query->when(in_array($search, ['1500', 'UB04']), function ($query) use ($search) {
                    $query->whereHas('claims', function ($q) use ($search) {
                        $subSearch = match ($search) {
                            '1500' => 1,
                            'UB04' => 2,
                        };
                        $q->where('type', $subSearch);
                    });
                });
            })
            ->orWhere(function ($query) use ($search) {
                $query->when(in_array(strtoupper($search), ['P', 'E']), function ($query) use ($search) {
                    $query->where('fake_transmission', match (strtoupper($search)) {
                        'P' => true,
                        'E' => false,
                    });
                });
            });
    }

    protected function searchByCompany($query, $search)
    {
        $query->with(['company'])
            ->whereHas('company', function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', [strtolower("%$search%")]);
            });
    }

    protected function searchByStatus($query, $search)
    {
        $query->with(['claimBatchStatus'])
            ->whereHas('claimBatchStatus', function ($q) use ($search) {
                $q->whereRaw('LOWER(status) LIKE ?', [strtolower("%$search%")]);
            });
    }
}
