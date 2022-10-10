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
        Schema::table('insurance_policies', function (Blueprint $table) {
            $table->foreignId('payer_responsibility_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_policies', function (Blueprint $table) {
            $table->dropForeign(['payer_responsibility_id']);
            $table->dropColumn('payer_responsibility_id');
        });
    }
};