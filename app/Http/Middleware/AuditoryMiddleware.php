<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuditoryMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $data = $request->header('extra-data');

        $data = json_decode($data,true);

        if(
            !(array_key_exists("mac_machine",$data) && !empty($data["mac_machine"])) &&
            !(array_key_exists("location",$data) && !empty($data["location"])) &&
            !(array_key_exists("machine_used",$data) && !empty($data["machine_used"]))
        ){
            return response()->json("missing data of auditory",401);
        }
        return $next($request);
    }
}
