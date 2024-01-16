<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\SocialMedia.
 *
 * @property int $id
 * @property string $link
 * @property int $profile_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $social_network_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property \App\Models\Profile $profile
 * @property \App\Models\SocialNetwork|null $socialNetwork
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereSocialNetworkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialMedia whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class SocialMedia extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'link',
        'profile_id',
        'social_network_id',
        'billing_company_id',
    ];

    /**
     * Lista de relaciones a incorporar en las consultas.
     *
     * @var array
     */
    protected $with = ['socialNetwork'];

    /**
     * Get the billingCompany that owns the SocialMedia.
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * SocialMedia belongs to Profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * SocialMedia belongs to SocialNetwork.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function socialNetwork()
    {
        return $this->belongsTo(SocialNetwork::class);
    }
}
