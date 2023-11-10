<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Claims\ClaimTransmissionResponse;
use Illuminate\Console\Command;

final class FormatTransmissionResponse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'response:format';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Formats the response details field of the claim transmission response table';

    /** Execute the console command. */
    public function handle(): int
    {
        ClaimTransmissionResponse::query()
            ->get()
            ->each(function (ClaimTransmissionResponse $resp) {
                if ('string' === gettype($resp->response_details)) {
                    $details = json_decode($resp->response_details);
                    $resp->response_details = $details;
                    $resp->save();
                }
            });

        $this->info('Formatting completed successfully.');

        return Command::SUCCESS;
    }
}
