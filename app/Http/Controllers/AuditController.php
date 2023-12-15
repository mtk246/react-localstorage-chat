<?php

namespace App\Http\Controllers;

use App\Facades\Pagination;
use App\Models\Audit;
use App\Models\User;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function getAuditAll(Request $request)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $auditables = Audit::with(['user' => function ($query) {
                $query->with('profile');
            }]);
        } else {
            $auditables = Audit::whereHas('user', function ($query) use ($bC) {
                $query->whereHas('billingCompanies', function ($q) use ($bC) {
                    $q->where('billing_company_id', $bC);
                });
            })->with(['user' => function ($query) {
                $query->with('profile');
            }]);
        }
        $records = [];

        foreach ($auditables->get() as $audit) {
            array_push($records, [
                'id' => $audit->id,
                'event' => $audit->event,
                'date' => $audit->created_at->format('d-m-Y h:i:s A'),
                'ip_address' => $audit->ip_address,
                'module' => $audit->auditable_type,
                'user' => $audit->user,
                'url' => $audit->url,
                'user_agent' => $audit->user_agent,
            ]);
        }

        return response()->json($records, 200);
    }

    public function getServerAuditAll(Request $request)
    {
        $sortBy = $request->sortBy ?? 'id';
        $sortDesc = $request->sortDesc ?? false;
        $page = $request->page ?? 1;
        $itemsPerPage = $request->itemsPerPage ?? 5;
        $search = $request->search ?? '';

        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $records = Audit::with(['user' => function ($query) {
                $query->with('profile');
            }])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->paginate($itemsPerPage);
        } else {
            $records = Audit::whereHas('user', function ($query) use ($bC) {
                $query->whereHas('billingCompanies', function ($q) use ($bC) {
                    $q->where('billing_company_id', $bC);
                });
            })->with(['user' => function ($query) {
                $query->with('profile');
            }])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->paginate($itemsPerPage);
        }

        return response()->json([
            'pagination' => [
                'total' => $records->total(),
                'currentPage' => $records->currentPage(),
                'perPage' => $records->perPage(),
                'lastPage' => $records->lastPage(),
            ],
            'items' => $records->items(),
        ], 200);
    }

    public function getAudit(Request $request)
    {
        $sortBy = $request->sortBy ?? 'id';
        $sortDesc = $request->sortDesc ?? false;
        $page = $request->page ?? 1;
        $itemsPerPage = $request->itemsPerPage ?? 5;
        $search = $request->search ?? '';

        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $records = Audit::select([
                'id',
                'event',
                'created_at as date',
                'ip_address',
                'auditable_type as module',
                'auditable_id as module_id',
                'user_id',
                'user_type',
                'url',
                'user_agent',
            ])->with([
                'user' => function ($query) {
                    $query->with('profile');
                },
            ])->searchAudit($search)->sortAudit($sortBy, $sortDesc)->paginate($itemsPerPage);
        } else {
            $records = Audit::whereHas('user', function ($query) use ($bC) {
                $query->whereHas('billingCompanies', function ($q) use ($bC) {
                    $q->where('billing_company_id', $bC);
                });
            })->select([
                'id',
                'event',
                'created_at as date',
                'ip_address',
                'auditable_type as module',
                'auditable_id as module_id',
                'user_id',
                'user_type',
                'url',
                'user_agent',
            ])->with([
                'user' => function ($query) {
                    $query->with('profile');
                },
            ])->searchAudit($search)->sortAudit($sortBy, $sortDesc)->paginate($itemsPerPage);
        }

        return response()->json([
            'pagination' => [
                'total' => $records->total(),
                'currentPage' => $records->currentPage(),
                'perPage' => $records->perPage(),
                'lastPage' => $records->lastPage(),
            ],
            'items' => $records->items(),
        ], 200);
    }

    public function getAuditAllByUser(Request $request)
    {
        $auditables = Audit::where('user_id', $request->user_id)
            ->with(['user' => function ($query) {
                $query->with('profile');
            }]);
        $records = [];

        foreach ($auditables->get() as $audit) {
            array_push($records, [
                'id' => $audit->id,
                'event' => $audit->event,
                'date' => $audit->created_at->format('d-m-Y h:i:s A'),
                'ip_address' => $audit->ip_address,
                'module' => $audit->auditable_type,
                'user' => $audit->user,
                'url' => $audit->url,
                'user_agent' => $audit->user_agent,
            ]);
        }

        return response()->json($records, 200);
    }

    public function getAuditAllByBillingCompany(Request $request)
    {
        $bC = $request->billing_company_id;
        $auditables = Audit::whereHas('user', function ($query) use ($bC) {
            $query->whereHas('billingCompanies', function ($q) use ($bC) {
                $q->where('billing_company_id', $bC);
            });
        })->with(['user' => function ($query) {
            $query->with('profile');
        }]);
        $records = [];

        foreach ($auditables->get() as $audit) {
            array_push($records, [
                'id' => $audit->id,
                'event' => $audit->event,
                'date' => $audit->created_at->format('d-m-Y h:i:s A'),
                'ip_address' => $audit->ip_address,
                'module' => $audit->auditable_type,
                'user' => $audit->user,
                'url' => $audit->url,
                'user_agent' => $audit->user_agent,
            ]);
        }

        return response()->json($records, 200);
    }

    public function getAuditAllByEntity(Request $request, $entity, $id)
    {
        $model = toModel($entity);
        if ('claim-batch' === $entity) {
            $entity = 'claim-batch';
            $model = '\App\Models\Claims\ClaimBatch';
        } else if ('claim-rules' === $entity) {
            $entity = 'claim-rules';
            $model = '\App\Models\Claims\Rules';
        }
        $record = $model::find($id);

        if (isset($record)) {
            $auditables = Audit::query()
                ->where('url', 'like', '%/'.$entity.'/'.$id.'%')
                ->orWhere('url', 'like', '%/'.$entity.'/create')
                ->where('audits.created_at', $record->created_at)
                ->orWhere('url', 'like', '%/'.$entity)
                ->where('audits.created_at', $record->created_at)
                ->orWhere('url', 'like', '%/'.$entity.'/draft/'.$id)
                ->orWhere('url', 'like', '%/'.$entity.'/draft')
                ->where('audits.created_at', $record->created_at)
                ->orWhere('url', 'like', '%/'.$entity.'/check-eligibility/'.$id)
                ->orWhere('url', 'like', '%/'.$entity.'/draft-check-eligibility')
                ->where('audits.created_at', $record->created_at)
                ->orWhere('url', 'like', '%/'.$entity.'/verify-register/'.$id)
                ->orWhere('url', 'like', '%/'.$entity.'/draft-check-eligibility')
                ->where('audits.created_at', $record->created_at)
                ->orWhere('url', 'like', '%/'.$entity.'/change-status/'.$id)
                ->with(['user' => function ($query) {
                    $query->with('profile');
                }])
                ->when(
                    !empty($request->query('query')) && '{}' !== $request->query('query'),
                    fn ($query) => $query->search($request->query('query')),
                )
                ->when('user' === Pagination::sortBy(), function ($query) {
                    $query->select('audits.*')
                        ->join('users', 'audits.user_id', '=', 'users.id')
                        ->leftJoin('profiles', 'users.profile_id', '=', 'profiles.id')
                        ->orderBy('profiles.first_name', Pagination::sortDesc());
                }, function ($query) {
                    $query->orderBy(Pagination::sortBy(), Pagination::sortDesc());
                })
                ->paginate(Pagination::itemsPerPage());
        }

        return response()->json(isset($auditables) 
            ? [
                'data' => $auditables->items(),
                'numberOfPages' => $auditables->lastPage(),
                'count' => $auditables->total(),
            ]
            : null
        , 200);

        /*$records = [];

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
        }*/
    }

    public function rollbackAuditByEntity($audit, $entity, $id)
    {
        try {
            $model = Audit::find($audit);
            if ('created' == $model->event) {
                return response()->json(__('Error, unable to restore registry'), 404);
            }
            $auditable = $model->auditable;
            $newAuditable = $auditable->transitionTo($model, true);
            $newAuditable->save();

            return ($newAuditable) ? response()->json($newAuditable, 200) : response()->json(__('Error, audit not found'), 404);
        } catch (\Exception $e) {
            return response()->json(__('Error, wrong id'), 404);
        }
    }

    public function getAuditOne(Request $request)
    {
        try {
            $id = $request->id;
            $audit = Audit::with(['auditable', 'user' => function ($query) {
                $query->with('profile');
            }])->find($id);

            return ($audit) ? response()->json($audit, 200) : response()->json(__('Error, audit not found'), 404);
        } catch (\Exception $e) {
            return response()->json(__('Error, wrong id'), 404);
        }
    }
}
