<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('refile_reason', function (Blueprint $table) {
            $table->id();
            $table->string('cod', 10);
            $table->text('description');
            $table->timestamps();
        });

        DB::table('refile_reason')->insert([
            ['cod' => '01', 'description' => 'Adjustments were made because was rejected'],
            ['cod' => '02', 'description' => 'The claim was not received by the insurance'],
            ['cod' => '03', 'description' => 'The claim was sent to the wrong insurance'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('refile_reason');
    }
};
