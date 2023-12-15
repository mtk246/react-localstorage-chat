<?php

declare(strict_types=1);

namespace App\Actions\Payments;

use App\Facades\Pagination;
use App\Http\Resources\Payments\BatchResource;
use App\Models\Payments\Batch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Laravel\Scout\Builder as ScoutBuilder;
use Meilisearch\Endpoints\Indexes;

final class GetBatchAction
{
    public function all(Request $request): LengthAwarePaginator
    {
        return DB::transaction(function () use ($request): LengthAwarePaginator {
            $batches = Batch::search(
                $request->query('query', ''),
                function (Indexes $searchEngine, string $query, array $options) use ($request) {
                    $config = config('scout.meilisearch.index-settings.'.Batch::class.'.sortableAttributes');

                    if (isset($request->sortBy) && in_array($request->sortBy, $config)) {
                        $options['sort'] = [$request->sortBy.':'.Pagination::sortDesc()];
                    }

                    return $searchEngine->search($query, $options);
                })
                ->when(
                    Gate::denies('is-admin'),
                    function (ScoutBuilder $query) use ($request) {
                        $bC = $request->user()->billing_company_id;
                        $query
                            ->where('billingCompany.id', $bC)
                            ->query(fn (Builder $query) => $query->with([
                                'payments',
                                'company',
                                'billingCompany',
                            ]));
                    },
                    fn (ScoutBuilder $query) => $query->query(fn (Builder $query) => $query->with([
                        'payments',
                        'company',
                        'billingCompany',
                    ]))
                )
                ->paginate(Pagination::itemsPerPage());

            return BatchResource::collection($batches)->resource;
        });
    }
}
