<?php

declare(strict_types=1);

use App\Enums\User\UserType;
use App\Models\BillingCompany\Membership;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('type')->default(UserType::USER->value);
        });

        DB::table('rollables')->delete();

        DB::table('roles')->get()->each(function ($role) {
            $superUsersList = DB::table('role_user')->where('role_id', $role->id)->get('user_id')->pluck('user_id')->toArray();

            DB::table('users')->whereIn('id', $superUsersList)->get()->each(function ($user) use ($role) {
                $rollableId = $user->id;
                $rollableType = User::class;
                $userType = UserType::ADMIN;

                if (!is_null($role->billing_company_id)) {
                    if (!DB::table('billing_company_user')
                        ->where('billing_company_id', $role->billing_company_id)
                        ->where('user_id', $user->id)
                        ->exists()
                    ) {
                        DB::table('users')->where('id', $user->id)->update(['billing_company_id' => $role->billing_company_id]);
                        DB::table('billing_company_user')->insert([
                            'billing_company_id' => $role->billing_company_id,
                            'user_id' => $user->id,
                            'status' => true,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                    /** @var int $rollableId */
                    $rollableId = DB::table('billing_company_user')
                        ->where('billing_company_id', $role->billing_company_id)
                        ->where('user_id', $user->id)
                        ->first()
                        ->id;

                    $rollableType = Membership::class;
                    $userType = UserType::USER;
                }

                DB::table('users')->where('id', $user->id)->update(['type' => $userType->value]);
                DB::table('rollables')->insert([
                    'rollable_id' => $rollableId,
                    'rollable_type' => $rollableType,
                    'role_id' => $role->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['type']);
        });
    }
};
