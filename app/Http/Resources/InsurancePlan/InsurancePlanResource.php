<?php

declare(strict_types=1);

namespace App\Http\Resources\InsurancePlan;

use App\Facades\Pagination;
use App\Models\PayerResponsibility;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

final class InsurancePlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'name' => $this->resource->name,
            'payer_id' => $this->resource->payer_id,
            'accept_assign' => $this->resource->accept_assign,
            'pre_authorization' => $this->resource->pre_authorization,
            'file_zero_changes' => $this->resource->file_zero_changes,
            'referral_required' => $this->resource->referral_required,
            'accrue_patient_resp' => $this->resource->accrue_patient_resp,
            'require_abn' => $this->resource->require_abn,
            'pqrs_eligible' => $this->resource->pqrs_eligible,
            'allow_attached_files' => $this->resource->allow_attached_files,
            'ins_type_id' => $this->resource->ins_type_id ?? '',
            'ins_type' => isset($this->resource->insType) ? ($this->resource->insType->code.' - '.$this->resource->insType->description) : '',
            'plan_type_id' => $this->resource->plan_type_id ?? '',
            'plan_type' => isset($this->resource->planType) ? ($this->resource->planType->code.' - '.$this->resource->planType->description) : '',
            'insurance_company_id' => $this->resource->insurance_company_id,
            'insurance_company' => !is_null($this->resource->insuranceCompany) ? $this->resource->insuranceCompany->name : null,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'last_modified' => $this->resource->last_modified,
            'public_note' => isset($this->resource->publicNote) ? $this->resource->publicNote->note : '',
            'copays' => $this->getCopays(),
            'contract_fees' => $this->getContracFees(),
            'billing_companies' => $this->resource->billingCompanies
                ->unique('id')
                ->setVisible(['id', 'name', 'code', 'abbreviation', 'private_insurance_plan'])
                ->map(function ($bC) {
                    $private_insurance_plan = $this->getInsurancePlanPrivate($bC->id);
                    $nickname = $this->getNickname($bC->id);

                    $bC->private_insurance_plan = [
                        'naic' => $private_insurance_plan->naic ?? '',
                        'format_professional_id' => $private_insurance_plan->naic ?? '',
                        'format_professional' => $private_insurance_plan->formatProfessional ?? '',
                        'format_institutional_id' => $private_insurance_plan->format_institutional_id ?? '',
                        'format_institutional' => isset($private_insurance_plan->formatInstitutional) ? $private_insurance_plan->formatInstitutional->code : '',
                        'format_cms_id' => $private_insurance_plan->format_cms_id ?? '',
                        'format_cms' => isset($private_insurance_plan->formatCMS) ? $private_insurance_plan->formatCMS->code : '',
                        'format_ub_id' => $private_insurance_plan->format_ub_id ?? '',
                        'format_ub' => isset($private_insurance_plan->formatUB) ? $private_insurance_plan->formatUB->code : '',
                        'file_method_id' => $private_insurance_plan->file_method_id ?? '',
                        'file_method' => isset($private_insurance_plan->fileMethod) ? ($private_insurance_plan->fileMethod->code.' - '.$private_insurance_plan->fileMethod->description) : '',
                        'eff_date' => $this->resource->eff_date,
                        'status' => $bC->pivot->status ?? false,
                        'edit_name' => isset($nickname->nickname) ? true : false,
                        'nickname' => $nickname->nickname ?? '',
                        'abbreviation' => $this->getAbbreviation($bC->id),
                        'private_note' => $this->getPrivateNote($bC->id),
                        'address' => $this->getAddress($bC->id, 1),
                        'contact' => $this->getContact($bC->id),
                        'insurance_plan_time_failed' => $this->getTimeFailed($bC->id),
                        'responsibilities' => $this->getResponsibilities($private_insurance_plan->responsibilities),
                    ];

                    return $bC;
                }),
        ];
    }

    private function getInsurancePlanPrivate(int $billingCompanyId)
    {
        return $this->resource->insurancePlanPrivate()->where([
            'billing_company_id' => $billingCompanyId,
        ])->first();
    }

    private function getNickname(int $billingCompanyId)
    {
        return $this->resource->nicknames()->where([
            'billing_company_id' => $billingCompanyId,
        ])->first();
    }

    private function getAbbreviation(int $billingCompanyId)
    {
        $abbreviation = $this->resource->abbreviations()
                                ->where('billing_company_id', $billingCompanyId)
                                ->first();

        return $abbreviation->abbreviation ?? '';
    }

    private function getAddress(int $billingCompanyId, int $addressType)
    {
        $address = $this->resource->addresses()
            ->where('billing_company_id', $billingCompanyId)
            ->where('address_type_id', $addressType)
            ->first();

        return $address ? AddressResource::make($address) : null;
    }

    private function getContact(int $billingCompanyId)
    {
        $contact = $this->resource->contacts()
            ->where('billing_company_id', $billingCompanyId)
            ->first();

        return $contact ? ContactResource::make($contact) : null;
    }

    private function getPrivateNote(int $billingCompanyId)
    {
        return $this->resource->privateNotes()
            ->where('billing_company_id', $billingCompanyId)
            ->first();
    }

    private function getTimeFailed(int $billingCompanyId)
    {
        $time_failed = $this->resource->timeFaileds()
            ->where('billing_company_id', $billingCompanyId)
            ->first();

        return isset($time_failed)
                ? [
                    'days' => $time_failed->days,
                    'from' => $time_failed->from,
                    'from_id' => $time_failed->from_id,
                ]
                : null;
    }

    private function getCopays()
    {
        $bC = request()->user()->billing_company_id;

        $copays = $this->resource->copays()
            ->with('procedures', 'companies')
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('billing_company_id', $bC)
            )
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return CopayResource::collection($copays)->resource;
    }

    private function getContracFees()
    {
        $bC = request()->user()->billing_company_id;

        $contractFees = $this->resource->contractFees()
            ->with([
                'procedures',
                'modifiers',
                'patients',
                'macLocality',
                'companies',
            ])
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('billing_company_id', $bC)
            )
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return ContractFeeResource::collection($contractFees)->resource;
    }

    private function getResponsibilities($responsibilities)
    {
        return isset($responsibilities)
            ? PayerResponsibility::whereIn('id', $responsibilities)->get()
            : null;
    }
}
