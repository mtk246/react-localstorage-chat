<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TaxonomyChangePrimaryRequest;
use App\Http\Requests\TaxonomyCreateRequest;
use App\Http\Requests\TaxonomyUpdateRequest;
use App\Repositories\TaxonomyRepository;
use Illuminate\Http\JsonResponse as JsonResponseAlias;

// use Illuminate\Http\Request;

class TaxonomyController extends Controller
{
    private $taxonomyRepository;

    public function __construct()
    {
        $this->taxonomyRepository = new TaxonomyRepository();
    }

    public function createTaxonomy(TaxonomyCreateRequest $request): JsonResponseAlias
    {
        if (!$request->has('user_id') && !$request->has('company_id')) {
            return response()->json('Error! its necesary at least a user_id or company_id', 400);
        }

        if ($request->has('user_id') && $request->has('company_id')) {
            return response()->json('Error! you cant send user_id at the same time with company_id', 400);
        }

        if ($request->input('isPrimary')) {
            if (
                !$this->taxonomyRepository->checkPrimaryTaxonomy(
                    $request->input('user_id'),
                    $request->input('company_id')
                )
            ) {
                return response()->json('Error! a taxonomy existent', 400);
            }
        }

        $rs = $this->taxonomyRepository->addTaxonomy($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json('Error! creating taxonomy', 400);
    }

    public function removeTaxonomy(int $id): JsonResponseAlias
    {
        $rs = $this->taxonomyRepository->removeTaxonomy($id);

        return $rs ? response()->json([], 204) : response()->json('Error! deleting taxonomy', 400);
    }

    public function updateTaxonomy(TaxonomyUpdateRequest $request, int $id): JsonResponseAlias
    {
        $rs = $this->taxonomyRepository->updateTaxonomy($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json('Error! updating taxonomy', 400);
    }

    public function changePrimary(TaxonomyChangePrimaryRequest $request, int $id): JsonResponseAlias
    {
        if (!$request->has('user_id') && !$request->has('company_id')) {
            return response()->json('Error! its necesary at least a user_id or company_id', 400);
        }

        if ($request->has('user_id') && $request->has('company_id')) {
            return response()->json('Error! you cant send user_id at the same time with company_id', 400);
        }

        $rs = $this->taxonomyRepository->changePrimary(
            $request->input('primary'),
            $id,
            $request->input('user_id'),
            $request->input('company_id')
        );

        return $rs ? response()->json([], 204) : response()->json('', 400);
    }

    public function getAllTaxonomies(int $type, int $id): JsonResponseAlias
    {
        return response()->json(
            $this->taxonomyRepository->getAllTaxonomy($type, $id)
        );
    }

    public function getOneTaxonomy(int $id): JsonResponseAlias
    {
        $rs = $this->taxonomyRepository->getOneTaxonomy($id);

        return $rs ? response()->json($rs) : response()->json('taxonomy not found', 404);
    }
}
