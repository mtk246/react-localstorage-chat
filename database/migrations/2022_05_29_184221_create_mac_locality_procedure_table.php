<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMacLocalityProcedureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mac_locality_procedure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mac_locality_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('procedure_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('mac_locality_procedure');
    }
}
