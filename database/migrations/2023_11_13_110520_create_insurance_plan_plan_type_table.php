<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('insurance_plan_plan_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_company_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreignId('insurance_plan_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreignId('plan_type_id')
                ->constrained('type_catalogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->timestamps();
        });

        DB::statement('INSERT INTO
            insurance_plan_plan_type (insurance_plan_id, plan_type_id, billing_company_id, created_at, updated_at)
            SELECT insurance.id AS insurance_plan_id, insurance.plan_type_id, insurance_plan_privates.billing_company_id, NOW(), NOW()
            FROM insurance_plans AS insurance
            INNER JOIN insurance_plan_privates ON insurance_plan_privates.insurance_plan_id = insurance.id
            WHERE insurance.plan_type_id IS NOT NULL');
    }

    public function down(): void
    {
        Schema::dropIfExists('insurance_plan_plan_type');
    }
};
