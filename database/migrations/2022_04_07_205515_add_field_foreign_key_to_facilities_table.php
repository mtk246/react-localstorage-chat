<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldForeignKeyToFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->renameColumn('type', 'facility_type_id');
        });
        Schema::table('facilities', function (Blueprint $table) {
            $table->foreignId('facility_type_id')->change()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facilities', function (Blueprint $table) {
            //
        });
    }
}
