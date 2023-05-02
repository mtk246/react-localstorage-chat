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
        Schema::table('claims', function (Blueprint $table) {
            $table->dropForeign(['health_professional_id']);
            $table->dropColumn('health_professional_id');

            $table->boolean('validate')->default(true)->change();
            $table->boolean('automatic_eligibility')->default(true);
            $table->foreignId('billing_provider_id')->nullable()->constrained('health_professionals')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('service_provider_id')->nullable()->constrained('health_professionals')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('referred_id')->nullable()->constrained('health_professionals')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->dropForeign(['billing_provider_id']);
            $table->dropColumn('billing_provider_id');

            $table->dropForeign(['service_provider_id']);
            $table->dropColumn('service_provider_id');

            $table->dropForeign(['referred_id']);
            $table->dropColumn('referred_id');

            $table->dropColumn('automatic_eligibility');

            $table->foreignId('health_professional_id')->nullable()->constrained()->onDelete('restrict')->onUpdate('cascade');
        });
    }
};
