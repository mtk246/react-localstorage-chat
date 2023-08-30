<?php

declare(strict_types=1);

namespace App\Services\ClearingHouse;

use App\Enums\ClearingHouse;

final class ChangeHCAPI extends ClearingHouseAPI
{
    protected $clearingHouse = ClearingHouse::CHANGE;
    protected $data;

    protected function setConfigData(): void
    {
        $jsonData = file_get_contents(database_path('data/ClearingHouse/' . $this->clearingHouse->getFile()));
        $this->data = json_decode($jsonData, true);
    }
}
