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
        Schema::create('patient_condition_related', function (Blueprint $table) {
            $table->id();
            $table->boolean('employment')->default(false);
            $table->boolean('auto_accident')->default(false);
            $table->boolean('other_accident')->default(false);
            $table->string('place_state', 50)->nullable();
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
        Schema::dropIfExists('patient_condition_related');
    }
};
