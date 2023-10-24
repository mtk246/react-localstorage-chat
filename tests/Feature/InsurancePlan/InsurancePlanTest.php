<?php

declare(strict_types=1);

namespace Tests\Feature\InsurancePlan;

use App\Actions\InsurancePlan\AddCopays;
use App\Actions\InsurancePlan\AddContractFees;
use App\Actions\InsurancePlan\GetInsurancePlan;
use App\Actions\InsurancePlan\GetInsurancePlanAction;
use App\Http\Controllers\InsurancePlanController;
use App\Http\Requests\ChangeStatusInsurancePlanRequest;
use App\Http\Requests\InsurancePlan\AddContractFeesRequest;
use App\Http\Requests\InsurancePlan\AddCopaysRequest;
use App\Http\Requests\InsurancePlan\CreateRequest;
use App\Http\Requests\InsurancePlan\UpdateRequest;
use App\Http\Resources\InsurancePlan\InsurancePlanByPayerResource;
use App\Models\InsurancePlan;
use App\Models\ClearingHouse\AvailablePayer;
use App\Services\ClearingHouseService;
use App\Repositories\InsurancePlanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
