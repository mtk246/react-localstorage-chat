<?php

namespace App\Http\Controllers;

use App\Models\BillingCompany;
use App\Models\Claim;
use App\Models\Company;
use App\Models\Facility;
use App\Models\HealthProfessional;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

final class SearchController extends Controller
{
    public function __invoke(Request $request, string $query): JsonResponse
    {
        $results = $this->getModels($request)
            ->mapWithKeys(fn (string $model) => [class_basename($model) => $model::search($query)->get()])
            ->filter(fn (Collection $results) => $results->isNotEmpty());

        return response()->json($results);
    }

    private function getModels(Request $request): Collection
    {
        $filters = $request->get('filters', []);

        return config('scout.index')
            ? collect(config('scout.index'))
                ->filter(fn (string $value, string $key) => array_empty($filters) || in_array($key, $filters))
            : throw new \Exception('No "index" key found in config/scout.php');
    }
}
