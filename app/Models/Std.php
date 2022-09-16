<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Std extends Model
{
    use HasFactory;

    protected $fillable = ['std'];

    /**
     * DiagnosticPointer has many claimServices.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimServices()
    {
        return $this->hasMany(ClaimService::class);
    }
}
