<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class CompanyStatement extends Model implements Auditable
{
    use HasFactory, AuditableTrait;
    
    protected $fillable = [
        "start_date",
        "end_date",
        "rule_id",
        "when_id",
        "apply_to_ids",
        "company_id",
        "billing_company_id"
    ];

    /**
     * CompanyStatement belongs to Rule.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rule()
    {
        return $this->belongsTo(TypeCatalog::class, 'rule_id');
    }

    /**
     * CompanyStatement belongs to When.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function when()
    {
        return $this->belongsTo(TypeCatalog::class, 'when_id');
    }

    /**
     * CompanyStatement belongs to BillingCompanny.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompanny()
    {
        return $this->belongsTo(BillingCompanny::class);
    }

    /**
     * CompanyStatement belongs to Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'apply_to_ids' => 'array'
    ];

}
