<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('insurance_plan_service_aliances');
        Schema::dropIfExists('insurance_plan_service');
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_applicable_to');
        Schema::dropIfExists('service_groups');
        Schema::dropIfExists('service_rev_centers');
        Schema::dropIfExists('service_special_instructions');
        Schema::dropIfExists('service_stmt_descriptions');
        Schema::dropIfExists('service_type_of_services');
        Schema::dropIfExists('service_types');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
