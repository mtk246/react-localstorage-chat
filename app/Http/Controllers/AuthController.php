<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\MetadataController;
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
     * @return \Illuminate\Http\JsonResponse
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
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $timeInit = microtime(true);

        $dataValidated = $request->validated();

        $data = [
            "dataset_name" => "LOGIN",
            "description"  => "making login",
            "machine_used" => $request->ip(),
            "start_date"   => now(),
            "end_date"     => now(),
            "location"     => $request->ip(), 
        ];

        if( !$token = auth()->attempt($dataValidated) ){
            $timeEnd = microtime(true);
            $executionTime = ($timeEnd - $timeInit) / 60;
            $data['time'] = $executionTime;
            MetadataController::saveLogAuditory($data,null,$request->input("email"));
            return response()->json(['error' => 'Bad Credencials'], 401);
        }

        $timeEnd = microtime(true);
        $executionTime = ($timeEnd - $timeInit) / 60;
        $data['time']  = $executionTime;
        MetadataController::saveLogAuditory($data,null,$request->input("email"));
        
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
    public function me(Request $request): \Illuminate\Http\JsonResponse
    {
        $timeInit = microtime(true);
        $user = auth()->user()->load("roles")->load("permissions");
        
        $data = [
            "dataset_name" => "Get me",
            "description"  => "Get information user authenticated",
            "machine_used" => $request->ip(),
            "start_date"   => now(),
            "end_date"     => now(),
            "location"     => $request->ip(), 
        ];
        
        $timeEnd = microtime(true);
        $executionTime = ($timeEnd - $timeInit) / 60;
        $data['time']  = $executionTime;
        MetadataController::saveLogAuditory($data,$user->id,null);

        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        $timeInit = microtime(true);
        $data = [
            "dataset_name" => "Logout",
            "description"  => "exit from app",
            "machine_used" => $request->ip(),
            "start_date"   => now(),
            "end_date"     => now(),
            "location"     => $request->ip(), 
        ];
        
        $timeEnd = microtime(true);
        $executionTime = ($timeEnd - $timeInit) / 60;
        $data['time']  = $executionTime;
        MetadataController::saveLogAuditory($data,auth()->user()->id,null);
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
    public function refresh(Request $request): \Illuminate\Http\JsonResponse
    {
        $timeInit = microtime(true);
        $data = [
            "dataset_name" => "Refresh Token",
            "description"  => "Refresh token authentication",
            "machine_used" => $request->ip(),
            "start_date"   => now(),
            "end_date"     => now(),
            "location"     => $request->ip(), 
        ];
        
        $timeEnd = microtime(true);
        $executionTime = ($timeEnd - $timeInit) / 60;
        $data['time']  = $executionTime;
        MetadataController::saveLogAuditory($data,auth()->user()->id,null);
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(string $token): \Illuminate\Http\JsonResponse
    {
        /**
         * @var $user User
         */
        $user = auth()->user();
        return response()->json([
            'user'         => $user->load("permissions")->load("roles"),
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
