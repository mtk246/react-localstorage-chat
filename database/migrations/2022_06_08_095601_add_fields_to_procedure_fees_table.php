<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProcedureFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('procedure_fees', function (Blueprint $table) {
            $table->foreignId('insurance_label_fee_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('mac_locality_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->date('fee_start_date');
            $table->date('fee_end_date');

            $table->dropForeign(['insurance_type_id']);
            $table->dropColumn('insurance_type_id');
            $table->dropColumn('label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('procedure_fees', function (Blueprint $table) {
            $table->dropForeign(['insurance_label_fee_id']);
            $table->dropColumn('insurance_label_fee_id');
            $table->dropForeign(['mac_locality_id']);
            $table->dropColumn('mac_locality_id');
            $table->dropColumn('fee_start_date');
            $table->dropColumn('fee_end_date');

            $table->foreignId('insurance_type_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->string('label', 50);
        });
    }
};
