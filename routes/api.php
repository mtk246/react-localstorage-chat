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

Route::prefix("v1")/*->middleware('audit')*/
/*->middleware('checkAvailable')*/->group(function(){

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
        Route::post("/",[\App\Http\Controllers\UserController::class,'createUser']);
        Route::get("/",[\App\Http\Controllers\UserController::class,'getAllUsers'])->middleware(['auth:api','role:SUPER_USER']);
        Route::get("{id}/",[\App\Http\Controllers\UserController::class,'getOneUser'])->middleware(['auth:api','role:SUPER_USER']);
        Route::post("send-email-rescue-pass",[\App\Http\Controllers\UserController::class,'sendEmailRescuePass']);
        Route::post("send-email-rescue-user",[\App\Http\Controllers\UserController::class,'recoveryUser']);
        Route::post("change-password/{token}",[\App\Http\Controllers\UserController::class,'changePassword']);
        Route::patch("{id?}/change-status",[\App\Http\Controllers\UserController::class,'changeStatus'])->middleware('auth:api');
        Route::put("{id?}",[\App\Http\Controllers\UserController::class,'editUser'])->middleware('auth:api');
        Route::post("img-profile",[\App\Http\Controllers\UserController::class,'updateImgProfile'])->middleware(['auth:api']);
        Route::patch("update-password",[\App\Http\Controllers\UserController::class,'changePasswordForm'])->middleware(['auth:api']);
        Route::get("/{ssn}/get-by-ssn",[\App\Http\Controllers\UserController::class,'searchBySsn']);
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

    Route::prefix("billing-company")->group(function(){
        Route::post("create",
            [\App\Http\Controllers\BillingCompanyController::class,'createCompany'])->middleware([
            "auth:api",
        ]);
        Route::get("/user/{user_id}",[\App\Http\Controllers\BillingCompanyController::class,'getBillingCompanyByUser'])->middleware([
            "auth:api",
        ]);
        Route::get("/",[\App\Http\Controllers\BillingCompanyController::class,'getAllBillingCompany'])->middleware([
            "auth:api",
        ]);
        Route::get("get-by-code/{code}",[\App\Http\Controllers\BillingCompanyController::class,'getByCode'])->middleware([
            "auth:api",
        ]);
        Route::get("get-by-name/{name}",[\App\Http\Controllers\BillingCompanyController::class,'getByName'])->middleware([
            "auth:api",
        ]);
    });

    Route::prefix("clearing-house")->group(function(){
        Route::post("/",[\App\Http\Controllers\ClearingHouseController::class,'createClearingHouse'])->middleware([
            "auth:api",
        ]);
        Route::get("/",[\App\Http\Controllers\ClearingHouseController::class,'getAllClearingHouse'])->middleware([
            "auth:api",
        ]);
        Route::get("/{id}",[\App\Http\Controllers\ClearingHouseController::class,'getOneClearingHouse'])->middleware([
            "auth:api",
        ]);
        Route::put("/{clearing_id}",[\App\Http\Controllers\ClearingHouseController::class,"updateClearingHouse"])->middleware([
            "auth:api",
        ]);
        Route::get("/get-by-name/{name}",[\App\Http\Controllers\ClearingHouseController::class,"getOneByName"])->middleware([
            "auth:api",
        ]);
        Route::patch("/{clearing_id}",[\App\Http\Controllers\ClearingHouseController::class,"changeStatus"])->middleware([
            "auth:api",
        ]);
    });

    Route::prefix("facility")->group(function(){
        Route::post("/",[\App\Http\Controllers\FacilityController::class,'create'])->middleware([
            "auth:api",
        ]);
        Route::get("/",[\App\Http\Controllers\FacilityController::class,'getAllFacilities'])->middleware([
            "auth:api",
        ]);
        Route::get("/{id}",[\App\Http\Controllers\FacilityController::class,'getOneFacility'])->middleware([
            "auth:api",
        ]);
        Route::put("/{id}",[\App\Http\Controllers\FacilityController::class,'updateFacility'])->middleware([
            "auth:api",
        ]);
        Route::patch("/{id}/change-status",[\App\Http\Controllers\FacilityController::class,'changeStatus'])->middleware([
            "auth:api",
        ]);
        Route::get("/{id}/get-by-name",[\App\Http\Controllers\FacilityController::class,'getByName'])->middleware([
            "auth:api",
        ]);
    });

    Route::prefix("company")->group(function(){
        Route::post("/",[\App\Http\Controllers\CompanyController::class,'createCompany'])->middleware([
            "auth:api",
        ]);
        Route::get("/",[\App\Http\Controllers\CompanyController::class,'getAllCompany'])->middleware([
            "auth:api",
        ]);
        Route::get("/{id}",[\App\Http\Controllers\CompanyController::class,'getOneCompany'])->middleware([
            "auth:api",
        ]);
        Route::get("/get-by-name/{name}",[\App\Http\Controllers\CompanyController::class,'getByName'])->middleware([
            "auth:api",
        ]);
        Route::get("/get-by-email/{email}",[\App\Http\Controllers\CompanyController::class,'getOneByEmail'])->middleware([
            "auth:api",
        ]);
        Route::put("/{id}",[\App\Http\Controllers\CompanyController::class,'updateCompany'])->middleware([
            "auth:api",
        ]);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\CompanyController::class,'changeStatus'])->middleware([
            "auth:api",
        ]);
    });

    Route::prefix("device")->group(function(){
        Route::post("allow-device",[\App\Http\Controllers\DeviceController::class,'allowDevice']);
    });

    Route::prefix("insurance-company")->middleware([
        "auth:api",
        'role:SUPER_USER|BILLER|BILLING_MANAGER',
    ])->group(function(){
        Route::get("/{id}",[\App\Http\Controllers\InsuranceCompanyController::class,'getOneInsurance']);
        Route::get("/{name}/get-by-name",[\App\Http\Controllers\InsuranceCompanyController::class,'getByName']);
        Route::post("/",[\App\Http\Controllers\InsuranceCompanyController::class,'createInsurance']);
        Route::get("/",[\App\Http\Controllers\InsuranceCompanyController::class,'getAllInsurance']);
        Route::put("/{id}",[\App\Http\Controllers\InsuranceCompanyController::class,'updateInsurance']);
        Route::patch("/{id}/change-status",[\App\Http\Controllers\InsuranceCompanyController::class,'changeStatus']);
    });

    Route::prefix("insurance-plan")->middleware([
        "auth:api",
        'role:SUPER_USER|BILLER|BILLING_MANAGER',
    ])->group(function(){
        Route::post("/",[\App\Http\Controllers\InsurancePlanController::class,'createInsurancePlan']);
        Route::put("/{id}",[\App\Http\Controllers\InsurancePlanController::class,'updateInsurancePlan']);
        Route::get("/",[\App\Http\Controllers\InsurancePlanController::class,'getAllInsurancePlans']);
        Route::get("/{id}",[\App\Http\Controllers\InsurancePlanController::class,'getOneInsurancePlan']);
        Route::patch("/{id}/change-status",[\App\Http\Controllers\InsurancePlanController::class,'changeStatus']);
        Route::get("/{companyName}/get-by-company",[\App\Http\Controllers\InsurancePlanController::class,'getByCompany']);
        Route::get("/{name}/get-by-name",[\App\Http\Controllers\InsurancePlanController::class,'getByName']);
        Route::get("/insurance-company/{id}/get-by-insurance-company",[\App\Http\Controllers\InsurancePlanController::class,'getAllPlanByInsuranceCompany']);
    });

    Route::prefix("doctor")->middleware([
        "auth:api",
        'role:SUPER_USER',
    ])->group(function(){
        Route::post("/",[\App\Http\Controllers\DoctorController::class,'createDoctor']);
        Route::put("/{id}",[\App\Http\Controllers\DoctorController::class,'updateDoctor']);
        Route::get("/{id}",[\App\Http\Controllers\DoctorController::class,'getOneDoctor']);
        Route::get("/",[\App\Http\Controllers\DoctorController::class,'getAllDoctors']);
        Route::get("/{npi}/get-by-npi",[\App\Http\Controllers\DoctorController::class,'getByNpi']);
        Route::patch("/{id}/change-status",[\App\Http\Controllers\DoctorController::class,'changeStatus']);
    });

    Route::prefix("patient")->middleware([
        "auth:api",
        'role:SUPER_USER|BILLER|BILLING_MANAGER',
    ])->group(function(){
        Route::post("/",[\App\Http\Controllers\PatientController::class,"createPatient"]);
        Route::get("/",[\App\Http\Controllers\PatientController::class,"getAllPatient"]);
        Route::get("/{id}",[\App\Http\Controllers\PatientController::class,"getOnePatient"]);
        Route::put("/{id}",[\App\Http\Controllers\PatientController::class,"updatePatient"]);
    });

    Route::prefix("taxonomy")->middleware([
        "auth:api",
        'role:SUPER_USER|BILLER|BILLING_MANAGER',
    ])->group(function(){
        Route::post("/",[\App\Http\Controllers\TaxonomyController::class,'createTaxonomy']);
        Route::put("/{id}",[\App\Http\Controllers\TaxonomyController::class,'updateTaxonomy']);
        Route::patch("/{id}/change-primary",[\App\Http\Controllers\TaxonomyController::class,'changePrimary']);
        Route::delete("/{id}",[\App\Http\Controllers\TaxonomyController::class,'removeTaxonomy']);
        Route::get("/{type}/{id}",[\App\Http\Controllers\TaxonomyController::class,'getAllTaxonomies']);
        Route::get("/{id}",[\App\Http\Controllers\TaxonomyController::class,'getOneTaxonomy']);
    });

    Route::get('npi/{npi}', [\App\Http\Controllers\ApiController::class, 'getNpi']);
    Route::post('usps', [\App\Http\Controllers\ApiController::class, 'getZipCode']);
});
