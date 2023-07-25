<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('insurance_plans', function (Blueprint $table) {
            $table->dropForeign(['charge_using_id']);
            $table->dropColumn(['charge_using_id']);
        });
    }

    public function down(): void
    {
        Schema::table('insurance_plans', function (Blueprint $table) {
            $table->foreignId('charge_using_id')
                    ->nullable()
                    ->constrained('type_catalogs')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
        });
    }
};
