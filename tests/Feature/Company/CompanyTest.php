<?php

declare(strict_types=1);

namespace Tests\Feature\Company;

use App\Actions\Company\GetMeasurementUnitAction;
use App\Http\Controllers\Company\CompanyController;
use App\Repositories\CompanyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

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
        $companyRepository = $this->createMock(CompanyRepository::class);

        $controller = new CompanyController($companyRepository);

        $response = $controller->getListStatementWhen();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsAJsonResponseForStatementApplyToList()
    {
        $companyRepository = $this->createMock(CompanyRepository::class);

        $controller = new CompanyController($companyRepository);

        $response = $controller->getListStatementApplyTo();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsJsonResponseForNameSuffixLists()
    {
        $companyRepository = $this->createMock(CompanyRepository::class);

        $controller = new CompanyController($companyRepository);

        $response = $controller->getListNameSuffix();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsJsonResponseForContractFeeTypesLists()
    {
        $companyRepository = $this->createMock(CompanyRepository::class);

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
        $companyRepository = $this->createMock(CompanyRepository::class);

        $controller = new CompanyController($companyRepository);

        $response = $controller->getAllCompany();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }
}
