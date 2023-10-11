<?php

declare(strict_types=1);

namespace App\Http\Controllers\Permissions;

use App\Actions\Permissions\StorePermitAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\StorePermitsRequest;
use App\Http\Resources\Permissions\PermitResource;
use App\Models\BillingCompany\MembershipRole;
use App\Models\Permissions\Permission;
use Illuminate\Http\JsonResponse;

final class PermissionResource extends Controller
{
    public function index(MembershipRole $role): JsonResponse
    {
        return response()->json(PermitResource::collection($role->permits));
    }

    public function store(
        StorePermitAction $store,
        StorePermitsRequest $request,
        MembershipRole $role,
    ): JsonResponse {
        return response()->json($store->invoke($request->castedCollect('permits'), $role));
    }

    public function destroy(MembershipRole $role, Permission $permission): JsonResponse
    {
        $permission->rollback($permission->audits->first());
        return response()->json();
    }
}
