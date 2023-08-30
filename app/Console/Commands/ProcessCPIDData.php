<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

final class ProcessCPIDData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:process {filepath : Path to the CSV file}';

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

        $csvData = array_map('str_getcsv', file($csvFilePath));
        $header = array_shift($csvData);

        $payerIdIndex = array_search('Payer ID', $header);
        $payerNameIndex = array_search('Payer Name', $header);
        $claimTypeIndex = array_search('Claim Type', $header);
        $paperCPIDIndex = array_search('Paper CPID', $header);
        $CPIDIndex = array_search('CPID', $header);

        $processedData = [];

        foreach ($csvData as $row) {
            $payerId = $row[$payerIdIndex];
            $payerName = trim(str_replace('\t', ' ', $row[$payerNameIndex]));
            $claimType = $row[$claimTypeIndex];
            $paperCPID = $row[$paperCPIDIndex];
            $CPID = $row[$CPIDIndex];

            if (!isset($processedData[$payerId])) {
                $processedData[$payerId] = [
                    'Name' => [$payerName],
                    'Professional' => [
                        'PaperCPID' => '',
                        'CPID' => '',
                    ],
                    'Institutional' => [
                        'PaperCPID' => '',
                        'CPID' => '',
                    ],
                ];
            } elseif (!in_array($payerName, $processedData[$payerId]['Name'])) {
                $processedData[$payerId]['Name'][] = $payerName;
            }

            $processedData[$payerId][$claimType]['PaperCPID'] = $paperCPID;
            $processedData[$payerId][$claimType]['CPID'] = $CPID;
        }

        $outputFilePath = database_path('data/ClearingHouse/ChangeHC-Payers.json');
        file_put_contents($outputFilePath, json_encode($processedData, JSON_PRETTY_PRINT));

        $this->info('CSV data processed and JSON file generated successfully.');

        return Command::SUCCESS;
    }
}
