<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\CustomKeyboardShortcuts.
 *
 * @property int $id
 * @property string $key
 * @property int $keyboard_shortcut_id
 * @property string $shortcutable_type
 * @property int $shortcutable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property Model|\Eloquent $billingCompany
 * @property \App\Models\KeyboardShortcut $keyboardShortcut
 * @property Model|\Eloquent $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CustomKeyboardShortcuts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomKeyboardShortcuts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomKeyboardShortcuts query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomKeyboardShortcuts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomKeyboardShortcuts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomKeyboardShortcuts whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomKeyboardShortcuts whereKeyboardShortcutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomKeyboardShortcuts whereShortcutableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomKeyboardShortcuts whereShortcutableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomKeyboardShortcuts whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class CustomKeyboardShortcuts extends Model
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
