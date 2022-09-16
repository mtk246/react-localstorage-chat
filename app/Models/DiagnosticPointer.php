<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticPointer extends Model
{
    use HasFactory;

    protected $fillable = ['diagnostic_pointer'];

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
