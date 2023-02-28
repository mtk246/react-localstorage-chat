<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\KeyboardShortcut
 *
 * @property int $id
 * @property string $description
 * @property string $shortcut_type
 * @property string|null $module
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $key
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut query()
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereShortcutType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeyboardShortcut whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class KeyboardShortcut extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "description",
        "shortcut_type",
        "module"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['key'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'module' => 'array',
    ];

    /**
     * The billingCompanies that belong to the insurancePlan.
     *
     * @return BelongsToMany
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('key')->withTimestamps();
    }

    /**
     * Interact with the keyboardShortcut's description.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst(strtolower($value)),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }

    public function getKeyAttribute()
    {
        $billingCompany = $this->billingCompanies->first();
        return $billingCompany->pivot->key ?? null;
    }
}
