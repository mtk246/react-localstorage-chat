<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('group_1');
            $table->string('group_2');
            $table->string('type');
            $table->string('aplicable_to');
            $table->string('type_of_service');
            $table->string('rev_center');
            $table->string('stmt_description');
            $table->string('special_instruction')->nullable();
            $table->string('rev_code')->nullable();
            $table->string('use_time_units')->nullable();
            $table->string('ndc_number')->nullable();
            $table->string('units')->nullable();
            $table->string('measure')->nullable();
            $table->string('units_limit')->nullable();
            $table->boolean('requires_claim_note')->nullable();
            $table->boolean('requires_supervisor')->nullable();
            $table->boolean('requires_authorization')->nullable();
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
        Schema::dropIfExists('services');
    }
}
