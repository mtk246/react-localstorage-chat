<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthProfessional extends Model
{
    use HasFactory;

    protected $fillable = [
        "code",
        "npi",
        "dea",
        "user_id"
    ];

    /**
     * HealthProfessional belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The companies that belong to the heatProfessional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    /**
     * The taxonomies that belong to the heatProfessional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taxonomies()
    {
        return $this->belongsToMany(Taxonomy::class)->withTimestamps();
    }

    /**
     * The billingCompanies that belong to the HealthProfessional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function billingCompanies()
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }
}
