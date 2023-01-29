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
        Schema::table('insurance_plans', function (Blueprint $table) {
            $tble->dropColumn('ins_type');
            $table->dropColumn('format');
            $table->dropColumn('method');

            $table->string('cap_group')->nullable()->change();
            $table->string('charge_using')->nullable()->change();
            $table->string('naic')->nullable()->change();

            $table->foreignId('file_method_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('format_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('ins_type_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('plan_type_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_plans', function (Blueprint $table) {
            //
        });
    }
};
