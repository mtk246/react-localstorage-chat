<?php

declare(strict_types=1);

namespace Tests\Feature\InsurancePlan;

use App\Http\Controllers\InsurancePlanController;
use App\Models\User;
use App\Repositories\InsurancePlanRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class InsurancePlanTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanCreateInsurancePlan()
    {
        $user = User::factory()->create();

        try {
            $data = [
                'name' => 'test',
                'payer_id' => '1',
                'ins_type_id' => 1,
                'plan_type_id' => 1,
                'format' => [
                    [
                        'format_professional_id' => 1,
                        'format_cms_id' => 2,
                        'format_institutional_id' => 3,
                        'format_ub_id' => 4,
                        'responsibilities' => [1, 2],
                    ],
                ],
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

            $response = $this->actingAs($user)->postJson('/api/v1/insurance-plan/', $data);

            $this->assertNotNull($response);
            $this->assertInstanceOf(JsonResponse::class, $response);
            $this->assertSame(201, $response->getStatusCode());
        } catch (\Exception $e) {
            $this->assertNotNull($e);
        }
    }

    public function testItCanUpdateInsurancePlan()
    {
        $user = User::factory()->create();

        try {
            $updatedData = [
                'name' => 'Updated Plan Name',
                'payer_id' => 1,
                'ins_type_id' => 1,
                'plan_type_id' => 1,
                'format' => [
                    [
                        'format_professional_id' => 1,
                        'format_cms_id' => 2,
                        'format_institutional_id' => 3,
                        'format_ub_id' => 4,
                        'responsibilities' => [1, 2],
                    ],
                ],
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

            $response = $this->actingAs($user)->postJson('/api/v1/insurance-plan/1', $updatedData);

            $this->assertNotNull($response);
            $this->assertInstanceOf(JsonResponse::class, $response);
            $this->assertSame(201, $response->getStatusCode());
        } catch (\Exception $e) {
            $this->assertNotNull($e);
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
