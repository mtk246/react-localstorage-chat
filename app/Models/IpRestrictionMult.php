<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\IpRestrictionMult.
 *
 * @property int $id
 * @property string $ip_beginning
 * @property string|null $ip_finish
 * @property bool $rank
 * @property int $ip_restriction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\IpRestriction $ipRestriction
 *
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult query()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereIpBeginning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereIpFinish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereIpRestrictionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestrictionMult whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class IpRestrictionMult extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = ['ip_beginning', 'ip_finish', 'rank', 'ip_restriction_id'];

    /**
     * The billingCompanies that belong to the ip restriction.
     *
     * @return BelongsTo
     */
    public function ipRestriction()
    {
        return $this->belongsTo(IpRestriction::class);
    }
}
