<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Facades\Pagination;
use App\Http\Resources\Claim\ClaimBodyResource;
use App\Models\Claims\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Meilisearch\Endpoints\Indexes;

final class GetClaimAction
{
    public function single(Claim $claim): ClaimBodyResource
    {
        return ClaimBodyResource::make($claim);
    }

    public function all(Request $request)
    {
        $claimsQuery = Claim::search(
            $request->query('query', ''),
            function (Indexes $searchEngine, string $query, array $options) use ($request) {
                $config = config('scout.meilisearch.index-settings.'.Claim::class);

                if (isset($request->sortBy) && in_array($request->sortBy, $config['sortableAttributes'])) {
                    $options['sort'] = [$request->sortBy.':'.Pagination::sortDesc()];
                }

                if (isset($request->filter)) {
                    $options['filter'] = $request->filter;
                }

                return $searchEngine->search($query, $options);
            }
        )
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('billing_company_id', $request->user()->billing_company_id),
            )
            ->paginate(Pagination::itemsPerPage());

        $data = [
            'data' => ClaimBodyResource::collection($claimsQuery->items()),
            'numberOfPages' => $claimsQuery->lastPage(),
            'count' => $claimsQuery->total(),
        ];

        return $data;
    }
}
