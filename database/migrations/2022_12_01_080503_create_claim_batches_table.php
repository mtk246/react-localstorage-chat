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
        Schema::create('claim_batches', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name', 50);
            $table->string('status', 10);
            $table->date('shipping_date')->nullable();
            $table->boolean('fake_transmission')->default(false);
            $table->foreignId('company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('billing_company_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('claim_batches');
    }
};
