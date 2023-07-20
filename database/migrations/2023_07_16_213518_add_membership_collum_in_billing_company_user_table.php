<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        schema::create('memberships_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->foreignId('billing_company_id')
                ->constrained('billing_companies')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
        Schema::create('membership_role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_company_user_id')
                ->constrained('billing_company_user')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('membership_role_id')
                ->constrained('memberships_roles')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_role_user');
        Schema::dropIfExists('memberships_roles');
    }
};
