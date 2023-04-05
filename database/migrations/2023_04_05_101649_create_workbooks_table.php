<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('tableau_workbooks', function (Blueprint $table) {
            $table->ulid();
            $table->string('name');
            $table->string('icon');
            $table->string('description')->nullable();
            $table->string('url');
            $table->string('type');
            $table->string('group')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tableau_workbooks');
    }
};
