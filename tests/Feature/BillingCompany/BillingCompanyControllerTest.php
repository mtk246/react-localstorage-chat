<?php

namespace Tests\Feature\BillingCompany;

use App\Http\Controllers\BillingCompany\BillingCompanyController;
use App\Repositories\BillingCompanyRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class BillingCompanyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Create a mock of BillingCompanyRepository
        $billingCompanyRepository = $this->createMock(BillingCompanyRepository::class);

        // Create an instance of BillingCompanyController with the mock repository
        $controller = new BillingCompanyController($billingCompanyRepository);

        // Define the expected result from the repository
        $expectedResult = ['data' => ['company1', 'company2']];

        // Set up the mock to return the expected result
        $billingCompanyRepository->expects($this->once())
            ->method('getAllBillingCompany')
            ->willReturn($expectedResult);

        // Call the index method and assert the response
        $response = $controller->index();

        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(Response::HTTP_OK, $response->status());
        $this->assertEquals($expectedResult, $responseData);
    }
}
