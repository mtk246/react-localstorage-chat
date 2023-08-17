<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TransmissionFormat.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransmissionFormat whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TransmissionFormat extends Model
{
    use HasFactory;
}
