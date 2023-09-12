<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->ulid();
            $table->string('module');
            $table->foreignId('role_id')
                ->nullable()
                ->constrained('membership_roles')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('billing_company_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->json('permission');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission');
    }
};
