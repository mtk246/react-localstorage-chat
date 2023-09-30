<?php

declare(strict_types=1);

use App\Enums\Reports\ClassificationType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['tags', 'use']);
            $table->string('clasification')->after('type')->default(ClassificationType::LIVE_INSIGHTS->value);
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('clasification');
            $table->text('use')->default('')->after('name');
            $table->json('tags')->after('type')->default('[]');
        });
    }
};
