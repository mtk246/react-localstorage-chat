<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

final class PatientAdditionalInformation extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

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
