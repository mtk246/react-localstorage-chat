<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\PhysicianOrSupplierInformation.
 *
 * @property \App\Models\TypeCatalog|null $admissionSource
 * @property \App\Models\TypeCatalog|null $admissionType
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\TypeCatalog $billClassification
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimDateInformation> $claimDateInformations
 * @property int|null $claim_date_informations_count
 * @property \App\Models\ClaimFormP|null $claimFormP
 * @property \App\Models\TypeCatalog|null $diagnosisRelatedGroup
 * @property mixed $condition_codes
 * @property \App\Models\TypeCatalog|null $patientStatus
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhysicianOrSupplierInformation query()
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
        'condition_code_ids',
        'admission_date',
        'admission_time',
        'discharge_date',
        'discharge_time',
        'non_covered_charges',
        'admission_type_id',
        'admission_source_id',
        'patient_status_id',
        'bill_classification_id',
        'diagnosis_related_group_id',
    ];

    protected $casts = [
        'condition_code_ids' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['condition_codes'];

    protected $with = ['claimDateInformations'];

    /**
     * PhysicianOrSupplierInformation belongs to ClaimFormP.
     */
    public function claimFormP(): BelongsTo
    {
        return $this->belongsTo(ClaimFormP::class);
    }

    /**
     * PhysicianOrSupplierInformation belongs to AdmissionType.
     */
    public function admissionType(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'admission_type_id');
    }

    /**
     * PhysicianOrSupplierInformation belongs to AdmissionSource.
     */
    public function admissionSource(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'admission_source_id');
    }

    /**
     * PhysicianOrSupplierInformation belongs to PatientStatus.
     */
    public function patientStatus(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'patient_status_id');
    }

    /**
     * PhysicianOrSupplierInformation belongs to BillClassification.
     */
    public function billClassification(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'bill_classification_id');
    }

    /**
     * PhysicianOrSupplierInformation belongs to DiagnosisRelatedGroup.
     */
    public function diagnosisRelatedGroup(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'diagnosis_related_group_id');
    }

    /**
     * PhysicianOrSupplierInformation has many ClaimDateInformations.
     */
    public function claimDateInformations(): HasMany
    {
        return $this->hasMany(ClaimDateInformation::class);
    }

    public function getConditionCodesAttribute()
    {
        $condition_codes = [];
        foreach ($this->condition_code_ids ?? [] as $codeId) {
            $cond = TypeCatalog::find($codeId);
            array_push($condition_codes, [
                'id' => $cond['id'] ?? '',
                'code' => $cond['code'] ?? '',
                'name' => $cond['code'].' - '.$cond['description'] ?? '',
            ]);
        }

        return $condition_codes;
    }
}
