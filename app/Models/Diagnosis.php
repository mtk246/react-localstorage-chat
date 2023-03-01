<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\Diagnosis
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $start_date
 * @property string|null $end_date
 * @property bool $injury_date_required
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $last_modified
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read int|null $procedures_count
 * @property-read \App\Models\PublicNote $publicNote
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis query()
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereInjuryDateRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @mixin \Eloquent
 */
class Diagnosis extends Model implements Auditable
{
    use HasFactory, AuditableTrait;
    
    protected $table = 'diagnoses';
    
    protected $fillable = [
        "code",
        "start_date",
        "end_date",
        "description",
        "active",
        "injury_date_required"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

    /**
     * Diagnosis morphs many publicNotes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function publicNote()
    {
        return $this->morphOne(PublicNote::class, 'publishable');
    }

    /**
     * The procedures that belong to the Diagnosis. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function procedures()
    {
        return $this->belongsToMany(Procedure::class, 'diagnosis_procedure', 'diagnosis_id', 'procedure_id')->withTimestamps();
    }

    /**
     * Interact with the diagnosis's description.
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

    public function scopeSearch($query, $search)
    {
        if ($search != "") {
            return $query->whereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")])
                         ->orWhereRaw('LOWER(description) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }
}
