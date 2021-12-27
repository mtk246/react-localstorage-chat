<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\SendRescuePassRequest;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * @param UserCreateRequest $request
     * @return JsonResponse
     */
    public function createUser(UserCreateRequest $request): JsonResponse
    {
        try{
            /** @var  $user User*/
            $user = $this->userRepository->create($request);

            return response()->json($user->load("roles"),201);
        }catch (\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /**
     * @param SendRescuePassRequest $request
     * @return JsonResponse
     */
    public function sendEmailRescuePass(SendRescuePassRequest $request): JsonResponse
    {
        try{
            $rs = $this->userRepository->sendEmailToRescuePassword($request->input("email"));

            if(is_null($rs)) return response()->json("User not found",403);

            return ($rs) ? response()->json("Rescue Email was sent") : response()->json("Error, a error have occurred",403);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }

    /**
     * @param ChangePasswordRequest $request
     * @param $token
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request,$token): JsonResponse
    {
        try{
            $rs = $this->userRepository->changePassword($request,$token);

            if(is_null($rs)) return response()->json("Error, token not exist",403);

            return ($rs) ? response()->json("Password changed successfully") : response()->json("Error, a error have occurred",403);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }
}
