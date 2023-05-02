<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_insurance_policy', function (Blueprint $table) {
            $table->smallInteger('order')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('claim_insurance_policy', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
