<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('payment_batches', function (Blueprint $table) {
            $table->date('posting_date')->nullable()->change();
        });
        Schema::table('payment_services', function (Blueprint $table) {
            $table->string('note')->nullable()->change();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->string('note')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('payment_batches', function (Blueprint $table) {
            $table->date('posting_date')->change();
        });
        Schema::table('payment_services', function (Blueprint $table) {
            $table->string('note')->change();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->string('note')->change();
        });
    }
};
