<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class RefileReason extends Model
{
    use HasFactory;

    protected $table = 'refile_reason';

    protected $fillable = [
        'cod',
        'description',
    ];
}
