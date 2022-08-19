<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PlaceOfService extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "description",
    ];

    /**
     * The facilities that belong to the PlaceOfService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class)->withTimestamps();
    }

    /**
     * PlaceOfService has many ClaimInformation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function claimInformations()
    {
        return $this->hasMany(ClaimInformation::class);
    }

    /**
     * PlaceOfService has many ClaimServiceLine.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimServiceLines()
    {
        return $this->hasMany(ClaimServiceLine::class);
    }
}
