<?php

declare(strict_types=1);

namespace App\Models\Payments;

use App\Enums\Payments\MethodType;
use App\Enums\Payments\SourceType;
use App\Models\Claims\Claim;
use App\Models\InsurancePlan;
use App\Models\User;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Cknow\Money\Casts\MoneyDecimalCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Payments\Payment.
 *
 * @property int $id
 * @property SourceType $source
 * @property \Illuminate\Support\Carbon $payment_date
 * @property string $currency
 * @property \Cknow\Money\Money|null $total_amount
 * @property string $payment_method
 * @property string|null $reference
 * @property bool $statement
 * @property string|null $note
 * @property int $payment_batch_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $insurance_plan_id
 * @property int|null $order
 * @property MethodType $method
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Payments\Batch $batch
 * @property \App\Models\Payments\Card|null $card
 * @property \Illuminate\Database\Eloquent\Collection<int, Claim> $claims
 * @property int|null $claims_count
 * @property \App\Models\Payments\Eob|null $eobs
 * @property array<key, string> $last_modified
 * @property InsurancePlan|null $insurancePlan
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Payment extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    /** @var string[] */
    protected $fillable = [
        'source',
        'payment_date',
        'currency',
        'total_amount',
        'payment_method',
        'reference',
        'statement',
        'note',
        'payment_batch_id',
        'insurance_plan_id',
        'order',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'payment_date' => 'date',
        'total_amount' => MoneyDecimalCast::class.':currency',
        'statement' => 'boolean',
        'source' => SourceType::class,
        'method' => MethodType::class,
    ];

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'payment_batch_id');
    }

    public function insurancePlan(): BelongsTo
    {
        return $this->belongsTo(InsurancePlan::class);
    }

    public function card(): HasOne
    {
        return $this->hasOne(Card::class);
    }

    public function eobs(): HasOne
    {
        return $this->hasOne(Eob::class);
    }

    public function claims(): BelongsToMany
    {
        return $this->belongsToMany(Claim::class, 'claim_payment')
            ->using(ClaimPayment::class)
            ->withPivot(['id'])
            ->withTimestamps()
            ->as('payment');
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
}