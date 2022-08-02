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
        Schema::table('mac_localities', function (Blueprint $table) {
            $table->string('fsa')->change();
            $table->string('counties')->change();
            $table->dropColumn('locality_number');
        });
        Schema::table('mac_localities', function (Blueprint $table) {
            $table->string('locality_number', 5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mac_localities', function (Blueprint $table) {
            //
        });
    }
};
