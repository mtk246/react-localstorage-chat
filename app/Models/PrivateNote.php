<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PrivateNote extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

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

    /**
     * Interact with the privateNote's note.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function note(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst(strtolower($value)),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }
}
