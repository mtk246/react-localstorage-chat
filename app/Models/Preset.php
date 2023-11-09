<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Preset extends Model
{
    use HasFactory;
    // use HasUuids;

    protected $fillable = ['name', 'filter', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function filter(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value),
        );
    }
}
