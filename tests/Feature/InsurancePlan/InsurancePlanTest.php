<?php

declare(strict_types=1);

namespace Tests\Feature\InsurancePlan;

use App\Http\Controllers\InsurancePlanController;
use App\Models\InsurancePlan;
use App\Models\Type;
use App\Models\TypeCatalog;
use App\Repositories\InsurancePlanRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class InsurancePlanTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Type::factory()->create([
            'description' => 'Ins type',
        ]);

        TypeCatalog::factory()->create([
            'type_id' => Type::first()->id,
            'code' => 'CI',
            'description' => 'Commercial Insurance',
        ]);

        $user = $this->createUser('superuser');
        $this->actingAs($user);
    }

    public function testItCanCreateInsurancePlan()
    {
        $repository = new InsurancePlanRepository();

        $data = [
            'name' => 'test',
            'payer_id' => 1,
            'ins_type_id' => 1,
            'plan_type_id' => 1,
            'accept_assign' => true,
            'pre_authorization' => true,
            'file_zero_changes' => true,
            'referral_required' => true,
            'accrue_patient_resp' => true,
            'require_abn' => true,
            'pqrs_eligible' => true,
            'allow_attached_files' => true,
            'eff_date' => date('Y-m-d'),
            'insurance_company_id' => 1,
        ];

        DB::beginTransaction();

        try {
            $result = $repository->createInsurancePlan($data);

            $this->assertNull($result);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function testItCanUpdateInsurancePlan()
    {
        $insurancePlan = InsurancePlan::factory()->create();

        $repository = new InsurancePlanRepository();

        $updatedData = [
            'name' => 'Updated Plan Name',
            'payer_id' => 1,
            'ins_type_id' => 1,
            'plan_type_id' => 1,
            'accept_assign' => true,
            'pre_authorization' => true,
            'file_zero_changes' => true,
            'referral_required' => true,
            'accrue_patient_resp' => true,
            'require_abn' => true,
            'pqrs_eligible' => true,
            'allow_attached_files' => true,
            'eff_date' => date('Y-m-d'),
            'insurance_company_id' => 1,
        ];

        DB::beginTransaction();

        try {
            $result = $repository->updateInsurancePlan($updatedData, $insurancePlan->id);

            $this->assertNull($result);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

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
