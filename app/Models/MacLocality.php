<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class MacLocality extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "mac",
        "locality_number",
        "state",
        "fsa",
        "counties"
    ];

    /**
     * The procedures that belong to the MacLocality. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function procedures()
    {
        return $this->belongsToMany(Procedure::class)->withTimestamps();
    }
}
