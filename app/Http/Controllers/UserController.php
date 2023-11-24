<?php

namespace App\Http\Controllers;

use App\Actions\User\Recovery;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Enums\User\UserType;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\ImgProfileRequest;
use App\Http\Requests\RecoveryUserRequest;
use App\Http\Requests\SendRescuePassRequest;
use App\Http\Requests\SocialMediaProfileRequest;
use App\Http\Requests\UnlockUserRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\ValidateSearchRequest;
use App\Http\Resources\Enums\EnumResource;
use App\Http\Resources\Enums\TypeResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
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
     * @OA\Post(
     *     path="/api/v1/user",
     *     summary="Create Users, endpoint to create users",
     *     description="Create User",
     *     tags={"Users"},
     *     security={{"bearer_token":{}}},
     *
     *     @OA\RequestBody(
     *
     *         @OA\MediaType(
     *             mediaType="application/json",
     *
     *             @OA\Schema(
     *
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
     *
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
    public function createUser(UserCreateRequest $request, StoreUserAction $storeUser): JsonResponse
    {
        $rs = $storeUser->invoke($request->casted());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating user'), 400);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user/send-email-rescue-pass",
     *     summary="Rescue password,Solicitude email to rescue password",
     *     description="Solicitude email to rescue password",
     *     tags={"Users"},
     *
     *     @OA\RequestBody(
     *
     *         @OA\MediaType(
     *             mediaType="application/json",
     *
     *             @OA\Schema(
     *
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 example={"email": "hola@mundo.com"}
     *             )
     *         )
     *     ),
     *
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
        try {
            $rs = $this->userRepository->sendEmailToRescuePassword(strtolower($request->input('email')));

            if (is_null($rs)) {
                return response()->json(__('Error, user not found'), 403);
            }

            return ($rs) ? response()->json([], 204) : response()->json(__('Error, a error have occurred'), 404);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user/change-password/{token}",
     *     summary="Change Password, endpoint to change password to users",
     *     description="Change password users",
     *     tags={"Users"},
     *
     *     @OA\Parameter(
     *          name="token",
     *          required=true,
     *          in="path",
     *
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *     @OA\RequestBody(
     *
     *         @OA\MediaType(
     *             mediaType="application/json",
     *
     *             @OA\Schema(
     *
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"password": "12345678"}
     *             )
     *         )
     *     ),
     *
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
    public function changePassword(ChangePasswordRequest $request, $token): JsonResponse
    {
        try {
            $user = $this->getInfoToken($token);

            if (!$user) {
                return response()->json(__('Token is Expired'), 403);
            }

            $rs = $this->userRepository->changePassword($request, $token);

            if (is_null($rs)) {
                return response()->json(__('Token is Invalid'), 403);
            }

            return ($rs) ? response()->json([], 204) : response()->json(__('Error, a error have occurred'), 403);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function newToken(Request $request): JsonResponse
    {
        try {
            $rs = $this->userRepository->newToken($request->token_old);

            return ($rs) ? response()->json([], 204) : response()->json(__('Error, a error have occurred'), 403);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function getInfoToken(string $token)
    {
        try {
            $strData = \Crypt::decrypt($token);
            $dataSplit = explode('@#@#$', $strData);

            return User::where('token', $token)->where('email', $dataSplit[1])->first();
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function editUser(EditUserRequest $request, UpdateUserAction $updateUser, User $user): JsonResponse
    {
        $rs = $updateUser->invoke($request->casted(), $user);

        return $rs ? response()->json($rs) : response()->json(__('Error updating user'), 400);
    }

    /**
     * @param null $id
     */
    public function changeStatus(ChangeStatusRequest $request, $id = null): JsonResponse
    {
        try {
            if (is_null($id)) {
                $id = auth()->id();
            }

            $rs = $this->userRepository->changeStatus($request->input('status'), $id);

            return $rs ? response()->json([], 204) : response()->json(__('Error changing status'), 400);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function getAllUsers(Request $request): JsonResponse
    {
        $rs = $this->userRepository->getAllUsers();

        return response()->json($rs);
    }

    public function getServerAllUsers(Request $request): JsonResponse
    {
        return response()->json($this->userRepository->getServerAllUsers($request));
    }

    public function getOneUser(Request $request, User $user): JsonResponse
    {
        $rs = $this->userRepository->getOneUser($user);

        return $rs ? response()->json($rs) : response()->json(__('Error, user not found'), 404);
    }

    public function updateImgProfile(ImgProfileRequest $request): JsonResponse
    {
        $rs = $this->userRepository->updateImgProfile($request);

        return ($rs) ? response()->json($rs) : response()->json(__('Error updating image profile'), 400);
    }

    /**
     * @param Illuminate\Http\Request $request
     */
    public function getListSocialNetworks(): JsonResponse
    {
        $rs = $this->userRepository->getListSocialNetworks();

        return response()->json($rs);
    }

    /**
     * @param Illuminate\Http\Request $request
     */
    public function getListNameSuffix(): JsonResponse
    {
        $rs = $this->userRepository->getListNameSuffix();

        return response()->json($rs);
    }

    /**
     * @param Illuminate\Http\Request $request
     */
    public function getListGender(): JsonResponse
    {
        $rs = $this->userRepository->getListGender();

        return response()->json($rs);
    }

    /**
     * @param Illuminate\Http\Request $request
     */
    public function getList(Request $request): JsonResponse
    {
        $rs = $this->userRepository->getList($request);

        return response()->json($rs);
    }

    public function updateSocialMediaProfile(SocialMediaProfileRequest $request, int $id): JsonResponse
    {
        $rs = $this->userRepository->updateSocialMediaProfile($request->validated(), $id);

        return ($rs) ? response()->json($rs) : response()->json(__('Error updating social media profile'), 400);
    }

    public function recoveryUser(RecoveryUserRequest $request, Recovery $recovery): JsonResponse
    {
        $rs = $recovery->user($request->casted());

        return $rs ? response()->json($rs) : response()->json(__('Error, user not found'), 404);
    }

    public function changePasswordForm(ChangePasswordRequest $request): JsonResponse
    {
        $rs = $this->userRepository->changePasswordForm($request->input('password'));

        return $rs ? response()->json([], 204) : response()->json(__('Error updating password'), 400);
    }

    /**
     * @param string $usercode
     */
    public function unlockUser(UnlockUserRequest $request): JsonResponse
    {
        $rs = $this->userRepository->unlockUser($request);

        return $rs ? response()->json($rs) : response()->json(__('Error, wrong otp code'), 404);
    }

    public function searchBySsn(Request $request, string $ssn): JsonResponse
    {
        $rs = $this->userRepository->searchBySsn($ssn, $request->billing_company_id ?? null);

        return $rs ? response()->json($rs) : response()->json(__('Error, user not found'), 404);
    }

    /**
     * @param string $ssn
     */
    public function search(ValidateSearchRequest $request): JsonResponse
    {
        $rs = $this->userRepository->search($request);

        return ($rs) ? response()->json($rs) : response()->json(__('Error, User already exists for this email'), 403);
    }

    public function updateLang(Request $request)
    {
        $rs = $this->userRepository->updateLang($request->input('language'));

        return $rs ? response()->json($rs) : response()->json(__('Error updating language'), 400);
    }

    public function getListLangs()
    {
        $rs = $this->userRepository->getListLangs();

        return response()->json($rs);
    }

    public function getTypes()
    {
        return response()->json(
            new EnumResource(collect(UserType::cases()), TypeResource::class),
        );
    }

    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $rs = $this->userRepository->updatePassword($request->validated());

        return $rs ? response()->json($rs) : response()->json(__('Error current password incorrect'), 400);
    }
}
