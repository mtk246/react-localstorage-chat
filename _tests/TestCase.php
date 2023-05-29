<?php

declare(strict_types=1);

namespace Tests;

use App\Models\User;
use App\Roles\Models\Role;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
        Artisan::call('db:seed --class=RoleSeeder');

        $user = User::factory()->withProfile()->create();

        $role = Role::where('slug', 'superuser')->first();
        $user->attachRole($role);
        
        $this->actingAs($user);
    }
}
