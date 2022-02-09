<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string("marital_status");
            $table->string("driver_licence");
            $table->boolean("dependent")->default(false);
            $table->string("guardian_name");
            $table->string("guardian_phone");
            $table->string("spuse_name");
            $table->string("employer");
            $table->string("employer_address");
            $table->string("position");
            $table->string("phone_employer");
            $table->string("spuse_employer");
            $table->string("spuse_work_phone");
            $table->foreignIdFor(\App\Models\User::class);
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
        Schema::dropIfExists('patients');
    }
}
