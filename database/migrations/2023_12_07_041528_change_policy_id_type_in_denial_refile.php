<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        // First, drop foreign key constraint if it exists
        Schema::table('denial_refile', function (Blueprint $table) {
            $table->dropForeign(['claim_id']);
        });

        // Change the data type of policy_id
        Schema::table('denial_refile', function (Blueprint $table) {
            $table->unsignedBigInteger('policy_id')->change();
        });

        // Add back the foreign key constraint
        Schema::table('denial_refile', function (Blueprint $table) {
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // First, drop foreign key constraint if it exists
        Schema::table('denial_refile', function (Blueprint $table) {
            $table->dropForeign(['claim_id']);
        });

        // Change the data type of policy_id back to its original type
        Schema::table('denial_refile', function (Blueprint $table) {
            $table->bigInteger('policy_id')->change();
        });

        // Add back the foreign key constraint
        Schema::table('denial_refile', function (Blueprint $table) {
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
        });
    }
};
