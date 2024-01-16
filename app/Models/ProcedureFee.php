<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ProcedureFee.
 *
 * @property int $id
 * @property float $fee
 * @property int $procedure_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $insurance_label_fee_id
 * @property int $mac_locality_id
 * @property string|null $fee_start_date
 * @property string|null $fee_end_date
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\InsuranceLabelFee $insuranceLabelFee
 * @property \App\Models\MacLocality $macLocality
 * @property \App\Models\Procedure $procedure
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereFeeEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereFeeStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereInsuranceLabelFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereMacLocalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureFee whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ProcedureFee extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'fee',
        'insurance_label_fee_id',
        'procedure_id',
        'mac_locality_id',
        'fee_start_date',
        'fee_end_date',
    ];

    /**
     * ProcedureFee belongs to Procedure.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }

    /**
     * ProcedureFee belongs to InsuranceLabelFee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceLabelFee()
    {
        return $this->belongsTo(InsuranceLabelFee::class);
    }

    /**
     * ProcedureFee belongs to MacLocality.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function macLocality()
    {
        return $this->belongsTo(MacLocality::class);
    }
}
