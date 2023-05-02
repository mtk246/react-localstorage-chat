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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('ein', 9)->nullable();
            $table->string('upin', 50)->nullable();
            $table->string('clia', 50)->nullable();
            $table->foreignId('name_suffix_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('ein');
            $table->dropColumn('upin');
            $table->dropColumn('clia');

            $table->dropForeign(['name_suffix_id']);
            $table->dropColumn('name_suffix_id');
        });
    }
};
