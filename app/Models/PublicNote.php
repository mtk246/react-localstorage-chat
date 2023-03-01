<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\PublicNote
 *
 * @property int $id
 * @property string $note
 * @property string $publishable_type
 * @property int $publishable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $last_modified
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote wherePublishableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote wherePublishableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read Model|\Eloquent $publishable
 * @mixin \Eloquent
 */
class PublicNote extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "note",
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
     * Interact with the publicNote's note.
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
