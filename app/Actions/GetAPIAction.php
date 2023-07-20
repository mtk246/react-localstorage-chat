<?php

declare(strict_types=1);

namespace App\Actions;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

final class GetAPIAction
{
    public function getByNPI(string $npi)
    {
        return DB::transaction(function () use ($npi) {
            $client = new Client([
                'base_uri' => 'https://npiregistry.cms.hhs.gov/api',
            ]);

            $response = $client->request('GET', '?number='.$npi.'&version=2.1');
            $data = json_decode($response->getBody()->getContents());

            return $data?->results[0] ?? null;
        });
    }
}
