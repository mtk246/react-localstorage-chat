<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\EmergencyContact
 *
 * @property int $id
 * @property string $name
 * @property string $cellphone
 * @property string $relationship
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient|null $patient
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereCellphone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereUpdatedAt($value)
 * @property int $patient_id
 * @property int|null $relationship_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereRelationshipId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class EmergencyContact extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "name",
        "cellphone",
        "relationship_id",
        "patient_id"
    ];

    /**
     * EmergencyContact belongs to patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Relationship belongs to patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relationship(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'relationship_id');
    }

    /**
     * Interact with the emergencyContact's name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }
}
