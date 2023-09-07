<?php

declare(strict_types=1);

namespace App\Services\ClearingHouse;

use App\Enums\Claim\ClaimType;
use App\Models\ClearingHouse\AvailablePayer;
use App\Models\InsurancePlan;
use App\Models\TypeCatalog;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ClearingHouseAPI implements ClearingHouseAPIInterface
{
    public function __construct(
        protected readonly ?InsurancePlan $insurance = null,
        protected readonly ?string $type = null,
    ) {
    }

    public function getCPIDByPayerID(string $payerID, string $payerName, int $type, bool $fakeTransmission = false): ?string
    {
        $availablePayer = AvailablePayer::query()
            ->where(
                [
                    'payer_id' => $payerID,
                    'name' => $payerName,
                ]
            )
            ->first();

        if (!$availablePayer) {
            throw new \Exception('Payer not found');
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

        return $payers->filter(function ($payer) use ($payerID, $user, $request) {
            $insurance = InsurancePlan::query()
                ->whereRaw('LOWER(payer_id) LIKE (?)', [strtolower("$payerID")])
                ->where('name', $payer->name)
                ->first();

            if (is_null($insurance)) {
                return true;
            }

            $billingCompaniesException = $insurance->billingCompanies()
                ->get()
                ->pluck('id')
                ->toArray();

            $billingCompanies = $insurance->insuranceCompany
                ->billingCompanies()
                ->when(Gate::denies('is-admin'), function ($query) use ($user) {
                    $billingCompaniesUser = [$user->billing_company_id];

                    return $query->whereIn('billing_companies.id', $billingCompaniesUser ?? []);
                })
                ->when(Gate::check('is-admin'), function ($query) use ($request) {
                    $billingCompaniesUser = [$request['billing_company_id'] ?? null];

                    return $query->whereIn('billing_companies.id', $billingCompaniesUser ?? []);
                })
                ->whereNotIn('billing_companies.id', $billingCompaniesException ?? [])
                ->get()
                ->pluck('id')
                ->toArray();

            return !empty($billingCompanies);
        })
            ->map(fn ($payer) => [
            'id' => $payer->name,
            'name' => $payer->name,
            'public_note' => $payer->payerInformation?->first()?->portal ?? '',
            'ins_type_id' => $this->getInsType(explode('/', $payer->payerInformation?->first()?->claim_insurance_type ?? '')[0] ?? ''),
            'plan_type_id' => $this->getPlanType(explode('/', $payer->payerInformation?->first()?->claim_insurance_type ?? '')[1] ?? ''),
        ])->toArray();
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
