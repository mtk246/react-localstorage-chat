<?php

namespace App\Http\Controllers;

use App\Enums\SearchFilterType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

final class SearchController extends Controller
{
    public function search(Request $request, string $query): JsonResponse
    {
        $results = $this->getModels($request)
            ->mapWithKeys(fn (string $model) => [class_basename($model) => $model::search($query)->get()])
            ->filter(fn (Collection $results) => $results->isNotEmpty());

        return response()->json($results);
    }

    public function filters(): JsonResponse
    {
        return response()->json(SearchFilterType::cases());
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
