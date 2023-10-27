<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\UpdatePermitsRequest;
use App\Http\Resources\Permissions\PermitResource;
use Illuminate\Http\JsonResponse;

final class PermissionResource extends Controller
{
    public function index(User $user): JsonResponse
    {
        return response()->json(PermitResource::collection($user->permits()));
    }

    public function update(UpdatePermitsRequest $request, User $user): JsonResponse
    {
        $user->permits()->detach();
        $user->permits()->sync($request->get('permissions'));

        return response()->json(PermitResource::collection($user->permits()));
    }

    public function destroy(User $user): JsonResponse
    {
        return response()->json($user->permits()->detach());
    }
}
