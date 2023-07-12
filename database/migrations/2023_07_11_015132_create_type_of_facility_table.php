<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('type_of_facility', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('facility_id');
            $table->foreign('facility_id')->references('id')->on('facilities');

            $table->unsignedBigInteger('facility_type_id');
            $table->foreign('facility_type_id')->references('id')->on('facility_types');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('type_of_facility');
    }
};
