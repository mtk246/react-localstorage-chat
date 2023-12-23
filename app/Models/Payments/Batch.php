<?php

declare(strict_types=1);

namespace App\Models\Payments;

use App\Enums\Payments\BatchStateType;
use App\Models\BillingCompany;
use App\Models\Company;
use App\Models\User;
use Cknow\Money\Casts\MoneyDecimalCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Date;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Payments\Batch.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $posting_date
 * @property string $currency
 * @property \Cknow\Money\Money|null $amount
 * @property BatchStateType $status
 * @property int $company_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $close_date
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property BillingCompany $billingCompany
 * @property Company $company
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payments\Eob> $eobs
 * @property int|null $eobs_count
 * @property array<key, string> $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payments\Payment> $payments
 * @property int|null $payments_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Batch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Batch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Batch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereCloseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch wherePostingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Batch extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    protected $table = 'payment_batches';

    protected $fillable = [
        'name',
        'posting_date',
        'currency',
        'amount',
        'status',
        'company_id',
        'billing_company_id',
        'close_date',
    ];

    protected $casts = [
        'posting_date' => 'date',
        'amount' => MoneyDecimalCast::class.':currency',
        'status' => BatchStateType::class,
        'close_date' => 'date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'payment_batch_id');
    }

    public function eobs(): HasManyThrough
    {
        return $this->hasManyThrough(Eob::class, Payment::class, 'payment_batch_id');
    }

    public function close(string $date): self
    {
        $this->status = BatchStateType::COMPLETED->value;
        $this->close_date = $date;

        $this->save();

        return $this;
    }

    /** @return array<key, string> */
    public function getLastModifiedAttribute(): array
    {
        $lastModified = $this->audits()->latest()->first();

        if (isset($lastModified->user_id)) {
            $user = User::find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles()?->get(['name'])->pluck('name'),
            ];
        }

        return [
            'user' => 'Console',
            'roles' => [],
        ];
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'posting_date' => $this->posting_date,
            'currency' => $this->currency,
            'amount' => $this->amount?->getAmount(),
            'status' => $this->status,
            'payments' => $this->payments?->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'company.name' => $this->company->name,
            'company.code' => $this->company->code,
            'company.npi' => $this->company->npi,
            'company.ein' => $this->company->ein,
            'company.clia' => $this->company->clia,
            'billing_company.id' => $this->billing_company_id,
            'billing_company.name' => $this->billingCompany->name,
        ];
    }
}
