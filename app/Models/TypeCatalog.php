<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCatalog extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'description', 'status', 'type_id'];

    /**
     * TypeCatalog belongs to Type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}

