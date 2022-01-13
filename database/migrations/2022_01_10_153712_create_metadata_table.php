<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metadata', function (Blueprint $table) {
            $table->id();
            $table->string("dataset_name",30)->nullable();
            $table->string("description",150)->nullable();
            $table->string("machine_used",20)->nullable();
            $table->date("start_date");
            $table->date("end_date");
            $table->time("time",1);
            $table->string("location",50)->nullable();
            $table->string("ip_machine",20)->nullable();
            $table->string("mac_machine",50)->nullable();
            $table->foreignIdFor(\App\Models\User::class)->nullable();
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
        Schema::dropIfExists('metadata');
    }
}
