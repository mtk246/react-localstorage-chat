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
        Schema::create('claim_form_i_diagnosis', function (Blueprint $table) {
            $table->id();
            $table->integer('dx')->nullable();
            $table->foreignId('claim_form_i_id')->constrained('claim_forms_i')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('diagnosis_id')->constrained('diagnoses')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_form_i_diagnosis');
    }
};
