<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\PatientAdditionalInformation.
 *
 * @property int $id
 * @property int $claim_id
 * @property string|null $admission_date
 * @property string|null $admission_time
 * @property string|null $discharge_date
 * @property string|null $discharge_time
 * @property array|null $condition_code_ids
 * @property string|null $admission_type_id
 * @property string|null $admission_source_id
 * @property string|null $patient_status_id
 * @property string|null $bill_classification_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property TypeCatalog|null $admissionSource
 * @property TypeCatalog|null $admissionType
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property TypeCatalog|null $billClassification
 * @property \App\Models\Claims\Claim $claim
 * @property mixed $condition_codes
 * @property TypeCatalog|null $patientStatus
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereAdmissionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereAdmissionSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereAdmissionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereAdmissionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereBillClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereConditionCodeIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereDischargeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereDischargeTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation wherePatientStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientAdditionalInformation whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class PatientAdditionalInformation extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'patient_information';

    protected $fillable = [
        'admission_date',
        'admission_time',
        'discharge_date',
        'discharge_time',
        'condition_code_ids',
        'admission_type_id',
        'admission_source_id',
        'patient_status_id',
        'bill_classification_id',
        'claim_additional_information_id',
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

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * ClaimAdditionalInformation belongs to AdmissionType.
     */
    public function admissionType()
    {
        return $this->belongsTo(TypeCatalog::class, 'admission_type_id');
    }

    /**
     * ClaimAdditionalInformation belongs to AdmissionSource.
     */
    public function admissionSource()
    {
        return $this->belongsTo(TypeCatalog::class, 'admission_source_id');
    }

    /**
     * ClaimAdditionalInformation belongs to PatientStatus.
     */
    public function patientStatus()
    {
        return $this->belongsTo(TypeCatalog::class, 'patient_status_id');
    }

    /**
     * ClaimAdditionalInformation belongs to BillClassification.
     */
    public function billClassification()
    {
        return $this->belongsTo(TypeCatalog::class, 'bill_classification_id');
    }

    public function getConditionCodesAttribute()
    {
        $condition_codes = [];
        foreach ($this->condition_code_ids ?? [] as $codeId) {
            $cond = \App\Models\TypeCatalog::find($codeId);
            array_push($condition_codes, [
                'id' => $cond['id'] ?? '',
                'code' => $cond['code'] ?? '',
                'name' => $cond['code'].' - '.$cond['description'] ?? '',
            ]);
        }

        return $condition_codes;
    }
}
