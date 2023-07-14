<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Facades\Pagination;
use App\Models\Company;
use App\Models\CompanyProcedure;
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
            'upin' => $this->resource->upin,
            'clia' => $this->resource->clia,
            'status' => (bool) $this->resource->status,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'public_note' => $this->resource->publicNote?->note ?? null,
            'last_modified' => $this->resource->last_modified,

            'taxonomies' => TaxonomiesResource::collection($this->resource->taxonomies),
            'facilities' => $this->getFacilities(),
            'services' => $this->getServices(),
            'copays' => $this->getCopays(),
            'contract_fees' => $this->getContracFees(),
            'addresses' => $this->resource->addresses,
            'contacts' => $this->resource->contacts,
        ];
    }

    private function getFacilities()
    {
        $bC = request()->user()->billing_company_id;
        $facilities = $this->resource->facilities()
            ->when(
                Gate::allows('is-admin'),
                fn ($query) => $query->where('company_facility.billing_company_id', $bC)
            )
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return FacilityResource::collection($facilities)->resource;
    }

    private function getServices()
    {
        $bC = request()->user()->billing_company_id;
        $companyProcedures = CompanyProcedure::query()
            ->where('company_id', $this->id)
            ->when(
                Gate::allows('is-admin'),
                fn ($query) => $query->where('company_procedure.billing_company_id', $bC)
            )
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return ServiceResource::collection($companyProcedures)->resource;
    }

    private function getCopays()
    {
        $bC = request()->user()->billing_company_id;

        return $this->resource->copays()
            ->with('procedures')
            ->when(
                Gate::allows('is-admin'),
                fn ($query) => $query->where('billing_company_id', $bC)
            )
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());
    }

    private function getContracFees()
    {
        $bC = request()->user()->billing_company_id;

        return $this->resource->contracFees()
            ->with(
                [
                    'procedures',
                    'modifiers',
                    'patients',
                    'macLocality',
                    'insuranceCompany',
                ]
            )
            ->when(
                Gate::allows('is-admin'),
                fn ($query) => $query->where('billing_company_id', $bC)
            )
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());
    }
}
