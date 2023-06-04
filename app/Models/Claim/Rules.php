<?php

declare(strict_types=1);

namespace App\Models\Claim;

use App\Enums\Claim\RuleFormatType;
use App\Models\BillingCompany;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Rules extends Model
{
    use HasFactory;

    protected $table = 'claim_rules';

    protected $fillable = [
        'name',
        'format',
        'description',
        'billing_company_id',
        'rules',
        'parameters',
    ];

    protected $casts = [
        'format' => RuleFormatType::class,
        'rules' => 'array',
        'parameters' => 'array',
    ];

    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_claim_rule');
    }
}
