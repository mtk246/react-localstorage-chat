<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Company\MeasurementUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Medication.
 *
 * @property int $id
 * @property string $drug_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property MeasurementUnit|null $measurement_unit_id
 * @property string|null $units
 * @property string|null $units_limit
 * @property string|null $link_sequence_number
 * @property string|null $pharmacy_prescription_number
 * @property bool $repackaged_NDC
 * @property string|null $code_NDC
 * @property string|null $note
 * @property int|null $company_service_id
 * @property bool $claim_note_required
 * @property \App\Models\CompanyService|null $companyService
 * @property string $code
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Medication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication query()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereClaimNoteRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereCodeNDC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereCompanyServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereDrugCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereLinkSequenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereMeasurementUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication wherePharmacyPrescriptionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereRepackagedNDC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereUnitsLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Medication extends Model
{
    use HasFactory;

    protected $fillable = [
        'drug_code',
        'measurement_unit_id',
        'units',
        'units_limit',
        'link_sequence_number',
        'pharmacy_prescription_number',
        'repackaged_NDC',
        'code_NDC',
        'claim_note_required',
        'note',
        'company_service_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'code',
    ];

    /** @var string[] */
    protected $hidden = [
        'id',
        'company_procedure_id',
    ];

    protected $casts = [
        'measurement_unit_id' => MeasurementUnit::class,
    ];

    public function getCodeAttribute(): string
    {
        return $this->company_procedure_id.$this->drug_code.$this->id;
    }

    public function companyService(): BelongsTo
    {
        return $this->belongsTo(CompanyService::class);
    }
}
