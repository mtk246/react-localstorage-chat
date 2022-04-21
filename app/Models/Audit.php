<?php

namespace App\Models;

use \OwenIt\Auditing\Models\Audit as BaseAudit;

class Audit extends BaseAudit
{

    /**
     * Query scope SearchAudit.
     *
     * @param  \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchAudit($query, $search)
    {
        return $query;
        if ($search != "") {
            return $query->whereHas('user', function ($q) use ($search) {
                                $q->whereRaw('LOWER(abbreviation) LIKE (?) ',[strtolower("%$search%")])
                                ->orWhereRaw('LOWER(first_name) LIKE (?) ',[strtolower("%$search%")])
                                ->orWhereRaw('LOWER(last_name) LIKE (?) ',[strtolower("%$search%")]);
                          })->orWhereRaw('LOWER(volume) LIKE (?) ',[strtolower("%$search%")])
                            ->orWhereRaw('LOWER(title) LIKE (?) ',[strtolower("%$search%")])
                            ->orWhere('year', 'like', "%$search%");
        }
            return $query;
    }

    /**
     * Query scope sortAudit.
     *
     * @param  \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortAudit($query, $orderBy, $desc)
    {
        return $query->orderBy($orderBy, ($desc == 'true') ? 'desc' : 'asc');
    }
}
