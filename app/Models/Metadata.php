<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    use HasFactory;

    protected $fillable =[
        "dataset_name",
        "description",
        "machine_used",
        "start_date",
        "end_date",
        "time",
        "location",
        "user_id",
    ];
    
    protected $table = "metadata";
 
}
