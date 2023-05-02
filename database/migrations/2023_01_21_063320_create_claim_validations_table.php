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
        Schema::create('claim_validations', function (Blueprint $table) {
            $table->id();
            $table->string('control_number', 9);
            $table->longText('response_details')->nullable();
            $table->foreignId('claim_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('insurance_policy_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_validations');
    }
};
