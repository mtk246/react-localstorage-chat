<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('marital_status');
            $table->dropColumn('dependent')->default(false);
            $table->dropColumn('guardian_name');
            $table->dropColumn('guardian_phone');
            $table->dropColumn('spuse_name');
            $table->dropColumn('employer');
            $table->dropColumn('employer_address');
            $table->dropColumn('position');
            $table->dropColumn('phone_employer');
            $table->dropColumn('spuse_employer');
            $table->dropColumn('spuse_work_phone');

            $table->renameColumn('driver_licence', 'driver_license');
            $table->string('credit_score');
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            //
        });
    }
}
