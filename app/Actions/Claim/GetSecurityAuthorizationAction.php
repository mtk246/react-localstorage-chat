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
                    config('claim.connections.url_token'),
                    [
                        'client_id' => config('claim.connections.client_id'),
                        'client_secret' => config('claim.connections.client_secret'),
                        'grant_type' => 'client_credentials',
                    ]
                );
            $responseData = json_decode($response->body(), true);

            return isset($responseData['access_token']) ? $responseData['access_token'] : null;
        });
    }
}
