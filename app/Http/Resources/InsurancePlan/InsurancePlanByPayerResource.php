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
            'accept_assign' => $this->resource['data']['accept_assign'] ?? null,
            'pre_authorization' => $this->resource['data']['pre_authorization'] ?? null,
            'file_zero_changes' => $this->resource['data']['file_zero_changes'] ?? null,
            'referral_required' => $this->resource['data']['referral_required'] ?? null,
            'accrue_patient_resp' => $this->resource['data']['accrue_patient_resp'] ?? null,
            'require_abn' => $this->resource['data']['require_abn'] ?? null,
            'pqrs_eligible' => $this->resource['data']['pqrs_eligible'] ?? null,
            'allow_attached_files' => $this->resource['data']['allow_attached_files'] ?? null,
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
            'id' => $this->resource['data'][0]['id'] ?? null,
            'code' => $this->resource['data'][0]['code'] ?? null,
            'name' => $this->resource['data'][0]['name'] ?? null,
            'payer_id' => $this->resource['data'][0]['payer_id'] ?? null,
            'accept_assign' => $this->resource['data'][0]['accept_assign'] ?? null,
            'pre_authorization' => $this->resource['data'][0]['pre_authorization'] ?? null,
            'file_zero_changes' => $this->resource['data'][0]['file_zero_changes'] ?? null,
            'referral_required' => $this->resource['data'][0]['referral_required'] ?? null,
            'accrue_patient_resp' => $this->resource['data'][0]['accrue_patient_resp'] ?? null,
            'require_abn' => $this->resource['data'][0]['require_abn'] ?? null,
            'pqrs_eligible' => $this->resource['data'][0]['pqrs_eligible'] ?? null,
            'allow_attached_files' => $this->resource['data'][0]['allow_attached_files'] ?? null,
            'ins_type_id' => $this->resource['data'][0]['ins_type_id'] ?? null,
            'ins_type' => $this->resource['data'][0]['ins_type'] ?? null,
            'plan_type_id' => $this->resource['data'][0]['plan_type_id'] ?? null,
            'plan_type' => $this->resource['data'][0]['plan_type'] ?? null,
            'insurance_company_id' => $this->resource['data'][0]['insurance_company_id'] ?? null,
            'insurance_company' => $this->resource['data'][0]['insurance_company'] ?? null,
            'created_at' => $this->resource['data'][0]['created_at'] ?? null,
            'updated_at' => $this->resource['data'][0]['updated_at'] ?? null,
            'last_modified' => $this->resource['data'][0]['last_modified'] ?? null,
            'user' => $this->resource['data'][0]['user'] ?? null,
            'public_note' => $this->resource['data'][0]['public_note'] ?? null,
            'copays' => $this->resource['data'][0]['copays'] ?? null,
            'contract_fees' => $this->resource['data'][0]['contract_fees'] ?? null,
        ];
    }
}
