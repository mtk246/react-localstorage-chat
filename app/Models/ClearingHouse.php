<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\ClearingHouse
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse query()
 * @mixin \Eloquent
 * @property-read \App\Models\Address|null $address
 * @property-read \App\Models\Contact|null $contact
 * @property int $id
 * @property string $code
 * @property string $name
 * @property bool $ack
 * @property int $org_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereAck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereOrgType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereUpdatedAt($value)
 */
class ClearingHouse extends Model
{
    use HasFactory;

    protected $table = "clearing_houses";
    protected $fillable = [
        "code",
        "name",
        "status"
    ];

    /**
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * @return HasOne
     */
    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }
}
