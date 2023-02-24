<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Copay extends Model
{
    use HasFactory;

    public function procedures(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class);
    }
}
