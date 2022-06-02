<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMacLocalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mac_localities', function (Blueprint $table) {
            $table->id();
            $table->string('mac', 8);
            $table->integer('locality_number');
            $table->string('state', 50);
            $table->string('fsa', 50);
            $table->string('counties', 50);
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
        Schema::dropIfExists('mac_localities');
    }
}
