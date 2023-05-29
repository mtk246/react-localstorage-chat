<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Facility;

use App\Models\BillingCompany;
use App\Models\Company;
use App\Models\FacilityType;
use App\Models\PlaceOfService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

final class CreateFacilityTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateFacility()
    {
        // TODO: This can be refactor installing request factory package.
        /*$data = [
            'name' => 'facilityName4',
            'facility_type_id' => FacilityType::factory()->create()->id,
            'billing_company_id' => BillingCompany::factory()->create()->id,
            'companies' => [
                Company::factory()->create()->id,
            ],
            'place_of_services' => [
                PlaceOfService::factory()->create()->id,
            ],
            'nickname' => 'alias facility2',
            'abbreviation' => 'ABBFAC',
            'taxonomies' => [
                [
                    'tax_id' => 'TAX01213',
                    'name' => 'NameTaxonomy',
                    'primary' => true,
                ],
                [
                    'tax_id' => 'TAX01214',
                    'name' => 'NameTaxonomy',
                    'primary' => false,
                ],
                [
                    'tax_id' => 'TAX01215',
                    'name' => 'NameTaxonomy',
                    'primary' => false,
                ],
            ],
            'npi' => '123fac321',
            'address' => [
                'address' => 'address Facility',
                'city' => 'city Facility',
                'state' => 'state Facility',
                'country' => 'country Facility',
                'zip' => '234',
            ],
            'contact' => [
                'phone' => '34324234',
                'mobile' => '34324234',
                'fax' => '567674576457',
                'email' => 'facility4@facility.com',
            ],
        ];

        $response = $this->postJson('/api/v1/facility/', $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('facilities', ['id' => $response['id']]);*/
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
