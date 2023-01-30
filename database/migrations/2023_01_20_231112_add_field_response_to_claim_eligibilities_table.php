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
        Schema::table('claim_eligibilities', function (Blueprint $table) {
            $table->dropColumn('eligibility');
            $table->longText('response_details')->nullable();

            $table->foreignId('claim_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('claim_eligibility_status_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claim_eligibilities', function (Blueprint $table) {
            $table->dropColumn('response_details');
            $table->string('eligibility', 50)->nullable();

            $table->dropForeign(['claim_id']);
            $table->dropColumn(['claim_id']);

            $table->dropForeign(['claim_eligibility_status_id']);
            $table->dropColumn('claim_eligibility_status_id');
        });
    }
};
