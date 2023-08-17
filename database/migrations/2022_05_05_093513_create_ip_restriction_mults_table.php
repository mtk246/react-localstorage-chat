<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpRestrictionMultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_restriction_mults', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip_beginning');
            $table->ipAddress('ip_finish')->nullable();
            $table->boolean('rank')->default(true);
            $table->foreignId('ip_restriction_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('ip_restriction_mults');
    }
}
