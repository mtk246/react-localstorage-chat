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
use App\Http\Resources\Company\NotesResource;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

final class UpdateCompany
{
    public function invoke(Company $company, UpdateCompanyRequestCast $request): Company
    {
        return DB::transaction(function () use ($company, $request): Company {
            $company->update($request->getCompanyValues());

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
                $company->taxonomies()->upsert($request->getTaxonomies()->toArray(), ['tax_id']);
                $company->taxonomies()->whereNotIn(
                    'tax_id',
                    $request->getTaxonomies()
                        ->pluck('tax_id')
                        ->toArray(),
                )->delete();
            }

            return $company;
        });
    }

    public function contactData(Company $company, UpdateContactDataRequestCast $request): Company
    {
        return DB::transaction(function () use ($company, $request): Company {
            $company->contacts()->updateOrCreate(['billing_company_id' => $request->getBillingCompanyId()], [
                'contact_name' => $request->getContact()->getContactName(),
                'phone' => $request->getContact()->getPhone(),
                'mobile' => $request->getContact()->getMobile(),
                'fax' => $request->getContact()->getFax(),
                'email' => $request->getContact()->getEmail(),
            ]);

            $company->addresses()->updateOrCreate(['billing_company_id' => $request->getBillingCompanyId()], [
                'addresses' => $request->getAddress()->getAddresses(),
                'city' => $request->getAddress()->getCity(),
                'state' => $request->getAddress()->getState(),
                'zip' => $request->getAddress()->getZip(),
                'country' => $request->getAddress()->getCountry(),
                'country_subdivision_code' => $request->getAddress()->getCountrySubdivisionCode(),
            ]);

            if ($request->getPaymentAddres()) {
                $company->addresses()->updateOrCreate(['billing_company_id' => $request->getBillingCompanyId()], [
                    'addresses' => $request->getPaymentAddres()->getAddresses(),
                    'city' => $request->getPaymentAddres()->getCity(),
                    'state' => $request->getPaymentAddres()->getState(),
                    'zip' => $request->getPaymentAddres()->getZip(),
                    'country' => $request->getPaymentAddres()->getCountry(),
                    'country_subdivision_code' => $request->getPaymentAddres()->getCountrySubdivisionCode(),
                ]);
            }

            return $company;
        });
    }

    public function statement(Company $company, StoreStatementRequestCast $request): Company
    {
        return DB::transaction(function () use ($company, $request): Company {
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

            $company->companyStatements()
                ->whereIn('id', $request->getDelete())
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->delete();

            return $company;
        });
    }

    public function exectionInsuranceCompanies(Company $company, StoreExectionICRequestCast $request): Company
    {
        return DB::transaction(function () use ($company, $request): Company {
            $request->getStore()
                ->each(function (ExectionInsuranceCompanyCast $store) use ($company, $request): void {
                    $company->exceptionInsuranceCompanies()
                        ->updateOrCreate([
                            'id' => $store->getId(),
                            'billing_company_id' => $request->getBillingCompanyId(),
                        ], ['insurance_company_id' => $store->getInsuranceCompanyId()]);
                });

            $company->exceptionInsuranceCompanies()
                ->whereIn('id', $request->getDelete())
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->delete();

            return $company;
        });
    }

    public function notes(Company $company, UpdateNotesRequestCast $request): NotesResource
    {
        return DB::transaction(function () use ($company, $request): NotesResource {
            $company->privateNotes()->updateOrCreate([
                'billing_company_id' => $request->getBillingCompanyId(),
            ], ['note' => $request->getPrivateNote()]);

            $company->publicNote()->updateOrCreate(['note' => $request->getPublicNote()]);

            return new NotesResource($company, $request);
        });
    }
}
