<?php

declare(strict_types=1);

namespace Tests\Feature\Permissions;

use App\Models\BillingCompany\MembershipRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class PermitsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itReturnsAJsonResponseContaininglistOfRoles(): void
    {
        // Arrange
        $user = $this->createUser('billingmanager');
        $role = MembershipRole::factory()
            ->withPermissions()
            ->create(['billing_company_id' => $user->billing_company_id]);

        // Act
        $response = $this->actingAs($user)->get(route('roles.permission.index', ['role' => $role->id]));
        // Assert
        $response->assertOk();
    }

    /** @test */
    public function itReturnsAJsonResponseContaininglistOfRolesAsAdmin(): void
    {
        // Arrange
        $user = $this->createUser('superuser');
        $role = MembershipRole::factory()
            ->withPermissions()
            ->withBillingCompany()
            ->create();

        // Act
        $response = $this->actingAs($user)->get(route('roles.permission.index', ['role' => $role->id]));
        // Assert
        $response->assertOk();
    }

    /** @test */
    public function itReturnsAJsonResponseContainingCreatedRole(): void
    {
        // Arrange
        $billingManager = $this->createUser('billingmanager');
        $role = MembershipRole::factory()
            ->withPermissions()
            ->withBillingCompany()
            ->create();

        $billingManagerRequestData = [
            'permits' => [
                ['module' => 'test.module', 'permission' => ['store', 'read', 'update', 'delete']],
                ['module' => 'test.module2', 'permission' => ['store', 'read', 'update', 'delete']],
            ],
        ];

        // Act
        $billingManagerResponse = $this->actingAs($billingManager)->post(route('roles.permission.store', ['role' => $role->id]), $billingManagerRequestData);

        // Assert
        $billingManagerResponse->assertOk();
    }

    /** @test */
    public function itReturnsAJsonResponseContainingCreatedRoleAsAdmin(): void
    {
        // Arrange
        $superUser = $this->createUser('superuser');
        $role = MembershipRole::factory()
            ->withPermissions()
            ->withBillingCompany()
            ->create();

        $superUserRequestData = [
            'permits' => [
                ['module' => 'test.module', 'permission' => ['store', 'read', 'update', 'delete']],
                ['module' => 'test.module2', 'permission' => ['store', 'read', 'update', 'delete']],
            ],
        ];

        // Act
        $billingManagerResponse = $this->actingAs($superUser)->post(route('roles.permission.store', ['role' => $role->id]), $superUserRequestData);

        // Assert
        $billingManagerResponse->assertOk();
    }

    /** @test */
    public function itReturnsAJsonResponseContainingDeletedRoleResponse(): void
    {
        // Arrange
        $user = $this->createUser('billingmanager');
        $role = MembershipRole::factory()
            ->withPermissions()
            ->create(['billing_company_id' => $user->billing_company_id]);

        $requestData = [
            'permits' => [
                ['module' => 'test.module', 'permission' => ['store', 'read', 'update', 'delete']],
                ['module' => 'test.module2', 'permission' => ['store', 'read', 'update', 'delete']],
            ],
        ];

        // Act
        $this->actingAs($user)->post(route('roles.permission.store', ['role' => $role->id]), $requestData);
        $response = $this->actingAs($user)->delete(route('roles.destroy', ['role' => $role->id]));

        // Assert
        $response->assertOk();
    }

    /** @test */
    public function itReturnsAJsonResponseContainingDeletedRoleResponseAsAdmin(): void
    {
        // Arrange
        $user = $this->createUser('superuser');
        $role = MembershipRole::factory()
            ->withPermissions()
            ->withBillingCompany()
            ->create();

        $requestData = [
            'permits' => [
                ['module' => 'test.module', 'permission' => ['store', 'read', 'update', 'delete']],
                ['module' => 'test.module2', 'permission' => ['store', 'read', 'update', 'delete']],
            ],
        ];

        // Act
        $this->actingAs($user)->post(route('roles.permission.store', ['role' => $role->id]), $requestData);
        $response = $this->actingAs($user)->delete(route('roles.destroy', ['role' => $role->id]));

        // Assert
        $response->assertOk();
    }
}
