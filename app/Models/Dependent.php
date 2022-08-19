<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Dependent extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "patient_id",
        "subscriber_id",
        "relationship_to_subscriber_code_id"
    ];


    /**
     * The patients that belong to the dependent.
     *
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * The subscribers that belong to the dependent.
     *
     * @return BelongsTo
     */
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    /**
     * The relationship to subscriber codes that belong to the dependent.
     *
     * @return BelongsTo
     */
    public function relationshipToSubscriberCode()
    {
        return $this->belongsTo(RelationshipToSubscriberCode::class);
    }
}
