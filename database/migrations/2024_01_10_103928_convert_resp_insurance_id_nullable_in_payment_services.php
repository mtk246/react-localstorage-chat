<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('payment_services', function (Blueprint $table) {
            $table->string('exp_adj')->nullable()->change();
            $table->string('remain')->nullable()->change();
            $table->string('ins_amount')->nullable()->change();
            $table->string('resp_insurance')->nullable()->change();
            $table->string('pt_resp')->nullable()->change();
            $table->string('reason')->nullable()->change();
            $table->string('denial_reason')->nullable()->change();
            $table->string('note')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('payment_services', function (Blueprint $table) {
            $table->string('exp_adj')->default('')->change();
            $table->string('remain')->default('')->change();
            $table->string('ins_amount')->default('')->change();
            $table->string('resp_insurance')->change();
            $table->string('pt_resp')->default('')->change();
            $table->string('reason')->default('')->change();
            $table->string('denial_reason')->default('')->change();
            $table->string('note')->default('')->change();
        });
    }
};
