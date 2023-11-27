<?php

declare(strict_types=1);

namespace App\Services\ClearingHouse;

use App\Enums\Claim\ClaimType;
use App\Models\BillingCompany;
use App\Models\ClearingHouse\AvailablePayer;
use App\Models\InsurancePlan;
use App\Models\TypeCatalog;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ClearingHouseAPI implements ClearingHouseAPIInterface
{
    public function __construct(
        protected readonly ?InsurancePlan $insurance = null,
        protected readonly ?string $type = null,
    ) {
    }

    public function getDataByPayerID(
        string $payerID,
        string $payerName,
        int $type,
        bool $fakeTransmission = false,
        string $key = 'cpid'
    ): ?string {
        $availablePayer = AvailablePayer::query()
            ->whereRaw('UPPER(payer_id) = ?', [Str::upper($payerID)])
            ->whereRaw('UPPER(name) = ?', [Str::upper($payerName)])
            ->first();

        if (!$availablePayer) {
            throw new \Exception('Payer not found');
        }

        if ('cpid' !== $key) {
            return $availablePayer->{$key};
        }

        return ($fakeTransmission)
            ? $availablePayer->payerInformation
                ->where('type', ClaimType::tryFrom($type))
                ?->first()
                ?->paper_cpid ?? ''
            : $availablePayer->payerInformation
                ->where('type', ClaimType::tryFrom($type))
                ?->first()
                ?->cpid ?? '';
    }

    public function getByPayerID(string $payerID, array $request, User $user): ?array
    {
        $edit = $request['edit'] ?? false;
        $payers = AvailablePayer::query()
            ->with('payerInformation')
            ->where(
                [
                    'payer_id' => $payerID,
                ]
            )
            ->get();
        if (0 === count($payers)) {
            return null;
        }

        return $payers->filter(function ($payer) use ($payerID, $user, $request, $edit) {
            $insurance = InsurancePlan::query()
                ->whereRaw('UPPER(payer_id) = ?', [Str::upper($payerID)])
                ->whereRaw('UPPER(name) = ?', [Str::upper($payer->name)])
                ->first();

            if (is_null($insurance)) {
                return true;
            }

            $billingCompaniesException = $insurance->billingCompanies()
                ->get()
                ->pluck('id')
                ->toArray();

            $billingCompanies = BillingCompany::query()
                ->where('status', true)
                ->when(Gate::denies('is-admin'), function ($query) use ($user) {
                    $billingCompaniesUser = [$user->billing_company_id];

                    return $query->whereIn('billing_companies.id', $billingCompaniesUser ?? []);
                })
                ->when(Gate::check('is-admin'), function ($query) use ($request) {
                    $billingCompaniesUser = [$request['billing_company_id'] ?? null];

                    return $query->whereIn('billing_companies.id', $billingCompaniesUser ?? []);
                })
                ->when(in_array($edit, ['false', false]), function ($query) use ($billingCompaniesException) {
                    return $query->whereNotIn('billing_companies.id', $billingCompaniesException ?? []);
                })
                ->get()
                ->pluck('id')
                ->toArray();

            return !empty($billingCompanies);
        })
        ->map(fn ($payer) => [
            'id' => upperCaseWords($payer->name),
            'name' => upperCaseWords($payer->name),
            'public_note' => $payer->payerInformation?->first()?->portal ?? '',
            'ins_type_id' => $this->getInsType(explode('/', $payer->payerInformation?->first()?->claim_insurance_type ?? '')[0] ?? ''),
            'plan_type_id' => $this->getPlanType(explode('/', $payer->payerInformation?->first()?->claim_insurance_type ?? '')[1] ?? ''),
        ])
        ->values()
        ->toArray();
    }

    protected function getInsType(string $insType)
    {
        if ('' == $insType) {
            return '';
        }

        return TypeCatalog::query()
            ->whereHas('type', function ($query) {
                $query->where('description', 'Ins type');
            })
            ->whereRaw('LOWER(description) LIKE (?)', [strtolower("%$insType%")])
            ->first()
            ?->id;
    }

    protected function getPlanType(string $planType)
    {
        if ('' == $planType) {
            return '';
        }

        return TypeCatalog::query()
            ->whereHas('type', function ($query) {
                $query->where('description', 'Insurance plan type');
            })
            ->whereRaw('LOWER(code) LIKE (?)', [strtolower("%$planType%")])
            ->first()
            ?->id;
    }
}
