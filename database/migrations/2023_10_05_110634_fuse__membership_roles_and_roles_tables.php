<?php

declare(strict_types=1);

use App\Models\BillingCompany;
use App\Models\User\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->foreignId('billing_company_id')
                ->nullable()
                ->constrained('billing_companies')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->dropUnique(['slug']);
            $table->boolean('public')->default(true)->after('name');
        });

        $billingCompanies = BillingCompany::all(['id']);
        $firstBillingCompany = $billingCompanies->first();

        $roles = Role::query()->whereNotIn('slug', [
            'superuser',
            'patient',
            'superauditor',
            'developmentsupport',
            'healthprofessional',
        ])->get()->map(function (Role $role) use ($firstBillingCompany) {
            $role->billing_company_id = $firstBillingCompany->id;
            $role->save();

            return $role->toArray();
        });

        $billingCompanies
            ->filter(fn ($item) => $item->id !== $firstBillingCompany->id)
            ->each(function (BillingCompany $billingCompany) use ($roles) {
                $roles->each(function ($role) use ($billingCompany) {
                    $role['billing_company_id'] = $billingCompany->id;
                    Role::query()->create($role);
                });
            });
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign(['billing_company_id']);
            $table->dropColumn(['billing_company_id', 'public']);
            $table->unique(['slug']);
        });
    }
};
