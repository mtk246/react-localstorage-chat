<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Doctor
 *
 * @property int $id
 * @property string $npi
 * @property string $taxonomy
 * @property string $speciality
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property bool $status
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereNpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereSpeciality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereTaxonomy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereUserId($value)
 * @mixin \Eloquent
 */
class Doctor extends Model
{
    use HasFactory;

    protected $table = "doctors";

    protected $fillable = [
        "npi",
        "taxonomy",
        "speciality",
        "user_id",
        "status",
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
