<?php

declare(strict_types=1);

namespace App\Models\ClearingHouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ClearingHouse\AvailablePayer.
 *
 * @property int $id
 * @property string $payer_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClearingHouse\DataOfPayer> $dataOfPayers
 * @property int|null $data_of_payers_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AvailablePayer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AvailablePayer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AvailablePayer query()
 * @method static \Illuminate\Database\Eloquent\Builder|AvailablePayer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvailablePayer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvailablePayer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvailablePayer wherePayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvailablePayer whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class AvailablePayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'payer_id',
        'name',
    ];

    /**
     * Get all of the dataOfPayers for the AvailablePayer.
     */
    public function dataOfPayers(): HasMany
    {
        return $this->hasMany(DataOfPayer::class);
    }
}
