<?php

declare(strict_types=1);

namespace App\Models;

use App\Roles\Traits\HasRoleAndPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $sex
 * @property string $lastName
 * @property string $firstName
 * @property string $middleName
 * @property string|null $token
 * @property bool $available
 * @property bool $isLogged
 * @property string|null $img_profile
 * @property string|null $ssn
 * @property string|null $dateOfBirth
 * @property bool $isBlocked
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $address
 * @property int|null $address_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\BillingCompany[] $billingCompanyUser
 * @property int|null $billing_company_user_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contact
 * @property int|null $contact_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Device[] $devices
 * @property int|null $devices_count
 * @property \App\Models\Doctor|null $doctor
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Metadata[] $metadata
 * @property int|null $metadata_count
 * @property \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property int|null $notifications_count
 * @property \App\Models\Patient|null $patient
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property int|null $permissions_count
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property int|null $roles_count
 * @property \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property int|null $tokens_count
 *
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImgProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsLogged($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 *
 * @property string|null $usercode
 * @property string|null $userkey
 * @property bool $status
 * @property string|null $last_login
 * @property int|null $profile_id
 * @property string $language
 * @property string|null $last_activity
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\FailedLoginAttempt> $failedLoginAttempts
 * @property int|null $failed_login_attempts_count
 * @property mixed $billing_company
 * @property mixed $billing_company_id
 * @property mixed $last_modified
 * @property \App\Models\HealthProfessional|null $healthProfessional
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property int|null $ip_restrictions_count
 * @property \App\Models\Profile|null $profile
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $userPermissions
 * @property int|null $user_permissions_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsercode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserkey($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\FailedLoginAttempt> $failedLoginAttempts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $userPermissions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\FailedLoginAttempt> $failedLoginAttempts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $userPermissions
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
        'language',
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
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['billing_company_id', 'billing_company', 'last_modified'];

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
    public function profile(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * User has one HealthProfessional.
     */
    public function healthProfessional(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(healthProfessional::class);
    }

    /**
     * User has one HealthProfessional.
     */
    public function patient(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * The billingCompanies that belong to the User.
     */
    public function billingCompanies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * User morphs many Contact.
     */
    public function contacts(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * User morphs many Address.
     */
    public function addresses(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * User morphs many ipRestrictions.
     */
    public function ipRestrictions(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(IpRestriction::class, 'restrictable');
    }

    /**
     * User has many FailedLoginAttempts.
     */
    public function failedLoginAttempts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FailedLoginAttempt::class);
    }

    /**
     * User has many Devices.
     */
    public function devices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Device::class);
    }

    /*
     * Get the company's status.
     *
     * @param  string  $value
     * @return string
     */
    public function getBillingCompanyIdAttribute()
    {
        $user = auth()->user();

        if (is_null($user)) {
            return null;
        }

        $billingCompany = $user->billingCompanies->first();

        return $billingCompany->id ?? null;
    }

    /*
     * Get the billing company's.
     *
     * @param  string  $value
     * @return string
     */
    public function getBillingCompanyAttribute()
    {
        $billingCompany = $this->billingCompanies->first();

        return $billingCompany ?? null;
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
            return [
                'user' => 'Console',
                'roles' => [],
            ];
        } elseif ($lastModified->user_id !== $this->id) {
            $user = User::with(['profile', 'roles'])->find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles,
            ];
        } elseif ($lastModified->user_id === $this->id) {
            $profile = $this->profile;

            return [
                'user' => $profile->first_name.' '.$profile->last_name,
                'roles' => $this->getRoles(),
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
}
