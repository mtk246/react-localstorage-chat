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
        $auditables = Audit::with('user');
        $records = [];
        
        foreach ($auditables->get() as $audit) {
            array_push($records, [
                'id'          => \Crypt::encrypt($audit->id),
                'event'       => $audit->event,
                'date'        => $audit->created_at->format('d-m-Y h:i:s A'),
                'ip_address'  => $audit->ip_address,
                'module'      => $audit->auditable_type,
                'user'        => $audit->user,
                'url'         => $audit->url,
                'user_agent'  => $audit->user_agent,
            ]);
        }
        return response()->json($records, 200);
    }

    public function getAuditOne(Request $request)
    {
        try {
            $id = \Crypt::decrypt($request->id);
            $audit = Audit::with('user')->find($id);
            return ($audit) ? response()->json($audit, 200) : response()->json('Error audit not found', 404);
        } catch (\Exception $e) {
            return response()->json('Error wrong id', 404);
        }
    }
}
