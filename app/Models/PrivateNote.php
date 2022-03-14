<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateNote extends Model
{
    use HasFactory;

    protected $fillable = [
        "note",
        "billing_company_id",
        "publishable_type",
        "publishable_id"
    ];

    /**
     * PublicNote morphs to models in publishable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function publishable(): MorphTo
    {
        return $this->morphTo();
    }
}
