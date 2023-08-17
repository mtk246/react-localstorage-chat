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
        Schema::table('insurance_plan_privates', function (Blueprint $table) {
            $table->dropColumn('file_capitated');

            $table->dropForeign(['format_id']);
            $table->dropColumn('format_id');

            $table->foreignId('format_professional_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('format_cms_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('format_institutional_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('format_ub_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_plan_privates', function (Blueprint $table) {
            $table->foreignId('format_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');

            $table->dropForeign(['format_professional_id']);
            $table->dropColumn('format_professional_id');

            $table->dropForeign(['format_cms_id']);
            $table->dropColumn('format_cms_id');

            $table->dropForeign(['format_institutional_id']);
            $table->dropColumn('format_institutional_id');

            $table->dropForeign(['format_ub_id']);
            $table->dropColumn('format_ub_id');
        });
    }
};
