<?php

declare(strict_types=1);

namespace App\Http\Controllers\Permissions;

use App\Actions\Permissions\GetRoleAction;
use App\Actions\Permissions\StoreRoleAction;
use App\Actions\Permissions\UpdateRolePermitAction;
use App\Actions\Permissions\UpdateRoleAction;
use App\Enums\User\RoleType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\StoreRoleRequest;
use App\Http\Requests\Permissions\UpdateRoleRequest;
use App\Http\Requests\Permissions\UpdatePermitsRequest;
use App\Http\Resources\Enums\EnumResource;
use App\Http\Resources\Enums\TypeResource;
use App\Http\Resources\Permissions\RoleResource as RoleResponseResource;
use App\Models\Permissions\Permission;
use App\Models\User\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

final class RoleResource extends Controller
{
    public function index(GetRoleAction $get): JsonResponse
    {
        return response()->json($get->getAll());
    }

    public function store(StoreRoleRequest $request, StoreRoleAction $store): JsonResponse
    {
        return response()->json($store->invoke($request->casted()));
    }

    public function show(Role $role): JsonResponse
    {
        return response()->json(new RoleResponseResource($role));
    }

    public function update(UpdateRoleRequest $request, Role $role, UpdateRoleAction $upate): JsonResponse
    {
        return response()->json($upate->invoke($request->casted(), $role));
    }

    public function destroy(Role $role): JsonResponse
    {
        return response()->json($role->delete());
    }

    public function updatePermissions(
        UpdateRolePermitAction $update,
        UpdatePermitsRequest $request,
        Role $role,
    ): JsonResponse {
        return response()->json($update->invoke($request->get('permissions'), $role));
    }

    public function getPermissions(): JsonResponse
    {
        return response()->json(Permission::all()->groupBy('module'));
    }

    public function getTypes(): JsonResponse
    {
        return response()->json(
            new EnumResource(collect(RoleType::cases())->when(
                Gate::denies('is-admin'),
                fn ($rules) => $rules->filter(fn ($rule) => RoleType::SYSTEM->value !== $rule->value),
            ), TypeResource::class),
        );
    }
}
