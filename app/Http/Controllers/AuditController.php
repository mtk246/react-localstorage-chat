<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuditController extends Controller
{
    public function getAuditAll(Request $request)
    {
        /** @var Audit Instances the class to fetch audit data */
        $auditables = new Audit;

        $records = [];
        foreach ($auditables->orderBy('id', 'desc')->take(20)->get() as $audit) {
            if ($audit->user_id !== null) {
                $model_user = $audit->user_type;
                $user = $model_user::find($audit->user_id);
                $name = ($user) ? ($user->firstName . ' ' . $user->lastName) : '';
                $email = ($user) ? $user->email : '';

                array_push($records, [
                    'id'     => \Crypt::encrypt($audit->id),
                    'status' => $audit->event,
                    'date'   => $audit->created_at->format('d-m-Y h:i:s A'),
                    'ip'     => $audit->ip_address,
                    'module' => $audit->auditable_type,
                    'users'  => "<b>Nombre:</b> $name<br><b>Email:</b> $email"
                ]);
            }
        }
        return response()->json($records, 200);
    }

    public function getAuditOne(Request $request)
    {
        try {
            $id = \Crypt::decrypt($request->id);
            $audit = Audit::find($id);
            return ($audit) ? response()->json($audit, 200) : response()->json('Error audit not found', 404);
        } catch (\Exception $e){
            return response()->json('Error wrong id', 404);
        }
    }
}
