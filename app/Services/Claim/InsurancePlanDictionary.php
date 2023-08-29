<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Models\ClearingHouse;
use App\Models\InsurancePlan;

abstract class InsurancePlanDictionary implements InsurancePlanDictionaryInterface
{
    protected $data;

    public function __construct(
        protected readonly ?InsurancePlan $insurance,
        protected readonly ?string $type,
        protected readonly ?ClearingHouse $clearingHouse,
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
        $jsonData = file_get_contents(database_path('data/claim/CPIDPayers.json'));
        $this->data = json_decode($jsonData, true);
    }
}
