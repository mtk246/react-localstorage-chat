<?php

declare(strict_types=1);

use App\Enums\User\UserType;
use App\Models\BillingCompany\Membership;
use App\Models\User;
use App\Models\User\Role;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
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

        Role::all()->each(function (Role $role) {
            $superUsersList = DB::table('role_user')->where('role_id', $role->id)->get('user_id')->pluck('user_id')->toArray();

            User::query()->whereIn('id', $superUsersList)->get()->each(function (User $user) use ($role) {
                $userRoles = $user->roles();
                $rollableType = User::class;
                $userType = UserType::ADMIN;

                if (!is_null($role->billing_company_id)) {
                    if (0 === $user
                        ->billingCompanies()
                        ->wherePivot('billing_company_id', $role->billing_company_id)
                        ->get()
                        ->count()
                    ) {
                        $user->billingCompany()->associate($role->billing_company_id);
                        $user->billingCompanies()->syncWithoutDetaching($role->billing_company_id);
                    }

                    /** @var MorphToMany $userRoles */
                    $userRoles = $user
                        ->billingCompanies()
                        ->wherePivot('billing_company_id', $role->billing_company_id)
                        ->first()
                        ->membership
                        ->roles();

                    $rollableType = Membership::class;
                    $userType = UserType::USER;
                }

                $user->type = $userType->value;
                $userRoles->syncWithPivotValues($role->id, ['rollable_type' => $rollableType], false);
                $user->save();
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
