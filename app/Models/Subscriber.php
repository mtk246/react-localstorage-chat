<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Subscriber extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "ssn",
        "member_id",
        "last_name",
        "first_name",
        "date_of_birth",
        "relationship_id",
    ];

    /**
     * Subscriber belongs to Relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relationship()
    {
        return $this->belongsTo(TypeCatalog::class, 'relationship_id');
    }

    /**
     * Subscriber has many claim eligibilities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimEligibilities(): HasMany
    {
        return $this->hasMany(ClaimEligibility::class);
    }

    /**
     * Subscriber belongs to Patients.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class)->withTimestamps();
    }

    /**
     * Subscriber belongs to InsurancePolicy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePolicies(): BelongsToMany
    {
        return $this->belongsToMany(InsurancePolicies::class)->withTimestamps();
    }

    /**
     * Subscriber morphs many Contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * Subscriber morphs many Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Interact with the subscriber's first_name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }

    /**
     * Interact with the subscriber's last_name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }
}
