<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class ClaimStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        "status"
    ];

    /**
     * ClaimStatus has many ClaimStatusClaim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimStatusClaims(): HasMany
    {
        return $this->hasMany(ClaimStatusClaim::class);
    }
}
