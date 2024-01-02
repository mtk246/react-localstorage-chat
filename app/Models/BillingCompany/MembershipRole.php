<?php

declare(strict_types=1);

namespace App\Models\BillingCompany;

use App\Models\BillingCompany;
use App\Models\Permissions\Permission;
use App\Roles\Traits\Slugable;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\BillingCompany\MembershipRole.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property BillingCompany|null $billingCompany
 * @property \Illuminate\Database\Eloquent\Collection<int, Permission> $permits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany\Membership> $memberships
 * @property int|null $memberships_count
 * @property int|null $permits_count
 *
 * @method static \Database\Factories\BillingCompany\MembershipRoleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class MembershipRole extends Model implements Auditable
{
    use HasFactory;
    use Slugable;
    use AuditableTrait;

    /** @var array */
    protected $fillable = ['name', 'slug', 'description', 'billing_company_id'];

    /** @var array */
    protected $appends = ['permits'];

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Membership::class, 'membership_role_id', 'membership_id');
    }

    public function getPermitsAttribute(): Collection
    {
        return $this->permits()->get();
    }

    public function permits(): MorphMany
    {
        return $this->morphMany(Permission::class, 'permissioned');
    }
}
