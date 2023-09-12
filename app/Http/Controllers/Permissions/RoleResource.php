<?php

declare(strict_types=1);

namespace App\Http\Controllers\Permissions;

use App\Actions\Permissions\GetRoleAction;
use App\Actions\Permissions\StoreMembershipAction;
use App\Actions\Permissions\UpdateMembershipAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\StoreMembershipRequest;
use App\Http\Requests\Permissions\UpdateMembershipRequest;
use App\Models\BillingCompany\MembershipRole;
use Illuminate\Http\JsonResponse;

final class RoleResource extends Controller
{
    public function index(GetRoleAction $get): JsonResponse
    {
        return response()->json($get->getAll());
    }

    public function store(StoreMembershipRequest $request, StoreMembershipAction $store): JsonResponse
    {
        return response()->json($store->invoke($request->casted()));
    }

    public function show(MembershipRole $role): JsonResponse
    {
        return response()->json($role);
    }

    public function update(UpdateMembershipRequest $request, MembershipRole $role, UpdateMembershipAction $upate): JsonResponse
    {
        return response()->json($upate->invoke($request->casted(), $role));
    }

    public function destroy(MembershipRole $role): JsonResponse
    {
        return response()->json($role->delete());
    }
}
