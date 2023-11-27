<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('denial_refile', function (Blueprint $table) {
            $table->id();
            $table->integer('refile_type');
            $table->string('policy_number', 100);
            $table->boolean('is_cross_over')->default(false);
            $table->date('cross_over_date');
            $table->text('note')->nullable;
            $table->string('original_claim_id', 100)->nullable;
            $table->integer('refile_reason');
            $table->timestamps();
            $table->unsignedBigInteger('denial_tracking_id');
            $table->unsignedBigInteger('claim_id');
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('denial_refile');
    }
};
