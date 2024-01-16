<?php

declare(strict_types=1);

namespace App\Models;

use OwenIt\Auditing\Models\Audit as BaseAudit;

/**
 * App\Models\Audit.
 *
 * @property int $id
 * @property string|null $user_type
 * @property int|null $user_id
 * @property string $event
 * @property string $auditable_type
 * @property string $auditable_id
 * @property array|null $old_values
 * @property array|null $new_values
 * @property string|null $url
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Model|\Eloquent $auditable
 * @property \Illuminate\Database\Eloquent\Model|\Eloquent $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Audit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Audit search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit searchAudit($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit sortAudit($orderBy, $desc)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereAuditableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereAuditableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereNewValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereOldValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audit whereUserType($value)
 *
 * @mixin \Eloquent
 */
class Audit extends BaseAudit
{
    /**
     * Query scope SearchAudit.
     *
     * @param  \Illuminate\Database\Eloquent\Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchAudit($query, $search)
    {
        return $query;
        if ('' != $search) {
            return $query->whereHas('user', function ($q) use ($search) {
                $q->whereRaw('LOWER(abbreviation) LIKE (?) ', [strtolower("%$search%")])
                ->orWhereRaw('LOWER(first_name) LIKE (?) ', [strtolower("%$search%")])
                ->orWhereRaw('LOWER(last_name) LIKE (?) ', [strtolower("%$search%")]);
            })->orWhereRaw('LOWER(volume) LIKE (?) ', [strtolower("%$search%")])
                            ->orWhereRaw('LOWER(title) LIKE (?) ', [strtolower("%$search%")])
                            ->orWhere('year', 'like', "%$search%");
        }

        return $query;
    }

    public function scopeSearch($query, $search)
    {
        if ('' != $search) {
            return $query->whereHas('user', function ($q) use ($search) {
                $q->whereHas('profile', function ($qq) use ($search) {
                    $qq->whereRaw('LOWER(first_name) LIKE (?) ', [strtolower("%$search%")])
                        ->orWhereRaw('LOWER(last_name) LIKE (?) ', [strtolower("%$search%")]);
                });
            })->orWhereRaw('LOWER(event) LIKE (?) ', [strtolower("%$search%")])
            ->orWhereRaw('LOWER(auditable_type) LIKE (?) ', [strtolower("%$search%")])
            ->orWhere('audits.created_at', 'LIKE', "%$search%");
        }

        return $query;
    }

    /**
     * Query scope sortAudit.
     *
     * @param  \Illuminate\Database\Eloquent\Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortAudit($query, $orderBy, $desc)
    {
        return $query->orderBy($orderBy, ('true' == $desc) ? 'desc' : 'asc');
    }
}
