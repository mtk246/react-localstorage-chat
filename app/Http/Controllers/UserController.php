<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\ImgProfileRequest;
use App\Http\Requests\RecoveryUserRequest;
use App\Http\Requests\SendRescuePassRequest;
use App\Http\Requests\UserCreateRequest;
use App\Mail\RecoveryUserMail;
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
            $data = [
                "dataset_name" => "Create user",
                "description"  => "creation a new user",
                "machine_used" => $request->ip(),
                "start_date"   => now(),
                "end_date"     => now(),
                "location"     => $request->ip(),
                "time"         => now()->toTimeString(),
            ];

            if( $request->has('company-billing') ){
                if( !$this->userRepository->checkCompanyBilling($request->input('company-billing')) ){
                    return response()->json("Error company billing dont existent",403);
                }
            }

            /** @var  $user User*/
            $user = $this->userRepository->create($request);
            //MetadataController::saveLogAuditory($data,auth()->user()->id,null);

            return response()->json($user->load("roles"),201);
        }catch (\Exception $e){
            return response()->json($e->getMessage(),500);
        } catch (\Throwable $e) {
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
            $data = [
                "dataset_name" => "send email recover password",
                "description"  => "solicitude email to recover password",
                "machine_used" => $request->ip(),
                "start_date"   => now(),
                "end_date"     => now(),
                "location"     => $request->ip(),
                "time"         => now()->toTimeString(),
            ];

            $rs = $this->userRepository->sendEmailToRescuePassword($request->input("email"));
            MetadataController::saveLogAuditory($data,null,$request->input("email"));

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
            $user = $this->getInfoToken($token);

            if(!$user){
                return response()->json("token expired",403);
            }

            $data = [
                "dataset_name" => "change password",
                "description"  => "user change password",
                "machine_used" => $request->ip(),
                "start_date"   => now(),
                "end_date"     => now(),
                "location"     => $request->ip(),
                "time"         => now()->toTimeString(),
            ];

            $rs = $this->userRepository->changePassword($request,$token);

            MetadataController::saveLogAuditory($data,$user->id,null);

            if(is_null($rs)) return response()->json("Error, token not exist",403);

            return ($rs) ? response()->json([],204) : response()->json("Error, a error have occurred",403);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }

    public function getInfoToken(string $token){
        try{
            $strData = \Crypt::decrypt($token);
            $dataSplit = explode("@#@#$",$strData);
            return User::where("token",$token)->where("email",$dataSplit[1])->first();
        }catch(\Exception $exception){
            return false;
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

            $data = [
                "dataset_name" => "edit user",
                "description"  => "updating info user",
                "machine_used" => $request->ip(),
                "start_date"   => now(),
                "end_date"     => now(),
                "location"     => $request->ip(),
                "time"         => now()->toTimeString(),
            ];


            $rs = $this->userRepository->editUser($request,$id);

            MetadataController::saveLogAuditory($data,auth()->user()->id,null);

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

            $data = [
                "dataset_name" => "change status",
                "description"  => "change status users",
                "machine_used" => $request->ip(),
                "start_date"   => now(),
                "end_date"     => now(),
                "location"     => $request->ip(),
                "time"         => now()->toTimeString(),
            ];

            $rs = $this->userRepository->changeStatus($request->input("available"),$id);

            MetadataController::saveLogAuditory($data,auth()->user()->id,null);

            return $rs ? response()->json([],204) : response()->json("error changing status",400);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }

    /**
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function getAllUsers(Request $request): JsonResponse
    {
        $data = [
            "dataset_name" => "get all users",
            "description"  => "get all users",
            "machine_used" => $request->ip(),
            "start_date"   => now(),
            "end_date"     => now(),
            "location"     => $request->ip(),
            "time"         => now()->toTimeString(),
        ];

        $rs = $this->userRepository->getAllUsers();

        MetadataController::saveLogAuditory($data,auth()->user()->id,null);
        return response()->json($rs);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function getOneUser(Request $request,int $id): JsonResponse
    {
        $data = [
            "dataset_name" => "get all users",
            "description"  => "get all users",
            "machine_used" => $request->ip(),
            "start_date"   => now(),
            "end_date"     => now(),
            "location"     => $request->ip(),
            "time"         => now()->toTimeString(),
        ];

        $rs = $this->userRepository->getOneUser($id);

        MetadataController::saveLogAuditory($data,auth()->user()->id,null);

        return $rs ? response()->json($rs) : response()->json("user not found",404);
    }

    /**
     * @param ImgProfileRequest $request
     * @return JsonResponse
     */
    public function updateImgProfile(ImgProfileRequest $request): JsonResponse
    {
        $rs = $this->userRepository->updateImgProfile($request);

        return ($rs) ? response()->json($rs) : response()->json("error updating image profile",400);
    }

    /**
     * @param RecoveryUserRequest $request
     * @return JsonResponse
     */
    public function recoveryUser(RecoveryUserRequest $request): JsonResponse
    {
        $rs = $this->userRepository->recoveryUser($request->input("email"));

        return $rs ? response()->json([],204) : response()->json("Error user not found",404);
    }

    /**
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePasswordForm(ChangePasswordRequest $request): JsonResponse
    {
        $rs = $this->userRepository->changePasswordForm($request->input("password"));

        return $rs ? response()->json([],204) : response()->json("Error updating password",400);
    }

    /**
     * @param string $ssn
     * @return JsonResponse
     */
    public function searchBySsn(string $ssn): JsonResponse
    {
        $rs = $this->userRepository->searchBySsn($ssn);

        return $rs ? response()->json($ssn) : response()->json("user not found",404);
    }
}
