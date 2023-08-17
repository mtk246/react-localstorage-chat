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
        Schema::table('company_procedure', function (Blueprint $table) {
            $table->foreignId('billing_company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('modifier_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('mac_locality_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->string('clia')->nullable();
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
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn('billing_company_id');

            $table->dropForeign(['modifier_id']);
            $table->dropColumn('modifier_id');

            $table->dropForeign(['mac_locality_id']);
            $table->dropColumn('mac_locality_id');

            $table->dropColumn('clia');
        });
    }
};
