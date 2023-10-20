<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\EntityAbbreviation;
use App\Models\InsuranceCompany;
use App\Models\TypeCatalog;
use Illuminate\Console\Command;

final class ProcessInsuranceCompanyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insuranceCompany:process {filepath : Path to the CSV file}';

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
        $fileMethodIndex = array_search('file_method', $header);
        $addressIndex = array_search('address', $header);
        $aptSuiteIndex = array_search('apt_suite', $header);
        $countryIndex = array_search('country', $header);
        $zipIndex = array_search('zip', $header);
        $cityIndex = array_search('city', $header);
        $stateIndex = array_search('state', $header);
        $phoneIndex = array_search('phone', $header);

        foreach ($csvData as $row) {
            if ('' != $row[$payerIdIndex]) {
                $billingCompany = BillingCompany::where('abbreviation', explode(' ', $row[$billingCompanyIndex])[0])->first() ?? null;
                $payerId = $row[$payerIdIndex] ?? '';
                $name = $row[$nameIndex] ?? '';
                $abbreviation = $row[$abbreviationIndex] ?? '';
                $fileMethodId = TypeCatalog::where('code', explode(' - ', $row[$fileMethodIndex])[0])->first()?->id ?? null;
                $address = $row[$addressIndex] ?? '';
                $aptSuite = $row[$aptSuiteIndex] ?? '';
                $country = $row[$countryIndex] ?? '';
                $zip = $row[$zipIndex] ?? '';
                $city = $row[$cityIndex] ?? '';
                $state = $row[$stateIndex] ?? '';
                $phone = $row[$phoneIndex] ?? '';

                $insurance = InsuranceCompany::where('payer_id', $payerId)->first();
                if (isset($insurance)) {
                    $insurance->update([
                        'naic' => $naic ?? '',
                        'file_method_id' => $fileMethodId,
                    ]);
                } else {
                    $insurance = InsuranceCompany::create([
                        'code' => generateNewCode('IC', 5, date('Y'), InsuranceCompany::class, 'code'),
                        'name' => $name ?? '',
                        'naic' => $naic ?? '',
                        'payer_id' => $payerId,
                        'file_method_id' => $fileMethodId,
                    ]);
                }

                /* Attach billing company */
                $insurance->billingCompanies()->attach($billingCompany?->id);

                if (!empty($abbreviation)) {
                    EntityAbbreviation::firstOrCreate([
                        'abbreviable_id' => $insurance->id,
                        'abbreviable_type' => InsuranceCompany::class,
                        'billing_company_id' => $billingCompany?->id,
                    ], [
                        'abbreviation' => $abbreviation,
                    ]);
                }

                if (!empty($address)) {
                    Address::firstOrCreate([
                        'addressable_id' => $insurance->id,
                        'addressable_type' => InsuranceCompany::class,
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
                    Contact::firstOrCreate([
                        'contactable_id' => $insurance->id,
                        'contactable_type' => InsuranceCompany::class,
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
        $this->info('CSV data processed successfully.');

        return Command::SUCCESS;
    }
}
