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
 * @property string $date
 * @property string $drug_code
 * @property string $batch
 * @property int $quantity
 * @property int $frequency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $company_procedure_id
 * @property \App\Models\CompanyProcedure|null $companyProcedure
 * @property string $code
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Medication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication query()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereCompanyProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereDrugCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereQuantity($value)
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

    public function companyProcedure(): BelongsTo
    {
        return $this->belongsTo(CompanyProcedure::class);
    }
}
