<?php

declare(strict_types=1);

use App\Http\Controllers\BillingCompany\BillingCompanyController;
use App\Http\Controllers\BillingCompany\KeyboardShortcutController;
use App\Http\Controllers\Claim\RulesResource;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Denial\DenialController;
use App\Http\Controllers\HealthProfessional\CompanyResource as HPCompanyResource;
use App\Http\Controllers\Payments\BatchResource;
use App\Http\Controllers\Reports\PresetsController;
use App\Http\Controllers\Reports\ReportReSource;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Tableau\AuthController;
use App\Http\Controllers\User\KeyboardShortcutController as UserKeyboardShortcutController;
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

Route::prefix('v1')/* ->middleware('audit') */
->middleware(['lastActivity'])->group(function () {
    Route::get('/', function () {
        \Log::info(Str::ulid());

        return response()->json(['message' => 'Api Running']);
    });

    Route::post('audit-all', [\App\Http\Controllers\AuditController::class, 'getAuditAll'])->middleware('auth:api');
    Route::get('audit-all', [\App\Http\Controllers\AuditController::class, 'getAudit'])->middleware('auth:api');
    Route::patch('audit-all-by-entity/{entity}/{id}', [\App\Http\Controllers\AuditController::class, 'getAuditAllByEntity'])->middleware('auth:api');
    Route::patch('rollback-audit/{audit}/by-entity/{entity}/{id}', [\App\Http\Controllers\AuditController::class, 'rollbackAuditByEntity'])->middleware('auth:api');
    Route::post('audit-all-by-user', [\App\Http\Controllers\AuditController::class, 'getAuditAllByUser'])->middleware('auth:api');
    Route::post('audit-all-by-billing-company', [\App\Http\Controllers\AuditController::class, 'getAuditAllByBillingCompany'])->middleware('auth:api');
    Route::post('audit-one', [\App\Http\Controllers\AuditController::class, 'getAuditOne'])->middleware('auth:api');

    Route::prefix('auth')->group(function () {
        Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
        Route::post('send-email-code', [\App\Http\Controllers\AuthController::class, 'sendEmailCode']);
        Route::get('check-token', [\App\Http\Controllers\AuthController::class, 'checkToken']);
        Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:api');
        Route::get('refresh-token', [\App\Http\Controllers\AuthController::class, 'refresh'])->middleware('auth:api');
        Route::get('me', [\App\Http\Controllers\AuthController::class, 'me'])->middleware('auth:api');
    });

    Route::prefix('user')->group(function () {
        Route::resource('shortcuts', UserKeyboardShortcutController::class)->only(['index', 'show', 'store'])->middleware(['auth:api']);
        Route::get('types', [\App\Http\Controllers\UserController::class, 'getTypes'])->middleware(['auth:api']);
        Route::get('/get-all-server', [\App\Http\Controllers\UserController::class, 'getServerAllUsers'])->middleware(['auth:api']);
        Route::get('/get-list', [\App\Http\Controllers\UserController::class, 'getList'])->middleware(['auth:api']);
        Route::get('/get-list-gender', [\App\Http\Controllers\UserController::class, 'getListGender'])->middleware(['auth:api']);
        Route::get('/get-list-name-suffix', [\App\Http\Controllers\UserController::class, 'getListNameSuffix'])->middleware(['auth:api']);
        Route::get('/search', [\App\Http\Controllers\UserController::class, 'search']);
        Route::post('/', [\App\Http\Controllers\UserController::class, 'createUser']);
        Route::get('/', [\App\Http\Controllers\UserController::class, 'getAllUsers'])->middleware(['auth:api']);
        Route::resource('{user}/permissions', \App\Http\Controllers\User\PermissionResource::class)->only(['index', 'update', 'destroy'])->middleware(['auth:api']);
        Route::get('{user}', [\App\Http\Controllers\UserController::class, 'getOneUser'])->middleware(['auth:api']);
        Route::post('send-email-rescue-pass', [\App\Http\Controllers\UserController::class, 'sendEmailRescuePass']);
        Route::post('recovery-user', [\App\Http\Controllers\UserController::class, 'recoveryUser']);
        Route::post('unlock-user', [\App\Http\Controllers\UserController::class, 'unlockUser']);
        Route::post('change-password/{token}', [\App\Http\Controllers\UserController::class, 'changePassword']);
        Route::post('new-token', [\App\Http\Controllers\UserController::class, 'newToken']);
        Route::patch('{id?}/change-status', [\App\Http\Controllers\UserController::class, 'changeStatus'])->middleware('auth:api');
        Route::put('/{user}', [\App\Http\Controllers\UserController::class, 'editUser'])->middleware('auth:api');
        Route::post('img-profile', [\App\Http\Controllers\UserController::class, 'updateImgProfile'])->middleware(['auth:api']);

        Route::get('social-networks/get-list', [\App\Http\Controllers\UserController::class, 'getListSocialNetworks'])->middleware(['auth:api']);
        Route::patch('social-medias/{id}', [\App\Http\Controllers\UserController::class, 'updateSocialMediaProfile'])->middleware(['auth:api']);
        Route::patch('update-password', [\App\Http\Controllers\UserController::class, 'changePasswordForm'])->middleware(['auth:api']);
        Route::get('/{ssn}/get-by-ssn', [\App\Http\Controllers\UserController::class, 'searchBySsn']);

        // update password from profile view
        Route::post('update-password', [\App\Http\Controllers\UserController::class, 'updatePassword'])->middleware(['auth:api']);
    });

    Route::get('permissions', [\App\Http\Controllers\Permissions\RoleResource::class, 'getPermissions'])->middleware('auth:api');
    Route::put('roles/{role}/permissions', [\App\Http\Controllers\Permissions\RoleResource::class, 'updatePermissions'])->middleware('auth:api');
    Route::get('roles/types', [\App\Http\Controllers\Permissions\RoleResource::class, 'getTypes'])->middleware('auth:api');
    Route::resource('roles', \App\Http\Controllers\Permissions\RoleResource::class)->only(['index', 'store', 'show', 'update', 'destroy'])->middleware('auth:api');

    /*Route::prefix('permission')->middleware('auth:api')->group(function () {
        Route::get('roles', [\App\Http\Controllers\RolePermissionController::class, 'getRoles']);
        Route::get('roles-permissions', [\App\Http\Controllers\RolePermissionController::class, 'getRolesWithPermissions']);
        Route::get('permissions', [\App\Http\Controllers\RolePermissionController::class, 'getPermissions']);
        Route::get('permissions-by-role/{role}', [\App\Http\Controllers\RolePermissionController::class, 'getPermissionsByRole']);
        Route::get('role/{id}', [\App\Http\Controllers\RolePermissionController::class, 'getOneRole']);
        Route::get('permission/{id}', [\App\Http\Controllers\RolePermissionController::class, 'getOnePermission']);
        Route::post('create-role', [\App\Http\Controllers\RolePermissionController::class, 'createRole']);
        Route::post('create-permission', [\App\Http\Controllers\RolePermissionController::class, 'createPermission']);

        Route::patch('assign-permissions-role/{role_id}/{permission_id}', [\App\Http\Controllers\RolePermissionController::class, 'assignPermissionRole']);
        Route::patch('assign-permissions-user/{permission_id}/{user_id}', [\App\Http\Controllers\RolePermissionController::class, 'assignPermissionUser']);
        Route::patch('assign-role-user/{user_id}/{role_id}', [\App\Http\Controllers\RolePermissionController::class, 'assignRoleUser']);

        Route::patch('remove-permission-user/{user_id}/{permission_id}', [\App\Http\Controllers\RolePermissionController::class, 'revokePermissionUser']);
        Route::patch('remove-permission-role/{role_id}/{permission_id}', [\App\Http\Controllers\RolePermissionController::class, 'revokePermissionRole']);
        Route::patch('remove-role-user/{user_id}/{role_id}', [\App\Http\Controllers\RolePermissionController::class, 'revokeRoleUser']);

        Route::patch('assign-permissions-role/{role_id}', [\App\Http\Controllers\RolePermissionController::class, 'assignPermissionsRole']);
        Route::patch('assign-permissions-user/{user_id}', [\App\Http\Controllers\RolePermissionController::class, 'assignPermissionsUser']);

        Route::patch('remove-permissions-user/{user_id}', [\App\Http\Controllers\RolePermissionController::class, 'revokePermissionsUser']);
        Route::patch('remove-permissions-role/{role_id}', [\App\Http\Controllers\RolePermissionController::class, 'revokePermissionsRole']);
    });*/

    Route::prefix('setting')->middleware('auth:api')->group(function () {
        Route::prefix('ip-restriction')->group(function () {
            Route::get('/get-all-server', [\App\Http\Controllers\IpRestrictionController::class, 'getServerAll']);
            Route::post('/', [\App\Http\Controllers\IpRestrictionController::class, 'store']);
            Route::get('/', [\App\Http\Controllers\IpRestrictionController::class, 'getAllRestrictions']);
            Route::get('{id}', [\App\Http\Controllers\IpRestrictionController::class, 'getOneRestriction']);
            Route::put('{id}', [\App\Http\Controllers\IpRestrictionController::class, 'update']);
            Route::delete('{id}', [\App\Http\Controllers\IpRestrictionController::class, 'destroy']);
        });
        Route::patch('/lang', [\App\Http\Controllers\UserController::class, 'updateLang']);
        Route::get('/get-list-langs', [\App\Http\Controllers\UserController::class, 'getListLangs']);
    });

    Route::middleware([
            'auth:api',
    ])->group(function (): void {
        Route::prefix('billing-company')->group(function (): void {
            Route::get('/get-all-server', [BillingCompanyController::class, 'getServerAllBillingCompanies']);
            Route::post('create', [BillingCompanyController::class, 'createCompany']);
            Route::post('/upload-image', [BillingCompanyController::class, 'uploadImage']);
            Route::get('/get-list', [BillingCompanyController::class, 'getList']);
            Route::patch('/change-status/{billing_company_id}', [BillingCompanyController::class, 'changeStatus']);
            Route::get('get-by-name/{name}', [BillingCompanyController::class, 'getByName']);
            Route::get('/{company_binding}', [BillingCompanyController::class, 'getBillingCompany']);

            /*
            Route::get('get-by-code/{code}', [BillingCompanyController::class, 'getByCode']);
            */
        });

        Route::resource('billing-company', BillingCompanyController::class)->only(['index', 'update']);
        Route::resource('billing-company.shortcuts', KeyboardShortcutController::class)
            ->only(['index', 'store']);
    });

    Route::prefix('clearing-house')->group(function () {
        Route::get('/get-all-server', [\App\Http\Controllers\ClearingHouseController::class, 'getServerAll'])->middleware(['auth:api']);
        Route::get('/get-list-transmission-formats', [\App\Http\Controllers\ClearingHouseController::class, 'getListTransmissionFormats'])->middleware(['auth:api']);
        Route::get('/get-list-org-types', [\App\Http\Controllers\ClearingHouseController::class, 'getListOrgTypes'])->middleware(['auth:api']);
        Route::post('/', [\App\Http\Controllers\ClearingHouseController::class, 'createClearingHouse'])->middleware([
            'auth:api',
        ]);
        Route::get('/', [\App\Http\Controllers\ClearingHouseController::class, 'getAllClearingHouse'])->middleware([
            'auth:api',
        ]);
        Route::get('/{id}', [\App\Http\Controllers\ClearingHouseController::class, 'getOneClearingHouse'])->middleware([
            'auth:api',
        ]);
        Route::put('/{clearing_id}', [\App\Http\Controllers\ClearingHouseController::class, 'updateClearingHouse'])->middleware([
            'auth:api',
        ]);
        Route::get('/get-by-name/{name}', [\App\Http\Controllers\ClearingHouseController::class, 'getByName'])->middleware([
            'auth:api',
        ]);
        Route::patch('/{clearing_id}', [\App\Http\Controllers\ClearingHouseController::class, 'changeStatus'])->middleware([
            'auth:api',
        ]);
        Route::patch('/add-to-billing-company/{clearing_house_id}', [\App\Http\Controllers\ClearingHouseController::class, 'addToBillingCompany'])->middleware([
            'auth:api',
        ]);
    });

    Route::prefix('facility')->group(function () {
        Route::get('/get-all-server', [\App\Http\Controllers\FacilityController::class, 'getServerAll'])->middleware(['auth:api']);
        Route::get('/get-list-billing-companies', [\App\Http\Controllers\FacilityController::class, 'getListBillingCompanies'])->middleware(['auth:api']);
        Route::post('/', [\App\Http\Controllers\FacilityController::class, 'create'])->middleware([
            'auth:api',
        ]);
        Route::get('/', [\App\Http\Controllers\FacilityController::class, 'getAllFacilities'])->middleware([
            'auth:api',
        ]);
        Route::get('/get-list-facility-types', [\App\Http\Controllers\FacilityController::class, 'getListFacilityTypes'])->middleware([
            'auth:api',
        ]);
        Route::get('/get-list', [\App\Http\Controllers\FacilityController::class, 'getList'])->middleware([
            'auth:api',
        ]);
        Route::get('/get-list-place-of-services', [\App\Http\Controllers\ClaimController::class, 'getListPlaceOfServices']);
        Route::get('/{id}', [\App\Http\Controllers\FacilityController::class, 'getOneFacility'])->middleware([
            'auth:api',
        ]);
        Route::put('/{id}', [\App\Http\Controllers\FacilityController::class, 'updateFacility'])->middleware([
            'auth:api',
        ]);
        Route::patch('/{id}/change-status', [\App\Http\Controllers\FacilityController::class, 'changeStatus'])->middleware([
            'auth:api',
        ]);
        Route::get('/{id}/get-by-name', [\App\Http\Controllers\FacilityController::class, 'getByName'])->middleware([
            'auth:api',
        ]);
        Route::get('/get-by-npi/{npi}', [\App\Http\Controllers\FacilityController::class, 'getOneByNpi'])->middleware([
            'auth:api',
        ]);
        Route::get('/get-all-by-company/{company_id}', [\App\Http\Controllers\FacilityController::class, 'getAllByCompany'])->middleware([
            'auth:api',
        ]);
        Route::patch('/add-to-billing-company/{id}', [\App\Http\Controllers\FacilityController::class, 'addToBillingCompany'])->middleware([
            'auth:api',
        ]);
        Route::patch('/{facility}/company', [\App\Http\Controllers\FacilityController::class, 'addToCompany'])->middleware([
            'auth:api',
        ]);
        Route::patch('/{facility}/remove-company', [\App\Http\Controllers\FacilityController::class, 'removeToCompany'])->middleware([
            'auth:api',
        ]);
        Route::get('/bill-classifications/{facility_type}', [\App\Http\Controllers\FacilityController::class, 'getBillClassifiations'])->middleware([
            'auth:api',
        ]);
    });

    Route::prefix('company')->group(function () {
        Route::get('/get-list-by-billing-company/{id?}', [CompanyController::class, 'getList']);
        Route::get('/get-list-name-suffix', [CompanyController::class, 'getListNameSuffix']);
        Route::get('/get-list-measurement-units', [CompanyController::class, 'getListMeasurementUnits']);
        Route::get('/get-list-statement-rules', [CompanyController::class, 'getListStatementRules']);
        Route::get('/get-list-statement-when', [CompanyController::class, 'getListStatementWhen']);
        Route::get('/get-list-statement-apply-to', [CompanyController::class, 'getListStatementApplyTo']);
        Route::get('/get-list-contract-fee-types', [CompanyController::class, 'getListContractFeeTypes']);
        Route::get('/get-list-billing-companies', [CompanyController::class, 'getListBillingCompanies']);
        Route::get('/get-list-billing-providers', [CompanyController::class, 'getListBillingProviders']);

        Route::middleware([
            'auth:api',
        ])->group(function (): void {
            Route::put('/{company}/data', [CompanyController::class, 'updateCompanyData']);
            Route::put('/{company}/patients', [CompanyController::class, 'UpdatePatients']);
            Route::put('/{company}/contacts', [CompanyController::class, 'UpdateContactData']);
            Route::put('/{company}/statements', [CompanyController::class, 'StoreStatements']);
            Route::put('/{company}/exceptions', [CompanyController::class, 'StoreExceptionInsurance']);
            Route::put('/{company}/notes', [CompanyController::class, 'updateCompanyNotes']);
            Route::get('/get-all-server', [CompanyController::class, 'getServerAll']);
            Route::post('/', [CompanyController::class, 'createCompany']);
            Route::get('/', [CompanyController::class, 'getAllCompany']);
            Route::get('/get-by-name/{name}', [CompanyController::class, 'getByName']);
            Route::get('/get-by-email/{email}', [CompanyController::class, 'getOneByEmail']);
            Route::get('/get-by-npi/{npi}', [CompanyController::class, 'getOneByNpi']);
            Route::patch('/change-status/{id}', [CompanyController::class, 'changeStatus']);
            Route::patch('/add-to-billing-company/{id}', [CompanyController::class, 'addToBillingCompany']);
            Route::patch('/add-facilities-to-company/{company}', [CompanyController::class, 'addFacilities']);
            Route::patch('/{company}/services', [CompanyController::class, 'addServices']);
            Route::patch('/{company}/copays', [CompanyController::class, 'addCompanyCopays']);
            Route::patch('/{company}/contract-fees', [CompanyController::class, 'addCompanyContractFees']);
            Route::get('/{company}', [CompanyController::class, 'getOneCompany']);
            Route::put('/{id}', [CompanyController::class, 'updateCompany']);
        });
    });

    Route::prefix('device')->group(function () {
        Route::post('allow-device', [\App\Http\Controllers\DeviceController::class, 'allowDevice']);
    });

    Route::prefix('insurance-company')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::post('/search', [\App\Http\Controllers\InsuranceCompanyController::class, 'search']);
        Route::get('/get-all-server', [\App\Http\Controllers\InsuranceCompanyController::class, 'getServerAll']);
        Route::get('/get-list', [\App\Http\Controllers\InsuranceCompanyController::class, 'getList']);
        Route::get('/get-list-file-methods', [\App\Http\Controllers\InsuranceCompanyController::class, 'getListFileMethods']);
        Route::get('/get-list-from-the-date', [\App\Http\Controllers\InsuranceCompanyController::class, 'getListFromTheDate']);
        Route::get('/get-list-billing-incomplete-reasons', [\App\Http\Controllers\InsuranceCompanyController::class, 'getListBillingIncompleteReasons']);
        Route::get('/get-list-appeal-reasons', [\App\Http\Controllers\InsuranceCompanyController::class, 'getListAppealReasons']);
        Route::get('/get-list-billing-companies', [\App\Http\Controllers\InsuranceCompanyController::class, 'getListBillingCompanies'])->middleware(['auth:api']);
        Route::get('/{id}', [\App\Http\Controllers\InsuranceCompanyController::class, 'getOneInsurance']);
        Route::get('/{name}/get-by-name', [\App\Http\Controllers\InsuranceCompanyController::class, 'getByName']);
        Route::get('/get-by-payer-id/{payer}', [\App\Http\Controllers\InsuranceCompanyController::class, 'getByPayer']);
        Route::post('/', [\App\Http\Controllers\InsuranceCompanyController::class, 'createInsurance']);
        Route::get('/', [\App\Http\Controllers\InsuranceCompanyController::class, 'getAllInsurance']);
        Route::put('/{id}', [\App\Http\Controllers\InsuranceCompanyController::class, 'updateInsurance']);
        Route::patch('/{id}/change-status', [\App\Http\Controllers\InsuranceCompanyController::class, 'changeStatus']);
        Route::patch('/add-to-billing-company/{insurance_company_id}', [\App\Http\Controllers\InsuranceCompanyController::class, 'addToBillingCompany']);
    });

    Route::prefix('insurance-plan')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::get('/get-list-responsibility-type', [\App\Http\Controllers\InsurancePlanController::class, 'getListResponsibilityType']);
        Route::get('/get-all-server', [\App\Http\Controllers\InsurancePlanController::class, 'getServerAll']);
        Route::get('/get-list', [\App\Http\Controllers\InsurancePlanController::class, 'getList']);
        Route::get('/get-list-formats', [\App\Http\Controllers\InsurancePlanController::class, 'getListFormats']);
        Route::get('/get-list-ins-types', [\App\Http\Controllers\InsurancePlanController::class, 'getListInsTypes']);
        Route::get('/get-list-plan-types', [\App\Http\Controllers\InsurancePlanController::class, 'getListPlanTypes']);
        // Route::get('/get-list-charge-usings', [\App\Http\Controllers\InsurancePlanController::class, 'getListChargeUsings']);
        Route::get('/get-list-billing-companies', [\App\Http\Controllers\InsurancePlanController::class, 'getListBillingCompanies']);
        Route::get('/get-list-by-payer/{payer}', [\App\Http\Controllers\InsurancePlanController::class, 'getListByPayer']);
        Route::get('/get-by-payer-id/{payer}', [\App\Http\Controllers\InsurancePlanController::class, 'getByPayer']);
        Route::post('/', [\App\Http\Controllers\InsurancePlanController::class, 'createInsurancePlan']);
        Route::get('/{insurance}', [\App\Http\Controllers\InsurancePlanController::class, 'getOneInsurancePlan']);
        Route::put('/{id}', [\App\Http\Controllers\InsurancePlanController::class, 'updateInsurancePlan']);
        Route::get('/', [\App\Http\Controllers\InsurancePlanController::class, 'getAllInsurancePlans']);
        Route::patch('/{id}/change-status', [\App\Http\Controllers\InsurancePlanController::class, 'changeStatus']);
        Route::get('/{companyName}/get-by-company', [\App\Http\Controllers\InsurancePlanController::class, 'getByCompany']);
        Route::get('/{name}/get-by-name', [\App\Http\Controllers\InsurancePlanController::class, 'getByName']);
        Route::get('/insurance-company/{id}/get-by-insurance-company', [\App\Http\Controllers\InsurancePlanController::class, 'getAllPlanByInsuranceCompany']);
        Route::patch('/{insurance}/copays', [\App\Http\Controllers\InsurancePlanController::class, 'addCopays']);
        Route::patch('/{insurance}/contract-fees', [\App\Http\Controllers\InsurancePlanController::class, 'addContractFees']);
    });

    Route::prefix('health-professional')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::post('/', [\App\Http\Controllers\DoctorController::class, 'createDoctor']);
        Route::resource('{doctor}/company', HPCompanyResource::class)->only(['index', 'store']);
        Route::get('/get-list-health-professional-types', [\App\Http\Controllers\DoctorController::class, 'getListTypes']);
        Route::get('/get-list-authorizations', [\App\Http\Controllers\DoctorController::class, 'getListAuthorizations']);
        Route::get('/get-list-billing-companies', [\App\Http\Controllers\DoctorController::class, 'getListBillingCompanies']);
        Route::get('/get-list', [\App\Http\Controllers\DoctorController::class, 'getList']);
        Route::get('/get-all-server', [\App\Http\Controllers\DoctorController::class, 'getServerAll']);
        Route::put('/{id}', [\App\Http\Controllers\DoctorController::class, 'updateDoctor']);
        Route::get('/{doctor}', [\App\Http\Controllers\DoctorController::class, 'getOneDoctor']);
        Route::get('/', [\App\Http\Controllers\DoctorController::class, 'getAllDoctors']);
        Route::get('/{npi}/get-by-npi', [\App\Http\Controllers\DoctorController::class, 'getOneByNpi']);
        Route::patch('/{id}/change-status', [\App\Http\Controllers\DoctorController::class, 'changeStatus']);
        Route::put('/{id}/update-companies', [\App\Http\Controllers\DoctorController::class, 'updateCompanies']);
    });

    Route::prefix('patient')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::get('/get-all-server', [\App\Http\Controllers\PatientController::class, 'getServerAll']);
        Route::get('/search/{date_of_birth?}/{first_name?}/{last_name?}/{ssn?}', [\App\Http\Controllers\PatientController::class, 'search']);
        Route::get('/get-list', [\App\Http\Controllers\PatientController::class, 'getList']);
        Route::get('/get-list-marital-status', [\App\Http\Controllers\PatientController::class, 'getListMaritalStatus']);
        Route::get('/get-list-address-type', [\App\Http\Controllers\PatientController::class, 'getListAddressType']);
        Route::get('/get-list-insurance-policy-type', [\App\Http\Controllers\PatientController::class, 'getListInsurancePolicyType']);
        Route::get('/get-list-responsibility-type', [\App\Http\Controllers\PatientController::class, 'getListResponsibilityType']);
        Route::get('/get-list-relationship', [\App\Http\Controllers\PatientController::class, 'getListRelationship']);
        Route::get('/get-list-billing-companies', [\App\Http\Controllers\PatientController::class, 'getListBillingCompanies']);
        Route::post('/', [\App\Http\Controllers\PatientController::class, 'createPatient']);
        Route::get('/', [\App\Http\Controllers\PatientController::class, 'getAllPatient']);
        Route::get('/get-subscribers', [\App\Http\Controllers\PatientController::class, 'getAllSubscribers']);
        Route::get('/get-by-ssn/{ssn}', [\App\Http\Controllers\PatientController::class, 'getBySsn']);
        Route::get('/{id}', [\App\Http\Controllers\PatientController::class, 'getOnePatient']);
        Route::put('/{id}', [\App\Http\Controllers\PatientController::class, 'updatePatient']);
        Route::patch('/change-status/{id}', [\App\Http\Controllers\PatientController::class, 'changeStatus']);
        Route::patch('/add-policy-to-patient/{id}', [\App\Http\Controllers\PatientController::class, 'addPolicy']);
        Route::patch('/add-companies-to-patient/{id}', [\App\Http\Controllers\PatientController::class, 'addCompanies']);
        Route::patch('/{patient_id}/change-status-policy/{policy_id}', [\App\Http\Controllers\PatientController::class, 'changeStatusPolicy']);
        Route::patch('/{patient_id}/edit-policy/{policy_id}', [\App\Http\Controllers\PatientController::class, 'editPolicy']);
        Route::get('/{patient_id}/get-policy/{policy_id}', [\App\Http\Controllers\PatientController::class, 'getPolicy']);
        Route::get('/{patient_id}/get-policies', [\App\Http\Controllers\PatientController::class, 'getPolicies']);
        Route::get('/{patient}/get-list-policies', [\App\Http\Controllers\PatientController::class, 'getListPolicies']);
    });

    Route::prefix('taxonomy')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::post('/', [\App\Http\Controllers\TaxonomyController::class, 'createTaxonomy']);
        Route::put('/{id}', [\App\Http\Controllers\TaxonomyController::class, 'updateTaxonomy']);
        Route::patch('/{id}/change-primary', [\App\Http\Controllers\TaxonomyController::class, 'changePrimary']);
        Route::delete('/{id}', [\App\Http\Controllers\TaxonomyController::class, 'removeTaxonomy']);
        Route::get('/{type}/{id}', [\App\Http\Controllers\TaxonomyController::class, 'getAllTaxonomies']);
        Route::get('/{id}', [\App\Http\Controllers\TaxonomyController::class, 'getOneTaxonomy']);
    });

    Route::prefix('service')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::post('/', [\App\Http\Controllers\ServiceController::class, 'create']);
        Route::put('/{id}', [\App\Http\Controllers\ServiceController::class, 'update']);
        Route::patch('/change-status/{id}', [\App\Http\Controllers\ServiceController::class, 'changeStatus']);

        Route::get('/get-list-service-rev-centers', [\App\Http\Controllers\ServiceController::class, 'getAllServiceRevCenters']);
        Route::get('/get-list-service-applicable-to', [\App\Http\Controllers\ServiceController::class, 'getAllServiceApplicableTo']);
        Route::get('/get-list-service-groups', [\App\Http\Controllers\ServiceController::class, 'getAllServiceGroups']);
        Route::get('/get-list-service-types', [\App\Http\Controllers\ServiceController::class, 'getAllServiceTypes']);
        Route::get('/get-list-service-type-of-services', [\App\Http\Controllers\ServiceController::class, 'getAllServiceTypeOfServices']);
        Route::get('/get-list-service-stmt-descriptions', [\App\Http\Controllers\ServiceController::class, 'getAllServiceStmtDescriptions']);
        Route::get('/get-list-service-special-instructions', [\App\Http\Controllers\ServiceController::class, 'getAllServiceSpecialInstructions']);
        Route::get('/', [\App\Http\Controllers\ServiceController::class, 'getAllServices']);
        Route::get('/{id}', [\App\Http\Controllers\ServiceController::class, 'getOneService']);
    });

    Route::prefix('address')->middleware([
        'auth:api',
    ])->group(function () {
        Route::get('/get-list-countries', [\App\Http\Controllers\AddressController::class, 'getListCountries']);
        Route::get('/get-list-states', [\App\Http\Controllers\AddressController::class, 'getListStates']);
    });

    Route::prefix('diagnosis')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::get('/get-all-server', [\App\Http\Controllers\DiagnosisController::class, 'getServerAll']);
        Route::post('/', [\App\Http\Controllers\DiagnosisController::class, 'createDiagnosis']);
        Route::get('/', [\App\Http\Controllers\DiagnosisController::class, 'getAllDiagnoses']);
        Route::get('get-by-code/{code}', [\App\Http\Controllers\DiagnosisController::class, 'getByCode']);
        Route::patch('/change-status/{id}', [\App\Http\Controllers\DiagnosisController::class, 'changeStatus']);
        Route::get('/get-list', [\App\Http\Controllers\DiagnosisController::class, 'getList']);
        Route::get('/type', [\App\Http\Controllers\DiagnosisController::class, 'getType']);
        Route::get('/type/{type}/classification', [\App\Http\Controllers\DiagnosisController::class, 'getClassifications']);
        Route::get('/{id}', [\App\Http\Controllers\DiagnosisController::class, 'getOneDiagnosis']);
        Route::put('/{id}', [\App\Http\Controllers\DiagnosisController::class, 'updateDiagnosis']);
        Route::delete('/{id}', [\App\Http\Controllers\DiagnosisController::class, 'deleteDiagnosis']);
        Route::put('/{diagnosis}/note', [\App\Http\Controllers\DiagnosisController::class, 'updateDiagnosisNote']);
        Route::get('/classification/{code}', [\App\Http\Controllers\DiagnosisController::class, 'getClassificationsByCode']);
    });

    Route::prefix('modifier')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::get('/get-all-server', [\App\Http\Controllers\ModifierController::class, 'getServerAll']);
        Route::get('/get-list', [\App\Http\Controllers\ModifierController::class, 'getList']);
        Route::post('/', [\App\Http\Controllers\ModifierController::class, 'createModifier']);
        Route::get('/', [\App\Http\Controllers\ModifierController::class, 'getAllModifiers']);
        Route::get('/get-by-code/{code}', [\App\Http\Controllers\ModifierController::class, 'getByCode']);
        Route::patch('/change-status/{id}', [\App\Http\Controllers\ModifierController::class, 'changeStatus']);
        Route::get('/type', [\App\Http\Controllers\ModifierController::class, 'getTypes']);
        Route::get('/classification', [\App\Http\Controllers\ModifierController::class, 'getClassifications']);
        Route::get('/{id}', [\App\Http\Controllers\ModifierController::class, 'getOneModifier']);
        Route::put('/{id}', [\App\Http\Controllers\ModifierController::class, 'updateModifier']);
        Route::put('/{modifier}/note', [\App\Http\Controllers\ModifierController::class, 'updateModifierNote']);
    });

    Route::prefix('procedure')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::post('/', [\App\Http\Controllers\ProcedureController::class, 'createProcedure']);
        Route::get('/', [\App\Http\Controllers\ProcedureController::class, 'getAllProcedures']);
        Route::get('/get-all-server', [\App\Http\Controllers\ProcedureController::class, 'getServerAll']);
        Route::get('/get-by-code/{code}', [\App\Http\Controllers\ProcedureController::class, 'getByCode']);
        Route::get('/get-list-mac-localities', [\App\Http\Controllers\ProcedureController::class, 'getListMacLocalities']);
        Route::get('/get-price-of-procedure', [\App\Http\Controllers\ProcedureController::class, 'getPriceOfProcedure']);
        Route::get('/get-list-genders', [\App\Http\Controllers\ProcedureController::class, 'getListGenders']);
        Route::get('/get-list-discriminatories', [\App\Http\Controllers\ProcedureController::class, 'getListDiscriminatories']);
        Route::get('/get-list-modifiers/{code?}', [\App\Http\Controllers\ProcedureController::class, 'getListModifiers']);
        Route::get('/get-list-diagnoses/{code?}', [\App\Http\Controllers\ProcedureController::class, 'getListdiagnoses']);
        Route::get('/get-list-insurance-companies/{procedure_id?}', [\App\Http\Controllers\ProcedureController::class, 'getListInsuranceCompanies']);
        Route::get('/get-list-insurance-label-fees', [\App\Http\Controllers\ProcedureController::class, 'getListInsuranceLabelFees']);
        Route::get('/get-list/{company_id?}', [\App\Http\Controllers\ProcedureController::class, 'getList']);
        Route::get('/type', [\App\Http\Controllers\ProcedureController::class, 'getType']);
        Route::get('/type/{type}/classification', [\App\Http\Controllers\ProcedureController::class, 'getClassifications']);
        Route::patch('/change-status/{id}', [\App\Http\Controllers\ProcedureController::class, 'changeStatus']);
        Route::get('/get-list-insurance-companies', [\App\Http\Controllers\ProcedureController::class, 'getListInsuranceCompany']);
        Route::get('/{id}', [\App\Http\Controllers\ProcedureController::class, 'getOneProcedure']);
        Route::put('/{procedure}', [\App\Http\Controllers\ProcedureController::class, 'updateProcedure']);
        Route::put('/{procedure}/considerations', [\App\Http\Controllers\ProcedureController::class, 'updateProcedureConsiderations']);
        Route::put('/{procedure}/note', [\App\Http\Controllers\ProcedureController::class, 'updateProcedureNote']);
        Route::patch('/change-status/{id}', [\App\Http\Controllers\ProcedureController::class, 'changeStatus']);
    });

    Route::prefix('injury')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::get('/get-list-type-diags', [\App\Http\Controllers\ClaimController::class, 'getListTypeDiags']);
    });

    Route::prefix('claim')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::prefix('/batch')->middleware([
            'auth:api',
            // 'role:superuser|biller|billingmanager',
        ])->group(function () {
            Route::get('/get-all-server', [\App\Http\Controllers\ClaimBatchController::class, 'getServerAll']);
            Route::get('/get-all-server-claims', [\App\Http\Controllers\ClaimBatchController::class, 'getServerClaims']);
            Route::get('show-batch-preview/{id}', [\App\Http\Controllers\ClaimPreviewController::class, 'showBatch']);
            Route::get('show-batch-report/{id}', [\App\Http\Controllers\ClaimPreviewController::class, 'showBatchReport']);
            Route::get('show-response-preview', [\App\Http\Controllers\ClaimPreviewController::class, 'showResponses']);
            Route::get('/{id}', [\App\Http\Controllers\ClaimBatchController::class, 'getOneClaimBatch']);
            Route::post('/', [\App\Http\Controllers\ClaimBatchController::class, 'createBatch']);
            Route::put('/{id}', [\App\Http\Controllers\ClaimBatchController::class, 'updateBatch']);
            Route::delete('/{id}', [\App\Http\Controllers\ClaimBatchController::class, 'deleteBatch']);
            Route::patch('/submit-to-clearing-house/{batch}', [\App\Http\Controllers\ClaimBatchController::class, 'submitToClearingHouse']);
            Route::patch('/confirm-shipping/{batch}', [\App\Http\Controllers\ClaimBatchController::class, 'confirmShipping']);
        });

        Route::get('/get-list-code-values', [\App\Http\Controllers\ClaimController::class, 'getListCodeValues']);
        Route::get('/get-list-department-responsibilities', [\App\Http\Controllers\ClaimController::class, 'getListDepartmentresponsibilities']);
        Route::get('/get-list-insurance-policies/{claim}', [\App\Http\Controllers\ClaimController::class, 'getListInsurancePolicies']);
        Route::get('/get-list-claim-services', [\App\Http\Controllers\ClaimController::class, 'getListClaimServices']);
        Route::get('/get-list-type-of-services', [\App\Http\Controllers\ClaimController::class, 'getListTypeOfServices']);
        Route::get('/get-list-place-of-services', [\App\Http\Controllers\ClaimController::class, 'getListPlaceOfServices']);
        Route::get('/get-list-revenue-codes', [\App\Http\Controllers\ClaimController::class, 'getListRevenueCodes']);
        Route::get('/get-list-admission-types', [\App\Http\Controllers\ClaimController::class, 'getListAdmissionTypes']);
        Route::get('/get-list-admission-sources', [\App\Http\Controllers\ClaimController::class, 'getListAdmissionSources']);
        Route::get('/get-list-patient-statuses', [\App\Http\Controllers\ClaimController::class, 'getListPatientStatuses']);
        Route::get('/get-list-condition-codes', [\App\Http\Controllers\ClaimController::class, 'getListConditionCodes']);
        Route::get('/get-list-bill-classifications', [\App\Http\Controllers\ClaimController::class, 'getListBillClassifications']);
        Route::get('/get-list-diagnosis-related-groups', [\App\Http\Controllers\ClaimController::class, 'getListDiagnosisRelatedGroups']);
        Route::get('/get-list-type-formats', [\App\Http\Controllers\ClaimController::class, 'getListTypeFormats']);
        Route::get('/get-list-claim-field-informations', [\App\Http\Controllers\ClaimController::class, 'getListClaimFieldInformations']);
        Route::get('/get-list-qualifier-by-field', [\App\Http\Controllers\ClaimController::class, 'getListFieldQualifiers']);
        Route::get('/get-list-status', [\App\Http\Controllers\ClaimController::class, 'getListStatus']);
        Route::get('/get-check-status/{claim}', [\App\Http\Controllers\ClaimController::class, 'getCheckStatus']);
        Route::get('/get-all-server', [\App\Http\Controllers\ClaimController::class, 'getServerAll']);
        Route::get('/bill-classifications/{facility_id}', [\App\Http\Controllers\ClaimController::class, 'getBillClassifications']);
        Route::post('/show-claim-preview', [\App\Http\Controllers\ClaimPreviewController::class, 'Show']);

        Route::get('/get-access-token', [\App\Http\Controllers\ClaimController::class, 'getSecurityAuthorizationAccessToken']);
        Route::get('/check-eligibility', [\App\Http\Controllers\ClaimController::class, 'checkEligibility']);
        Route::post('/check-eligibility', [\App\Http\Controllers\ClaimController::class, 'storeCheckEligibility']);
        Route::get('/validation/{id}', [\App\Http\Controllers\ClaimController::class, 'claimValidation']);

        Route::get('rules/list', [RulesResource::class, 'getList']);
        Route::get('rules/types', [RulesResource::class, 'getTypes']);
        Route::resource('/rules', RulesResource::class)->only(['index', 'store', 'show', 'update', 'destroy']);
        Route::post('/', [\App\Http\Controllers\ClaimController::class, 'createClaim']);
        Route::get('/{claim}', [\App\Http\Controllers\ClaimController::class, 'getOneClaim']);
        Route::get('/{status?}/{substatus?}', [\App\Http\Controllers\ClaimController::class, 'getAllClaims']);
        Route::put('/{claim}', [\App\Http\Controllers\ClaimController::class, 'updateClaim']);

        Route::put('/verify-register/{id}', [\App\Http\Controllers\ClaimController::class, 'verifyAndRegister']);
        Route::post('/verify-register', [\App\Http\Controllers\ClaimController::class, 'storeVerifyAndRegister']);

        Route::patch('/change-status/{claim}', [\App\Http\Controllers\ClaimController::class, 'changeStatus']);
        Route::patch('/update-note-current-status/{id}', [\App\Http\Controllers\ClaimController::class, 'updateNoteCurrentStatus']);
        Route::patch('/add-note-current-status/{claim}', [\App\Http\Controllers\ClaimController::class, 'addNoteCurrentStatus']);
        Route::patch('/add-tracking-claim/{claim}', [\App\Http\Controllers\ClaimController::class, 'addTrackingClaim']);
    });

    Route::prefix('claim-sub-status')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::get('/get-all-server', [\App\Http\Controllers\ClaimSubStatusController::class, 'getServerAll'])->middleware(['auth:api']);
        Route::get('/get-list-by-billing-company/{status_id}/{billing_company_id?}', [\App\Http\Controllers\ClaimSubStatusController::class, 'getListByBilling']);
        Route::get('/get-list', [\App\Http\Controllers\ClaimSubStatusController::class, 'getList']);
        Route::get('/get-list-status', [\App\Http\Controllers\ClaimSubStatusController::class, 'getListStatus']);
        Route::post('/', [\App\Http\Controllers\ClaimSubStatusController::class, 'createClaimSubStatus'])->middleware([
            'auth:api',
        ]);
        Route::get('/{id}', [\App\Http\Controllers\ClaimSubStatusController::class, 'getOneClaimSubStatus'])->middleware([
            'auth:api',
        ]);
        Route::get('/get-by-name/{name}', [\App\Http\Controllers\ClaimSubStatusController::class, 'getByName'])->middleware([
            'auth:api',
        ]);
        Route::put('/{id}', [\App\Http\Controllers\ClaimSubStatusController::class, 'updateClaimSubStatus'])->middleware([
            'auth:api',
        ]);
        Route::patch('/change-status/{id}', [\App\Http\Controllers\ClaimSubStatusController::class, 'changeStatus'])->middleware([
            'auth:api',
        ]);
    });

    Route::prefix('denial')->middleware([
        'auth:api',
        // 'role:superuser|biller|billingmanager',
    ])->group(function () {
        Route::get('/get-all-server', [DenialController::class, 'getServerAll']);
        Route::get('/{denial}', [DenialController::class, 'getOneDenial']);
        Route::post('/', [DenialController::class, 'createDenialTracking']);
        Route::put('/', [DenialController::class, 'updateDenialTracking']);

        Route::prefix('/refile')->middleware([
            'auth:api',
            // 'role:superuser|biller|billingmanager',
        ])->group(function () {
            Route::post('/', [DenialController::class, 'createDenialRefile']);
            Route::put('/', [DenialController::class, 'updateDenialRefile']);
        });
    });

    Route::prefix('tableau')->middleware([
        'auth:api',
        // 'role:superuser|billingmanager',
    ])->group(function () {
        Route::get('/auth/embed-token', [AuthController::class, 'getEmbedToken']);
    });

    Route::middleware([
        'auth:api',
        // 'role:superuser|billingmanager',
    ])->group(function () {
        Route::get('/reports/classifications', [ReportReSource::class, 'classifications']);
        Route::get('/reports/types', [ReportReSource::class, 'types']);
        Route::get('reports/records', [ReportReSource::class, 'records']);
        Route::get('reports/columns', [ReportReSource::class, 'columnsReports']);
        Route::resource('presets', PresetsController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('reports', ReportReSource::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    });

    Route::prefix('payments')->middleware([
        'auth:api',
        // 'role:superuser|billingmanager',
    ])->group(function () {
        Route::get('batch/states', [BatchResource::class, 'getStates'])->name('batch.states');
        Route::get('/sources', [BatchResource::class, 'getSources'])->name('payments.sources');
        Route::get('/methods', [BatchResource::class, 'getMethods'])->name('payments.methods');
        Route::get('/eob/{eob_file}', [BatchResource::class, 'showEob'])->name('payments.eob.show');
        Route::get('/batch/{batch}/close', [BatchResource::class, 'close'])->name('batch.close');
        Route::post('/batch/{batch}/claims', [BatchResource::class, 'storeClaims'])->name('batch.claims');
        Route::post('/batch/{batch}/services', [BatchResource::class, 'storeServices'])->name('batch.services');
        Route::resource('batch', BatchResource::class)->only(['index', 'store', 'show', 'update', 'destroy'])->name('batch', 'payments.batch');
    });

    Route::get('/search-filters', [SearchController::class, 'filters'])->middleware('auth:api')->name('search.filters');
    Route::get('/search/{query}', [SearchController::class, 'search'])->middleware('auth:api')->name('search');
    Route::get('npi/{npi}', [\App\Http\Controllers\ApiController::class, 'getNpi']);
    Route::post('usps', [\App\Http\Controllers\ApiController::class, 'getZipCode']);
    Route::get('roket/token', [\App\Http\Controllers\RocketChatController::class, 'getToken']);
});
