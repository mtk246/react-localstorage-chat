<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Claim\ClaimType;
use App\Enums\ClearingHouse as ClearingHouseEnum;
use App\Models\ClearingHouse\AvailablePayer;
use App\Models\ClearingHouse\DataOfPayer;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

final class ProcessCPIDData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:process {filepath : Path to the CSV file} {code : Identification code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process CPID CSV data and generate JSON file';

    /** Execute the console command. */
    public function handle(): int
    {
        $csvFilePath = $this->argument('filepath');
        $csvCode = $this->argument('code');

        $clearingHouseId = match ($csvCode) {
            ClearingHouseEnum::CHANGE->getCode() => ClearingHouseEnum::CHANGE->value,
            default => 0
        };

        $csvData = array_map('str_getcsv', file($csvFilePath));
        $header = array_shift($csvData);

        $payerIdIndex = array_search('Payer ID', $header);
        $payerNameIndex = array_search('Payer Name', $header);
        $claimTypeIndex = array_search('Claim Type', $header);
        $paperCPIDIndex = array_search('Paper CPID', $header);
        $CPIDIndex = array_search('CPID', $header);
        $portalIndex = array_search('Portal Avail', $header);
        $insuranceTypeIndex = array_search('Claim Insurance Type', $header);

        foreach ($csvData as $row) {
            $payerId = $row[$payerIdIndex];
            $payerName = trim(str_replace('\t', ' ', $row[$payerNameIndex]));
            $claimType = $row[$claimTypeIndex];
            $paperCPID = $row[$paperCPIDIndex];
            $CPID = $row[$CPIDIndex];
            $portal = $row[$portalIndex];
            $insuranceType = $row[$insuranceTypeIndex];

            $availablePayer = AvailablePayer::firstOrCreate(
                [
                    'payer_id' => $payerId,
                    'name' => $payerName,
                ],
                [
                    'payer_id' => $payerId,
                    'name' => $payerName,
                ]
            );

            DataOfPayer::updateOrCreate(
                [
                    'clearing_house_id' => ($clearingHouseId > 0) ? $clearingHouseId : null,
                    'available_payer_id' => $availablePayer->id,
                    'cpid' => $CPID,
                    'paper_cpid' => $paperCPID,
                    'type' => ('PROFESSIONAL' == Str::upper($claimType)) ? ClaimType::PROFESSIONAL : ClaimType::INSTITUTIONAL,
                    'claim_insurance_type' => $insuranceType,
                ],
                [
                    'portal' => $portal,
                ]
            );
        }

        $this->info('CSV data processed and JSON file generated successfully.');

        return Command::SUCCESS;
    }
}
