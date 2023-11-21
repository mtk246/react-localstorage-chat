<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Mail\LogNewDevice;
use App\Models\Device;
use App\Models\FailedLoginAttempt;
use App\Models\IpRestriction;
use App\Models\IpRestrictionMult;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Detection\MobileDetect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Events\User\LoginEvent;

/**
 * @todo change to protective programing pattern
 *
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
     * Maximum number of failed attempts when trying to authenticate to the application.
     *
     * @var int
     */
    protected $maxAttempts = 3;

    /**
     * Maximum user inactivity time in the mobile version of the application.
     *
     * @var int
     */
    protected $mobileDowntime = 1296000000;

    /**
     * Maximum user inactivity time in the web version of the application.
     *
     * @var int
     */
    protected $webDowntime = 3600000;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'checkToken', 'sendEmailCode']]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     summary="Login, make auth",
     *     description="Make Auth in app",
     *     tags={"Authentication"},
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
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *
     *                 example={"password": "helloworld","email": "admin@billing.com"}
     *             )
     *         )
     *     ),
     *
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
    public function login(LoginRequest $request, MobileDetect $deviceDetect): JsonResponse
    {
        $dataValidated = $request->validated();
        $dataValidated = $request->safe()->only(['email', 'password']);
        $dataValidated['email'] = strtolower($dataValidated['email']);

        /** @var User */
        $user = User::where('email', strtolower($dataValidated['email']))->first();

        if (!isset($user)) {
            return response()->json(['error' => __('Bad Credentials')], 401);
        }

        if ($this->checkIpIsRestricted($request->ip(), $user)) {
            return response()->json(['error' => __('You are not allowed to access this application')], 401);
        }

        if ($this->checkIsLogged($request, $deviceDetect)) {
            return response()->json(['error' => __('This user has a session active in other device')], 401);
        }

        if (null !== $user && (true == $user->isBlocked)) {
            return $this->sendLockoutResponse();
        }

        $token = auth('api')->attempt($dataValidated);

        if (!$token) {
            $this->incrementLoginAttempts($request);
            if ($user->failedLoginAttempts()->where('status', true)->count() == $this->maxAttempts) {
                return response()->json(['error' => __('You have entered bad credentials 3 times. If you enter bad credentials again your user will be blocked for security.')], 429);
            } elseif ($user->failedLoginAttempts()->where('status', true)->count() > $this->maxAttempts) {
                /* elimina la cantidad de intentos fallidos del usuario */
                $this->clearLoginAttempts($request);
                /* Se procede al bloqueo del usuario */
                $this->fireLockoutEvent($request);
                /* Se envia la respuesta de usuario bloqueado */
                return $this->sendLockoutResponse();
            } else {
                return response()->json(['error' => __('Bad Credentials')], 401);
            }
        }
        $this->clearLoginAttempts($request);
        if (isset($request->code)) {
            $device = Device::where([
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'type' => $deviceDetect->isMobile()
                    ? 'mobile.agent'
                    : 'web.agent',
                'status' => false,
            ])->first();

            if (isset($device)) {
                if ($request->code == $device->code_temp) {
                    $date = $device->updated_at->toString();
                    $now = now();
                    $difference = $now->diff($date);
                    if ($difference->i > 5) {
                        return response()->json(['error' => __('The validation code has expired. request a new code.')], 403);
                    }
                    $device->status = true;
                    $device->save();
                } else {
                    return response()->json(['error' => __('The validation code is incorrect. Please check and enter again.')], 403);
                }
            }
        }
        if ($this->checkNewDevice($user->id, $request->ip(), $request->userAgent(), $deviceDetect)) {
            return $this->loginNewDevice($user->id, $request->ip(), $request->userAgent(), $deviceDetect);
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->isLogged = true;
        $device = Device::where([
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'type' => $deviceDetect->isMobile()
                ? 'mobile.agent'
                : 'web.agent',
            'status' => true,
        ])->first();
        $device->last_login = $user->last_login;
        $device->save();
        $user->save();

        event(new LoginEvent($user, $dataValidated['password']));

        return $this->respondWithToken($token, $request->ip(), $request->userAgent());
    }

    public function checkIsLogged(LoginRequest $request, MobileDetect $deviceDetect): bool
    {
        $user = User::whereEmail(strtolower($request->input('email')))->first();
        $device = Device::where([
            'user_id' => $user->id,
            'type' => $deviceDetect->isMobile()
                ? 'mobile.agent'
                : 'web.agent',
            'status' => true,
        ])->first();

        return $user->isLogged
            && $device
            && $device->ip_address === $request->ip()
            && $device->user_agent !== $request->userAgent()
            && $device->last_login !== $user?->last_login;
    }

    /**
     * Get the authenticated User.
     *
     * @param Illuminate\Http\Request $request
     */

    /**
     * @OA\Get(
     *     path="/api/v1/auth/me",
     *     summary="me, get info about user authenticated",
     *     description="Get information of user authenticate",
     *     tags={"Authentication"},
     *     security={{"bearer_token":{}}},
     *
     *     @OA\Response(
     *        response="200",
     *        description="Model User with roles and permission",
     *     )
     * )
     */
    public function me(Request $request): JsonResponse
    {
        $user = Auth::user();

        $bC = $user->billing_company_id;
        if (!$bC) {
            $user = Auth::user()->load([
                'billingCompanies',
                'profile' => function ($query) {
                    $query->with(['socialMedias', 'addresses', 'contacts']);
                },
            ]);
        } else {
            $user = $user->load([
                'billingCompanies',
                'profile' => function ($query) use ($bC)  {
                    $query->with([
                        'socialMedias',
                        'addresses' => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        'contacts' => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                    ]);
                },
            ]);
        }

        $user->roles = $user->roles()->get();

        $perms = [];
        $perms_v2 = [];
        $menu_app = [
            'Claims Process' => [
                'Claims Management', 'Claim Rules Management', 'Payments Management', 'Patient Management',
                'Denial Management', 'Ledger Management',
            ],
            'Administration' => [
                'Health Care Professional Management', 'Insurance Management', 'Company Management',
                'Facility Management', 'Procedure Management', 'Diagnosis Management', 'Modifier Management',
                'User Management', 'Clearing House Management', 'Billing Company Management', 'Status Management',
            ],
            'Reports and statistics' => ['Reports'],
            'Tools' => [
                'File Manager', 'Web Browser', 'Sticky Notes', 'Messenger', 'Calculator', 'Widgets',
            ],
            'System' => [
                'Setting', 'Profile', 'Permission Management', 'Role Management',
                'Restriction by IP', 'Technical Support', 'Guidelines',
            ],
        ];
        foreach ($user->permissions->groupBy('module') as $module => $permissions) {
            $perms[strtolower($module)] = [];
            $perms[strtolower($module)]['create'] = false;
            $perms[strtolower($module)]['view'] = false;
            $perms[strtolower($module)]['show'] = false;
            $perms[strtolower($module)]['edit'] = false;
            $perms[strtolower($module)]['disable'] = false;
            $perms[strtolower($module)]['history'] = false;
            foreach ($permissions as $permission) {
                if (str_contains(strtolower($permission->name), 'manage permissions')) {
                    $perms[strtolower($module)]['history'] = true;
                    $perms[strtolower($module)]['create'] = true;
                    $perms[strtolower($module)]['view'] = true;
                    $perms[strtolower($module)]['show'] = true;
                    $perms[strtolower($module)]['edit'] = true;
                } elseif (str_contains(strtolower($permission->name), 'show profile')) {
                    $perms[strtolower($module)]['view'] = true;
                    $perms[strtolower($module)]['show'] = true;
                } elseif (str_contains(strtolower($permission->name), 'history')) {
                    $perms[strtolower($module)]['history'] = true;
                } elseif (str_contains(strtolower($permission->name), 'create')) {
                    $perms[strtolower($module)]['create'] = true;
                } elseif (str_contains(strtolower($permission->name), 'view')) {
                    $perms[strtolower($module)]['view'] = true;
                } elseif (str_contains(strtolower($permission->name), 'show')) {
                    $perms[strtolower($module)]['show'] = true;
                } elseif (str_contains(strtolower($permission->name), 'edit')) {
                    $perms[strtolower($module)]['edit'] = true;
                } elseif (str_contains(strtolower($permission->name), 'disable')) {
                    $perms[strtolower($module)]['disable'] = true;
                } else {
                    $perms[strtolower($module)][strtolower($permission->name)] = true;
                }
            }
        }
        if (auth()->user()->hasRole('billingmanager')) {
            $perms['my billing company management'] = $perms['billing company management'];
        }
        foreach ($menu_app as $clasif => $apps) {
            foreach ($apps as $app) {
                if (isset($perms[strtolower($app)])) {
                    if (auth()->user()->hasRole('billingmanager') && 'Billing Company Management' == $app) {
                        $perms_v2[$clasif]['My Billing Company Management'] = $perms['my billing company management'];
                    } else {
                        $perms_v2[$clasif][$app] = $perms[strtolower($app)];
                    }
                } else {
                    $perms_v2[$clasif][$app] = [
                        'create' => true,
                        'view' => true,
                        'show' => true,
                        'edit' => true,
                        'disable' => true,
                        'history' => true,
                    ];
                    $perms[strtolower($app)] = [
                        'create' => false,
                        'view' => true,
                        'show' => true,
                        'edit' => false,
                        'disable' => false,
                        'history' => false,
                    ];
                }
            }
        }
        if (auth()->user()->hasRole('billingmanager')) {
            unset($perms['billing company management']);
        }
        // unset($user['permissions']);
        $user->menu = $perms;
        $user->menu_by_category = $perms_v2;
        $now = new \DateTime(Carbon::now()->toString());
        $lastActivity = new \DateTime((string) $user->last_activity);
        if ('mr@ciph3r.co' == $user->email) {
            $user->inactivity_time = 120000 - ((\strtotime(Carbon::now()->toString()) - \strtotime((string) $user->last_activity)) * 1000);
        } else {
            $user->inactivity_time = $this->webDowntime - ((\strtotime(Carbon::now()->toString()) - \strtotime((string) $user->last_activity)) * 1000);
        }

        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param Illuminate\Http\Request $request
     */

    /**
     * @OA\Get(
     *     path="/api/v1/auth/logout",
     *     summary="logout, revoke auth",
     *     description="Make logout",
     *     tags={"Authentication"},
     *     security={{"bearer_token":{}}},
     *
     *     @OA\Response(
     *        response="200",
     *        description="Successfully logged out",
     *     )
     * )
     */
    public function logout(Request $request): JsonResponse
    {
        User::whereId(auth()->id())->update(['isLogged' => false]);
        auth()->logout();

        return response()->json(['message' => __('Successfully logged out')]);
    }

    /**
     * Refresh a token.
     *
     * @param Illuminate\Http\Request $request
     */

    /**
     * @OA\Get(
     *     path="/api/v1/auth/refresh-token",
     *     summary="refresh_token, refresh token",
     *     description="Refresh Token",
     *     tags={"Authentication"},
     *     security={{"bearer_token":{}}},
     *
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

    protected function checkIpIsRestricted(string $ip, User $user, bool $whiteList = true): bool
    {
        /** @var IpRestriction|null */
        $ipRestrictions = IpRestriction::query()
            ->where('billing_company_id', $user->billing_company_id)
            ->whereNull('deleted_at')
            ->with('ipRestrictionMults')
            ->get();

        if ($ipRestrictions->isEmpty()) {
            return false;
        }
        $result = $ipRestrictions->reduce(function (bool $carry, IpRestriction $ipRestriction) use ($ip, $user) {
            if ($carry) {
                return true;
            }
            return $ipRestriction->ipRestrictionMults->reduce(function (bool $carry, IpRestrictionMult $item) use ($ip) {
                if ($carry) {
                    return true;
                }

                $beginRange = ip2long($item->ip_beginning);
                $endRange = ip2long($item->ip_finish);
                $ip = ip2long($ip);

                return ($item->rank)
                    ? $ip >= $beginRange && $ip <= $endRange
                    : $ip === $beginRange;
            }, false);
        }, false);

        return ($whiteList) ? !$result : $result;
    }

    protected function respondWithToken(string $token, string $ip, string $os): JsonResponse
    {
        /**
         * @var $user User
         */
        $user = auth()->user();
        // User::whereId($user->id)->update(["isLogged" => true]);
        // $device = DeviceController::searchDeviceByIp($ip);

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
            'user' => $user->load(['billingCompanies', 'permits']),
            'access_token' => $token,
            'token_type' => 'bearer',
            'inactivity_time' => $this->webDowntime,
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    protected function checkNewDevice(int $user_id, string $ip_address, string $user_agent, MobileDetect $deviceDetect)
    {
        $device = Device::where([
            'user_id' => $user_id,
            'ip_address' => $ip_address,
            'user_agent' => $user_agent,
            'type' => $deviceDetect->isMobile()
                ? 'mobile.agent'
                : 'web.agent',
            'status' => true,
        ])->first();

        return (isset($device)) ? false : true;
    }

    protected function loginNewDevice(int $user_id, string $ip_address, string $user_agent, MobileDetect $deviceDetect)
    {
        $user = User::find($user_id);

        $code = Str::random(6);
        Device::updateOrCreate([
            'user_id' => $user->id,
            'ip_address' => $ip_address,
            'user_agent' => $user_agent,
            'type' => $deviceDetect->isMobile()
                ? 'mobile.agent'
                : 'web.agent',
            'status' => false,
        ], [
            'user_id' => $user->id,
            'ip_address' => $ip_address,
            'user_agent' => $user_agent,
            'code_temp' => $code,
            'status' => false,
        ]);

        \Mail::to($user->email)->send(
            new LogNewDevice(
                $user->first_name,
                $ip_address,
                $code,
                $user_agent
            )
        );

        return response()->json(['error' => __('You are trying to access from a new device. Enter the code sent to your email.')], 403);
    }

    public function checkToken()
    {
        try {
            $user = \JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => __('Token is Invalid')], 403);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => __('Token is Expired')], 401);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json(['status' => __('Token is Blacklisted')], 400);
            } else {
                return response()->json(['status' => __('Authorization Token not found')], 404);
            }
        }

        return response()->json(['status' => __('Token is valid')], 200);
    }

    protected function incrementLoginAttempts(Request $request)
    {
        $user = User::where('email', strtolower($request->email))->first();
        FailedLoginAttempt::create([
            'user_id' => $user->id,
        ]);
    }

    protected function clearLoginAttempts(Request $request)
    {
        $user = User::where('email', strtolower($request->email))->first();
        $user->failedLoginAttempts()->where(['status' => true])->update(['status' => false]);
    }

    protected function fireLockoutEvent(Request $request)
    {
        $user = User::where('email', strtolower($request->email))->first();
        $user->isBlocked = true;
        $user->save();
    }

    protected function sendLockoutResponse()
    {
        return response()->json(['error' => __('Your user has been blocked. Enter your user code or try again in 24 hours.')], 401);
    }

    public function sendEmailCode(Request $request, MobileDetect $deviceDetect): JsonResponse
    {
        try {
            $user = User::where('email', strtolower($request->email))->first();
            if ($this->checkNewDevice($user->id, $request->ip(), $request->userAgent(), $deviceDetect)) {
                $code = Str::random(6);
                Device::updateOrCreate([
                    'user_id' => $user->id,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'type' => $deviceDetect->isMobile()
                        ? 'mobile.agent'
                        : 'web.agent',
                    'status' => false,
                ], [
                    'user_id' => $user->id,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'code_temp' => $code,
                    'status' => false,
                ]);

                \Mail::to($user->email)->send(
                    new LogNewDevice(
                        $user->first_name,
                        $request->ip(),
                        $code,
                        $request->userAgent()
                    )
                );

                return response()->json(__('The new code has been sent.'), 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => __('Error, An error has occurred, please try again later')], 401);
        }
    }
}
