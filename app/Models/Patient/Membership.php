<?php

declare(strict_types=1);

namespace App\Models\Patient;

use App\Models\User\Role;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\Patient\Membership.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, Role> $roles
 * @property int|null $roles_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
 *
 * @mixin \Eloquent
 */
final class Membership extends Pivot
{
    public $incrementing = true;

    protected $table = 'patient_memberships';

    protected $appends = [
        'roles',
    ];

    public function roles(): ?MorphToMany
    {
        return $this->morphToMany(Role::class, 'rollable')->withTimestamps();
    }

    public function getRolesAttribute()
    {
        return $this->roles()->get();
    }
}
