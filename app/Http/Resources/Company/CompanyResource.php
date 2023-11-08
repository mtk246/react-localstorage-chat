<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Facades\Pagination;
use App\Models\Company;
use App\Models\CompanyService;
use App\Models\TypeForm;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

/** @property Company $resource */
final class CompanyResource extends JsonResource
{
    /** @return array<key, string> */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'name' => $this->resource->name,
            'npi' => $this->resource->npi,
            'ein' => $this->resource->ein,
            'clia' => $this->resource->clia ?? '',
            'other_name' => $this->resource->other_name ?? '',
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'public_note' => $this->resource->publicNote?->note ?? '',
            'last_modified' => $this->resource->last_modified,
            'taxonomies' => TaxonomiesResource::collection(
                $this->resource->taxonomies()
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->where('billing_company_id', request()->user()->billing_company_id)
                )
                ->distinct('taxonomy_id')->get()
            ),
            'facilities' => $this->getFacilities(),
            'services' => $this->getServices(),
            'copays' => $this->getCopays(),
            'contract_fees' => $this->getContracFees(),
            'exception_insurance_companies' => $this->getExceptionInsuranceCompanies(),
            'patients' => $this->getPatients(),
            'statements' => $this->getStatements(),
            'abbreviations' => $this->resource->abbreviations()
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->where('billing_company_id', request()->user()->billing_company_id)
                )
                ->distinct('abbreviation')
                ->get()
                ->map(fn ($option) => $option->abbreviation)
                ->toArray(),
            'billing_companies' => $this->resource->billingCompanies()
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->where('billing_company_id', request()->user()->billing_company_id)
                )
                ->distinct('id')
                ->get()
                ->setVisible(['id', 'name', 'code', 'abbreviation', 'private_company'])
                ->map(function ($bC) {
                    $nickname = $this->resource->nicknames()
                        ->where('billing_company_id', $bC->id)
                        ->first()->nickname ?? '';

                    $bC->private_company = [
                        'status' => $bC->pivot->status ?? false,
                        'miscellaneous' => $bC->pivot->miscellaneous ?? '',
                        'split_company_claim' => $bC->pivot->split_company_claim ?? false,
                        'claim_format_ids' => $bC->pivot->claim_format_ids ?? [],
                        'claim_formats' => getList(TypeForm::class, 'form'),
                        'edit_name' => !empty($nickname),
                        'nickname' => $nickname,
                        'abbreviation' => $this->resource->abbreviations()
                            ->where('billing_company_id', $bC->id)
                            ->first()->abbreviation ?? '',
                        'private_note' => $this->getPrivateNote($bC->id)?->note ?? '',
                        'taxonomy' => TaxonomiesResource::collection($this->resource->taxonomies()
                            ->wherePivot('billing_company_id', $bC->id)
                            ->wherePivot('primary', true)
                            ->get()),
                        'address' => $this->getAddress($bC->id, 1),
                        'payment_address' => $this->getAddress($bC->id, 3),
                        'contact' => $this->getContact($bC->id),
                    ];

                    return $bC;
                }),
        ];
    }

    private function getExceptionInsuranceCompanies()
    {
        $bC = request()->user()->billing_company_id;
        $exceptions = $this->resource->exceptionInsuranceCompanies()
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('billing_company_id', $bC)
            )
            ->orderBy('id', Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return ExceptionInsuranceResource::collection($exceptions)->resource;
    }

    private function getPatients()
    {
        $bC = request()->user()->billing_company_id;
        $patients = $this->resource->patients()
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('company_patient.billing_company_id', $bC)
            )
            ->orderBy('id', Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return CompanyPatientResource::collection($patients)->resource;
    }

    private function getStatements()
    {
        $bC = request()->user()->billing_company_id;
        $statements = $this->resource->companyStatements()
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('billing_company_id', $bC)
            )
            ->orderBy('id', Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return StatementResource::collection($statements)->resource;
    }

    private function getFacilities()
    {
        $bC = request()->user()->billing_company_id;
        $facilities = $this->resource->facilities()
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('company_facility.billing_company_id', $bC)
            )
            ->orderBy('id', Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return FacilityResource::collection($facilities)->resource;
    }

    private function getServices()
    {
        $bC = request()->user()->billing_company_id;
        $companyServices = CompanyService::query()
            ->where('company_id', $this->id)
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('billing_company_id', $bC)
            )
            ->orderBy('id', Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return ServiceResource::collection($companyServices)->resource;
    }

    private function getCopays()
    {
        $bC = request()->user()->billing_company_id;

        $copays = $this->resource->copays()
            ->with('procedures', 'insurancePlans')
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('billing_company_id', $bC)
            )
            ->orderBy('id', Pagination::sortDesc())
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
                'insurancePlans',
            ])
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('billing_company_id', $bC)
            )
            ->orderBy('id', Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return ContractFeeResource::collection($contractFees)->resource;
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
        return $this->resource
            ->privateNotes()
            ->where('billing_company_id', $billingCompanyId)
            ->first();
    }
}
