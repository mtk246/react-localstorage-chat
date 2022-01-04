<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("v1")->group(function(){

    Route::get("/",function(){
        return response()->json(["message"=>"Api Running"]);
    });

    Route::prefix("auth")->group(function(){
        Route::post("login",[\App\Http\Controllers\AuthController::class,'login']);
        Route::get("logout",[\App\Http\Controllers\AuthController::class,'logout'])->middleware('auth:api');
        Route::get("refresh-token",[\App\Http\Controllers\AuthController::class,'refresh'])->middleware('auth:api');
        Route::get("me",[\App\Http\Controllers\AuthController::class,'me'])->middleware('auth:api');
    });

    Route::prefix("user")->group(function(){
        Route::post("/",[\App\Http\Controllers\UserController::class,'createUser'])->middleware(['auth:api','role:SUPER_USER']);
        Route::get("/",[\App\Http\Controllers\UserController::class,'getAllUsers'])->middleware(['auth:api','role:SUPER_USER']);
        Route::get("{id}/",[\App\Http\Controllers\UserController::class,'getOneUser'])->middleware(['auth:api','role:SUPER_USER']);
        Route::post("send-email-rescue-pass",[\App\Http\Controllers\UserController::class,'sendEmailRescuePass']);
        Route::post("change-password/{token}",[\App\Http\Controllers\UserController::class,'changePassword']);
        Route::patch("{id?}/change-status",[\App\Http\Controllers\UserController::class,'changeStatus'])->middleware('auth:api');
        Route::put("{id?}",[\App\Http\Controllers\UserController::class,'editUser'])->middleware('auth:api');
    });

    Route::prefix("permission")->middleware("auth:api")->group(function(){
        Route::get("roles",[\App\Http\Controllers\RolePermissionController::class,'getRoles']);
        Route::get("permissions",[\App\Http\Controllers\RolePermissionController::class,'getPermissions']);
        Route::get("role/{id}",[\App\Http\Controllers\RolePermissionController::class,'getOneRole']);
        Route::get("permission/{id}",[\App\Http\Controllers\RolePermissionController::class,'getOnePermission']);
        Route::post("create-role",[\App\Http\Controllers\RolePermissionController::class,'createRole']);
        Route::post("create-permission",[\App\Http\Controllers\RolePermissionController::class,'createPermission']);

        Route::patch("assign-permissions-role/{role_id}/{permission_id}",[\App\Http\Controllers\RolePermissionController::class,'assignPermissionsRole']);
        Route::patch("assign-permissions-user/{permission_id}/{user_id}",[\App\Http\Controllers\RolePermissionController::class,'assignPermissionUser']);
        Route::patch("assign-role-user/{user_id}/{role_id}",[\App\Http\Controllers\RolePermissionController::class,'assignRoleUser']);

        Route::patch("remove-permission-user/{user_id}/{permission_id}",[\App\Http\Controllers\RolePermissionController::class,'revokePermissionUser']);
        Route::patch("remove-permission-role/{role_id}/{permission_id}",[\App\Http\Controllers\RolePermissionController::class,'revokePermissionRole']);
        Route::patch("remove-role-user/{user_id}/{role_id}",[\App\Http\Controllers\RolePermissionController::class,'revokeRoleUser']);
    });
});
