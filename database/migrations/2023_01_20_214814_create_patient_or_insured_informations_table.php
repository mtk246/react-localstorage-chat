<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_or_insured_informations', function (Blueprint $table) {
            $table->id();
            $table->boolean('employment_related_condition')->default(false);
            $table->boolean('auto_accident_related_condition')->default(false);
            $table->string('auto_accident_place_state', 2)->nullable();
            $table->boolean('other_accident_related_condition')->default(false);
            $table->boolean('patient_signature')->default(false);
            $table->boolean('insured_signature')->default(false);
            $table->foreignId('claim_form_p_id')->constrained('claim_forms_p')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('patient_or_insured_informations');
    }
};
