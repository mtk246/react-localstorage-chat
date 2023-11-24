<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('insurance_policies', function (Blueprint $table) {
            $table->boolean('dual_plan')->default(false);
            $table->foreignId('complementary_policy_id')
                ->nullable()
                ->constrained('insurance_policies')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('insurance_policies', function (Blueprint $table) {
            $table->dropForeign(['complementary_policy_id']);
            $table->dropColumn(['dual_plan', 'complementary_policy_id']);
        });
    }
};
