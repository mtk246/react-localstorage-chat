<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('facility_taxonomy', function (Blueprint $table) {
            $table->unsignedBigInteger('billing_company_id')->nullable();
            $table->foreign('billing_company_id', 'bchp_bc_id')
                ->references('id')
                ->on('billing_companies')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('facility_taxonomy', function (Blueprint $table) {
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn(['billing_company_id']);
        });
    }
};
