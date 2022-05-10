<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Service extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "description",
        "service_group_1_id",
        "service_group_2_id",
        "service_type_id",
        "aplicable_to",
        "service_type_of_service_id",
        "service_rev_center_id",
        "service_stmt_description_id",
        "service_special_instruction_id",
        "rev_code",
        "use_time_units",
        "ndc_number",
        "units",
        "measure",
        "units_limit",
        "requires_claim_note",
        "requires_supervisor",
        "requires_authorization",
        "std_price",
        "status",
        "billing_company_id",
        "company_id"
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
     *  Service belongs to InsurancePlanServices.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePlanServices()
    {
        return $this->belongsToMany(InsurancePlanService::class)->withTimestamps();
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
