<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DiagnosticPointer
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DiagnosticPointer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiagnosticPointer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiagnosticPointer query()
 * @mixin \Eloquent
 */
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
