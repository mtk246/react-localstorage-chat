<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCompanyProcedureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_procedure', function (Blueprint $table) {
            $table->float('price', 8, 2);
            $table->float('price_percentage', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_procedure', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('price_percentage');
        });
    }
}
