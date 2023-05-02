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
        Schema::create('billing_company_claim_sub_status', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->foreignId('billing_company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('claim_sub_status_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('billing_company_claim_sub_status');
    }
};
