<?php

declare(strict_types=1);

namespace App\Http\Resources\InsurancePlan;

use Illuminate\Http\Resources\Json\JsonResource;

final class InsurancePlanByPayerResource extends JsonResource
{
    public function toArray($request)
    {
        if ('local' === $this->resource['type']) {
            return $this->getLocalData();
        }

        if ('service' === $this->resource['type']) {
            return $this->getServiceData();
        }
    }

    private function getLocalData()
    {
        return [
            'id' => $this->resource['data']['id'] ?? null,
            'code' => $this->resource['data']['code'] ?? null,
            'name' => $this->resource['data']['name'] ?? null,
            'payer_id' => $this->resource['data']['payer_id'] ?? null,
            'accept_assign' => $this->resource['data']['accept_assign'] ?? false,
            'pre_authorization' => $this->resource['data']['pre_authorization'] ?? false,
            'file_zero_changes' => $this->resource['data']['file_zero_changes'] ?? false,
            'referral_required' => $this->resource['data']['referral_required'] ?? false,
            'accrue_patient_resp' => $this->resource['data']['accrue_patient_resp'] ?? false,
            'require_abn' => $this->resource['data']['require_abn'] ?? false,
            'pqrs_eligible' => $this->resource['data']['pqrs_eligible'] ?? false,
            'allow_attached_files' => $this->resource['data']['allow_attached_files'] ?? false,
            'ins_type_id' => $this->resource['data']['ins_type_id'] ?? null,
            'ins_type' => $this->resource['data']['ins_type'] ?? null,
            'plan_type_id' => $this->resource['data']['plan_type_id'] ?? null,
            'plan_type' => $this->resource['data']['plan_type'] ?? null,
            'insurance_company_id' => $this->resource['data']['insurance_company_id'] ?? null,
            'insurance_company' => $this->resource['data']['insurance_company'] ?? null,
            'created_at' => $this->resource['data']['created_at'] ?? null,
            'updated_at' => $this->resource['data']['updated_at'] ?? null,
            'last_modified' => $this->resource['data']['last_modified'] ?? null,
            'user' => $this->resource['data']['user'] ?? null,
            'public_note' => $this->resource['data']['public_note'] ?? null,
            'copays' => $this->resource['data']['copays'] ?? null,
            'contract_fees' => $this->resource['data']['contract_fees'] ?? null,
        ];
    }

    private function getServiceData()
    {
        return [
            'id' => null,
            'code' => $this->resource['data']['code'] ?? null,
            'name' => $this->resource['data']['name'] ?? null,
            'payer_id' => $this->resource['data']['payer_id'] ?? null,
            'accept_assign' => $this->resource['data']['accept_assign'] ?? false,
            'pre_authorization' => $this->resource['data']['pre_authorization'] ?? false,
            'file_zero_changes' => $this->resource['data']['file_zero_changes'] ?? false,
            'referral_required' => $this->resource['data']['referral_required'] ?? false,
            'accrue_patient_resp' => $this->resource['data']['accrue_patient_resp'] ?? false,
            'require_abn' => $this->resource['data']['require_abn'] ?? false,
            'pqrs_eligible' => $this->resource['data']['pqrs_eligible'] ?? false,
            'allow_attached_files' => $this->resource['data']['allow_attached_files'] ?? false,
            'ins_type_id' => $this->resource['data']['ins_type_id'] ?? null,
            'ins_type' => $this->resource['data']['ins_type'] ?? null,
            'plan_type_id' => $this->resource['data']['plan_type_id'] ?? null,
            'plan_type' => $this->resource['data']['plan_type'] ?? null,
            'insurance_company_id' => $this->resource['data']['insurance_company_id'] ?? null,
            'insurance_company' => $this->resource['data']['insurance_company'] ?? null,
            'created_at' => $this->resource['data']['created_at'] ?? null,
            'updated_at' => $this->resource['data']['updated_at'] ?? null,
            'last_modified' => $this->resource['data']['last_modified'] ?? null,
            'user' => $this->resource['data']['user'] ?? null,
            'public_note' => $this->resource['data']['public_note'] ?? null,
        ];
    }
}
