<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingCompanyClearingHouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_company_clearing_house', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->foreignIdFor(\App\Models\BillingCompany::class);
            $table->foreignIdFor(\App\Models\ClearingHouse::class);
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
        Schema::dropIfExists('billing_company_clearing_house');
    }
}
