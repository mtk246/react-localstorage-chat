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
        Schema::table('company_health_professional', function (Blueprint $table) {
            $table->unsignedBigInteger('company_health_professional_type_id');
            $table->foreign('company_health_professional_type_id', 'fk_company_health_professional_type_id')
                ->references('id')
                ->on('company_health_professional_types')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_health_professional', function (Blueprint $table) {
            $table->dropForeign('fk_company_health_professional_type_id');
            $table->dropColumn('company_health_professional_type_id');
        });
    }
};
