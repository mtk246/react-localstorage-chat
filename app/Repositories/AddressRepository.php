<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Country;
use App\Models\State;

final class AddressRepository
{
    public function getListCountries(): array
    {
        return \DB::transaction(
            fn () => Country::query()->select('id', \DB::raw("CONCAT(code, ' - ', name) as name"))->get()->toArray()
        );
    }

    public function getListStates(array $data): array
    {
        return \DB::transaction(function () use ($data) {
            $query = State::select('id', 'code', \DB::raw("CONCAT(code, ' - ', name) as name"));

            if (isset($data['country_id'])) {
                $query->where('country_id', $data['country_id']);
            }

            return $query->get()->toArray();
        });
    }
}
