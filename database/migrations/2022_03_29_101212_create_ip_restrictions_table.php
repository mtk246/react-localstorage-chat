<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_restrictions', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip_beginning');
            $table->ipAddress('ip_finish')->nullable();
            $table->boolean('rank')->default('true');
            $table->foreignId('billing_company_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ip_restrictions');
    }
}
