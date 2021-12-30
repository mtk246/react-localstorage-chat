<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\SendRescuePassRequest;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 * @OA\Tag(
 *     name="Users",
 *     description="API Endpoints of Users",
 * )
 */

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

    /**
     * @OA\Post(
     *     path="/api/v1/user/",
     *     summary="Create Users, endpoint to create users",
     *     description="Create User",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                    property="password",
     *                    type="string"
     *                 ),
     *                 @OA\Property(
     *                    property="DBO",
     *                    type="date"
     *                 ),
     *                 @OA\Property(
     *                    property="sex",
     *                    type="char"
     *                 ),
     *                 @OA\Property(
     *                    property="firstName",
     *                    type="string"
     *                 ),
     *                 @OA\Property(
     *                    property="lastName",
     *                    type="char"
     *                 ),
     *                 @OA\Property(
     *                    property="middleName",
     *                    type="char"
     *                 ),
     *                 @OA\Property(
     *                    property="roles",
     *                    type="array",
     *                    items=@OA\Property(type="string")
     *                 ),
     *                 example={"name": "JessicaSmith","password": "12345678","email": "hola@mundo.com","DBO": "2021-12-31","sex":"F","firstName":"Jhon","lastName":"Due","middleName":"Due","roles":{"role1","role2"}}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *        response="201",
     *        description="Model User with roles and permission",
     *     ),
     *     @OA\Response(
     *        response="500",
     *        description="Exception",
     *     )
     * )
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

    /**
     * @OA\Post(
     *     path="/api/v1/user/send-email-rescue-pass",
     *     summary="Rescue password,Solicitude email to rescue password",
     *     description="Solicitude email to rescue password",
     *     security={{"bearer_token":{}}},
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 example={"email": "hola@mundo.com"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *        response="201",
     *        description="Rescue Email was sent",
     *     ),@OA\Response(
     *        response="403",
     *        description="Error, a error have occurred",
     *     ),
     *     @OA\Response(
     *        response="500",
     *        description="Exception",
     *     )
     * )
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

    /**
     * @OA\Post(
     *     path="/api/v1/user/change-password/{token}",
     *     summary="Change Password, endpoint to change password to users",
     *     description="Change password users",
     *     tags={"Users"},
     *     @OA\Parameter(
     *          name="token",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"password": "12345678"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="password changed",
     *     ),
     *     @OA\Response(
     *        response="500",
     *        description="Exception",
     *     )
     * )
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
