<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Facades\Pagination;
use App\Http\Resources\Company\CompanyResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

/** @todo finish the refactoring, only a partial refactoring was done */
final class GetCompany
{
    public function single(Company $company, User $user): CompanyResource
    {
        return DB::transaction(function () use ($company, $user) {
            $company->query()
                ->when(
                    Gate::check('is-admin'),
                    fn (Builder $query) => $this->loadAdminModel($query),
                    fn (Builder $query) => $this->loadModel($query, $user->billing_company_id)
                );

            return CompanyResource::make($company);
        });
    }

    public function all(Company $company, Request $request)
    {
        return DB::transaction(function () use ($company, $request) {
            $companiesQuery = $company->query()
                ->when(
                    Gate::denies('is-admin'),
                    function (Builder $query) use ($request) {
                        $bC = $request->user()->billing_company_id;
                        $query->whereHas('billingCompanies', function (Builder $query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        })
                        ->with([
                            'addresses' => function ($query) use ($bC) {
                                $query->where('billing_company_id', $bC);
                            },
                            'contacts' => function ($query) use ($bC) {
                                $query->where('billing_company_id', $bC);
                            },
                            'nicknames' => function ($query) use ($bC) {
                                $query->where('billing_company_id', $bC);
                            },
                            'billingCompanies' => function ($query) use ($bC) {
                                $query->where('billing_company_id', $bC);
                            },
                        ]);
                    },
                    function (Builder $query) {
                        $query->with([
                            'addresses',
                            'contacts',
                            'nicknames',
                            'billingCompanies',
                        ]);
                    }
                )
                ->when(
                    !empty($request->query('query')) && '{}' !== $request->query('query'),
                    fn (Builder $query) => $query->search($request->query('query')),
                )
                ->when(
                    isset($request->sortBy),
                    function (Builder $query) use ($request) {

                        switch($request->sortBy) {
                            case 'name':
                                $query->orderBy('name', Pagination::sortDesc());
                                break;
                            case 'code':
                                $query->orderBy('code', Pagination::sortDesc());
                                break;
                            case 'npi':
                                $query->orderBy('npi', Pagination::sortDesc());
                                break;
                            case 'ein':
                                $query->orderBy('ein', Pagination::sortDesc());
                                break;
                            default:
                                $query->orderBy('id', Pagination::sortDesc());
                                break;
                        }
                    },
                    fn (Builder $query) => $query->orderBy('created_at', Pagination::sortDesc())->orderBy('id', 'asc'),
                )
                ->paginate(Pagination::itemsPerPage());

            return [
                'data' => CompanyResource::collection($companiesQuery),
                'numberOfPages' => $companiesQuery->lastPage(),
                'count' => $companiesQuery->total(),
            ];
        });
    }

    private function loadAdminModel(Builder &$query): void
    {
        $query->with([
            'taxonomies',
            'addresses',
            'contacts',
            'nicknames',
            'abbreviations',
            'facilities',
            'companyStatements',
            'exceptionInsuranceCompanies',
            'billingCompanies',
            'publicNote',
            'privateNotes',
        ]);
    }

    private function loadModel(Builder &$query, int $bC): void
    {
        $query->with([
            'addresses' => function (Builder $query) use ($bC): void {
                $query->where('billing_company_id', $bC);
            },
            'contacts' => function (Builder $query) use ($bC): void {
                $query->where('billing_company_id', $bC);
            },
            'nicknames' => function (Builder $query) use ($bC): void {
                $query->where('billing_company_id', $bC);
            },
            'abbreviations' => function (Builder $query) use ($bC): void {
                $query->where('billing_company_id', $bC);
            },
            'billingCompanies' => function (Builder $query) use ($bC): void {
                $query->where('billing_company_id', $bC);
            },
            'exceptionInsuranceCompanies' => function (Builder $query) use ($bC): void {
                $query->where('billing_company_id', $bC);
            },
            'companyStatements' => function (Builder $query) use ($bC): void {
                $query->where('billing_company_id', $bC);
            },
            'privateNotes' => function (Builder $query) use ($bC): void {
                $query->where('billing_company_id', $bC);
            },
            'taxonomies',
            'facilities',
            'publicNote',
        ]);
    }
}
