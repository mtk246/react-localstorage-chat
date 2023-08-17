<?php

declare(strict_types=1);

namespace App\Policies\Reports;

use App\Models\Reports\Report;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

final class ReportPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Report $report): bool
    {
        return Gate::allows('is-admin')
            ? true
            : $report->billing_company_id
                && $report->billing_company_id === $user->billing_company_id;
    }

    public function destroy(User $user, Report $report): bool
    {
        return Gate::allows('is-admin')
            ? true
            : $report->billingCompany->id === $user->billing_company_id;
    }
}
