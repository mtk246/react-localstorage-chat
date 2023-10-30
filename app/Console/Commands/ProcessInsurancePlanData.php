<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\EntityAbbreviation;
use App\Models\InsuranceCompany;
use App\Models\InsurancePlan;
use App\Models\InsurancePlanPrivate;
use App\Models\TypeCatalog;
use Illuminate\Console\Command;

final class ProcessInsurancePlanData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insurancePlan:process {filepath : Path to the CSV file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process Insurance Company CSV data';

    /** Execute the console command. */
    public function handle(): int
    {
        $csvFilePath = $this->argument('filepath');

        $csvData = array_map('str_getcsv', file($csvFilePath));
        $header = array_shift($csvData);

        $billingCompanyIndex = array_search('billing_company', $header);
        $payerIdIndex = array_search('payer_id', $header);
        $nameIndex = array_search('name', $header);
        $abbreviationIndex = array_search('abbreviation', $header);
        $insuranceCompanyIndex = array_search('insurance_company', $header);
        $insTypeIndex = array_search('ins_type', $header);
        $planTypeIndex = array_search('plan_type', $header);
        $addressIndex = array_search('address', $header);
        $aptSuiteIndex = array_search('apt_suite', $header);
        $countryIndex = array_search('country', $header);
        $zipIndex = array_search('zip', $header);
        $cityIndex = array_search('city', $header);
        $stateIndex = array_search('state', $header);
        $phoneIndex = array_search('phone', $header);

        foreach ($csvData as $row) {
            if ('' != $row[$payerIdIndex]) {
                $billingCompany = BillingCompany::where('name', $row[$billingCompanyIndex])->first() ?? null;
                $payerId = trim($row[$payerIdIndex] ?? '');
                $name = trim($row[$nameIndex] ?? '');
                $abbreviation = trim($row[$abbreviationIndex] ?? '');
                $insuranceCompany = InsuranceCompany::query()
                    ->whereRaw('UPPER(name) LIKE (?)', [strtoupper("$row[$insuranceCompanyIndex]")])
                    ->first() ?? null;
                $insType = TypeCatalog::where('code', explode(' - ', $row[$insTypeIndex])[0])->first()?->id ?? null;
                $planType = TypeCatalog::where('code', strtoupper($row[$planTypeIndex]))->first()?->id ?? null;
                $address = trim($row[$addressIndex] ?? '');
                $aptSuite = trim($row[$aptSuiteIndex] ?? '');
                $country = trim($row[$countryIndex] ?? '');
                $zip = trim($row[$zipIndex] ?? '');
                $city = trim($row[$cityIndex] ?? '');
                $state = trim($row[$stateIndex] ?? '');
                $phone = trim($row[$phoneIndex] ?? '');

                if (isset($insuranceCompany)) {
                    $insurance = InsurancePlan::query()
                    ->whereRaw('UPPER(name) LIKE (?)', [strtoupper("$name")])
                    ->whereRaw('UPPER(payer_id) LIKE (?)', [strtoupper("$payerId")])
                    ->first();

                    if (isset($insurance)) {
                        $insurance->update([
                            'ins_type_id' => $insType,
                            'plan_type_id' => $planType ?? null,
                            'insurance_company_id' => $insuranceCompany->id,
                        ]);
                    } else {
                        $insurance = InsurancePlan::create([
                            'code' => generateNewCode('IP', 5, date('Y'), InsurancePlan::class, 'code'),
                            'name' => $name,
                            'payer_id' => $payerId,
                            'ins_type_id' => $insType,
                            'plan_type_id' => $planType ?? null,
                            'accept_assign' => $acceptAssign ?? false,
                            'pre_authorization' => $preAuthorization ?? false,
                            'file_zero_changes' => $fileZeroChanges ?? false,
                            'referral_required' => $referralRequired ?? false,
                            'accrue_patient_resp' => $accruePatientResp ?? false,
                            'require_abn' => $requireAbn ?? false,
                            'pqrs_eligible' => $pqrsEligible ?? false,
                            'allow_attached_files' => $allowAttachedFiles ?? false,
                            'eff_date' => $effDate ?? null,
                            'insurance_company_id' => $insuranceCompany->id,
                        ]);
                    }

                    /* Attach billing company */
                    if (is_null($insurance->billingCompanies()->find($billingCompany?->id))) {
                        $insurance->billingCompanies()->attach($billingCompany?->id);
                    }

                    InsurancePlanPrivate::updateOrCreate(
                        [
                            'insurance_plan_id' => $insurance->id,
                            'billing_company_id' => $billingCompany->id,
                        ],
                        [
                            'naic' => $naic ?? null,
                            'file_method_id' => $fileMethod ?? null,
                            'format_professional_id' => $formatProfessional ?? null,
                            'format_cms_id' => $formatCMS ?? null,
                            'format_institutional_id' => $formatInstitutional ?? null,
                            'format_ub_id' => $formatUB ?? null,
                            'insurance_plan_id' => $insurance->id,
                            'billing_company_id' => $billingCompany->id,
                            'responsibilities' => null,
                            'eff_date' => $effDate ?? null,
                        ]
                    );

                    if (!empty($abbreviation)) {
                        EntityAbbreviation::updateOrCreate([
                            'abbreviable_id' => $insurance->id,
                            'abbreviable_type' => InsurancePlan::class,
                            'billing_company_id' => $billingCompany?->id,
                        ], [
                            'abbreviation' => $abbreviation,
                        ]);
                    }

                    if (!empty($address)) {
                        Address::updateOrCreate([
                            'addressable_id' => $insurance->id,
                            'addressable_type' => InsurancePlan::class,
                            'billing_company_id' => $billingCompany?->id,
                        ], [
                            'address' => $address,
                            'city' => $city,
                            'state' => $state,
                            'zip' => str_replace('-', '', $zip),
                            'country' => $country,
                            'apt_suite' => $aptSuite,
                        ]);
                    }
                    if (isset($dataIC['contact']['email'])) {
                        Contact::updateOrCreate([
                            'contactable_id' => $insurance->id,
                            'contactable_type' => InsurancePlan::class,
                            'billing_company_id' => $billingCompany?->id,
                        ], [
                            'phone' => str_replace('-', '', $phone ?? ''),
                            'fax' => $fax ?? '',
                            'email' => $email ?? '',
                            'mobile' => $mobile ?? '',
                        ]);
                    }
                }
            }
        }
        $this->info('CSV data processed successfully.');

        return Command::SUCCESS;
    }
}
