<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceAllowRequest;
use App\Mail\LogNewDevice;
use App\Models\Device;
use App\Repositories\DeviceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    private $deviceRepository;

    public function __construct()
    {
        $this->deviceRepository = new DeviceRepository();
    }

    /**
     * @param array $data
     * @return void
     */
    public static function logNewDevice(array $data){
        $email = $data['email'];
        unset($data['email']);
        Device::updateOrCreate($data);
        (new DeviceController())->sendEmailNewDevice($email,$data['ip'],$data['os'],$data['code_temp']);
    }

    /**
     * @param string $ip
     * @return Device|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function searchDeviceByIp(string $ip){
        return Device::whereIp($ip)->first();
    }

    /**
     * @param string $email
     * @param string $ip
     * @param string $os
     * @param string $code
     * @return void
     */
    public function sendEmailNewDevice(string $email,string $ip,string $os,string $code){
        \Mail::to($email)->send(new LogNewDevice(
            $ip,
            $code,
            $os
        ));
    }

    /**
     * @param DeviceAllowRequest $request
     * @return JsonResponse
     */
    public function allowDevice(DeviceAllowRequest $request): JsonResponse
    {
        $rs = $this->deviceRepository->allowDevice($request->input("code"));

        return $rs ? response()->json([],204) : response()->json("device not found or wrong code",404);
    }
}
