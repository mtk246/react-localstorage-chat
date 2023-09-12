<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('insurance_plans', function (Blueprint $table) {
            $table->dropColumn(['eff_date']);
        });

        Schema::table('insurance_plan_privates', function (Blueprint $table) {
            $table->date('eff_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('insurance_plans', function (Blueprint $table) {
            $table->date('eff_date')->nullable();
        });

        Schema::table('insurance_plan_privates', function (Blueprint $table) {
            $table->dropColumn(['eff_date']);
        });
    }
};
