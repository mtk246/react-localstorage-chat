<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceAllowRequest;
use App\Mail\LogNewDevice;
use App\Models\Device;
use App\Repositories\DeviceRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class DeviceController extends Controller
{
    private $deviceRepository;

    public function __construct()
    {
        $this->deviceRepository = new DeviceRepository();
    }

    /**
     * @return void
     */
    public static function logNewDevice(array $data)
    {
        $email = $data['email'];
        unset($data['email']);
        Device::updateOrCreate($data);
        (new DeviceController())->sendEmailNewDevice($email, $data['ip'], $data['os'], $data['code_temp']);
    }

    /**
     * @return Device|Builder|Model|object|null
     */
    public static function searchDeviceByIp(string $ip)
    {
        return Device::whereIp($ip)->first();
    }

    /**
     * @return void
     */
    public function sendEmailNewDevice(string $email, string $ip, string $os, string $code)
    {
        \Mail::to($email)->send(new LogNewDevice(
            $ip,
            $code,
            $os
        ));
    }

    public function allowDevice(DeviceAllowRequest $request): JsonResponse
    {
        $rs = $this->deviceRepository->allowDevice($request->input('code'));

        return $rs ? response()->json([], 204) : response()->json(__('Error, device not found or wrong code'), 404);
    }
}
