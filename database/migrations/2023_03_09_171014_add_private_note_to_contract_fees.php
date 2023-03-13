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
        Schema::table('contract_fees', function (Blueprint $table) {
            $table->foreignId('insurance_company_id')
                ->nullable()
                ->constrained()
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->string('private_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_fees', function (Blueprint $table) {
            $table->dropForeign(['insurance_company_id']);
            $table->dropColumn('insurance_company_id');
            $table->dropColumn('private_note');
        });
    }
};
