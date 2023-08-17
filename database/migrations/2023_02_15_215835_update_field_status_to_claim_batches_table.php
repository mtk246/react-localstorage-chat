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
        Schema::table('claim_batches', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->foreignId('claim_batch_status_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claim_batches', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->dropForeign(['claim_batch_status_id']);
            $table->dropColumn('claim_batch_status_id');
        });
    }
};
