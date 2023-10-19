<?php

declare(strict_types=1);

use App\Enums\User\RoleType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('type')->default(RoleType::BILLING_COMPANY->value);
        });
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
