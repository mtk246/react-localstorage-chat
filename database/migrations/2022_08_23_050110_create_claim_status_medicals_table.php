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
        Schema::create('claim_status_medicals', function (Blueprint $table) {
            $table->id();
            $table->string('control_number', 9);
            $table->foreignId('company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('suscriber_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('insurance_company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_status_medicals');
    }
};
