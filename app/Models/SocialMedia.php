<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class SocialMedia extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "link",
        "profile_id",
        "social_network_id"
    ];

    /**
     * Lista de relaciones a incorporar en las consultas
     *
     * @var    array
     */
    protected $with = ['socialNetwork'];

    /**
     * SocialMedia belongs to Profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * SocialMedia belongs to SocialNetwork.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function socialNetwork()
    {
        return $this->belongsTo(SocialNetwork::class);
    }
}
