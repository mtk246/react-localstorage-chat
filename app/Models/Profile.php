<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Profile.
 *
 * @property int $id
 * @property string|null $ssn
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $sex
 * @property string|null $date_of_birth
 * @property string|null $avatar
 * @property bool $credit_score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 * @property int|null $social_medias_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property int|null $user_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreditScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 *
 * @mixin \Eloquent
 */
final class Profile extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'ssn',
        'first_name',
        'middle_name',
        'last_name',
        'sex',
        'date_of_birth',
        'avatar',
        'credit_score',
        'name_suffix_id',
    ];

    protected $appends = [
        'name_suffix',
    ];

    public function getNameSuffixAttribute(): ?TypeCatalog
    {
        return $this->nameSuffix()->first();
    }

    /**
     * Get the nameSuffix that owns the Profile.
     */
    public function nameSuffix(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'name_suffix_id');
    }

    /**
     * Profile has many User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'profile_id');
    }

    /**
     * Profile has many SocialMedias.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialMedias()
    {
        return $this->hasMany(SocialMedia::class);
    }

    /**
     * Interact with the profile's first_name.
     */
    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }

    /**
     * Interact with the profile's middle_name.
     */
    protected function middleName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }

    /**
     * Interact with the profile's last_name.
     */
    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }
}
