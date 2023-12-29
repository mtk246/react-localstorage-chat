<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\PrivateNote.
 *
 * @property int $id
 * @property string $note
 * @property int|null $billing_company_id
 * @property string $publishable_type
 * @property int $publishable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimCheckStatus|null $claimCheckStatus
 * @property mixed $last_modified
 * @property Model|\Eloquent $publishable
 *
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
 *
 * @mixin \Eloquent
 */
class PrivateNote extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'note',
        'billing_company_id',
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

    public function claimCheckStatus()
    {
        return $this->hasOne(ClaimCheckStatus::class, 'private_note_id');
    }
}
