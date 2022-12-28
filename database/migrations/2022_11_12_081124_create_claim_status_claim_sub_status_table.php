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
        Schema::create('claim_status_claim_sub_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_status_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('claim_sub_status_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_status_claim_sub_status');
    }
};
