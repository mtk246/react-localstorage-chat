<?php

declare(strict_types=1);

namespace App\Actions\Tableau;

use App\Http\Casts\Tableau\WorkbookFilterCast;
use App\Models\Tableau\Workbooks;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

final class GetWorkbook
{
    public function all(WorkbookFilterCast $filter)
    {
        return DB::transaction(function () use ($filter) {
            return $this->getFilterQuery($filter)
                ->get()
                ->groupBy('type');
        });
    }

    private function getFilterQuery(WorkbookFilterCast $filter): Builder
    {
        return Workbooks::query()
            ->when($filter->getName(), fn (Builder $query, string $name) => $query->where('name', 'like', "%{$name}%"))
            ->when($filter->getType(), fn (Builder $query, $type) => $query->where('type', $type->value))
            ->when($filter->getGroup(), fn (Builder $query, $group) => $query->where('group', $group->value));
    }
}
