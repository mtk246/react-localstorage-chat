<?php

declare(strict_types=1);

namespace Tests\Feature\Company;

use App\Actions\Company\GetMeasurementUnitAction;
use App\Http\Controllers\Company\CompanyController;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function testItReturnsAJsonResponseForCompanyList()
    {
        $user = $this->createUser('superuser');
        $this->actingAs($user);

        $response = $this->json('GET', '/api/v1/company/get-list-by-billing-company');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function testItReturnsAJsonResponseForMeasurementUnitsList()
    {
        $measurementUnitAction = new GetMeasurementUnitAction();

        $companyRepository = new CompanyRepository();

        $controller = new CompanyController($companyRepository);

        $response = $controller->getListMeasurementUnits($measurementUnitAction);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsAJsonResponseForListStatementRules()
    {
        $user = $this->createUser('superuser');
        $this->actingAs($user);

        $response = $this->json('GET', '/api/v1/company/get-list-statement-rules');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function testItReturnsAJsonResponseForListStatementWhen()
    {
        $companyRepository = new CompanyRepository();

        $controller = new CompanyController($companyRepository);

        $response = $controller->getListStatementWhen();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsAJsonResponseForStatementApplyToList()
    {
        $companyRepository = new CompanyRepository();

        $controller = new CompanyController($companyRepository);

        $response = $controller->getListStatementApplyTo();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsJsonResponseForNameSuffixLists()
    {
        $companyRepository = new CompanyRepository();

        $controller = new CompanyController($companyRepository);

        $response = $controller->getListNameSuffix();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsJsonResponseForContractFeeTypesLists()
    {
        $companyRepository = new CompanyRepository();

        $controller = new CompanyController($companyRepository);

        $response = $controller->getListContractFeeTypes();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsJsonResponseForBillingCompaniesLists()
    {
        $user = $this->createUser('superuser');
        $this->actingAs($user);

        $response = $this->json('GET', '/api/v1/company/get-list-billing-companies');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function testItReturnsJsonResponseForAllCompany()
    {
        $companyRepository = new CompanyRepository();

        $controller = new CompanyController($companyRepository);

        $response = $controller->getAllCompany();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsJsonResponseForAllServer()
    {
        $user = $this->createUser('superuser');
        $this->actingAs($user);

        $response = $this->json('GET', '/api/v1/company/get-all-server');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
    }
}
