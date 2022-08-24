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
        Schema::create('claim_eligibility_benefits_information', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('name', 50);
            $table->string('service_type_codes', 50);
            $table->string('service_types', 50);
            $table->string('insurance_type_code', 50);
            $table->string('insurance_type', 50);
            $table->string('time_qualifer_code', 50);
            $table->string('time_qualifer', 50);
            $table->string('benefit_amount', 50);
            $table->string('benefits_date_information', 50);
            $table->string('additional_information');
            $table->foreignId('claim_eligibility_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_eligibility_benefits_information');
    }
};
