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
        Schema::create('copays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('insurance_plan_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('procedure_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->decimal('copay', 8, 2)->nullable();
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
        Schema::dropIfExists('copays');
    }
};
