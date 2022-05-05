<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToIpRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ip_restrictions', function (Blueprint $table) {
            $table->dropColumn('ip_beginning');
            $table->dropColumn('ip_finish');
            $table->dropColumn('rank');
            $table->string('entity', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ip_restrictions', function (Blueprint $table) {
            //
        });
    }
}
