<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\SendRescuePassRequest;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Exception;

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
     *     path="/api/v1/user",
     *     summary="Create Users, endpoint to create users",
     *     description="Create User",
     *     tags={"Users"},
     *     security={{"bearer_token":{}}},
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
     *                 example={"name": "JessicaSmith","password": "12345678","email": "hola@mundo.com","DBO": "2021-12-31","sex":"F","firstName":"Jhon","lastName":"Due","middleName":"Due","roles":{"BILLER","COLLECTOR"}}
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

            return ($rs) ? response()->json([],204) : response()->json("Error, a error have occurred",404);
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

            return ($rs) ? response()->json([],204) : response()->json("Error, a error have occurred",403);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }

    /**
     * @param EditUserRequest $request
     * @param null $id
     * @return JsonResponse
     */
    public function editUser(EditUserRequest $request,$id=null): JsonResponse
    {
        try{

            if(is_null($id)) $id = auth()->id();

            $rs = $this->userRepository->editUser($request,$id);

            return $rs ? response()->json($rs) : response()->json("error updating user",400);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }

    /**
     * @param ChangeStatusRequest $request
     * @param null $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusRequest $request,$id=null): JsonResponse
    {
        try{
            if(!is_null($id)) $id = auth()->id();

            $data = $request->input("available");

            $rs = $this->userRepository->changeStatus($data,$id);

            return $rs ? response()->json([],204) : response()->json("error changing status",400);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function getAllUsers(): JsonResponse
    {
        return response()->json($this->userRepository->getAllUsers());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneUser(int $id): JsonResponse
    {
        $rs = $this->userRepository->getOneUser($id);
        return $rs ? response()->json($rs) : response()->json("user not found",404);
    }
}
