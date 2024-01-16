<?php

declare(strict_types=1);

namespace Tests\Feature\BillingCompany;

use App\Models\BillingCompany;
use App\Models\User;
use App\Models\User\Role;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BillingCompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itReturnsAJsonResponseContainingAllBillingCompaniesForTheAuthenticatedUser()
    {
        $billingCompany = BillingCompany::factory()->create();
        $user = User::factory()->withProfile()->create(['billing_company_id' => $billingCompany->id]);

        $adminRole = Role::where('slug', 'superuser')->first();

        $user = UserFactory::new()->whithRole($adminRole)->create();

        $billingCompany = BillingCompany::find(1);

        $response = $this->actingAs($user)->get(route('billing-company.index'));

        $response->assertOk();

        $responseData = $response->json();

        $this->assertIsArray($responseData);
        $this->assertCount(1, $responseData);

        $formattedTimestamps = [
            'created_at' => $billingCompany->created_at->format('Y-m-d\TH:i:s.u\Z'),
            'updated_at' => $billingCompany->updated_at->format('Y-m-d\TH:i:s.u\Z'),
        ];

        $expectedData = [
            'status' => true,
            'id' => $billingCompany->id,
            'name' => $billingCompany->name,
            'created_at' => $formattedTimestamps['created_at'],
            'updated_at' => $formattedTimestamps['updated_at'],
            'code' => $billingCompany->code,
            'logo' => $billingCompany->logo,
            'abbreviation' => $billingCompany->abbreviation,
            'tax_id' => $billingCompany->tax_id,
            'last_modified' => [
                'user' => 'Console',
                'roles' => [],
            ],
            'contact' => $billingCompany->contact,
            'address' => $billingCompany->address,
            'users' => [],
            'addresses' => [],
            'contacts' => [],
            'disabled_at' => null,
        ];

        $this->assertEquals([$expectedData], $responseData);
    }

    /** @test */
    public function itReturnsAJsonResponseContainingTheUpdatedBillingCompany()
    {
        $billingCompany = BillingCompany::factory()->create();
        $user = User::factory()->withProfile()->create(['billing_company_id' => $billingCompany->id]);

        $adminRole = Role::where('slug', 'superuser')->first();

        $user = UserFactory::new()->whithRole($adminRole)->create();

        $billingCompany = BillingCompany::find($billingCompany->id);

        if (!$billingCompany) {
            $billingCompany = BillingCompany::factory()->create(['id' => $user->billing_company_id]);
        }

        $updateBillingCompanyRequest = [
            'status' => true,
            'id' => $billingCompany->id,
            'name' => 'Updated Name',
            'tax_id' => 'Updated Tax ID',
            'contact' => [
                'email' => 'updated@example.com',
            ],
        ];

        $response = $this->actingAs($user)->put(route('billing-company.update', $billingCompany), $updateBillingCompanyRequest);

        $responseData = $response->json();

        $this->assertIsArray($responseData);

        $expectedData = [
            'status' => true,
            'id' => $billingCompany->id,
        ];

        if (array_key_exists('user', $responseData)) {
            $this->assertNotNull($responseData['user']['first_name']);
            $this->assertNotNull($responseData['user']['last_name']);
        }

        $found = false;

        foreach ($responseData as $dataItem) {
            if ($dataItem == $expectedData) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found);
    }
}
