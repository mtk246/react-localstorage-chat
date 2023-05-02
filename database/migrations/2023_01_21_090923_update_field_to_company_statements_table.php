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
        Schema::table('company_statements', function (Blueprint $table) {
            $table->dropForeign(['apply_to_id']);
            $table->dropColumn('apply_to_id');
            $table->dropColumn('name');
            $table->dropColumn('date');

            $table->string('apply_to_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_statements', function (Blueprint $table) {
            $table->dropColumn('apply_to_ids');

            $table->string('name')->nullable();
            $table->foreignId('apply_to_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->date('date')->nullable();
        });
    }
};
