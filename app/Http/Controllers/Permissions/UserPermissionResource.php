<?php

declare(strict_types=1);

namespace App\Http\Controllers\Permissions;

use App\Actions\Permissions\StorePermitAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\StorePermitsRequest;
use App\Http\Resources\Permissions\PermitResource;
use App\Models\BillingCompany\MembershipRole;
use App\Models\Permissions\Permission;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class UserPermissionResource extends Controller
{
    public function index(User $user): JsonResponse
    {
        return response()->json(PermitResource::collection($user->permits));
    }

    public function store(
        StorePermitAction $store,
        StorePermitsRequest $request,
        MembershipRole $role,
    ): JsonResponse {
        return response()->json($store->invoke($request->castedCollect('permits'), $role));
    }

    public function destroy(User $user, Permission $permission): JsonResponse
    {
        $user->permits->destroy();
        return response()->json();
    }
}
