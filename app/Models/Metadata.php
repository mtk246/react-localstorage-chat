<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Metadata.
 *
 * @property int $id
 * @property string|null $dataset_name
 * @property string|null $description
 * @property string|null $machine_used
 * @property string $start_date
 * @property string $end_date
 * @property string $time
 * @property string|null $location
 * @property string|null $ip_machine
 * @property string|null $mac_machine
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata query()
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereDatasetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereIpMachine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereMacMachine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereMachineUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metadata whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Metadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'dataset_name',
        'description',
        'machine_used',
        'start_date',
        'end_date',
        'time',
        'location',
        'user_id',
        'ip_machine',
        'mac_machine',
    ];

    protected $table = 'metadata';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
