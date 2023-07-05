<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

final class GetSecurityAuthorizationAction
{
    public function invoke(): string
    {
        return DB::transaction(function () {
            $data = [
                'production' => [
                    'client_id' => 'OB5PKVzA2Y0ecMMfML9ZeB56GC3MRKDN',
                    'client_secret' => 'P1YmwbYAIOPMUfF9',
                    'url' => 'https://apigw.changehealthcare.com/apip/auth/v2/token',
                ],
                'sandbox' => [
                    'client_id' => '7ULJqHZb91y2zP3lgD4xQ3A3jACdmPTF',
                    'client_secret' => 'EBPadsDKoOuEoOWv',
                    'url' => 'https://sandbox.apigw.changehealthcare.com/apip/auth/v2/token',
                ],
            ];

            $response = Http::acceptJson()->post($data[env('CHANGEHC_CONNECTION', 'sandbox')]['url'], [
                'client_id' => $data[env('CHANGEHC_CONNECTION', 'sandbox')]['client_id'],
                'client_secret' => $data[env('CHANGEHC_CONNECTION', 'sandbox')]['client_secret'],
                'grant_type' => 'client_credentials',
            ]);

            return json_decode($response->body());
        });
    }
}
