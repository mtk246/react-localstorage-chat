<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class CustomKeyboardShortcuts extends Model
{
    /** @var string[] */
    protected $fillable = [
        'key',
        'keyboard_shortcut_id',
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
