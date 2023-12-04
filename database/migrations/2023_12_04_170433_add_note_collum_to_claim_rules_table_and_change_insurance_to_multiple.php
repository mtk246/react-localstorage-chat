<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_rules', function (Blueprint $table) {
            $table->boolean('note')->default(true);
            $table->dropForeign(['insurance_plan_id']);
            $table->dropColumn('insurance_plan_id');
        });

        Schema::create('claim_rule_insurance_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_plan_id')
                ->nullable()
                ->constrained('insurance_plans')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignUlid('claim_rule_id')
                ->nullable()
                ->constrained('claim_rules')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_rule_insurance_plan');
        Schema::table('claim_rules', function (Blueprint $table) {
            $table->dropColumn('note');
            $table->foreignId('insurance_plan_id')
                ->nullable()
                ->constrained('insurance_plans')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
};
