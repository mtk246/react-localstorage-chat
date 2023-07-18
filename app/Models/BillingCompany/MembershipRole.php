<?php

declare(strict_types=1);

namespace App\Models\BillingCompany;

use App\Models\BillingCompany;
use App\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\BillingCompany\MembershipRole.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property BillingCompany $billingCompany
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany\Membership> $memberships
 * @property int|null $memberships_count
 * @property mixed $slug
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipRole query()
 *
 * @mixin \Eloquent
 */
final class MembershipRole extends Model
{
    use HasFactory;
    use Slugable;
    use AuditableTrait;

    /** @var array */
    protected $fillable = ['name', 'slug', 'description', 'billing_company_id'];

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Membership::class, 'membership_role_id', 'membership_id');
    }
}
