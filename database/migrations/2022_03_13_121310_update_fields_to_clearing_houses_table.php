<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToClearingHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clearing_houses', function (Blueprint $table) {
            $table->string('org_type')->nullable();
            $table->boolean('ack_required')->default(false);
            $table->string("name")->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clearing_houses', function (Blueprint $table) {
            //
        });
    }
}
