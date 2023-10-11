<?php

declare(strict_types=1);

use App\Models\BillingCompany;
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

        $roles = DB::table('roles')->whereNotIn('slug', [
            'superuser',
            'patient',
            'superauditor',
            'developmentsupport',
            'healthprofessional',
        ])->get()->map(function ($role) use ($firstBillingCompany) {
            DB::table('roles')->where('id', $role->id)->update(['billing_company_id' => $firstBillingCompany->id]);

            return (array) $role;
        });

        $billingCompanies
            ->filter(fn ($item) => $item->id !== $firstBillingCompany->id)
            ->each(function (BillingCompany $billingCompany) use ($roles) {
                $roles->each(function ($role) use ($billingCompany) {
                    $role['billing_company_id'] = $billingCompany->id;
                    unset($role['id']);
                    DB::table('roles')->insert([$role]);
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
