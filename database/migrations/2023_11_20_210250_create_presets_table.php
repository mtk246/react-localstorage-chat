<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('presets', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name', 100);
            $table->string('description', 255)->nullable();
            $table->boolean('is_private')->default(false);
            $table->string('version')->nullable();
            $table->json('filter');
            $table->foreignUlid('report_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('billing_company_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presents');
    }
};
