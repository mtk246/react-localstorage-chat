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
        Schema::create('claim_transmission_responses', function (Blueprint $table) {
            $table->id();
            $table->longText('response_details')->nullable();
            $table->foreignId('claim_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('claim_batch_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('claim_transmission_status_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_transmission_responses');
    }
};