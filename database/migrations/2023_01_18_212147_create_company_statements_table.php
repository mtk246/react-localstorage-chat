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
        Schema::create('company_statements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('rule_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('when_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('apply_to_id')->nullable()->constrained('type_catalogs')->onDelete('restrict')->onUpdate('cascade');

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('date')->nullable();

            $table->foreignId('company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('billing_company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('company_statements');
    }
};
