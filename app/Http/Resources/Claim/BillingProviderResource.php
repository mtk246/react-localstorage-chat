<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Models\Claims\ClaimDemographicInformation;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ClaimDemographicInformation $resource */
final class BillingProviderResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        $billingProvider = $this->resource->healthProfessionals;

        $billingProviderData = $billingProvider->map(function ($healthProfessional) {
            return [
                'id' => $healthProfessional->id,
                'npi' => $healthProfessional->npi,
                'created_at' => $healthProfessional->created_at->format('H:i:s'),
                'updated_at' => $healthProfessional->updated_at->format('H:i:s'),
                'code' => $healthProfessional->code,
                'is_provider' => $healthProfessional->is_provider,
                'npi_company' => $healthProfessional->npi_company,
                'company_id' => $healthProfessional->company_id,
                'nppes_verified_at' => $healthProfessional->nppes_verified_at,
                'ein' => $healthProfessional->ein,
                'upin' => $healthProfessional->upin,
                'profile' => $healthProfessional->profile ? [
                    'id' => $healthProfessional->profile_id,
                    'first_name' => $healthProfessional->profile->first_name,
                    'middle_name' => $healthProfessional->profile->middle_name,
                    'last_name' => $healthProfessional->profile->last_name,
                    'ssn' => $healthProfessional->profile->ssn,
                    'sex' => $healthProfessional->profile->sex,
                    'date_of_birth' => $healthProfessional->profile->date_of_birth,
                    'avatar' => $healthProfessional->profile->avatar,
                    'credit_score' => $healthProfessional->profile->credit_score,
                    'name_suffix_id' => $healthProfessional->profile->name_suffix_id,
                    'deceased_date' => $healthProfessional->profile->deceased_date,
                    'language' => $healthProfessional->profile->language,
                ] : [],
                'pivot' => [
                    'claim_id' => $healthProfessional->pivot->claim_id,
                    'field_id' => $healthProfessional->pivot->field_id,
                    'qualifier_id' => $healthProfessional->pivot->qualifier_id,
                    'created_at' => $healthProfessional->pivot->created_at->format('H:i:s'),
                    'updated_at' => $healthProfessional->pivot->updated_at->format('H:i:s'),
                ],
            ];
        })->all();

        return $billingProviderData;
    }
}
