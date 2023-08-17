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
        Schema::table('copays', function (Blueprint $table) {
            $table->dropForeign(['procedure_id']);
            $table->dropColumn('procedure_id');
        });

        Schema::create('copay_procedure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('copay_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreignId('procedure_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
        Schema::table('copays', function (Blueprint $table) {
            $table->foreignId('procedure_id')
                ->nullable()
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
        Schema::dropIfExists('copay_procedure');
    }
};
