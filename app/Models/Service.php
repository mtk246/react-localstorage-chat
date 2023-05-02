<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Service.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany $billingCompany
 * @property \App\Models\Company $company
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property int|null $insurance_plan_services_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property int|null $insurance_plans_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PublicNote> $publicNote
 * @property int|null $public_note_count
 * @property \App\Models\ServiceApplicableTo|null $serviceApplicableTo
 * @property \App\Models\ServiceGroup|null $serviceGroup1
 * @property \App\Models\ServiceGroup|null $serviceGroup2
 * @property \App\Models\ServiceRevCenter|null $serviceRevCenter
 * @property \App\Models\ServiceSpecialInstruction|null $serviceSpecialInstruction
 * @property \App\Models\ServiceStmtDescription|null $serviceStmtDescription
 * @property \App\Models\ServiceType|null $serviceType
 * @property \App\Models\ServiceTypeOfService|null $serviceTypeOfService
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PublicNote> $publicNote
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PublicNote> $publicNote
 *
 * @mixin \Eloquent
 */
class Service extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'code',
        'name',
        'description',
        'service_group_1_id',
        'service_group_2_id',
        'service_type_id',
        'service_applicable_to_id',
        'service_type_of_service_id',
        'service_rev_center_id',
        'service_stmt_description_id',
        'service_special_instruction_id',
        'rev_code',
        'use_time_units',
        'ndc_number',
        'units',
        'measure',
        'units_limit',
        'requires_claim_note',
        'requires_supervisor',
        'requires_authorization',
        'std_price',
        'status',
        'billing_company_id',
        'company_id',
    ];

    /**
     * Service belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * Service belongs to Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Service belongs to serviceApplicableTo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceApplicableTo()
    {
        return $this->belongsTo(ServiceApplicableTo::class);
    }

    /**
     * Service belongs to ServiceGroup1.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceGroup1()
    {
        return $this->belongsTo(ServiceGroup::class, 'service_group_1_id');
    }

    /**
     * Service belongs to ServiceGroup2.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceGroup2()
    {
        return $this->belongsTo(ServiceGroup::class, 'service_group_2_id');
    }

    /**
     * Service belongs to ServiceType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    /**
     * Service belongs to ServiceTypeOfService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceTypeOfService()
    {
        return $this->belongsTo(ServiceTypeOfService::class);
    }

    /**
     * Service belongs to ServiceRevCenter.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceRevCenter()
    {
        return $this->belongsTo(ServiceRevCenter::class);
    }

    /**
     * Service belongs to ServiceStmtDescription.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceStmtDescription()
    {
        return $this->belongsTo(ServiceStmtDescription::class);
    }

    /**
     * Service belongs to ServiceSpecialInstruction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceSpecialInstruction()
    {
        return $this->belongsTo(ServiceSpecialInstruction::class);
    }

    /**
     *  Service belongs to InsurancePlans.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePlans()
    {
        return $this->belongsToMany(InsurancePlan::class)->withTimestamps();
    }

    /**
     *  Service belongs to InsurancePlanServices.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePlanServices()
    {
        return $this->hasMany(InsurancePlanService::class);
    }

    /**
     * Service morphs many PublicNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function publicNote()
    {
        return $this->morphMany(PublicNote::class, 'publishable');
    }

    /**
     * Service morphs many privateNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function privateNotes()
    {
        return $this->morphMany(PrivateNote::class, 'publishable');
    }
}
