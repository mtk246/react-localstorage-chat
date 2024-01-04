<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\PatientOrInsuredInformation.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimFormP|null $claimFormP
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation query()
 *
 * @mixin \Eloquent
 */
class PatientOrInsuredInformation extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'patient_or_insured_informations';

    protected $fillable = [
        'employment_related_condition',
        'auto_accident_related_condition',
        'auto_accident_place_state',
        'other_accident_related_condition',
        'patient_signature',
        'insured_signature',
        'claim_form_p_id',
    ];

    /**
     * PatientOrInsuredInformation belongs to ClaimFormP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimFormP()
    {
        return $this->belongsTo(ClaimFormP::class);
    }
}
