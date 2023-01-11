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
        Schema::table('insurance_companies', function (Blueprint $table) {
            $table->string('file_method', 50);
            $table->integer('time_failed')->nullable();
            $table->integer('day_count')->nullable();
            $tabe->string('appeal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_companies', function (Blueprint $table) {
            $table->dropColumn('file_method');
            $table->dropColumn('time_failed');
            $table->dropColumn('day_count');
            $table->dropColumn('appeal');
        });
    }
};
