<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class SocialNetwork extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "name",
        "active"
    ];

    /**
     * SocialNetwork has many SocialMedias.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialMedias()
    {
        return $this->hasMany(SocialMedia::class);
    }
}
