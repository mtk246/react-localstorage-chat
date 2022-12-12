<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_health_professional', function (Blueprint $table) {
            $table->text('authorization')->nullable();
            $table->foreignId('billing_company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->dropForeign(['company_health_professional_type_id']);
            $table->dropColumn('company_health_professional_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_health_professional', function (Blueprint $table) {
            $table->foreignId('company_health_professional_type_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->dropColumn('authorization');
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn('billing_company_id');
        });
    }
};
