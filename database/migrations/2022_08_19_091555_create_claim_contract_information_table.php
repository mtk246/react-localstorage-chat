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
        Schema::create('claim_contract_information', function (Blueprint $table) {
            $table->id();
            $table->string('contract_amount', 18);
            $table->string('contract_percentage', 6);
            $table->string('contract_code', 50);
            $table->string('contract_version_identifier', 50);
            $table->string('terms_discount_percentage', 6);
            $table->foreignId('claim_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('claim_contract_type_code_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_contract_information');
    }
};
