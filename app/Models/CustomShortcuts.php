<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\CustomShortcuts.
 *
 * @property Model|\Eloquent $billingCompany
 * @property \App\Models\KeyboardShortcut $keyboardShortcut
 * @property Model|\Eloquent $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CustomShortcuts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomShortcuts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomShortcuts query()
 *
 * @mixin \Eloquent
 */
final class CustomShortcuts extends Model
{
    /** @var string[] */
    protected $fillable = [
        'key',
        'keyboard_shortcut_id',
        'shortcutable_type',
        'shortcutable_id',
    ];

    public function keyboardShortcut(): BelongsTo
    {
        return $this->belongsTo(KeyboardShortcut::class);
    }

    public function billingCompany(): MorphTo
    {
        return $this->morphTo(BillingCompany::class, 'shortcutable');
    }

    public function user(): MorphTo
    {
        return $this->morphTo(User::class, 'shortcutable');
    }
}
