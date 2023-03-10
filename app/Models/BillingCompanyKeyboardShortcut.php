<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\BillingCompanyKeyboardShortcut.
 *
 * @property int $id
 * @property string $key
 * @property int|null $billing_company_id
 * @property int $keyboard_shortcut_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyKeyboardShortcut newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyKeyboardShortcut newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyKeyboardShortcut query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyKeyboardShortcut whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyKeyboardShortcut whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyKeyboardShortcut whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyKeyboardShortcut whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyKeyboardShortcut whereKeyboardShortcutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyKeyboardShortcut whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class BillingCompanyKeyboardShortcut extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     *
     * @phpcs:disable SlevomatCodingStandard.Classes.ForbiddenPublicProperty
     */
    public $incrementing = true;

    /** @var string[] */
    protected $fillable = [
        'key',
        'billing_company_id',
        'keyboard_shortcut_id',
    ];
}
