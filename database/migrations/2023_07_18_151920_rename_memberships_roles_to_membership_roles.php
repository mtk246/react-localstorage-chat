<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::rename('memberships_roles', 'membership_roles');
    }

    public function down(): void
    {
        Schema::rename('membership_roles', 'memberships_roles');
    }
};
