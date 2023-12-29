<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\KeyboardShortcut.
 *
 * @property int $id
 * @property string $description
 * @property string $shortcut_type
 * @property array|null $module
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $default_key
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\CustomKeyboardShortcuts> $keys
 * @property int|null $keys_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut query()
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereDefaultKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereShortcutType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class KeyboardShortcut extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    /** @var string[] */
    protected $fillable = [
        'description',
        'shortcut_type',
        'module',
        'default_key',
    ];

    /** @var array<key, string> */
    protected $casts = [
        'module' => 'array',
    ];

    public function keys(): HasMany
    {
        return $this->hasMany(CustomKeyboardShortcuts::class);
    }

    public function userKey(): ?string
    {
        return $this->keys()
            ->where('shortcutable_type', User::class)
            ->where('shortcutable_id', auth()->id())
            ->first()?->key;
    }

    public function billingCompanyKey(?int $billingCompanyId): ?string
    {
        return $this->keys()
                ->where('shortcutable_type', BillingCompany::class)
                ->where('shortcutable_id', $billingCompanyId)
                ->first()?->key;
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst(strtolower($value)),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }
}
