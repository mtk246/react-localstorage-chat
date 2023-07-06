<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

final class GetSecurityAuthorizationAction
{
    public function invoke(): ?string
    {
        return DB::transaction(function () {
            $response = Http::acceptJson()
                ->post(
                    config('claim.connections')[env('CHANGEHC_CONNECTION', 'sandbox')]['authorization']['url'],
                    config('claim.connections')[env('CHANGEHC_CONNECTION', 'sandbox')]['authorization']['body']
                );

            return json_decode($response->body());
        });
    }
}
