<?php

declare(strict_types=1);

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::with(['roles' => function ($query) {
            return $query->where('roles.id', '=', 1);
        }])->first();

        $this->actingAs($user);
    }
}
