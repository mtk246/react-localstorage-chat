<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class RelationshipToSubscriberCode extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "relationship_to_subscriber_code"
    ];

    /**
     * RelationshipToSubscriberCode has many Dependent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dependents()
    {
        return $this->hasMany(Dependent::class);
    }
}
