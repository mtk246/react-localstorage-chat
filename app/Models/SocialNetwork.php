<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\SocialNetwork.
 *
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialMedia> $socialMedias
 * @property int|null $social_medias_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialNetwork whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class SocialNetwork extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'name',
        'active',
    ];

    /**
     * SocialNetwork has many SocialMedias.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialMedias()
    {
        return $this->hasMany(SocialMedia::class);
    }
}
