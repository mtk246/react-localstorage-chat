<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Casts\Company\ExectionInsuranceCompanyCast;
use App\Http\Casts\Company\StatementCast;
use App\Http\Casts\Company\StoreExectionICRequestCast;
use App\Http\Casts\Company\StoreStatementRequestCast;
use App\Http\Casts\Company\UpdateCompanyRequestCast;
use App\Http\Casts\Company\UpdateContactDataRequestCast;
use App\Http\Casts\Company\UpdateNotesRequestCast;
use App\Http\Resources\Company\CompanyDataResource;
use App\Http\Resources\Company\ContactDataResource;
use App\Http\Resources\Company\ExectionICResource;
use App\Http\Resources\Company\NotesResource;
use App\Http\Resources\Company\StatementResource;
use App\Models\Company;
use App\Models\Taxonomy;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

final class UpdateCompany
{
    public function invoke(Company $company, UpdateCompanyRequestCast $request): CompanyDataResource
    {
        return DB::transaction(function () use ($company, $request): CompanyDataResource {
            $company->update($request->getCompanyValues());
            $company->billingCompanies()->syncWithoutDetaching($request->getBillingCompanyId());

            if ($request->getNickname()) {
                $company->nicknames()->updateOrCreate(
                    ['billing_company_id' => $request->getBillingCompanyId()],
                    ['nickname' => $request->getNickname()],
                );
            }

            if ($request->getAbbreviation()) {
                $company->abbreviations()->updateOrCreate(
                    ['billing_company_id' => $request->getBillingCompanyId()],
                    ['abbreviation' => $request->getAbbreviation()],
                );
            }

            if ($request->getTaxonomies()) {
                $taxIds = $request->getTaxonomies()->pluck('tax_id')->toArray();
                $company->taxonomies()->upsert($request->getTaxonomies()->toArray(), ['tax_id']);
                $company->taxonomies()->sync(Taxonomy::whereIn('tax_id', $taxIds)->get('id'));
            }

            return new CompanyDataResource($company, $request);
        });
    }

    public function contactData(Company $company, UpdateContactDataRequestCast $request): ContactDataResource
    {
        return DB::transaction(function () use ($company, $request): ContactDataResource {
            $company->contacts()->updateOrCreate(['billing_company_id' => $request->getBillingCompanyId()], [
                'contact_name' => $request->getContact()->getContactName(),
                'phone' => $request->getContact()->getPhone(),
                'mobile' => $request->getContact()->getMobile(),
                'fax' => $request->getContact()->getFax(),
                'email' => $request->getContact()->getEmail(),
            ]);

            $this->updateAddresses($company, $request);

            return new ContactDataResource($company, $request);
        });
    }

    public function statement(Company $company, StoreStatementRequestCast $request): AnonymousResourceCollection
    {
        return DB::transaction(function () use ($company, $request): AnonymousResourceCollection {
            $company->companyStatements()
                ->whereNotIn('id', $request->getStore()->map(
                    fn (StatementCast $statement) => $statement->getId(),
                )->toArray())
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->delete();

            $request->getStore()->each(function (StatementCast $statement) use ($company, $request): void {
                $company->companyStatements()
                    ->updateOrCreate([
                        'id' => $statement->getId(),
                        'billing_company_id' => $request->getBillingCompanyId(),
                    ], [
                        'start_date' => $statement->getStartDate(),
                        'end_date' => $statement->getEndDate(),
                        'rule_id' => $statement->getRuleId(),
                        'when_id' => $statement->getWhenId(),
                        'apply_to_ids' => $statement->getApplyToIds(),
                    ]);
            });

            return StatementResource::collection(
                $company->companyStatements()
                    ->where('billing_company_id', $request->getBillingCompanyId())
                    ->orderBy('id')
                    ->get(),
                $request,
            );
        });
    }

    public function exectionInsuranceCompanies(
        Company $company,
        StoreExectionICRequestCast $request
    ): AnonymousResourceCollection {
        return DB::transaction(function () use ($company, $request): AnonymousResourceCollection {
            $company->exceptionInsuranceCompanies()
                ->whereNotIn('id', $request->getStore()->map(
                    fn (ExectionInsuranceCompanyCast $statement) => $statement->getId(),
                )->toArray())
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->delete();

            $request->getStore()
                ->each(function (ExectionInsuranceCompanyCast $store) use ($company, $request): void {
                    $company->exceptionInsuranceCompanies()
                        ->updateOrCreate([
                            'id' => $store->getId(),
                            'billing_company_id' => $request->getBillingCompanyId(),
                        ], ['insurance_company_id' => $store->getInsuranceCompanyId()]);
                });

            return ExectionICResource::collection(
                $company->exceptionInsuranceCompanies()
                    ->where('billing_company_id', $request->getBillingCompanyId())
                    ->orderBy('id')
                    ->get(),
                $request,
            );
        });
    }

    public function notes(Company $company, UpdateNotesRequestCast $request): NotesResource
    {
        return DB::transaction(function () use ($company, $request): NotesResource {
            $company->privateNotes()->updateOrCreate([
                'billing_company_id' => $request->getBillingCompanyId(),
            ], ['note' => $request->getPrivateNote()]);

            $company->publicNote()->updateOrCreate([
                'publishable_type' => Company::class,
                'publishable_id' => $company->id,
            ], ['note' => $request->getPublicNote()]);

            return new NotesResource($company, $request);
        });
    }

    private function updateAddresses(Company $company, UpdateContactDataRequestCast $request): void
    {
        $company->addresses()->updateOrCreate([
            'billing_company_id' => $request->getBillingCompanyId(),
            'address_type_id' => '1',
        ], [
            'address' => $request->getAddress()->getAddress(),
            'city' => $request->getAddress()->getCity(),
            'state' => $request->getAddress()->getState(),
            'zip' => $request->getAddress()->getZip(),
            'country' => $request->getAddress()->getCountry(),
            'country_subdivision_code' => $request->getAddress()->getCountrySubdivisionCode(),
        ]);

        if (!$request->getPaymentAddres()) {
            $company->addresses()
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->where('address_type_id', '3')
                ->delete();

            return;
        }

        $company->addresses()->updateOrCreate([
            'billing_company_id' => $request->getBillingCompanyId(),
            'address_type_id' => '3',
        ], [
            'address' => $request->getPaymentAddres()->getAddress(),
            'city' => $request->getPaymentAddres()->getCity(),
            'state' => $request->getPaymentAddres()->getState(),
            'zip' => $request->getPaymentAddres()->getZip(),
            'country' => $request->getPaymentAddres()->getCountry(),
            'country_subdivision_code' => $request->getPaymentAddres()->getCountrySubdivisionCode(),
        ]);
    }
}
