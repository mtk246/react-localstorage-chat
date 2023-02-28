<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\PrivateNote
 *
 * @property int $id
 * @property string $note
 * @property int|null $billing_company_id
 * @property string $publishable_type
 * @property int $publishable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $last_modified
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote wherePublishableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote wherePublishableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateNote whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class PrivateNote extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "note",
        "billing_company_id",
        "publishable_type",
        "publishable_id"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

    /**
     * PublicNote morphs to models in publishable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function publishable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Interact with the privateNote's note.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function note(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst(strtolower($value)),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }

    public function getLastModifiedAttribute()
    {
        $record = [
            'user'  => '',
            'roles' => [],
        ];
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return [
                'user'  => 'Console',
                'roles' => [],
            ];
        } else {
            $user = User::with(['profile', 'roles'])->find($lastModified->user_id);
            return [
                'user'  => $user->profile->first_name . ' ' . $user->profile->last_name,
                'roles' => $user->roles,
            ];
        }
    }
}
