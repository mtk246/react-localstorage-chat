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
            $table->dropForeign(['procedure_id']);
            $table->dropColumn('procedure_id');
        });

        Schema::create('contract_fee_procedure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_fee_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('procedure_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_fee_procedure');
        Schema::table('contract_fees', function (Blueprint $table) {
            $table->foreignId('procedure_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }
};
