<?php

declare(strict_types=1);

namespace Tests\Feature\Facility;

use App\Models\BillClassification;
use App\Models\BillingCompany;
use App\Models\Company;
use App\Models\Facility;
use App\Models\FacilityType;
use App\Models\PlaceOfService;
use App\Models\User;
use Tests\TestCase;

final class FacilityTest extends TestCase
{
    public function testCanGetAllServer()
    {
        $this->markTestSkipped('Paused while it is found how to test with meilisearch');

        $billingCompany = BillingCompany::factory()->create();
        $user = User::factory()->withProfile()->create(['billing_company_id' => $billingCompany->id]);

        Facility::factory()->count(3)->create();

        $response = $this->actingAs($user)->getJson(route('facility.get.all.server'));
        $response->assertOk();
    }

    public function testGetAllServerWithFilter()
    {
        $this->markTestSkipped('Paused while it is found how to test with meilisearch');

        $billingCompany = BillingCompany::factory()->create();
        $user = User::factory()->withProfile()->create(['billing_company_id' => $billingCompany->id]);

        $facilities = Facility::factory()->count(3)->create();

        $response = $this->actingAs($user)->getJson(route('facility.get.all.server', ['query' => $facilities[0]->name]));
        $response->assertOk();
    }

    public function testCreateFacility()
    {
        $billingCompany = BillingCompany::factory()->create();
        $user = User::factory()->withProfile()->create(['billing_company_id' => $billingCompany->id]);

        $company = Company::factory()->create();

        $facilityType = FacilityType::factory()
            ->has(BillClassification::factory()->count(2), 'billClasifications')
            ->create();

        $pos = PlaceOfService::factory()->create();

        $data = [
            'name' => 'facilityName1',
            'companies' => [$company->id],
            'nickname' => 'alias facilityName',
            'abbreviation' => 'ABBFAC',
            'place_of_services' => [$pos->id],
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
            'npi' => '123fa1c321',
            'address' => [
                'address' => 'address Facility',
                'city' => 'city Facility',
                'state' => 'state Facility',
                'country' => 'country Facility',
                'zip' => '234',
                'apt_suite' => 'Apt suite value',
            ],
            'contact' => [
                'phone' => '222-222-2222',
                'mobile' => '222-222-2222',
                'fax' => '222-222-2222',
                'email' => 'facility41@facility.com',
            ],
            'public_note' => 'Public Note',
            'private_note' => 'Private Note',
            'types' => [
                [
                    'id' => $facilityType->id,
                    'bill_classifications' => [$facilityType->billClasifications[0]->id],
                ],
            ],
            'other_name' => 'Other name test',
        ];

        $response = $this->actingAs($user)->postJson(route('facility.create'), $data);
        $response->assertCreated();
    }

    public function testUpdateFacility()
    {
        $billingCompany = BillingCompany::factory()->create();
        $user = User::factory()->withProfile()->create(['billing_company_id' => $billingCompany->id]);

        $facility = Facility::factory()->create();

        $company = Company::factory()->create();

        $facilityType = FacilityType::factory()
            ->has(BillClassification::factory()->count(2), 'billClasifications')
            ->create();

        $data = [
            'name' => 'facility Edited',
            'npi' => '123fa1c321',
            'companies' => [$company->id],
            'abbreviation' => 'ABBFAC',
            'billing_company_id' => $billingCompany->id,
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
            ],
            'address' => [
                'address' => 'address Facility',
                'city' => 'city Facility',
                'state' => 'state Facility',
                'country' => 'country Facility',
                'zip' => '234',
                'apt_suite' => 'Apt suite value',
            ],
            'contact' => [
                'phone' => '222-222-2235',
                'mobile' => '222-222-2222',
                'fax' => '222-222-2222',
                'email' => 'facility41@facility.com',
            ],
            'types' => [
                [
                    'id' => $facilityType->id,
                    'bill_classifications' => [$facilityType->billClasifications[0]->id],
                ],
            ],
        ];

        $response = $this->actingAs($user)->putJson(route('facility.update', ['id' => $facility->id]), $data);
        $response->assertOk();
    }

    public function testChangeStatusFacility()
    {
        $billingCompany = BillingCompany::factory()->create();
        $user = User::factory()
            ->hasAttached($billingCompany, ['status' => true])
            ->withProfile()->create(['billing_company_id' => $billingCompany->id]);

        $facility = Facility::factory()
            ->hasAttached($billingCompany, ['status' => true])
            ->create();

        $response = $this->actingAs($user)->patchJson(route('facility.change-status', ['id' => $facility->id]), ['status' => false]);
        $response->assertStatus(204);
    }
}
