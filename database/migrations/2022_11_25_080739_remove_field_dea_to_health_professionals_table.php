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
        Schema::table('health_professionals', function (Blueprint $table) {
            $table->dropColumn("dea");
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_professionals', function (Blueprint $table) {
            $table->string("dea")->nullable();
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });
    }
};
