<?php

declare(strict_types=1);

namespace App\Http\Controllers\Permissions;

use App\Actions\Permissions\GetRoleAction;
use App\Actions\Permissions\StoreRoleAction;
use App\Actions\Permissions\UpdateRoleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\StoreRoleRequest;
use App\Http\Requests\Permissions\UpdateRoleRequest;
use App\Models\BillingCompany\MembershipRole;
use Illuminate\Http\JsonResponse;

final class UserRoleResource extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json($get->getAll());
    }

    public function store(StoreRoleRequest $request, StoreRoleAction $store): JsonResponse
    {
        return response()->json($store->invoke($request->casted()));
    }

    public function show(MembershipRole $role): JsonResponse
    {
        return response()->json($role);
    }

    public function update(UpdateRoleRequest $request, MembershipRole $role, UpdateRoleAction $upate): JsonResponse
    {
        return response()->json($upate->invoke($request->casted(), $role));
    }

    public function destroy(MembershipRole $role): JsonResponse
    {
        return response()->json($role->delete());
    }
}
