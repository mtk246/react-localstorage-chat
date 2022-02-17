<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingCompanyInsuranceCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_company_insurance_company', function (Blueprint $table) {
            $table->id();
            $table->boolean("status")->default("true");
            $table->foreignIdFor(\App\Models\BillingCompany::class);
            $table->foreignIdFor(\App\Models\InsuranceCompany::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_company_insurance_company');
    }
}
