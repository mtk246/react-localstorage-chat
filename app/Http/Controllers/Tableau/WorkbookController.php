<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tableau;

use App\Actions\Tableau\GetWorkbook;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tableau\WorkbookRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class WorkbookController extends Controller
{
    public function index(WorkbookRequest $request, GetWorkbook $getWorkbook): JsonResponse
    {
        $rs = $getWorkbook->all($request->casted('filter'));

        return response()->json($rs);
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json();
    }

    public function show($id): JsonResponse
    {
        return response()->json();
    }

    public function edit($id): JsonResponse
    {
        return response()->json();
    }

    public function update(Request $request, $id): JsonResponse
    {
        return response()->json();
    }

    public function destroy($id): JsonResponse
    {
        return response()->json();
    }
}
