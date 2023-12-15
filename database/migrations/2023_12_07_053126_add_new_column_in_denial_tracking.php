<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('denial_tracking', function (Blueprint $table) {
            $table->unsignedBigInteger('policy_id')->nullable();
            $table->foreign('policy_id')->references('id')->on('insurance_policies');
        });
    }

    public function down(): void
    {
        Schema::table('denial_tracking', function (Blueprint $table) {
        });
    }
};
