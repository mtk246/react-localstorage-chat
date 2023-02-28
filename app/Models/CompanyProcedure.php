<?php

declare(strict_types=1);

namespace App\Models;

use Cknow\Money\Casts\MoneyStringCast;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CondoMembership.
 *
 * @property mixed $roles
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CondoMembership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CondoMembership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CondoMembership query()
 *
 * @mixin \Eloquent
 */
final class CompanyProcedure extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     *
     * @phpcs:disable SlevomatCodingStandard.Classes.ForbiddenPublicProperty
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'company_id',
        'procedure_id',
        'billing_company_id',
        'mac_locality_id',
        'price',
        'price_percentage',
        'modifier_id',
        'insurance_label_fee_id',
        'clia',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'price' => MoneyStringCast::class,
    ];

    public function medications(): ?HasMany
    {
        return $this->hasMany(Medication::class, 'company_procedure_id');
    }
}
