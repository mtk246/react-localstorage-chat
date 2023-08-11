<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('language', 10)->nullable();
        });

        User::all()->each(function (User $user) {
            $user->profile->update([
                'language' => $user->language,
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('language');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('language', 10)->default('en');
        });

        User::all()->each(function (User $user) {
            $user->update([
                'language' => $user->profile->language,
            ]);
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('language');
        });
    }
};
