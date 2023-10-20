<?php

declare(strict_types=1);

namespace Tests\Feature\Company;

use App\Repositories\CompanyRepository;
use App\Http\Controllers\Company\CompanyController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Actions\Company\GetMeasurementUnitAction;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_json_response_for_company_list()
    {
        $user = $this->createUser('superuser');
        $this->actingAs($user);

        $response = $this->json('GET', '/api/v1/company/get-list-by-billing-company');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function test_it_returns_a_json_response_for_measurement_units_list()
    {
        $measurementUnitAction = new GetMeasurementUnitAction();

        $companyRepository = new CompanyRepository();

        $controller = new CompanyController($companyRepository);

        $response = $controller->getListMeasurementUnits($measurementUnitAction);

        $this->assertSame(200, $response->status());
    }

    public function test_it_returns_a_json_response_for_list_statement_rules()
    {
        $user = $this->createUser('superuser');
        $this->actingAs($user);

        $response = $this->json('GET', '/api/v1/company/get-list-statement-rules');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function test_it_returns_a_json_response_for_list_statement_when()
    {
        $user = $this->createUser('superuser');
        $this->actingAs($user);

        $response = $this->json('GET', '/api/v1/company/get-list-statement-when');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function test_it_returns_a_json_response_for_statement_apply_to_list()
    {
        $companyRepository = new CompanyRepository();

        $controller = new CompanyController($companyRepository);

        $response = $controller->getListStatementApplyTo();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }
}
