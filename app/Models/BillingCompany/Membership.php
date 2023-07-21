<?php

declare(strict_types=1);

namespace App\Models\BillingCompany;

use App\Models\BillingCompany;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\BillingCompany\Membership.
 *
 * @property BillingCompany $billingCompany
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany\MembershipRole> $roles
 * @property int|null $roles_count
 * @property User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
 *
 * @mixin \Eloquent
 */
final class Membership extends Pivot
{
    // use HasFactory;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        'status',
        'user_id',
        'billing_company_id',
    ];

    protected $appends = [
        'roles',
    ];

    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roles(): ?BelongsToMany
    {
        return $this->belongsToMany(
            related: MembershipRole::class,
            table: 'membership_role_user',
            foreignPivotKey: 'billing_company_user_id',
            relatedPivotKey: 'membership_role_id',
        );
    }

    public function getRolesAttribute()
    {
        return $this->roles()->get();
    }
}
