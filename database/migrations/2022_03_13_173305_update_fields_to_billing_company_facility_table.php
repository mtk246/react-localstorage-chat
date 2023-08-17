<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToBillingCompanyFacilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billing_company_facility', function (Blueprint $table) {
            $table->foreign('billing_company_id')->references('id')->on('billing_companies')
                  ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('facility_id')->references('id')->on('facilities')
                  ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billing_company_facility', function (Blueprint $table) {
        });
    }
}
