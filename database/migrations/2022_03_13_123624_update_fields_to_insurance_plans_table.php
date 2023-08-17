<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToInsurancePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_plans', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('note');
            $table->dropColumn('plan_type');
            $table->renameColumn('file_zero', 'file_zero_changes');
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
        });
    }
}
