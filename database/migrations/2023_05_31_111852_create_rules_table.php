<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('claim_rules', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('format');
            $table->string('description');
            $table->foreignId('billing_company_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->json('rules');
            $table->json('parameters')
                ->nullable();
            $table->timestamps();
        });
        Schema::create('company_claim_rule', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('claim_rule_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_claim_rule');
        Schema::dropIfExists('claim_rules');
    }
};
