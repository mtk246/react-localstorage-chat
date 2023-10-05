<?php

declare(strict_types=1);

namespace Tests\Feature\Permissions;

use App\Models\BillingCompany\MembershipRole;
use App\Models\User\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class RolesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function itReturnsAJsonResponseContaininglistOfRoles(): void
    {
        // Arrange
        $user = $this->createUser('billingmanager');
        $roleA = Role::factory()
            // ->withPermissions()
            ->create(['billing_company_id' => $user->billing_company_id]);
        $roleB = Role::factory()
            // ->withPermissions()
            ->create(['billing_company_id' => $user->billing_company_id]);

        // Act
        $response = $this->actingAs($user)->get(route('roles.index'));
        // Assert
        $response->assertOk();
        // $response->assertJsonCount(2, 'data');
        $response->assertJsonFragment([
            'id' => $roleA->id,
            'name' => $roleA->name,
            'description' => $roleA->description,
            'slug' => $roleA->slug,
            'billing_company_id' => $roleA->billing_company_id,
            'billing_company' => $roleA->billingCompany->toArray(),
        ]);
        $response->assertJsonFragment([
            'id' => $roleB->id,
            'name' => $roleB->name,
            'description' => $roleB->description,
            'slug' => $roleB->slug,
            'billing_company_id' => $roleA->billing_company_id,
            'billing_company' => $roleA->billingCompany->toArray(),
        ]);
    }

    /** @test */
    public function itReturnsAJsonResponseContaininglistOfRolesAsAdmin(): void
    {
        // Arrange
        $user = $this->createUser('superuser');
        $roleA = Role::factory()
            // ->withPermissions()
            ->withBillingCompany()
            ->create();
        $roleB = Role::factory()
            // ->withPermissions()
            ->withBillingCompany()
            ->create();

        // Act
        $response = $this->actingAs($user)->get(route('roles.index'));
        // Assert
        $response->assertOk();
        // $response->assertJsonCount(2, 'data');
        /*$response->assertJsonFragment([
            'id' => $roleA->id,
            'name' => $roleA->name,
            'description' => $roleA->description,
            'slug' => $roleA->slug,
            'billing_company_id' => $roleA->billing_company_id,
            'billing_company' => $roleA->billingCompany->toArray(),
        ]);
        $response->assertJsonFragment([
            'id' => $roleB->id,
            'name' => $roleB->name,
            'description' => $roleB->description,
            'slug' => $roleB->slug,
            'billing_company_id' => $roleA->billing_company_id,
            'billing_company' => $roleA->billingCompany->toArray(),
        ]);*/
    }

    /** @test */
    public function itReturnsAJsonResponseContainingCreatedRole(): void
    {
        // Arrange
        $billingManager = $this->createUser('billingmanager');

        $billingManagerRequestData = [
            'name' => 'test role',
            'note' => 'this is a test role',
            'permissions' => [
                ['module' => 'test_module', 'permission' => ['creste', 'read', 'update', 'delete']],
            ],
        ];

        // Act
        $billingManagerResponse = $this->actingAs($billingManager)->post(route('roles.store', $billingManagerRequestData));

        // Assert
        $billingManagerResponse->assertOk();
        $billingManagerResponse->assertJsonFragment($billingManagerRequestData);
    }

    /** @test */
    public function itReturnsAJsonResponseContainingCreatedRoleAsAdmin(): void
    {
        // Arrange
        $superUser = $this->createUser('superuser');

        $superUserRequestData = [
            'billing_company_id' => $superUser->billing_company_id,
            'name' => 'test role',
            'note' => 'this is a test role',
            'permissions' => [
                ['module' => 'test_module', 'permission' => ['create', 'read', 'update', 'delete']],
            ],
        ];

        // Act
        $superUserResponse = $this->actingAs($superUser)->postJson(route('roles.store'), $superUserRequestData);

        // Assert
        $superUserResponse->assertOk();
        $superUserResponse->assertJsonFragment($superUserRequestData);
    }

    /** @test */
    public function itReturnsAJsonResponseContainingEditedRole(): void
    {
        // Arrange
        $user = $this->createUser('billingmanager');
        $role = MembershipRole::factory()
            ->withPermissions()
            ->create(['billing_company_id' => $user->billing_company_id]);

        // Act
        $response = $this->actingAs($user)->put(route('roles.update', ['role' => $role->id]), [
            'name' => 'test edit role',
            'note' => 'this is a test role',
        ]);

        // Assert
        $response->assertOk();
        $response->assertJsonFragment([
            'name' => 'test edit role',
            'note' => 'this is a test role',
        ]);
    }

    /** @test */
    public function itReturnsAJsonResponseContainingEditedRoleAsAdmin(): void
    {
        // Arrange
        $user = $this->createUser('superuser');
        $role = MembershipRole::factory()
            ->withPermissions()
            ->withBillingCompany()
            ->create();

        // Act
        $response = $this->actingAs($user)->put(route('roles.update', ['role' => $role->id]), [
            'billing_company_id' => $role->billing_company_id,
            'name' => 'test edit role',
            'note' => 'this is a test role',
        ]);

        // Assert
        $response->assertOk();
        $response->assertJsonFragment([
            'name' => 'test edit role',
            'note' => 'this is a test role',
        ]);
    }

    /** @test */
    public function itReturnsAJsonResponseContainingDeletedRoleResponse(): void
    {
        // Arrange
        $user = $this->createUser('billingmanager');
        $role = MembershipRole::factory()
            ->withPermissions()
            ->create(['billing_company_id' => $user->billing_company_id]);

        // Act
        $response = $this->actingAs($user)->delete(route('roles.destroy', ['role' => $role->id]));

        // Assert
        $response->assertOk();
        $this->assertDatabaseMissing('membership_roles', ['id' => $role->id]);
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

        // Act
        $response = $this->actingAs($user)->delete(route('roles.destroy', ['role' => $role->id]));

        // Assert
        $response->assertOk();
        $this->assertDatabaseMissing('membership_roles', ['id' => $role->id]);
    }
}
