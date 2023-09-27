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
            $data = json_decode($response->getBody()->getContents())
                ?->results[0] ?? null;

            if ($data) {
                $data->addresses = array_map(function ($address) {
                    foreach ($address as $key => $value) {
                        if (in_array($key, ['address_1', 'city'])) {
                            $address->{$key} = upperCaseWords($value);
                        }
                    }

                    return $address;
                }, $data->addresses);
            }

            return $data;
        });
    }
}
