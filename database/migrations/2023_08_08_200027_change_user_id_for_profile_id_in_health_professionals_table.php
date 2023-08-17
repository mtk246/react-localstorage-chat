<?php

declare(strict_types=1);

use App\Models\HealthProfessional;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('health_professionals', function (Blueprint $table) {
            $table->foreignId('profile_id')
                ->nullable()
                ->constrained('profiles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        HealthProfessional::all()->each(function (HealthProfessional $patient) {
            $patient->profile_id = User::find($patient->user_id)->profile_id ?? null;
            $patient->save();
        });

        Schema::table('health_professionals', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('health_professionals', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        HealthProfessional::all()->each(function (HealthProfessional $patient) {
            $patient->user_id = User::query()->where('profile_id', $patient->profile_id)->first('id')->id ?? null;
            $patient->save();
        });
        Schema::table('health_professionals', function (Blueprint $table) {
            $table->dropForeign(['profile_id']);
            $table->dropColumn(['profile_id']);
        });
    }
};
