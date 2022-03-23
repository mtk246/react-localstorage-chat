<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * @OA\Info(title="Api Medical billing",version="1.0")
 *
 *  * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server",
 * )
 *
 * @OA\Tag(
 *     name="Authentication",
 *     description="API Endpoints of Authentication",
 * )
 */

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Maximum number of failed attempts when trying to authenticate to the application
     *
     * @var    integer
     */
    protected $maxAttempts = 3;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */

    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     summary="Login, make auth",
     *     description="Make Auth in app",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *
     *                 example={"password": "helloworld","email": "admin@billing.com"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="Model User with roles and permission",
     *     ),
     *     @OA\Response(
     *        response="401",
     *        description="User Unauthorized",
     *     ),
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $dataValidated = $request->validated();

        if ($this->checkIsLogged($request->input("email"))) {
            return response()->json("this user has a session active in other device", 401);
        }

        $user = User::where('email', $dataValidated["email"])->first();
        if ($user !== null && ($user->isBlocked == true)) {
            return response()->json(['error' => 'Your account is blocked. Please contact support for help.'], 401);
        }

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            /** elimina la cantidad de intentos fallidos del usuario y se procede al bloqueo del mismo */
            $this->clearLoginAttempts($request);

            $this->fireLockoutEvent($request);
            $user->isBlocked = true;
            $user->save();

            return $this->sendLockoutResponse($request);
        }

        $token = auth('api')->attempt($dataValidated);

        if (!$token) {
            $this->incrementLoginAttempts($request);
            return response()->json(['error' => 'Bad Credencials'], 401);
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->isLogged = true;
        $user->save();

        return $this->respondWithToken($token, $request->ip(), $request->userAgent());
    }

    public function checkIsLogged($email) {
        $user = User::whereEmail($email)->first();

        return $user->isLogged;
    }

    /**
     * Get the authenticated User.
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */

    /**
     * @OA\Get(
     *     path="/api/v1/auth/me",
     *     summary="me, get info about user authenticated",
     *     description="Get information of user authenticate",
     *     tags={"Authentication"},
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *        response="200",
     *        description="Model User with roles and permission",
     *     )
     * )
     */
    public function me(Request $request): JsonResponse
    {
        $user = User::whereId(auth()->id())->with([
            "roles",
            "permissions",
            "profile" => function ($query) {
                $query->with('socialMedias');
            }
        ])->first();

        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */

    /**
     * @OA\Get(
     *     path="/api/v1/auth/logout",
     *     summary="logout, revoke auth",
     *     description="Make logout",
     *     tags={"Authentication"},
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *        response="200",
     *        description="Successfully logged out",
     *     )
     * )
     */
    public function logout(Request $request): JsonResponse
    {
        User::whereId(auth()->id())->update(["isLogged" => false]);
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */

    /**
     * @OA\Get(
     *     path="/api/v1/auth/refresh-token",
     *     summary="refresh_token, refresh token",
     *     description="Refresh Token",
     *     tags={"Authentication"},
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *        response="200",
     *        description="response a bearer token",
     *     )
     * )
     */
    public function refresh(Request $request): JsonResponse
    {
        return response()->json(auth()->refresh());
    }

    /**
     * @param string $token
     * @param string $ip
     * @param string $os
     * @return JsonResponse
     */
    protected function respondWithToken(string $token,string $ip,string $os): JsonResponse
    {
        /**
         * @var $user User
         */
        $user = auth()->user();
        //User::whereId($user->id)->update(["isLogged" => true]);
        //$device = DeviceController::searchDeviceByIp($ip);

//        if( !$device ){
//            DeviceController::logNewDevice([
//                "email" => $user->email,
//                "ip"    => $ip,
//                "os"    => $os,
//                "code_temp" => Str::random(6),
//                "user_id"   => $user->id
//            ]);
//
//            User::whereId($user->id)->update([
//                "isBlocked" => true
//            ]);
//
//            return response()->json(
//                $token,
//                403
//            );
//        }
//        else{
//            if(!$device->status){
//                $ctrlDevice = new DeviceController();
//                $ctrlDevice->sendEmailNewDevice($user->email,$device->ip,$device->os,$device->code_temp);
//                User::whereId($user->id)->update([
//                    "isBlocked" => true
//                ]);
//
//                return response()->json(
//                    $token,
//                    403
//                );
//            }
//        }

        return response()->json([
            'user'         => $user->load("permissions")->load("roles"),
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
