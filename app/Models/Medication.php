<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Medication
 *
 * @property int $id
 * @property string $code
 * @property string $date
 * @property string $drug_code
 * @property string $batch
 * @property int $quantity
 * @property int $frequency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $company_procedure_id
 * @property-read \App\Models\CompanyProcedure|null $companyProcedure
 * @method static \Illuminate\Database\Eloquent\Builder|Medication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication query()
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereCompanyProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereDrugCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medication whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class Medication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'date',
        'drug_code',
        'batch',
        'quantity',
        'frequency',
    ];

    /** @var string[] */
    protected $hidden = [
        'id',
        'company_procedure_id',
    ];

    public function companyProcedure(): BelongsTo
    {
        return $this->belongsTo(CompanyProcedure::class);
    }
}
