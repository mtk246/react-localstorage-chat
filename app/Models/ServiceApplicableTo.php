<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceApplicableTo extends Model
{
    use HasFactory;

    protected $table = 'service_applicable_to';

    protected $fillable = ['applicable_to'];
}
