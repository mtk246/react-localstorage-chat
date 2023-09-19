<?php

declare(strict_types=1);

namespace App\Models\Permissions;

use App\Models\BillingCompany;
use App\Models\BillingCompany\MembershipRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Permissions\Permission.
 *
 * @property int $id
 * @property string $module
 * @property int|null $billing_company_id
 * @property array $permission
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $permissioned_type
 * @property int $permissioned_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property BillingCompany|null $billingCompany
 * @property Model|\Eloquent $role
 * @property Model|\Eloquent $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission wherePermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission wherePermissionedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission wherePermissionedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Permission extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'permission';

    protected $fillable = [
        'module',
        'permission',
        'permissioned_type',
        'permissioned_id',
        'billing_company_id',
    ];

    protected $casts = [
        'permission' => 'array',
    ];

    public function role(): MorphTo
    {
        return $this->morphTo(MembershipRole::class, 'permissioned');
    }

    public function user(): MorphTo
    {
        return $this->morphTo(User::class, 'permissioned');
    }

    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }
}
