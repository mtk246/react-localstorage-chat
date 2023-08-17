<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('contract_fees', function (Blueprint $table) {
            $table->dropForeign(['insurance_company_id']);
            $table->dropForeign(['insurance_plan_id']);
            $table->dropForeign(['company_id']);
            $table->dropForeign(['modifier_id']);
            $table->dropColumn([
                'insurance_company_id',
                'insurance_plan_id',
                'company_id',
                'modifier_id',
            ]);
            $table->date('start_date')->nullable()->change();
            $table->date('end_date')->nullable()->change();
        });

        Schema::table('copays', function (Blueprint $table) {
            $table->dropForeign(['insurance_company_id']);
            $table->dropForeign(['insurance_plan_id']);
            $table->dropForeign(['company_id']);
            $table->dropColumn(['insurance_company_id', 'insurance_plan_id', 'company_id']);
        });

        Schema::create('contract_fee_insurance_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_plan_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('contract_fee_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('company_contract_fee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('contract_fee_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('copay_insurance_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_plan_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('copay_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('company_copay', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('copay_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('contract_fees', function (Blueprint $table) {
            $table->foreignId('insurance_company_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('insurance_plan_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('company_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('modifier_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });

        Schema::table('copays', function (Blueprint $table) {
            $table->foreignId('insurance_company_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('insurance_plan_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('company_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });

        Schema::dropIfExists('contract_fee_insurance_plan');
        Schema::dropIfExists('company_contract_fee');
        Schema::dropIfExists('copay_insurance_plan');
        Schema::dropIfExists('company_copay');
    }
};
