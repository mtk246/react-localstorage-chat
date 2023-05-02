<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToBillingCompanyInsuranceCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billing_company_insurance_company', function (Blueprint $table) {
            $table->foreign('billing_company_id')->references('id')->on('billing_companies')
                  ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('insurance_company_id')->references('id')->on('insurance_companies')
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
        Schema::table('billing_company_insurance_company', function (Blueprint $table) {
        });
    }
}
