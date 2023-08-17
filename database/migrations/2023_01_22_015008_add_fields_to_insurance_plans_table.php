<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_plans', function (Blueprint $table) {
            $table->dropColumn('ins_type');
            $table->dropColumn('format');
            $table->dropColumn('method');
            $table->dropColumn('charge_using');
            $table->dropColumn('naic');

            $table->string('cap_group')->nullable()->change();
            $table->foreignId('charge_using_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
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
            $table->string('ins_type')->nullable();
            $table->string('format')->nullable();
            $table->string('method')->nullable();
            $table->string('charge_using')->nullable();
            $table->string('naic')->nullable();

            $table->dropForeign(['charge_using_id']);
            $table->dropColumn('charge_using_id');
            $table->dropForeign(['ins_type_id']);
            $table->dropColumn('ins_type_id');
            $table->dropForeign(['plan_type_id']);
            $table->dropColumn('plan_type_id');
        });
    }
};
