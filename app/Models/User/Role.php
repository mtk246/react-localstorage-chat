<?php

declare(strict_types=1);

namespace App\Models\User;

use App\Enums\User\RoleType;
use App\Models\BillingCompany;
use App\Models\BillingCompany\Membership;
use App\Models\Permissions\Permission;
use App\Models\User;
use App\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\User\Role.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $billing_company_id
 * @property bool $public
 * @property RoleType $type
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property BillingCompany|null $billingCompany
 * @property \Illuminate\Database\Eloquent\Collection<int, Membership> $memberships
 * @property int|null $memberships_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Permission> $permissions
 * @property int|null $permissions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property int|null $users_count
 *
 * @method static \Database\Factories\User\RoleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Role extends Model implements Auditable
{
    use HasFactory;
    use Slugable;
    use AuditableTrait;

    /** @var array */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'billing_company_id',
        'level',
        'type',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'type' => RoleType::class,
    ];

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    public function memberships(): BelongsToMany
    {
        return $this->morphToMany(Membership::class, 'rollable');
    }

    public function users(): BelongsToMany
    {
        return $this->morphToMany(User::class, 'rollable');
    }

    public function permissions(): MorphToMany
    {
        return $this->morphToMany(Permission::class, 'authorizable')->withTimestamps();
    }
}
