<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        "ssn",
        "first_name",
        "middle_name",
        "last_name",
        "sex",
        "date_of_birth",
        "avatar",
        "credit_score"
    ];

    /**
     * Profile has many User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Profile has many SocialMedias.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialMedias()
    {
        return $this->hasMany(SocialMedia::class);
    }
}
