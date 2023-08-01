<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('claim_demographic', function (Blueprint $table) {
            $table->renameColumn('bill_clasification', 'bill_classification');
        });
    }

    public function down(): void
    {
        Schema::table('claim_demographic', function (Blueprint $table) {
            $table->renameColumn('bill_classification', 'bill_clasification');
        });
    }
};
