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
        Schema::table('company_facility', function (Blueprint $table) {
            $table->foreignId('billing_company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_facility', function (Blueprint $table) {
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn(['billing_company_id']);
        });
    }
};
