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
        Schema::table('clearing_houses', function (Blueprint $table) {
            $table->dropColumn('org_type');
            $table->dropForeign(['transmission_format_id']);
            $table->dropColumn('transmission_format_id');
        });
        Schema::table('clearing_houses', function (Blueprint $table) {
            $table->foreignId('org_type_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('transmission_format_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
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
};
