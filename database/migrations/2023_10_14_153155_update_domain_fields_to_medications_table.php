<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('medications', function (Blueprint $table) {
            $table->decimal('units', 11, 3)->nullable()->change();
            $table->string('units_limit')->nullable()->change();
            $table->string('link_sequence_number', 50)->nullable()->change();
            $table->string('pharmacy_prescription_number', 50)->nullable()->change();
        });
    }

    public function down(): void
    {
    }
};
