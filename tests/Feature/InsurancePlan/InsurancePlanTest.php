<?php

declare(strict_types=1);

namespace Tests\Feature\InsurancePlan;

use App\Http\Controllers\InsurancePlanController;
use App\Repositories\InsurancePlanRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class InsurancePlanTest extends TestCase
{
    use RefreshDatabase;

    public function testItReturnsAJsonResponseForAllInsurancePlans()
    {
        $insurancePlanRepository = new InsurancePlanRepository();

        $controller = new InsurancePlanController($insurancePlanRepository);

        $response = $controller->getAllInsurancePlans();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsAJsonResponseForFormatsLists()
    {
        $insurancePlanRepository = new InsurancePlanRepository();

        $controller = new InsurancePlanController($insurancePlanRepository);

        $response = $controller->getListFormats();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsAJsonResponseForInsTypesList()
    {
        $insurancePlanRepository = new InsurancePlanRepository();

        $controller = new InsurancePlanController($insurancePlanRepository);

        $response = $controller->getListInsTypes();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsAJsonResponseForPlanTypesList()
    {
        $insurancePlanRepository = new InsurancePlanRepository();

        $controller = new InsurancePlanController($insurancePlanRepository);

        $response = $controller->getListPlanTypes();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }

    public function testItReturnsAJsonResponseForResposibilityTypeList()
    {
        $insurancePlanRepository = new InsurancePlanRepository();

        $controller = new InsurancePlanController($insurancePlanRepository);

        $response = $controller->getListResponsibilityType();

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertSame(200, $response->status());
    }
}
