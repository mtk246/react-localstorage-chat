<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDiscriminatoryIdToModifierConsiderationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modifier_considerations', function (Blueprint $table) {
            $table->foreignId('discriminatory_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modifier_considerations', function (Blueprint $table) {
            $table->dropForeign(['discriminatory_id']);
            $table->dropColumn('discriminatory_id');
        });
    }
};
