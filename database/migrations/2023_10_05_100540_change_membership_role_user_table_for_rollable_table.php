<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('rollables', function (Blueprint $table) {
            $table->id();
            $table->string('rollable_type');
            $table->integer('rollable_id');
            $table->foreignId('role_id')
                ->nullable()
                ->constrained('roles')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestamps();
        });
        DB::table('role_user')->get()->each(function ($item) {
            DB::table('rollables')->insert([
                'rollable_type' => App\Models\BillingCompany\Membership::class,
                'rollable_id' => $item->user_id,
                'role_id' => $item->role_id,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rollables');
    }
};
