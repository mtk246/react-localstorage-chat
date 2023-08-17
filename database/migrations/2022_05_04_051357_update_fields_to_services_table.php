<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('code', 50)->change();
            $table->string('name', 50)->change();
            $table->string('aplicable_to', 50)->change();
            $table->string('rev_code', 50)->nullable()->change();
            $table->string('use_time_units', 50)->nullable()->change();
            $table->string('ndc_number', 50)->nullable()->change();
            $table->string('units', 50)->nullable()->change();
            $table->string('measure', 50)->nullable()->change();
            $table->string('units_limit', 50)->nullable()->change();

            $table->dropColumn('group_1');
            $table->dropColumn('group_2');
            $table->dropColumn('type');
            $table->dropColumn('type_of_service');
            $table->dropColumn('rev_center');
            $table->dropColumn('stmt_description');
            $table->dropColumn('special_instruction');
        });
        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('service_group_1_id')->references('id')->on('service_groups')->onDelete('cascade');
            $table->foreignId('service_group_2_id')->references('id')->on('service_groups')->onDelete('cascade');
            $table->foreignId('service_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_type_of_service_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_rev_center_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_stmt_description_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_special_instruction_id')->constrained()->onDelete('cascade');

            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('billing_company_id')->constrained()->onDelete('cascade');

            $table->boolean('status')->nullable();
            $table->double('std_price', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
        });
    }
}
