<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\PhysicianOrSupplierInformation.
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
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimDateInformation> $claimDateInformations
 * @property int|null $claim_date_informations_count
 * @property \App\Models\ClaimFormP $claimFormP
 *
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
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimDateInformation> $claimDateInformations
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimDateInformation> $claimDateInformations
 *
 * @mixin \Eloquent
 */
class PhysicianOrSupplierInformation extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'physician_or_supplier_informations';

    protected $fillable = [
        'prior_authorization_number',
        'outside_lab',
        'charges',
        'patient_account_num',
        'accept_assignment',
        'claim_form_p_id',
    ];

    protected $with = ['claimDateInformations'];

    /**
     * PhysicianOrSupplierInformation belongs to ClaimFormP.
     */
    public function claimFormP(): BelongsTo
    {
        return $this->belongsTo(ClaimFormP::class);
    }

    /**
     * PhysicianOrSupplierInformation has many ClaimDateInformations.
     */
    public function claimDateInformations(): HasMany
    {
        return $this->hasMany(ClaimDateInformation::class);
    }
}
