<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claim_form_p_services', function (Blueprint $table) {
            $table->string('diagnostic_pointers', 65)->nullable()->change();
            
            $table->dropForeign(['modifier_id']);
            $table->dropColumn('modifier_id');
            $table->dropColumn('epstd');
            $table->dropColumn('rev');

            $table->string('modifier_ids', 50)->nullable();
            $table->decimal('days_or_units', 8, 2)->nullable();
            $table->decimal('copay', 8, 2)->nullable();
            $table->boolean('emg')->default(false);

            $table->foreignId('epsdt_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('family_planning_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claim_form_p_services', function (Blueprint $table) {
            $table->dropForeign(['epsdt_id']);
            $table->dropColumn('epsdt_id');

            $table->dropForeign(['family_planning_id']);
            $table->dropColumn('family_planning_id');

            $table->dropColumn('modifier_ids');
            $table->dropColumn('days_or_units');
            $table->dropColumn('copay');
            $table->dropColumn('emg');

            $table->foreignId('modifier_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->integer('epstd')->nullable();
            $table->integer('rev')->nullable();
        });
    }
};
