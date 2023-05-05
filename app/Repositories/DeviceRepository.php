<?php

namespace App\Repositories;

use App\Models\Device;

class DeviceRepository
{
    public function allowDevice(string $code): ?bool
    {
        $device = Device::whereCodeTemp($code)->first();

        if (!is_null($device)) {
            $device->status = true;
            $device->save();

            return true;
        }

        return null;
    }
}
