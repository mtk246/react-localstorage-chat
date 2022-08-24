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
        Schema::create('claim_eligibility_benefits_information_others', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('name', 50);
            $table->string('service_type_codes', 50);
            $table->string('service_types', 50);
            $table->string('insurance_type_code', 50);
            $table->string('insurance_type', 50);
            $table->string('header_loop_identifier_code', 50);
            $table->string('trailer_loop_identifier_code', 50);
            $table->string('plan_number', 50);
            $table->string('plan_network_id_number', 50);
            $table->string('benefits_date_information', 50);
            $table->string('entity_identifier', 50);
            $table->string('entity_type', 50);
            $table->string('entity_name', 50);
            $table->string('address', 50);
            $table->string('city', 50);
            $table->string('state', 2);
            $table->string('postal_code');
            $table->string('communication_mode', 50);
            $table->string('communication_number', 50);
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
        Schema::dropIfExists('claim_eligibility_benefits_information_others');
    }
};
