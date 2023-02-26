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
->middleware(['restrictIpAddress', 'lastActivity'])->group(function() {

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
        Route::post("send-email-code",[\App\Http\Controllers\AuthController::class,'sendEmailCode']);
        Route::get("check-token",[\App\Http\Controllers\AuthController::class,'checkToken']);
        Route::get("logout",[\App\Http\Controllers\AuthController::class,'logout'])->middleware('auth:api');
        Route::get("refresh-token",[\App\Http\Controllers\AuthController::class,'refresh'])->middleware('auth:api');
        Route::get("me",[\App\Http\Controllers\AuthController::class,'me'])->middleware('auth:api');
    });

    Route::prefix("user")->group(function(){
        Route::get("/get-all-server",[\App\Http\Controllers\UserController::class,'getServerAllUsers'])->middleware(['auth:api']);
        Route::get("/get-list",[\App\Http\Controllers\UserController::class,'getList'])->middleware(['auth:api']);
        Route::get("/search/{date_of_birth?}/{first_name?}/{last_name?}/{ssn?}", [\App\Http\Controllers\UserController::class,'search']);
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
        
        Route::get("social-networks/get-list",[\App\Http\Controllers\UserController::class,'getListSocialNetworks'])->middleware(['auth:api']);
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
            Route::get("/get-all-server",[\App\Http\Controllers\IpRestrictionController::class,'getServerAll']);
            Route::post("/", [\App\Http\Controllers\IpRestrictionController::class,'store']);
            Route::get("/", [\App\Http\Controllers\IpRestrictionController::class,'getAllRestrictions']);
            Route::get("{id}", [\App\Http\Controllers\IpRestrictionController::class,'getOneRestriction']);
            Route::put("{id}", [\App\Http\Controllers\IpRestrictionController::class,'update']);
            Route::delete("{id}", [\App\Http\Controllers\IpRestrictionController::class,'destroy']);
        });
        Route::patch("/lang", [\App\Http\Controllers\UserController::class,'updateLang']);
    });

    Route::prefix("billing-company")->group(function(){
        Route::get("/get-all-server",[\App\Http\Controllers\BillingCompanyController::class,'getServerAllBillingCompanies'])->middleware(['auth:api']);
        Route::post("create",
            [\App\Http\Controllers\BillingCompanyController::class,'createCompany'])->middleware([
            "auth:api",
        ]);
        Route::post("/upload-image", [\App\Http\Controllers\BillingCompanyController::class, 'uploadImage'])->middleware(['auth:api']);
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
        Route::get("/get-all-server",[\App\Http\Controllers\ClearingHouseController::class,'getServerAll'])->middleware(['auth:api']);
        Route::get("/get-list-transmission-formats",[\App\Http\Controllers\ClearingHouseController::class,'getListTransmissionFormats'])->middleware(['auth:api']);
        Route::get("/get-list-org-types",[\App\Http\Controllers\ClearingHouseController::class,'getListOrgTypes'])->middleware(['auth:api']);
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
        Route::get("/get-all-server",[\App\Http\Controllers\FacilityController::class,'getServerAll'])->middleware(['auth:api']);
        Route::get("/get-list-billing-companies",[\App\Http\Controllers\FacilityController::class,'getListBillingCompanies'])->middleware(['auth:api']);
        Route::post("/",[\App\Http\Controllers\FacilityController::class,'create'])->middleware([
            "auth:api",
        ]);
        Route::get("/",[\App\Http\Controllers\FacilityController::class,'getAllFacilities'])->middleware([
            "auth:api",
        ]);
        Route::get("/get-list-facility-types",[\App\Http\Controllers\FacilityController::class,'getListFacilityTypes'])->middleware([
            "auth:api",
        ]);
        Route::get("/get-list",[\App\Http\Controllers\FacilityController::class,'getList'])->middleware([
            "auth:api",
        ]);
        Route::get("/get-list-place-of-services",[\App\Http\Controllers\ClaimController::class,"getListPlaceOfServices"]);
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
        Route::get("/get-all-by-company/{company_id}",[\App\Http\Controllers\FacilityController::class,'getAllByCompany'])->middleware([
            "auth:api",
        ]);
        Route::patch("/add-to-billing-company/{id}",[\App\Http\Controllers\FacilityController::class,'addToBillingCompany'])->middleware([
            "auth:api",
        ]);
        Route::patch("/{facility_id}/add-to-company/{company_id}",[\App\Http\Controllers\FacilityController::class,'addToCompany'])->middleware([
            "auth:api",
        ]);
        Route::patch("/{facility_id}/remove-to-company/{company_id}",[\App\Http\Controllers\FacilityController::class,'removeToCompany'])->middleware([
            "auth:api",
        ]);
    });

    Route::prefix("company")->group(function() {
        Route::get("/get-all-server",[\App\Http\Controllers\CompanyController::class,'getServerAll'])->middleware(['auth:api']);
        Route::get("/get-list-by-billing-company/{id?}",[\App\Http\Controllers\CompanyController::class,'getList']);
        Route::get("/get-list-name-suffix",[\App\Http\Controllers\CompanyController::class,'getListNameSuffix']);
        Route::get("/get-list-statement-rules",[\App\Http\Controllers\CompanyController::class,'getListStatementRules']);
        Route::get("/get-list-statement-when",[\App\Http\Controllers\CompanyController::class,'getListStatementWhen']);
        Route::get("/get-list-statement-apply-to",[\App\Http\Controllers\CompanyController::class,'getListStatementApplyTo']);
        Route::get("/get-list-contract-fee-types",[\App\Http\Controllers\CompanyController::class,'getListContractFeeTypes']);
        Route::get("/get-list-billing-companies",[\App\Http\Controllers\CompanyController::class,'getListBillingCompanies']);
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
        Route::patch("/add-facilities-to-company/{id}",[\App\Http\Controllers\CompanyController::class,'addFacilities'])->middleware([
            "auth:api",
        ]);
        Route::patch("/add-services-to-company/{id}",[\App\Http\Controllers\CompanyController::class,'addServices'])->middleware([
            "auth:api",
        ]);
        Route::patch("/add-copays-to-company/{id}",[\App\Http\Controllers\CompanyController::class,'addCopays'])->middleware([
            "auth:api",
        ]);
        Route::patch("/add-contract-fees-to-company/{id}",[\App\Http\Controllers\CompanyController::class,'addContractFees'])->middleware([
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
        Route::get("/get-all-server",[\App\Http\Controllers\InsuranceCompanyController::class,'getServerAll']);
        Route::get("/get-list",[\App\Http\Controllers\InsuranceCompanyController::class,'getList']);
        Route::get("/get-list-file-methods",[\App\Http\Controllers\InsuranceCompanyController::class,'getListFileMethods']);
        Route::get("/get-list-from-the-date",[\App\Http\Controllers\InsuranceCompanyController::class,'getListFromTheDate']);
        Route::get("/get-list-billing-incomplete-reasons",[\App\Http\Controllers\InsuranceCompanyController::class,'getListBillingIncompleteReasons']);
        Route::get("/get-list-appeal-reasons",[\App\Http\Controllers\InsuranceCompanyController::class,'getListAppealReasons']);
        Route::get("/get-list-billing-companies",[\App\Http\Controllers\InsuranceCompanyController::class,'getListBillingCompanies'])->middleware(['auth:api']);
        Route::get("/{id}",[\App\Http\Controllers\InsuranceCompanyController::class,'getOneInsurance']);
        Route::get("/{name}/get-by-name",[\App\Http\Controllers\InsuranceCompanyController::class,'getByName']);
        Route::get("/get-by-payer-id/{payer}",[\App\Http\Controllers\InsuranceCompanyController::class,'getByPayer']);
        Route::post("/",[\App\Http\Controllers\InsuranceCompanyController::class,'createInsurance']);
        Route::get("/",[\App\Http\Controllers\InsuranceCompanyController::class,'getAllInsurance']);
        Route::put("/{id}",[\App\Http\Controllers\InsuranceCompanyController::class,'updateInsurance']);
        Route::patch("/{id}/change-status",[\App\Http\Controllers\InsuranceCompanyController::class,'changeStatus']);
        Route::patch("/add-to-billing-company/{insurance_company_id}",[\App\Http\Controllers\InsuranceCompanyController::class,'addToBillingCompany']);
    });

    Route::prefix("insurance-plan")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function() {
        Route::get("/get-all-server",[\App\Http\Controllers\InsurancePlanController::class,'getServerAll']);
        Route::get("/get-list",[\App\Http\Controllers\InsurancePlanController::class,'getList']);
        Route::get("/get-list-formats",[\App\Http\Controllers\InsurancePlanController::class,'getListFormats']);
        Route::get("/get-list-ins-types",[\App\Http\Controllers\InsurancePlanController::class,'getListInsTypes']);
        Route::get("/get-list-plan-types",[\App\Http\Controllers\InsurancePlanController::class,'getListPlanTypes']);
        Route::get("/get-list-charge-usings",[\App\Http\Controllers\InsurancePlanController::class,'getListChargeUsings']);
        Route::post("/",[\App\Http\Controllers\InsurancePlanController::class,'createInsurancePlan']);
        Route::put("/{id}",[\App\Http\Controllers\InsurancePlanController::class,'updateInsurancePlan']);
        Route::get("/",[\App\Http\Controllers\InsurancePlanController::class,'getAllInsurancePlans']);
        Route::get("/{id}",[\App\Http\Controllers\InsurancePlanController::class,'getOneInsurancePlan']);
        Route::patch("/{id}/change-status",[\App\Http\Controllers\InsurancePlanController::class,'changeStatus']);
        Route::get("/{companyName}/get-by-company",[\App\Http\Controllers\InsurancePlanController::class,'getByCompany']);
        Route::get("/{name}/get-by-name",[\App\Http\Controllers\InsurancePlanController::class,'getByName']);
        Route::get("/insurance-company/{id}/get-by-insurance-company",[\App\Http\Controllers\InsurancePlanController::class,'getAllPlanByInsuranceCompany']);
        Route::patch("/add-copays-to-insurance-plan/{id}",[\App\Http\Controllers\InsurancePlanController::class,'addCopays']);
        Route::patch("/add-contract-fees-to-insurance-plan/{id}",[\App\Http\Controllers\InsurancePlanController::class,'addContractFees']);
    });

    Route::prefix("health-professional")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::get("/get-list-health-professional-types",[\App\Http\Controllers\DoctorController::class,'getListTypes']);
        Route::get("/get-list-authorizations",[\App\Http\Controllers\DoctorController::class,'getListAuthorizations']);
        Route::get("/get-list-billing-companies",[\App\Http\Controllers\DoctorController::class,'getListBillingCompanies']);
        Route::get("/get-list",[\App\Http\Controllers\DoctorController::class,'getList']);
        Route::get("/get-all-server",[\App\Http\Controllers\DoctorController::class,'getServerAll']);
        Route::post("/",[\App\Http\Controllers\DoctorController::class,'createDoctor']);
        Route::put("/{id}",[\App\Http\Controllers\DoctorController::class,'updateDoctor']);
        Route::get("/{id}",[\App\Http\Controllers\DoctorController::class,'getOneDoctor']);
        Route::get("/",[\App\Http\Controllers\DoctorController::class,'getAllDoctors']);
        Route::get("/{npi}/get-by-npi",[\App\Http\Controllers\DoctorController::class,'getOneByNpi']);
        Route::patch("/{id}/change-status",[\App\Http\Controllers\DoctorController::class,'changeStatus']);
        Route::put("/{id}/update-companies",[\App\Http\Controllers\DoctorController::class,'updateCompanies']);
    });

    Route::prefix("patient")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::get("/get-all-server",[\App\Http\Controllers\PatientController::class,'getServerAll']);
        Route::get("/search/{date_of_birth?}/{first_name?}/{last_name?}/{ssn?}", [\App\Http\Controllers\PatientController::class,'search']);
        Route::get("/get-list",[\App\Http\Controllers\PatientController::class,"getList"]);
        Route::get("/get-list-marital-status",[\App\Http\Controllers\PatientController::class,"getListMaritalStatus"]);
        Route::get("/get-list-address-type",[\App\Http\Controllers\PatientController::class,"getListAddressType"]);
        Route::get("/get-list-insurance-policy-type",[\App\Http\Controllers\PatientController::class,"getListInsurancePolicyType"]);
        Route::get("/get-list-responsibility-type",[\App\Http\Controllers\PatientController::class,"getListResponsibilityType"]);
        Route::get("/get-list-relationship",[\App\Http\Controllers\PatientController::class,"getListRelationship"]);
        Route::post("/",[\App\Http\Controllers\PatientController::class,"createPatient"]);
        Route::get("/",[\App\Http\Controllers\PatientController::class,"getAllPatient"]);
        Route::get("/get-by-ssn/{ssn}",[\App\Http\Controllers\PatientController::class,"getBySsn"]);
        Route::get("/{id}",[\App\Http\Controllers\PatientController::class,"getOnePatient"]);
        Route::put("/{id}",[\App\Http\Controllers\PatientController::class,"updatePatient"]);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\PatientController::class,'changeStatus']);
        Route::patch("/add-policy-to-patient/{id}",[\App\Http\Controllers\PatientController::class,'addPolicy']);
        Route::patch("/{patient_id}/remove-policy/{policy_id}",[\App\Http\Controllers\PatientController::class,'removePolicy']);
        Route::patch("/{patient_id}/edit-policy/{policy_id}",[\App\Http\Controllers\PatientController::class,'editPolicy']);
        Route::get("/{patient_id}/get-policy/{policy_id}",[\App\Http\Controllers\PatientController::class,'getPolicy']);
        Route::get("/{patient_id}/get-policies",[\App\Http\Controllers\PatientController::class,'getPolicies']);

        Route::get("/get-subscribers/{ssn_patient}",[\App\Http\Controllers\PatientController::class,"getAllSubscribers"]);
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
    ])->group(function() {
        Route::get("/get-all-server",[\App\Http\Controllers\DiagnosisController::class,'getServerAll']);
        Route::post("/",[\App\Http\Controllers\DiagnosisController::class,"createDiagnosis"]);
        Route::get("/",[\App\Http\Controllers\DiagnosisController::class,"getAllDiagnoses"]);
        Route::get("get-by-code/{code}",[\App\Http\Controllers\DiagnosisController::class,"getByCode"]);
        Route::get("/{id}",[\App\Http\Controllers\DiagnosisController::class,"getOneDiagnosis"]);
        Route::put("/{id}",[\App\Http\Controllers\DiagnosisController::class,"updateDiagnosis"]);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\DiagnosisController::class,'changeStatus']);

        Route::get("/get-list",[\App\Http\Controllers\DiagnosisController::class,"getList"]);
    });

    Route::prefix("modifier")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function() {
        Route::get("/get-all-server",[\App\Http\Controllers\ModifierController::class,'getServerAll']);
        Route::get("/get-list",[\App\Http\Controllers\ModifierController::class,"getList"]);
        Route::post("/",[\App\Http\Controllers\ModifierController::class,"createModifier"]);
        Route::get("/",[\App\Http\Controllers\ModifierController::class,"getAllModifiers"]);
        Route::get("/{id}",[\App\Http\Controllers\ModifierController::class,"getOneModifier"]);
        Route::get("/get-by-code/{code}",[\App\Http\Controllers\ModifierController::class,"getByCode"]);
        Route::put("/{id}",[\App\Http\Controllers\ModifierController::class,"updateModifier"]);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\ModifierController::class,'changeStatus']);

    });

    Route::prefix("procedure")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function(){
        Route::get("/get-all-server",[\App\Http\Controllers\ProcedureController::class,'getServerAll']);
        Route::get("/get-by-code/{code}",[\App\Http\Controllers\ProcedureController::class,"getByCode"]);
        Route::get("/get-list-mac-localities",[\App\Http\Controllers\ProcedureController::class,"getListMacLocalities"]);
        Route::get("/get-price-of-procedure",[\App\Http\Controllers\ProcedureController::class,"getPriceOfProcedure"]);
        Route::get("/get-list-genders",[\App\Http\Controllers\ProcedureController::class,"getListGenders"]);
        Route::get("/get-list-discriminatories",[\App\Http\Controllers\ProcedureController::class,"getListDiscriminatories"]);
        Route::get("/get-list-modifiers/{code?}",[\App\Http\Controllers\ProcedureController::class,"getListModifiers"]);
        Route::get("/get-list-diagnoses/{code?}",[\App\Http\Controllers\ProcedureController::class,"getListdiagnoses"]);
        Route::get("/get-list-insurance-companies/{procedure_id?}",[\App\Http\Controllers\ProcedureController::class,"getListInsuranceCompanies"]);
        Route::get("/get-list-insurance-label-fees",[\App\Http\Controllers\ProcedureController::class,"getListInsuranceLabelFees"]);
        Route::get("/get-list/{company_id?}",[\App\Http\Controllers\ProcedureController::class,"getList"]);

        Route::post("/",[\App\Http\Controllers\ProcedureController::class,"createProcedure"]);
        Route::get("/",[\App\Http\Controllers\ProcedureController::class,"getAllProcedures"]);
        Route::get("/{id}",[\App\Http\Controllers\ProcedureController::class,"getOneProcedure"]);
        Route::put("/{id}",[\App\Http\Controllers\ProcedureController::class,"updateProcedure"]);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\ProcedureController::class,'changeStatus']);
        Route::patch("/add-to-company/{company_id}",[\App\Http\Controllers\ProcedureController::class,'addToCompany']);
        Route::get("/get-to-company/{company_id}",[\App\Http\Controllers\ProcedureController::class,'getToCompany']);
    });


    Route::prefix("injury")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function() {
        Route::get("/get-list-type-diags",[\App\Http\Controllers\ClaimController::class,"getListTypeDiags"]);

    });

    Route::prefix("claim")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function() {
        Route::prefix("/batch")->middleware([
            "auth:api",
            'role:superuser|biller|billingmanager',
        ])->group(function(){
            Route::get("/get-all-server", [\App\Http\Controllers\ClaimBatchController::class, 'getServerAll']);
            Route::get("/get-all-server-claims", [\App\Http\Controllers\ClaimBatchController::class, 'getServerClaims']);
            Route::get("show-batch-preview/{id}",[\App\Http\Controllers\ClaimBatchController::class,"showReport"]);
            Route::get("/{id}",[\App\Http\Controllers\ClaimBatchController::class,"getOneClaimBatch"]);
            Route::post("/",[\App\Http\Controllers\ClaimBatchController::class,"createBatch"]);
            Route::put("/{id}",[\App\Http\Controllers\ClaimBatchController::class,"updateBatch"]);
            Route::delete("/{id}",[\App\Http\Controllers\ClaimBatchController::class,"deleteBatch"]);
            Route::patch("/submit-to-clearing-house/{id}",[\App\Http\Controllers\ClaimBatchController::class,"submitToClearingHouse"]);
        });

        //Route::get("/get-all-server",[\App\Http\Controllers\ClaimController::class,'getServerAll']);
        Route::get("/get-list-claim-services",[\App\Http\Controllers\ClaimController::class,"getListClaimServices"]);
        Route::get("/get-list-type-of-services",[\App\Http\Controllers\ClaimController::class,"getListTypeOfServices"]);
        Route::get("/get-list-place-of-services",[\App\Http\Controllers\ClaimController::class,"getListPlaceOfServices"]);
        Route::get("/get-list-rev-centers",[\App\Http\Controllers\ClaimController::class,"getListRevCenters"]);
        Route::get("/get-list-type-formats",[\App\Http\Controllers\ClaimController::class,"getListTypeFormats"]);
        Route::get("/get-list-claim-field-informations",[\App\Http\Controllers\ClaimController::class,"getListClaimFieldInformations"]);
        Route::get("/get-list-qualifier-by-field/{field_id}",[\App\Http\Controllers\ClaimController::class,"getListFieldQualifiers"]);
        Route::get("/get-list-status",[\App\Http\Controllers\ClaimController::class,"getListStatus"]);
        Route::get("/get-all-server", [\App\Http\Controllers\ClaimController::class, 'getServerAll']);
        Route::post("/show-claim-preview",[\App\Http\Controllers\ClaimController::class,"ShowReport"]);

        Route::get("/get-access-token",[\App\Http\Controllers\ClaimController::class,"getSecurityAuthorizationAccessToken"]);
        Route::get("/check-eligibility/{id}",[\App\Http\Controllers\ClaimController::class,"checkEligibility"]);
        Route::get("/validation/{id}",[\App\Http\Controllers\ClaimController::class,"claimValidation"]);

        Route::post("/",[\App\Http\Controllers\ClaimController::class,"createClaim"]);
        Route::get("/{id}",[\App\Http\Controllers\ClaimController::class,"getOneClaim"]);
        Route::get("/{status?}/{substatus?}",[\App\Http\Controllers\ClaimController::class,"getAllClaims"]);
        Route::put("/{id}",[\App\Http\Controllers\ClaimController::class,"updateClaim"]);
        
        Route::post("/draft",[\App\Http\Controllers\ClaimController::class,"saveAsDraft"]);
        Route::put("/draft/{id}",[\App\Http\Controllers\ClaimController::class,"updateAsDraft"]);

        Route::post("/draft-check-eligibility",[\App\Http\Controllers\ClaimController::class,"saveAsDraftAndEligibility"]);
        Route::put("/verify-register/{id}", [\App\Http\Controllers\ClaimController::class,"verifyAndRegister"]);

        Route::patch("/change-status/{id}",[\App\Http\Controllers\ClaimController::class,"changeStatus"]);
        Route::patch("/update-note-current-status/{id}",[\App\Http\Controllers\ClaimController::class,"updateNoteCurrentStatus"]);
        Route::patch("/add-note-current-status/{id}",[\App\Http\Controllers\ClaimController::class,"AddNoteCurrentStatus"]);
    });

    Route::prefix("claim-sub-status")->middleware([
        "auth:api",
        'role:superuser|biller|billingmanager',
    ])->group(function() {
        Route::get("/get-all-server",[\App\Http\Controllers\ClaimSubStatusController::class,'getServerAll'])->middleware(['auth:api']);
        Route::get("/get-list-by-billing-company/{status_id}/{billing_company_id?}",[\App\Http\Controllers\ClaimSubStatusController::class,"getList"]);
        Route::get("/get-list-status",[\App\Http\Controllers\ClaimSubStatusController::class,"getListStatus"]);
        Route::post("/",[\App\Http\Controllers\ClaimSubStatusController::class,'createClaimSubStatus'])->middleware([
            "auth:api",
        ]);
        Route::get("/{id}",[\App\Http\Controllers\ClaimSubStatusController::class,'getOneClaimSubStatus'])->middleware([
            "auth:api",
        ]);
        Route::get("/get-by-name/{name}",[\App\Http\Controllers\ClaimSubStatusController::class,'getByName'])->middleware([
            "auth:api",
        ]);
        Route::put("/{id}",[\App\Http\Controllers\ClaimSubStatusController::class,'updateClaimSubStatus'])->middleware([
            "auth:api",
        ]);
        Route::patch("/change-status/{id}",[\App\Http\Controllers\ClaimSubStatusController::class,'changeStatus'])->middleware([
            "auth:api",
        ]);

    });

    Route::prefix("reports")->middleware([
        "auth:api",
        'role:superuser|billingmanager',
    ])->group(function() {
        Route::get("/get-sheet/{name?}",[\App\Http\Controllers\ReportController::class,"getSheet"]);
    });

    Route::get('npi/{npi}', [\App\Http\Controllers\ApiController::class, 'getNpi']);
    Route::post('usps', [\App\Http\Controllers\ApiController::class, 'getZipCode']);
});
