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
        Schema::table('health_professionals', function (Blueprint $table) {
            $table->boolean('is_provider')->default(false);
            $table->string('npi_company')->nullable();
            $table->foreignId('health_professional_type_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
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
            $table->dropForeign(['health_professional_type_id']);
            $table->dropColumn('health_professional_type_id');

            $table->dropColumn('is_provider');
            $table->dropColumn('npi_company');
        });
    }
};
