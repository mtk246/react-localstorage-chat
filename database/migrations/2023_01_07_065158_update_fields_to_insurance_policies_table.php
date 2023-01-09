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
        Schema::table('insurance_policies', function (Blueprint $table) {
            $table->foreignId('insurance_policy_type_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('type_responsibility_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_policies', function (Blueprint $table) {
            //
        });
    }
};
