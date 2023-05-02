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
        Schema::table('claim_eligibility_statuses', function (Blueprint $table) {
            $table->dropForeign(['claim_eligibility_id']);
            $table->dropForeign(['eligibility_status_id']);

            $table->dropColumn('claim_eligibility_id');
            $table->dropColumn('eligibility_status_id');

            $table->string('status', 50)->nullable();
            $table->string('background_color', 10)->nullable();
            $table->string('font_color', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claim_eligibility_statuses', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('background_color');
            $table->dropColumn('font_color');

            $table->foreignId('claim_eligibility_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('eligibility_status_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }
};
