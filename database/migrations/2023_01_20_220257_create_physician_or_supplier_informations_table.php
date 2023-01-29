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
        Schema::create('physician_or_supplier_informations', function (Blueprint $table) {
            $table->id();
            $table->string('prior_authorization_number', 40)->nullable();
            $table->boolean('outside_lab')->default(false);
            $table->decimal('charges', 8, 2)->nullable();
            $table->string('patient_account_num', 20)->nullable();
            $table->boolean('accept_assignment')->default(false);
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
        Schema::dropIfExists('physician_or_supplier_informations');
    }
};
