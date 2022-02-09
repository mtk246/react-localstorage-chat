<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Patient
 *
 * @property int $id
 * @property string $marital_status
 * @property string $driver_licence
 * @property bool $dependent
 * @property string $guardian_name
 * @property string $guardian_phone
 * @property string $spuse_name
 * @property string $employer
 * @property string $employer_address
 * @property string $position
 * @property string $phone_employer
 * @property string $spuse_employer
 * @property string $spuse_work_phone
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDependent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDriverLicence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereEmployer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereEmployerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereGuardianName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereGuardianPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePhoneEmployer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereSpuseEmployer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereSpuseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereSpuseWorkPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUserId($value)
 * @mixin \Eloquent
 */
class Patient extends Model
{
    use HasFactory;

    protected $table = "patients";

    protected $fillable = [
        "marital_status",
        "driver_licence",
        "dependent",
        "guardian_name",
        "guardian_phone",
        "spuse_name",
        "employer",
        "employer_address",
        "position",
        "phone_employer",
        "spuse_employer",
        "spuse_work_phone",
        "user_id",
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
