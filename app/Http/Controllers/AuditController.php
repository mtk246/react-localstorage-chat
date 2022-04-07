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
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $auditables = Audit::with(['user' => function ($query) {
                $query->with("profile");
            }]);
        } else {
            $auditables = Audit::whereHas("user", function ($query) use ($bC) {
                    $query->whereHas("billingCompanies", function ($q) use ($bC) {
                        $q->where('billing_company_id', $bC);
                    });
                })->with(['user' => function ($query) {
                $query->with("profile");
            }]);
        }
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

    public function getAuditAllByUser(Request $request)
    {
        $auditables = Audit::where('user_id', $request->user_id)
            ->with(['user' => function ($query) {
            $query->with("profile");
        }]);
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

    public function getAuditAllByBillingCompany(Request $request)
    {
        $bC = $request->billing_company_id;
        $auditables = Audit::whereHas("user", function ($query) use ($bC) {
                $query->whereHas("billingCompanies", function ($q) use ($bC) {
                    $q->where('billing_company_id', $bC);
                });
            })->with(['user' => function ($query) {
            $query->with("profile");
        }]);
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
            $audit = Audit::with(['user' => function ($query) {
                $query->with("profile");
            }])->find($id);
            return ($audit) ? response()->json($audit, 200) : response()->json('Error audit not found', 404);
        } catch (\Exception $e) {
            return response()->json('Error wrong id', 404);
        }
    }
}
