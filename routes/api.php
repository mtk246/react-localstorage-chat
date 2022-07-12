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
->middleware('restrictIpAddress')->group(function() {

    Route::get("/",function(){
        return response()->json(["message"=>"Api Running"]);
    });

    Route::post('audit-all', [\App\Http\Controllers\AuditController::class,'getAuditAll'])->middleware('auth:api');
    Route::get('audit-all', [\App\Http\Controllers\AuditController::class,'getAudit'])->middleware('auth:api');
    Route::patch('audit-all-by-entity/{entity}/{id}', [\App\Http\Controllers\AuditController::class,'getAuditAllByEntity'])->middleware('auth:api');
    Route::patch('rollback-audit/{audit}/by-entity/{entity}/{id}', [\App\Http\Controllers\AuditController::class,'rollbackAuditByEntity'])->middleware('auth:api');
    Route::post('audit-all-by-user', [\App\Http\Controllers\AuditController::class,'getAuditAllByUser'])->middleware('auth:api');
    Route::post('audit-all-by-billing-company', [\App\Http\Controllers\AuditController::class,'getAuditAllByBillingCompany'])->middleware('auth:api');
    Route::post('audit-one', [\App\Http\Controllers\AuditController::class,'getAuditOne'])->middleware('auth:api');

    Route::prefix("auth")->group(function(){
        Route::post("login",[\App\Http\Controllers\AuthController::class,'login']);
        Route::get("check-token",[\App\Http\Controllers\AuthController::class,'checkToken']);
        Route::get("logout",[\App\Http\Controllers\AuthController::class,'logout'])->middleware('auth:api');
        Route::get("refresh-token",[\App\Http\Controllers\AuthController::class,'refresh'])->middleware('auth:api');
        Route::get("me",[\App\Http\Controllers\AuthController::class,'me'])->middleware('auth:api');
    });

    Route::prefix("user")->group(function(){
        Route::post("/",[\App\Http\Controllers\UserController::class,'createUser']);
        Route::get("/",[\App\Http\Controllers\UserController::class,'getAllUsers'])->middleware(['auth:api']);
        Route::get("{id}/",[\App\Http\Controllers\UserController::class,'getOneUser'])->middleware(['auth:api']);
        Route::post("send-email-rescue-pass",[\App\Http\Controllers\UserController::class,'sendEmailRescuePass']);
        Route::post("recovery-user",[\App\Http\Controllers\UserController::class,'recoveryUser']);
        Route::post("unlock-user",[\App\Http\Controllers\UserController::class,'unlockUser']);
        Route::post("change-password/{token}",[\App\Http\Controllers\UserController::class,'changePassword']);
        Route::post("new-token",[\App\Http\Controllers\UserController::class,'newToken']);
        Route::patch("{id?}/change-status",[\App\Http\Controllers\UserController::class,'changeStatus'])->middleware('auth:api');
        Route::put("{id}",[\App\Http\Controllers\UserController::class,'editUser'])->middleware('auth:api');
        Route::post("img-profile",[\App\Http\Controllers\UserController::class,'updateImgProfile'])->middleware(['auth:api']);
        Route::patch("social-medias/{id}",[\App\Http\Controllers\UserController::class,'updateSocialMediaProfile'])->middleware(['auth:api']);
        Route::patch("update-password",[\App\Http\Controllers\UserController::class,'changePasswordForm'])->middleware(['auth:api']);
        Route::get("/{ssn}/get-by-ssn",[\App\Http\Controllers\UserController::class,'searchBySsn']);
    });

    Route::prefix("permission")->middleware("auth:api")->group(function(){
        Route::get("roles",[\App\Http\Controllers\RolePermissionController::class,'getRoles']);
        Route::get("roles-permissions",[\App\Http\Controllers\RolePermissionController::class,'getRolesWithPermissions']);
        Route::get("permissions",[\App\Http\Controllers\RolePermissionController::class,'getPermissions']);
        Route::get("permissions-by-role/{role}",[\App\Http\Controllers\RolePermissionController::class,'getPermissionsByRole']);
        Route::get("role/{id}",[\App\Http\Controllers\RolePermissionController::class,'getOneRole']);
        Route::get("permission/{id}",[\App\Http\Controllers\RolePermissionController::class,'getOnePermission']);
        Route::post("create-role",[\App\Http\Controllers\RolePermissionController::class,'createRole']);
        Route::post("create-permission",[\App\Http\Controllers\RolePermissionController::class,'createPermission']);

        Route::patch("assign-permissions-role/{role_id}/{permission_id}",[\App\Http\Controllers\RolePermissionController::class,'assignPermissionRole']);
        Route::patch("assign-permissions-user/{permission_id}/{user_id}",[\App\Http\Controllers\RolePermissionController::class,'assignPermissionUser']);
        Route::patch("assign-role-user/{user_id}/{role_id}",[\App\Http\Controllers\RolePermissionController::class,'assignRoleUser']);

        Route::patch("remove-permission-user/{user_id}/{permission_id}",[\App\Http\Controllers\RolePermissionController::class,'revokePermissionUser']);
        Route::patch("remove-permission-role/{role_id}/{permission_id}",[\App\Http\Controllers\RolePermissionController::class,'revokePermissionRole']);
        Route::patch("remove-role-user/{user_id}/{role_id}",[\App\Http\Controllers\RolePermissionController::class,'revokeRoleUser']);


        Route::patch("assign-permissions-role/{role_id}",[\App\Http\Controllers\RolePermissionController::class,'assignPermissionsRole']);
        Route::patch("assign-permissions-user/{user_id}",[\App\Http\Controllers\RolePermissionController::class,'assignPermissionsUser']);

        Route::patch("remove-permissions-user/{user_id}",[\App\Http\Controllers\RolePermissionController::class,'revokePermissionsUser']);
        Route::patch("remove-permissions-role/{role_id}",[\App\Http\Controllers\RolePermissionController::class,'revokePermissionsRole']);
    });

    Route::prefix("setting")->middleware("auth:api")->group(function() {
        Route::prefix("ip-restriction")->group(function() {
            Route::post("/", [\App\Http\Controllers\IpRestrictionController::class,'store']);
            Route::get("/", [\App\Http\Controllers\IpRestrictionController::class,'getAllRestrictions']);
            Route::get("{id}", [\App\Http\Controllers\IpRestrictionController::class,'getOneRestriction']);
            Route::put("{id}", [\App\Http\Controllers\IpRestrictionController::class,'update']);
            Route::delete("{id}", [\App\Http\Controllers\IpRestrictionController::class,'destroy']);
        });
        Route::patch("/lang", [\App\Http\Controllers\UserController::class,'updateLang']);
    });

    Route::prefix("billing-company")->group(function(){
        Route::post("create",
            [\App\Http\Controllers\BillingCompanyController::class,'createCompany'])->middleware([
            "auth:api",
        ]);
        Route::put("/{billing_company_id}",[\App\Http\Controllers\BillingCompanyController::class,'update'])->middleware([
            "auth:api",
        ]);
        Route::get("/get-list",[\App\Http\Controllers\BillingCompanyController::class,'getList'])->middleware([
            "auth:api",
        ]);
        Route::get("/{billing_company_id}",[\App\Http\Controllers\BillingCompanyController::class,'getBillingCompany'])->middleware([
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
        Route::patch("/change-status/{billing_company_id}",[\App\Http\Controllers\BillingCompanyController::class,"changeStatus"])->middleware([
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
        Route::get("/get-by-name/{name}",[\App\Http\Controllers\ClearingHouseController::class,"getByName"])->middleware([
            "auth:api",
        ]);
        Route::patch("/{clearing_id}",[\App\Http\Controllers\ClearingHouseController::class,"changeStatus"])->middleware([
            "auth:api",
        ]);
        Route::patch("/add-to-billing-company/{clearing_house_id}",[\App\Http\Controllers\ClearingHouseController::class,'addToBillingCompany'])->middleware([
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
        Route::get("/get-facility-types",[\App\Http\Controllers\FacilityController::class,'getAllFacilityTypes'])->middleware([
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
        Route::get("/get-by-npi/{npi}",[\App\Http\Controllers\FacilityController::class,'getOneByNpi'])->middleware([
            "auth:api",
        ]);
        Route::patch("/add-to-billing-company/{id}",[\App\Http\Controllers\FacilityController::class,'addToBillingCompany'])->middleware([
            "auth:api",
        ]);
    });

    Route::prefix("company")->group(function() {
        Route::get("/get-list-by-billing-company/{id?}",[\App\Http\Controllers\CompanyController::class,'getList']);
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
        Route::get("/get-by-npi/{npi}",[\App\Http\Controllers\CompanyController::class,'getOneByNpi'])->middleware([
            "auth:api",
        ]);
        Route::put("/{id}",[\App\Http\Controllers\CompanyController::class,'updateCompany'])->middleware([
            "auth:api",
        ]);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\CompanyController::class,'changeStatus'])->middleware([
            "auth:api",
        ]);
        Route::patch("/add-to-billing-company/{id}",[\App\Http\Controllers\CompanyController::class,'addToBillingCompany'])->middleware([
            "auth:api",
        ]);
    });

    Route::prefix("device")->group(function(){
        Route::post("allow-device",[\App\Http\Controllers\DeviceController::class,'allowDevice']);
    });

    Route::prefix("insurance-company")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::get("/get-list",[\App\Http\Controllers\InsuranceCompanyController::class,'getList']);
        Route::get("/{id}",[\App\Http\Controllers\InsuranceCompanyController::class,'getOneInsurance']);
        Route::get("/{name}/get-by-name",[\App\Http\Controllers\InsuranceCompanyController::class,'getByName']);
        Route::post("/",[\App\Http\Controllers\InsuranceCompanyController::class,'createInsurance']);
        Route::get("/",[\App\Http\Controllers\InsuranceCompanyController::class,'getAllInsurance']);
        Route::put("/{id}",[\App\Http\Controllers\InsuranceCompanyController::class,'updateInsurance']);
        Route::patch("/{id}/change-status",[\App\Http\Controllers\InsuranceCompanyController::class,'changeStatus']);
        Route::patch("/add-to-billing-company/{insurance_company_id}",[\App\Http\Controllers\InsuranceCompanyController::class,'addToBillingCompany']);
    });

    Route::prefix("insurance-plan")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::get("/get-list",[\App\Http\Controllers\InsurancePlanController::class,'getList']);
        Route::get("/get-list-by-company/{company}",[\App\Http\Controllers\InsurancePlanController::class,'getListByCompany']);
        Route::post("/",[\App\Http\Controllers\InsurancePlanController::class,'createInsurancePlan']);
        Route::put("/{id}",[\App\Http\Controllers\InsurancePlanController::class,'updateInsurancePlan']);
        Route::get("/",[\App\Http\Controllers\InsurancePlanController::class,'getAllInsurancePlans']);
        Route::get("/{id}",[\App\Http\Controllers\InsurancePlanController::class,'getOneInsurancePlan']);
        Route::patch("/{id}/change-status",[\App\Http\Controllers\InsurancePlanController::class,'changeStatus']);
        Route::get("/{companyName}/get-by-company",[\App\Http\Controllers\InsurancePlanController::class,'getByCompany']);
        Route::get("/{name}/get-by-name",[\App\Http\Controllers\InsurancePlanController::class,'getByName']);
        Route::get("/insurance-company/{id}/get-by-insurance-company",[\App\Http\Controllers\InsurancePlanController::class,'getAllPlanByInsuranceCompany']);
    });

    Route::prefix("health-professional")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::post("/",[\App\Http\Controllers\DoctorController::class,'createDoctor']);
        Route::put("/{id}",[\App\Http\Controllers\DoctorController::class,'updateDoctor']);
        Route::get("/{id}",[\App\Http\Controllers\DoctorController::class,'getOneDoctor']);
        Route::get("/",[\App\Http\Controllers\DoctorController::class,'getAllDoctors']);
        Route::get("/{npi}/get-by-npi",[\App\Http\Controllers\DoctorController::class,'getOneByNpi']);
        Route::patch("/{id}/change-status",[\App\Http\Controllers\DoctorController::class,'changeStatus']);
    });

    Route::prefix("patient")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::post("/",[\App\Http\Controllers\PatientController::class,"createPatient"]);
        Route::get("/",[\App\Http\Controllers\PatientController::class,"getAllPatient"]);
        Route::get("/{id}",[\App\Http\Controllers\PatientController::class,"getOnePatient"]);
        Route::put("/{id}",[\App\Http\Controllers\PatientController::class,"updatePatient"]);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\PatientController::class,'changeStatus']);

        Route::get("/get-suscribers/{ssn_patient}",[\App\Http\Controllers\PatientController::class,"getAllSuscribers"]);
    });

    Route::prefix("taxonomy")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::post("/",[\App\Http\Controllers\TaxonomyController::class,'createTaxonomy']);
        Route::put("/{id}",[\App\Http\Controllers\TaxonomyController::class,'updateTaxonomy']);
        Route::patch("/{id}/change-primary",[\App\Http\Controllers\TaxonomyController::class,'changePrimary']);
        Route::delete("/{id}",[\App\Http\Controllers\TaxonomyController::class,'removeTaxonomy']);
        Route::get("/{type}/{id}",[\App\Http\Controllers\TaxonomyController::class,'getAllTaxonomies']);
        Route::get("/{id}",[\App\Http\Controllers\TaxonomyController::class,'getOneTaxonomy']);
    });

    Route::prefix("service")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::post("/",[\App\Http\Controllers\ServiceController::class,'create']);
        Route::put("/{id}",[\App\Http\Controllers\ServiceController::class,'update']);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\ServiceController::class,"changeStatus"]);

        Route::get("/get-list-service-rev-centers",[\App\Http\Controllers\ServiceController::class,'getAllServiceRevCenters']);
        Route::get("/get-list-service-applicable-to",[\App\Http\Controllers\ServiceController::class,'getAllServiceApplicableTo']);
        Route::get("/get-list-service-groups",[\App\Http\Controllers\ServiceController::class,'getAllServiceGroups']);
        Route::get("/get-list-service-types",[\App\Http\Controllers\ServiceController::class,'getAllServiceTypes']);
        Route::get("/get-list-service-type-of-services",[\App\Http\Controllers\ServiceController::class,'getAllServiceTypeOfServices']);
        Route::get("/get-list-service-stmt-descriptions",[\App\Http\Controllers\ServiceController::class,'getAllServiceStmtDescriptions']);
        Route::get("/get-list-service-special-instructions",[\App\Http\Controllers\ServiceController::class,'getAllServiceSpecialInstructions']);
        Route::get("/",[\App\Http\Controllers\ServiceController::class,'getAllServices']);
        Route::get("/{id}",[\App\Http\Controllers\ServiceController::class,'getOneService']);
    });

    Route::prefix("diagnosis")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::post("/",[\App\Http\Controllers\DiagnosisController::class,"createDiagnosis"]);
        Route::get("/",[\App\Http\Controllers\DiagnosisController::class,"getAllDiagnoses"]);
        Route::get("/{id}",[\App\Http\Controllers\DiagnosisController::class,"getOneDiagnosis"]);
        Route::put("/{id}",[\App\Http\Controllers\DiagnosisController::class,"updateDiagnosis"]);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\DiagnosisController::class,'changeStatus']);

        Route::get("/get-list",[\App\Http\Controllers\DiagnosisController::class,"getList"]);
    });

    Route::prefix("modifier")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::post("/",[\App\Http\Controllers\ModifierController::class,"createModifier"]);
        Route::get("/",[\App\Http\Controllers\ModifierController::class,"getAllModifiers"]);
        Route::get("/{id}",[\App\Http\Controllers\ModifierController::class,"getOneModifier"]);
        Route::put("/{id}",[\App\Http\Controllers\ModifierController::class,"updateModifier"]);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\ModifierController::class,'changeStatus']);

        Route::get("/get-list",[\App\Http\Controllers\ModifierController::class,"getList"]);
    });

    Route::prefix("procedure")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::post("/",[\App\Http\Controllers\ProcedureController::class,"createProcedure"]);
        Route::get("/",[\App\Http\Controllers\ProcedureController::class,"getAllProcedures"]);
        Route::get("/{id}",[\App\Http\Controllers\ProcedureController::class,"getOneProcedure"]);
        Route::put("/{id}",[\App\Http\Controllers\ProcedureController::class,"updateProcedure"]);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\ProcedureController::class,'changeStatus']);
    });

    Route::get('npi/{npi}', [\App\Http\Controllers\ApiController::class, 'getNpi']);
    Route::post('usps', [\App\Http\Controllers\ApiController::class, 'getZipCode']);
});
