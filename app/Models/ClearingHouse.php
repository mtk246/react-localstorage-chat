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
 */
class ClearingHouse extends Model
{
    use HasFactory;

    protected $table = "clearing_houses";
    protected $fillable = [
        "code",
        "name",
        "ack",
        "org_type"
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
