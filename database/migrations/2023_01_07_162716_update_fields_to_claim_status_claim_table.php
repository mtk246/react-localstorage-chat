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
        Schema::table('claim_status_claim', function (Blueprint $table) {
            $table->dropForeign(['claim_status_id']);
            $table->dropColumn('claim_status_id');
        });
        Schema::table('claim_status_claim', function (Blueprint $table) {
            $table->nullableMorphs('claim_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claim_status_claim', function (Blueprint $table) {
            //
        });
    }
};
