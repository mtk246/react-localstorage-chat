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
        Schema::create('claim_forms_i', function (Blueprint $table) {
            $table->id();
            $table->string('type_of_bill', 3);
            $table->string('federal_tax_number', 50);
            $table->date('start_date_service')->nullable();
            $table->date('end_date_service')->nullable();
            $table->date('admission_date')->nullable();
            $table->integer('admission_hour')->nullable();
            $table->string('type_of_admission', 1);
            $table->string('source_admission', 1);
            $table->integer('discharge_hour')->nullable();
            $table->integer('patient_discharge_stat')->nullable();
            $table->integer('admit_dx')->nullable();
            
            $table->foreignId('type_form_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('patient_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_form_i_s');
    }
};
