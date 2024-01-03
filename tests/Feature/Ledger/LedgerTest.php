<?php

declare(strict_types=1);

namespace Tests\Feature\Ledger;

use App\Models\Claims\Claim;
use App\Models\Claims\ClaimDemographicInformation;
use App\Models\Claims\ClaimService;
use App\Models\Company;
use App\Models\HealthProfessional;
use App\Models\InsurancePlan;
use App\Models\InsurancePolicy;
use App\Models\Patient;
use App\Models\PatientPrivate;
use App\Models\User\Role;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class LedgerTest extends TestCase
{
    use RefreshDatabase;

    public function testCantSearchLedgerIfMissingsParams()
    {
        $adminRole = Role::where('slug', 'superuser')->first();
        $user = UserFactory::new()->whithRole($adminRole)->create();

        $response = $this->actingAs($user)->get(route('ledger.search'));
        $response->assertBadRequest();
    }

    public function testCanSearchLedger()
    {
        $insurancePlan = InsurancePlan::factory()->create();
        $insurancePolicy = InsurancePolicy::factory()
            ->for($insurancePlan)
            ->create();

        $claim = Claim::factory()
            ->hasAttached(
                $insurancePolicy,
                ['order' => 1]
            )
            ->create();
        ClaimService::factory()->for($claim)->create();

        $patient = Patient::factory()->withProfile()->create();
        PatientPrivate::factory()->for($patient)->create();

        $company = Company::factory()->create();
        $healthProfessional = HealthProfessional::factory()->create();

        $c = ClaimDemographicInformation::factory()
            ->for($claim)
            ->for($patient)
            ->for($company)
            ->hasAttached(
                $healthProfessional,
                ['field_id' => 5]
            )
            ->create();

        $adminRole = Role::where('slug', 'superuser')->first();
        $user = UserFactory::new()->whithRole($adminRole)->create();

        // create request get with params claim_number = "hola

        $response = $this->actingAs($user)->get(route('ledger.search', [
            'claim_number' => $claim->code,
        ]));

        $response->assertOk();
    }
}
