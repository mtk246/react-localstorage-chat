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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('qr_claim', 50)->nullable();
            $table->string('control_number', 9)->nullable();
            $table->string('submitter_name', 50)->nullable();
            $table->string('submitter_contact', 50)->nullable();
            $table->string('submitter_phone')->nullable();

            $table->foreignId('company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('facility_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('patient_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('health_professional_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('insurance_company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->nullableMorphs('claim_formattable');

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
        Schema::dropIfExists('claims');
    }
};
