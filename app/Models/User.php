<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\User\UserType;
use App\Events\User\UpdateEvent;
use App\Models\BillingCompany\Membership;
use App\Models\Permissions\Permission;
use App\Models\Reports\Preset;
use App\Models\User\Role;
use App\Roles\Traits\HasRoleAndPermission;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $token
 * @property bool $isLogged
 * @property bool $isBlocked
 * @property string|null $usercode
 * @property string|null $userkey
 * @property bool $status
 * @property string|null $last_login
 * @property int|null $profile_id
 * @property string|null $last_activity
 * @property int|null $billing_company_id
 * @property UserType $type
 * @property string|null $disabled_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\CustomKeyboardShortcuts> $customKeyboardShortcuts
 * @property int|null $custom_keyboard_shortcuts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Device> $devices
 * @property int|null $devices_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\FailedLoginAttempt> $failedLoginAttempts
 * @property int|null $failed_login_attempts_count
 * @property string $language
 * @property mixed $last_modified
 * @property \Illuminate\Support\Collection|null $permissions
 * @property \Illuminate\Database\Eloquent\Collection<int, Role> $roles
 * @property \App\Models\HealthProfessional|null $healthProfessional
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property int|null $ip_restrictions_count
 * @property \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property int|null $notifications_count
 * @property \App\Models\Patient|null $patient
 * @property \Illuminate\Database\Eloquent\Collection<int, Permission> $permits
 * @property int|null $permits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Preset> $presets
 * @property int|null $presets_count
 * @property \App\Models\Profile|null $profile
 * @property int|null $roles_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property int|null $tokens_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $userPermissions
 * @property int|null $user_permissions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Role> $userRoles
 * @property int|null $user_roles_count
 *
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDisabledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsLogged($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsercode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserkey($value)
 *
 * @mixin \Eloquent
 */
final class User extends Authenticatable implements JWTSubject, Auditable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoleAndPermission;
    use AuditableTrait;
    use Searchable;

    /** @var array */
    protected $dispatchesEvents = [
        'updated' => UpdateEvent::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usercode',
        'userkey',
        'email',
        'password',
        'token',
        'status',
        'last_login',
        'last_activity',
        'isLogged',
        'isBlocked',
        'profile_id',
        'billing_company_id',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'isLogged' => 'boolean',
        'type' => UserType::class,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['language', 'last_modified', 'permissions'];

    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'last_activity', 'updated_at',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * User belongs to Profile.
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function getLanguageAttribute(): string
    {
        return $this->profile?->language ?? 'en';
    }

    /**
     * User has one HealthProfessional.
     */
    public function healthProfessional(): HasOneThrough
    {
        return $this->hasOneThrough(HealthProfessional::class, Profile::class, 'id', 'profile_id', 'profile_id', 'id');
    }

    /**
     * User has one HealthProfessional.
     */
    public function patient(): HasOneThrough
    {
        return $this->hasOneThrough(Patient::class, Profile::class, 'id', 'profile_id', 'profile_id', 'id');
    }

    /**
     * The billingCompanies that belong to the User.
     */
    public function billingCompanies()// : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)
            ->using(Membership::class)
            ->withPivot('status', 'id')
            ->withTimestamps()
            ->as('membership');
    }

    /**
     * User morphs many Contact.
     */
    public function contacts(): ?MorphMany
    {
        return $this->profile?->contacts();
    }

    /**
     * User morphs many Address.
     */
    public function addresses(): ?MorphMany
    {
        return $this->profile?->addresses();
    }

    /**
     * User morphs many ipRestrictions.
     */
    public function ipRestrictions(): MorphMany
    {
        return $this->morphMany(IpRestriction::class, 'restrictable');
    }

    /**
     * User has many FailedLoginAttempts.
     */
    public function failedLoginAttempts(): HasMany
    {
        return $this->hasMany(FailedLoginAttempt::class);
    }

    /**
     * User has many Devices.
     */
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    public function presets(): HasMany
    {
        return $this->hasMany(Preset::class);
    }

    public function permissions(): ?Collection
    {
        return $this->roles()?->get()->reduce(function (Collection $v, Role $role) {
            $v = $v->merge($role->permissions()->get());

            return $v;
        }, $this->permits()->get())->unique();
    }

    public function getPermissionsAttribute(): ?Collection
    {
        return $this->permissions();
    }

    public function permits(): MorphToMany
    {
        return $this->morphToMany(Permission::class, 'authorizable')->withTimestamps();
    }

    /**
     * @todo find a better way to load this, maybe whit hasTrougth
     * @todo ennambe other user types returns that are stuct
     */
    public function roles(): ?MorphToMany
    {
        if (is_null($this->type)) {
            \Log::error("User type for user {$this->id} is null");

            return $this->userRoles();
        }

        try {
            return match ($this->type->value) {
                UserType::ADMIN->value => $this->userRoles(),
                UserType::BILLING->value => $this->billingCompanies()
                    ?->wherePivot('billing_company_id', $this->billing_company_id)
                    ->first()
                    ?->membership
                    ->roles(),
                UserType::DOCTOR->value => $this->healthProfessional()
                    ->first()
                    ?->billingCompanies()
                    ?->wherePivot('billing_company_id', $this->billing_company_id)
                    ->first()
                    ?->pivot
                    ->roles(),
                UserType::PATIENT->value => $this->patient()
                    ->first()
                    ?->billingCompanies()
                    ?->wherePivot('billing_company_id', $this->billing_company_id)
                    ->first()
                    ?->membership
                    ->roles(),
                default => $this->userRoles(),
            };
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            Log::error("User type for user {$this->id} is null {$this->type?->value}");

            return $this->$this->userRoles();
        }
    }

    public function getRolesAttribute(): ?Collection
    {
        return $this->roles()?->get();
    }

    public function userRoles(): MorphToMany
    {
        return $this->morphToMany(Role::class, 'rollable')->withTimestamps();
    }

    /** @deprecated use hasPermission instead */
    public function hasRole($role, $all = false)
    {
        return $this->roles()?->where('slug', $role)->exists() ?? false;
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->contains(function (Permission $value) use ($permission) {
            return Str::is($permission, $value->slug);
        }) ?? false;
    }

    public function hasAllPermissions(string $permissions): bool
    {
        foreach ($this->getArrayFrom($permissions) as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }

    /** @return string[] */
    private function getArrayFrom(string $argument): array
    {
        return (!is_array($argument)) ? preg_split('/ ?[,|] ?/', $argument) : $argument;
    }

    /**
     * The keyboard shortcuts that belong to the BillingCompany.
     */
    public function customKeyboardShortcuts(): MorphMany
    {
        return $this->morphMany(CustomKeyboardShortcuts::class, 'shortcutable');
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtolower($value),
            set: fn ($value) => strtolower($value),
        );
    }

    /*
     * Get the company's status.
     *
     * @param  string  $value
     * @return string
     */
    public function getLastModifiedAttribute()
    {
        $record = [
            'user' => '',
            'roles' => [],
        ];
        $lastModified = $this->audits()->latest()->first();

        if (!isset($lastModified->user_id)) {
        } elseif ($lastModified->user_id !== $this->id) {
            $user = User::find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles()?->get(['name'])->pluck('name'),
            ];
        } elseif ($lastModified->user_id === $this->id) {
            $profile = $this->profile;

            return [
                'user' => $profile->first_name.' '.$profile->last_name,
                'roles' => $this->roles()?->get(['name'])->pluck('name'),
            ];
        }
    }

    public function scopeSearch($query, $search)
    {
        if ('' !== $search) {
            return $query->whereHas('profile', function ($q) use ($search): void {
                $q->whereRaw('LOWER(first_name) LIKE (?)', [strtolower("%$search%")])
                  ->orWhereRaw('LOWER(last_name) LIKE (?)', [strtolower("%$search%")]);
            })->orWhereHas('roles', function ($q) use ($search): void {
                $q->whereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")]);
            })->orWhereRaw('LOWER(email) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }

    public function toSearchableArray(): array
    {
        return [
            'usercode' => $this->usercode,
            'email' => $this->email,
            'contacts' => $this->profile->contacts->toArray(),
            'addresses' => $this->profile->addresses->toArray(),
            'profile.first_name' => $this->profile->first_name,
            'profile.last_name' => $this->profile->last_name,
            'profile.ssn' => $this->profile->ssn,
            'profile.phone' => $this->profile->phone,
        ];
    }
}
