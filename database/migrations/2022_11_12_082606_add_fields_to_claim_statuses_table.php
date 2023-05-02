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
        Schema::table('claim_statuses', function (Blueprint $table) {
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
        Schema::table('claim_statuses', function (Blueprint $table) {
            $table->dropColumn('background_color');
            $table->dropColumn('font_color');
        });
    }
};
