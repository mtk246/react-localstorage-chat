<?php

declare(strict_types=1);

namespace Tests;

use App\Models\BillingCompany;
use App\Models\User;
use App\Roles\Models\Role;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createUser(string $role): User
    {
        $billingCompany = BillingCompany::factory()->create();
        $role = Role::factory()->create(match ($role) {
            'superuser' => ['name' => 'Super User', 'slug' => 'superuser', 'level' => 1],
            'billingmanager' => ['name' => 'Billing Manager', 'slug' => 'billingmanager', 'level' => 2],
        });

        return User::factory()->whithRole($role)->withProfile()->withBillingCompany($billingCompany)->create();
    }
}
