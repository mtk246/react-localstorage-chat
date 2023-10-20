<?php

declare(strict_types=1);

namespace Tests\Feature\BillingCompany;

use App\Models\BillingCompany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BillingCompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itReturnsAJsonResponseContainingAllBillingCompaniesForTheAuthenticatedUser()
    {
        $user = $this->createUser('superuser');

        $billingCompany = BillingCompany::find($user->billing_company_id);

        if (!$billingCompany) {
            $billingCompany = BillingCompany::factory()->create(['id' => $user->billing_company_id]);
        }

        $response = $this->actingAs($user)->get(route('billing-company.index'));

        $response->assertOk();

        $responseData = $response->json();

        $this->assertIsArray($responseData); // Ensure the response data is an array
        $this->assertCount(1, $responseData); // Assert the count of items in the 'data' array

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
        ];

        $this->assertEquals([$expectedData], $responseData);
    }

    /** @test */
    public function itReturnsAJsonResponseContainingTheUpdatedBillingCompany()
    {
        $user = $this->createUser('superuser');
        $billingCompany = BillingCompany::find($user->billing_company_id);

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

        $response->assertOk();

        $responseData = $response->json();

        $this->assertIsArray($responseData);

        $expectedData = [
            'status' => true,
            'id' => $billingCompany->id,
        ];

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
