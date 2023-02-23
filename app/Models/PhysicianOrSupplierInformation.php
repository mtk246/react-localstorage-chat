<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\PhysicianOrSupplierInformation
 *
 * @property int $id
 * @property string|null $prior_authorization_number
 * @property bool $outside_lab
 * @property string|null $charges
 * @property string|null $patient_account_num
 * @property bool $accept_assignment
 * @property int $claim_form_p_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimDateInformation> $claimDateInformations
 * @property-read int|null $claim_date_informations_count
 * @property-read \App\Models\ClaimFormP $claimFormP
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereAcceptAssignment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereClaimFormPId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereOutsideLab($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation wherePatientAccountNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation wherePriorAuthorizationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimDateInformation> $claimDateInformations
 * @mixin \Eloquent
 */
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
