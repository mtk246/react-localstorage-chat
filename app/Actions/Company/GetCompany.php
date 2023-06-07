<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Facades\Pagination;
use App\Http\Resources\Company\ServiceResource;
use App\Http\Resources\Enums\CatalogResource;
use App\Http\Resources\Enums\EnumResource;
use App\Models\Address;
use App\Models\AddressType;
use App\Models\Company;
use App\Models\CompanyProcedure;
use App\Models\Contact;
use App\Models\EntityAbbreviation;
use App\Models\EntityNickname;
use App\Models\PrivateNote;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

/** @todo finish the refactoring, only a partial refactoring was done */
final class GetCompany
{
    public function getOne(int $id, User $user)
    {
        return DB::transaction(function () use ($id, $user) {
            $bC = $user->billing_company_id ?? null;

            $company = $this->getCompanyInstance($id, $user);

            if ($user->hasRole('superuser')) {
                $facilities = $company->facilities()
                    ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                    ->paginate(Pagination::itemsPerPage());
                $companyProcedures = CompanyProcedure::query()
                    ->where('company_id', $company->id)
                    ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                    ->paginate(Pagination::itemsPerPage());
                $copays = $company->copays()
                    ->with('procedures')
                    ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                    ->paginate(Pagination::itemsPerPage());
                $contracFees = $company->contracFees()
                    ->with([
                        'procedures',
                        'modifiers',
                        'patiens',
                        'macLocality',
                        'insuranceCompany',
                    ])
                    ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                    ->paginate(Pagination::itemsPerPage());
            } else {
                $facilities = $company->facilities()
                    ->wherePivot('billing_company_id', $bC)
                    ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                    ->paginate(Pagination::itemsPerPage());
                $companyProcedures = CompanyProcedure::query()
                    ->where('company_id', $company->id)
                    ->where('billing_company_id', $bC)
                    ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                    ->paginate(Pagination::itemsPerPage());
                $copays = $company->copays()
                    ->with('procedures')
                    ->where('billing_company_id', $bC)
                    ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                    ->paginate(Pagination::itemsPerPage());
                $contracFees = $company->contracFees()
                    ->with([
                        'procedures',
                        'modifiers',
                        'patiens',
                        'macLocality',
                        'insuranceCompany',
                    ])
                    ->where('billing_company_id', $bC)
                    ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                    ->paginate(Pagination::itemsPerPage());
            }

            $facilities->getCollection()->transform(fn ($facility) => [
                'billing_company_id' => $facility->pivot->billing_company_id,
                'facility_id' => $facility->id,
                'facility_type_id' => $facility->facility_type_id,
                'facility_type' => $facility->facilityType,
                'billing_company' => $facility->billingCompanies()->find(
                    $facility->pivot->billing_company_id,
                )->name ?? null,
                'facility' => $facility->name,
                'facility_type' => $facility->facilityType->type,
            ]);

            $record = [
                'id' => $company->id,
                'code' => $company->code,
                'name' => $company->name,
                'npi' => $company->npi,
                'ein' => $company->ein,
                'upin' => $company->upin,
                'clia' => $company->clia,
                'status' => $company->status,
                'created_at' => $company->created_at,
                'updated_at' => $company->updated_at,
                'last_modified' => $company->last_modified,
                'public_note' => isset($company->publicNote) ? $company->publicNote->note : null,
                'taxonomies' => $company->taxonomies,
                'facilities' => $facilities,
                'services' => ServiceResource::collection($companyProcedures)->resource,
                'copays' => $copays,
                'contract_fees' => $contracFees,
            ];
            $record['billing_companies'] = [];

            foreach ($company->billingCompanies as $billingCompany) {
                $abbreviation = EntityAbbreviation::where([
                    'abbreviable_id' => $company->id,
                    'abbreviable_type' => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ])->first();
                $nickname = EntityNickname::where([
                    'nicknamable_id' => $company->id,
                    'nicknamable_type' => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ])->first();
                $address = Address::where([
                    'address_type_id' => '1',
                    'addressable_id' => $company->id,
                    'addressable_type' => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ])->first();

                $payment_address = Address::where([
                    'address_type_id' => '3',
                    'addressable_id' => $company->id,
                    'addressable_type' => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ])->first();

                $contact = Contact::where([
                    'contactable_id' => $company->id,
                    'contactable_type' => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ])->first();
                $private_note = PrivateNote::where([
                    'publishable_id' => $company->id,
                    'publishable_type' => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ])->first();

                $exception_insurance_companies = $company->exceptionInsuranceCompanies()
                    ->where('billing_company_id', $billingCompany->id ?? $billingCompany)
                    ->get();
                $company_statements = $company->companyStatements()
                    ->where('billing_company_id', $billingCompany->id ?? $billingCompany)->get();

                $exceptionIC = [];

                foreach ($exception_insurance_companies as $exception) {
                    $exceptionIC[] = [
                        'index' => $exception->id,
                        'id' => $exception->insuranceCompany->id,
                        'code' => $exception->insuranceCompany->code,
                        'name' => $exception->insuranceCompany->name,
                        'payer_id' => $exception->insuranceCompany->payer_id,
                    ];
                }

                $statements = [];

                foreach ($company_statements as $statement) {
                    array_push($statements, [
                        'id' => $statement->id,
                        'start_date' => $statement->start_date,
                        'end_date' => $statement->end_date,
                        'rule_id' => $statement->rule_id,
                        'rule' => $statement->rule->description ?? null,
                        'when_id' => $statement->when_id,
                        'when' => $statement->when->description ?? null,
                        'apply_to_ids' => new EnumResource($statement->apply_to_ids, CatalogResource::class),
                    ]);
                }

                if (isset($address)) {
                    $company_address = [
                        'zip' => $address->zip,
                        'city' => $address->city,
                        'state' => $address->state,
                        'address' => $address->address,
                        'country' => $address->country,
                        'address_type_id' => $address->address_type_id,
                        'country_subdivision_code' => $address->country_subdivision_code,
                    ];
                }

                if (isset($payment_address)) {
                    $company_payment_address = [
                        'zip' => $payment_address->zip,
                        'city' => $payment_address->city,
                        'state' => $payment_address->state,
                        'address' => $payment_address->address,
                        'country' => $payment_address->country,
                        'address_type_id' => $payment_address->address_type_id,
                        'country_subdivision_code' => $payment_address->country_subdivision_code,
                    ];
                }

                if (isset($contact)) {
                    $company_contact = [
                        'fax' => $contact->fax,
                        'email' => $contact->email,
                        'phone' => $contact->phone,
                        'mobile' => $contact->mobile,
                        'contact_name' => $contact->contact_name,
                    ];
                }

                array_push($record['billing_companies'], [
                    'id' => $billingCompany->id,
                    'name' => $billingCompany->name,
                    'code' => $billingCompany->code,
                    'abbreviation' => $billingCompany->abbreviation,
                    'private_company' => [
                        'status' => $billingCompany->pivot->status ?? false,
                        'edit_name' => isset($nickname->nickname),
                        'nickname' => $nickname->nickname ?? '',
                        'abbreviation' => $abbreviation->abbreviation ?? '',
                        'private_note' => $private_note->note ?? '',
                        'address' => $company_address ?? null,
                        'payment_address' => $company_payment_address ?? null,
                        'contact' => $company_contact ?? null,
                        'exception_insurance_companies' => $exceptionIC ?? [],
                        'statements' => $statements ?? [],
                    ],
                ]);
            }

            return !is_null($record)
                ? $record
                : null;
        });
    }

    public function getCompanyInstance(int $id, User $user): Company
    {
        return Company::whereId($id)
            ->when(Gate::allows('is-admin'), function (Builder $query): void {
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
            }, function (Builder $query) use ($user): void {
                $bC = $user->billing_company_id;

                $query->with([
                    'addresses' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                    'contacts' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                    'nicknames' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                    'abbreviations' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                    'billingCompanies' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                    'exceptionInsuranceCompanies' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                    'companyStatements' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                    'privateNotes' => function ($query) use ($bC): void {
                        $query->where('billing_company_id', $bC);
                    },
                    'taxonomies',
                    'facilities',
                    'publicNote',
                ]);
            })->first();
    }
}
