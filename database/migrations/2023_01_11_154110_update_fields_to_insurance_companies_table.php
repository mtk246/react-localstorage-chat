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
            $table->string('payer_id', 20)->nullable()->unique();
            $table->foreignId('file_method_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->dropColumn('file_method');
            $table->string('naic')->nullable()->change();
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
            $table->dropUnique(['payer_id']);
            $table->dropForeign(['file_method_id']);
            $table->dropColumn('payer_id');
            $table->dropColumn('file_method_id');
            $table->string('file_method')->nullable();
        });
    }
};
