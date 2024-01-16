<?php

declare(strict_types=1);

namespace App\Http\Casts\Payments;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;

final class AddServicesToBachWrapper extends CastsRequest
{
    public function getPaymentId(): int
    {
        return $this->getInt('id');
    }

    public function getClaimsIds(): Collection
    {
        return $this->getCollect('claims');
    }

    public function getServicesSyncData(string $currency): Collection
    {
        return $this->castMany('services', ServiceWrapper::class)
            ->mapWithKeys(fn (ServiceWrapper $serviceWrapper) => [
                $serviceWrapper->getServiceId() => $serviceWrapper->getServiceData(
                    $currency,
                ),
            ]);
    }

    public function getServices(): Collection
    {
        return $this->castMany('services', ServiceWrapper::class);
    }
}
