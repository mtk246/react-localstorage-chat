<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\BillingCompany;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimSubStatus.
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimStatus> $claimStatuses
 * @property int|null $claim_statuses_count
 * @property mixed $last_modified
 * @property mixed $specific_billing_company
 * @property mixed $status
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimSubStatus whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ClaimSubStatus extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status', 'last_modified', 'specific_billing_company'];

    /**
     * The billingCompanies that belong to the company.
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The claimStatus that belong to the claimSubStatus.
     */
    public function claimStatuses(): BelongsToMany
    {
        return $this->belongsToMany(ClaimStatus::class)->withTimestamps();
    }

    /*
     * Get the claim sub-status's status.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute()
    {
        $billingCompany = auth()->user()?->billingCompanies->first();
        if (is_null($billingCompany)) {
            return false;
        }

        return $this->billingCompanies->find($billingCompany->id)->pivot->status ?? false;
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

    public function getSpecificBillingCompanyAttribute()
    {
        return (count($this->billingCompanies) > 0) ? true : false;
    }

    /**
     * Interact with the claimSubStatus's name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }

    /**
     * Interact with the claimSubStatus's description.
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst(strtolower($value)),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }

    protected function code(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    public function scopeSearch($query, $search)
    {
        if ('' != $search) {
            return $query->whereHas('billingCompanies', function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")]);
            })->orWhereHas('claimStatuses', function ($q) use ($search) {
                $q->whereRaw('LOWER(status) LIKE (?)', [strtolower("%$search%")]);
            })->orWhereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")])
                ->orWhereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }
}
