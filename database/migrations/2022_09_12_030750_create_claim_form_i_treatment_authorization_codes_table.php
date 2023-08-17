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
        Schema::create('claim_form_i_treatment_authorization_codes', function (Blueprint $table) {
            $table->id();
            $table->integer('treatment_authorization_code');
            $table->unsignedBigInteger('claim_form_i_id');
            $table->foreign('claim_form_i_id', 'fk_cfitac_cfi_id')
                ->references('id')
                ->on('claim_forms_i')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('claim_form_i_treatment_authorization_codes');
    }
};
