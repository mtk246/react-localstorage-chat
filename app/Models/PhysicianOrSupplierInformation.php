<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PhysicianOrSupplierInformation extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = 'physician_or_supplier_informations';

    protected $fillable = [
        "prior_authorization_number",
        "outside_lab",
        "charges",
        "patient_account_num",
        "accept_assignment",
        "claim_form_p_id"
    ];

    protected $with = ["claimDateInformations"];

    /**
     * PhysicianOrSupplierInformation belongs to ClaimFormP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimFormP(): BelongsTo
    {
        return $this->belongsTo(ClaimFormP::class);
    }

    /**
     * PhysicianOrSupplierInformation has many ClaimDateInformations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimDateInformations(): HasMany
    {
        return $this->hasMany(ClaimDateInformation::class);
    }
}
