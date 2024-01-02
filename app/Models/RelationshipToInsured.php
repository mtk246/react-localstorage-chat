<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\RelationshipToInsured.
 *
 * @property int $id
 * @property string $relationship
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured query()
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured whereRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelationshipToInsured whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class RelationshipToInsured extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'relationship',
    ];
}
