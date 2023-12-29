<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\PublicNote.
 *
 * @property int $id
 * @property string|null $note
 * @property string $publishable_type
 * @property int $publishable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property mixed $last_modified
 * @property Model|\Eloquent $publishable
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote wherePublishableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote wherePublishableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicNote whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PublicNote extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'note',
        'publishable_type',
        'publishable_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

    /**
     * PublicNote morphs to models in publishable_type.
     */
    public function publishable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getLastModifiedAttribute()
    {
        $record = [
            'user' => '',
            'roles' => [],
        ];
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return [
                'user' => 'Console',
                'roles' => [],
            ];
        } else {
            $user = User::find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles()?->get(['name'])->pluck('name'),
            ];
        }
    }
}
