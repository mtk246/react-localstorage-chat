<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('payment_services', function (Blueprint $table) {
            $table->dropForeign(['claim_id']);
        });
        Schema::table('payment_services', function (Blueprint $table) {
            $table->string('claim_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('payment_services', function (Blueprint $table) {
            $table->dropColumn(['claim_id']);
        });
        Schema::table('payment_services', function (Blueprint $table) {
            $table->foreignId('claim_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }
};
