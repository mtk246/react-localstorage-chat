<?php

declare(strict_types=1);

namespace App\Services\ClearingHouse;

use App\Models\InsurancePlan;

abstract class ClearingHouseAPI implements ClearingHouseAPIInterface
{
    protected $data;

    public function __construct(
        protected readonly ?InsurancePlan $insurance,
        protected readonly ?string $type,
    ) {
        $this->setConfigData();
    }

    public function getCPIDByPayerID(string $payerID, string $type): ?string
    {
        if (isset($this->data[$payerID])) {
            return $this->data[$payerID][$type];
        } else {
            return null;
        }
    }

    protected function setConfigData(): void
    {
        /** @todo Aplicar consulta para todos los files .json. Recorer todos los ClearingHouseEnums */
        $jsonData = file_get_contents(database_path('data/ClearingHouse/ChangeHC-Payers.json'));
        $this->data = json_decode($jsonData, true);
    }
}
