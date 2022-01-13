<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\BillingCompanyUser
 *
 * @property int $id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyUser whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyUser whereIDbcu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyUser wherePfkSSN($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyUser whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyUser whereUserId($value)
 */
class BillingCompanyUser extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "billing_company_id",
    ];
    protected $table = "billing_company_users";

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}