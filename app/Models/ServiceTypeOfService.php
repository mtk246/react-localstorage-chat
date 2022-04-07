<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTypeOfService extends Model
{
    use HasFactory;

    protected $fillable = ['type_of_service'];
}
