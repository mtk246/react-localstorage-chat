<?php

declare(strict_types=1);

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->boolean('deceased')->default(false);
            $table->foreignId('profile_id')
                ->nullable()
                ->constrained('profiles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Patient::all()->each(function (Patient $patient) {
            $patient->profile_id = User::find($patient->user_id)->profile_id;
            $patient->save();
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Patient::all()->each(function (Patient $patient) {
            $patient->user_id = User::query()->where('profile_id', $patient->profile_id)->first('id')->id;
            $patient->save();
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['profile_id']);
            $table->dropColumn(['profile_id', 'deceased']);
        });
    }
};
