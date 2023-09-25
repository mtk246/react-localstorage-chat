<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Http\Casts\Permissions\PermissionWrapper;
use App\Http\Resources\Permissions\PermitResource;
use App\Models\Permissions\Permission;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

final class StorePermitAction
{
    public function invoke(Collection $wrapper, User $user): AnonymousResourceCollection
    {
        $user->permits()->delete();
        $wrapper->each(function (PermissionWrapper $permission) use ($user) {
            Permission::query()->create($permission->getData($user->id, User::class, $user->billing_company_id));
        });

        return PermitResource::collection($user->refresh()->permits);
    }
}
