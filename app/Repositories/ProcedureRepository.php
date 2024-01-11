<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Facades\Pagination;
use App\Http\Resources\Procedure\ListModifierResource;
use App\Models\Company;
use App\Models\Diagnosis;
use App\Models\Discriminatory;
use App\Models\Gender;
use App\Models\InsuranceCompany;
use App\Models\InsuranceLabelFee;
use App\Models\InsurancePlan;
use App\Models\InsuranceType;
use App\Models\MacLocality;
use App\Models\Modifier;
use App\Models\Procedure;
use App\Models\ProcedureConsideration;
use App\Models\ProcedureFee;
use App\Models\PublicNote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Meilisearch\Endpoints\Indexes;

class ProcedureRepository
{
    /**
     * @return Procedure|Model
     */
    public function createProcedure(array $data)
    {
        try {
            DB::beginTransaction();
            $procedure = Procedure::create([
                'code' => $data['code'],
                'start_date' => $data['start_date'] ?? null,
                'end_date' => $data['end_date'] ?? null,
                'short_description' => $data['short_description'],
                'description' => $data['description'],
                'type' => $data['type'],
                'clasifications' => collect($data['clasifications'])->filter()->toArray(),
            ]);

            if (isset($data['specific_insurance_company']) && isset($data['insurance_companies'])) {
                if ($data['specific_insurance_company']) {
                    $procedure->insuranceCompanies()->sync($data['insurance_companies']);
                }
            }

            if (isset($data['mac_localities'])) {
                foreach ($data['mac_localities'] as $macL) {
                    $macLocality = MacLocality::where([
                        'mac' => $macL['mac'],
                        'locality_number' => $macL['locality_number'],
                        'state' => $macL['state'],
                        'fsa' => $macL['fsa'],
                        'counties' => $macL['counties'],
                    ])->first();
                    if (isset($macLocality)) {
                        /* Attach macLocality to procedure */
                        $procedure->macLocalities()->attach($macLocality->id, ['modifier_id' => $macL['modifier_id'] ?? null]);
                    }
                    foreach ($macL['procedure_fees'] as $procedureFees => $value) {
                        if (isset($value)) {
                            /** insuranceType == Medicare */
                            $insuranceLabelFeesMedicare = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                                $query->whereDescription('Medicare');
                            })->get();

                            foreach ($insuranceLabelFeesMedicare as $insuranceLabelFeeMedicare) {
                                $field = str_replace(' ', '_', strtolower($insuranceLabelFeeMedicare->description));
                                if ($procedureFees == $field) {
                                    ProcedureFee::updateOrCreate([
                                        'insurance_label_fee_id' => $insuranceLabelFeeMedicare->id,
                                        'procedure_id' => $procedure->id,
                                        'mac_locality_id' => $macLocality->id,
                                    ], [
                                        'fee' => $value,
                                    ]);
                                }
                            }

                            /** insuranceType == Medicaid */
                            $insuranceLabelFeesMedicaid = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                                $query->whereDescription('Medicaid');
                            })->get();

                            foreach ($insuranceLabelFeesMedicaid as $insuranceLabelFeeMedicaid) {
                                $field = str_replace(' ', '_', strtolower($insuranceLabelFeeMedicaid->description));
                                if ($procedureFees == $field) {
                                    ProcedureFee::updateOrCreate([
                                        'insurance_label_fee_id' => $insuranceLabelFeeMedicaid->id,
                                        'procedure_id' => $procedure->id,
                                        'mac_locality_id' => $macLocality->id,
                                    ], [
                                        'fee' => $value,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

            if (isset($data['procedure_considerations'])) {
                if (isset($data['procedure_considerations']['gender_id']) &&
                    isset($data['procedure_considerations']['age_init']) &&
                    isset($data['procedure_considerations']['discriminatory_id'])) {
                    $considetation = ProcedureConsideration::create([
                        'procedure_id' => $procedure->id,
                        'gender_id' => $data['procedure_considerations']['gender_id'],
                        'age_init' => $data['procedure_considerations']['age_init'],
                        'age_end' => $data['procedure_considerations']['age_end'] ?? null,
                        'age_type' => $data['procedure_considerations']['age_type'] ?? 1,
                        'discriminatory_id' => $data['procedure_considerations']['discriminatory_id'],
                        'claim_note' => $data['procedure_considerations']['claim_note'] ?? false,
                        'supervisor' => $data['procedure_considerations']['supervisor'] ?? false,
                        'authorization' => $data['procedure_considerations']['authorization'] ?? false,
                    ]);

                    $considetation->frecuentDiagnoses()->sync($data['procedure_considerations']['frequent_diagnoses'] ?? []);
                    $considetation->frecuentModifiers()->sync($data['procedure_considerations']['frequent_modifiers'] ?? []);
                }
            }

            if (isset($data['modifiers'])) {
                $procedure->modifiers()->sync($data['modifiers']);
            }

            if (isset($data['diagnoses'])) {
                $procedure->diagnoses()->sync($data['diagnoses']);
            }

            if (isset($data['note'])) {
                PublicNote::create([
                    'publishable_type' => Procedure::class,
                    'publishable_id' => $procedure->id,
                    'note' => $data['note'],
                ]);
            }

            DB::commit();

            return $procedure;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * @return Procedure[]|Collection
     */
    public function getAllProcedures()
    {
        $procedures = Procedure::with([
            'publicNote',
        ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();

        return is_null($procedures) ? null : $procedures;
    }

    public function getServerAllProcedures(Request $request)
    {
        $data = Procedure::search(
            $request->query('query', ''),
            function (Indexes $searchEngine, string $query, array $options) use ($request) {
                $config = config('scout.meilisearch.index-settings.'.Procedure::class);

                if (isset($request->sortBy) && in_array($request->sortBy, $config['sortableAttributes'])) {
                    $options['sort'] = [$request->sortBy.':'.Pagination::sortDesc()];
                }

                if (isset($request->filter)) {
                    $options['filter'] = $request->filter;
                }

                return $searchEngine->search($query, $options);
            }
        )->paginate(Pagination::itemsPerPage());

        return response()->json([
            'data' => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count' => $data->total(),
        ], 200);
    }

    /**
     * @return Procedure|Builder|Model|object|null
     */
    public function getOneProcedure(int $id)
    {
        $procedure = Procedure::whereId($id)->with([
            'publicNote',
            'procedureCosiderations' => function ($query) {
                $query->with([
                    'gender',
                    'discriminatory',
                    'frecuentDiagnoses',
                    'frecuentModifiers',
                ]);
            },
            'insuranceCompanies',
            'diagnoses',
            'modifiers',
        ])->first();

        $procedure->mac_localities = $procedure->macLocalities()
            ->with(['procedureFees' => function ($q) use ($id) {
                $q->where('procedure_id', $id)->with('insuranceLabelFee');
            }])
            ->paginate();

        return !is_null($procedure) ? $procedure : null;
    }

    /**
     * @param int $id
     *
     * @return Procedure|Builder|Model|object|null
     */
    public function getPriceOfProcedure(Request $request)
    {
        if (isset($request->procedure_id)) {
            $id = $request->procedure_id;
            $filters = [];

            if (isset($request->mac)) {
                $filters['mac'] = $request->mac;
            }
            if (isset($request->locality_number)) {
                $filters['locality_number'] = $request->locality_number;
            }
            if (isset($request->state)) {
                $filters['state'] = $request->state;
            }
            if (isset($request->fsa)) {
                $filters['fsa'] = $request->fsa;
            }
            if (isset($request->counties)) {
                $filters['counties'] = $request->counties;
            }
            if (isset($request->insurance_label_fee_id)) {
                $label_fee = InsuranceLabelFee::find($request->insurance_label_fee_id);
            }
            $procedure = Procedure::whereId($id)->with([
                'macLocalities' => function ($query) use ($id, $filters) {
                    $query->where($filters)->with(['procedureFees' => function ($q) use ($id) {
                        $q->where('procedure_id', $id)->with('insuranceLabelFee');
                    }]);
                },
            ])->first();

            if ($procedure->macLocalities->isNotEmpty()) {
                $macLocality = $procedure->macLocalities->first();
                $labelFee = $macLocality->procedureFees()->where('insurance_label_fee_id', $label_fee->id)->first();

                return [
                    'fee' => $labelFee->fee ?? '',
                    'insurance_label_fee_id' => $labelFee->insurance_label_fee_id ?? null,
                    'insurance_label_fee' => $labelFee->insuranceLabelFee->description ?? '',
                    'created_at' => $labelFee->created_at ?? null,
                    'updated_at' => $labelFee->updated_at ?? null,
                ];
            }
        }

        return null;
    }

    /**
     * @return Procedure|Builder|Model|object|null
     */
    public function getByCode(string $code)
    {
        $proID = Procedure::whereCode($code)->first();
        $id = $proID->id ?? null;
        $procedure = Procedure::whereId($id)->with([
            'publicNote',
            'procedureCosiderations',
            'insuranceCompanies',
            'diagnoses',
            'modifiers',
            'macLocalities' => function ($query) use ($id) {
                $query->with(['procedureFees' => function ($q) use ($id) {
                    $q->where('procedure_id', $id)->with('insuranceLabelFee');
                }]);
            },
        ])->first();

        return !is_null($procedure) ? $procedure : null;
    }

    /**
     * @return Procedure|Builder|Model|object|null
     */
    public function updateProcedure(array $data, Procedure $procedure)
    {
        try {
            DB::beginTransaction();

            $procedure->update([
                'code' => $data['code'],
                'start_date' => $data['start_date'] ?? null,
                'end_date' => $data['end_date'] ?? null,
                'short_description' => $data['short_description'],
                'description' => $data['description'],
                'type' => $data['type'],
                'clasifications' => collect($data['clasifications'])->filter()->toArray(),
            ]);

            $procedure->insuranceCompanies()->sync(
                isset($data['specific_insurance_company']) && $data['specific_insurance_company'] && isset($data['insurance_companies'])
                    ? $data['insurance_companies']
                    : []
            );

            if (isset($data['mac_localities'])) {
                /* Delete mac localities */
                $procedure->macLocalities()->detach();
                $procedure->procedureFees()->delete();
                /* update or create new mac localities */
                foreach ($data['mac_localities'] as $macL) {
                    $macLocality = MacLocality::where([
                        'mac' => $macL['mac'],
                        'locality_number' => $macL['locality_number'],
                        'state' => $macL['state'],
                        'fsa' => $macL['fsa'],
                        'counties' => $macL['counties'],
                    ])->first();
                    if (isset($macLocality)) {
                        /* Attach macLocality to procedure */
                        $procedure->macLocalities()->attach($macLocality->id, ['modifier_id' => $macL['modifier_id'] ?? null]);
                    }

                    foreach ($macL['procedure_fees'] as $procedureFees => $value) {
                        if (isset($value)) {
                            /** insuranceType == Medicare */
                            $insuranceLabelFeesMedicare = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                                $query->whereDescription('Medicare');
                            })->get();

                            foreach ($insuranceLabelFeesMedicare as $insuranceLabelFeeMedicare) {
                                $field = str_replace(' ', '_', strtolower($insuranceLabelFeeMedicare->description));
                                if ($procedureFees == $field) {
                                    ProcedureFee::updateOrCreate([
                                        'insurance_label_fee_id' => $insuranceLabelFeeMedicare->id,
                                        'procedure_id' => $procedure->id,
                                        'mac_locality_id' => $macLocality->id,
                                    ], [
                                        'fee' => $value,
                                    ]);
                                }
                            }

                            /** insuranceType == Medicaid */
                            $insuranceLabelFeesMedicaid = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                                $query->whereDescription('Medicaid');
                            })->get();

                            foreach ($insuranceLabelFeesMedicaid as $insuranceLabelFeeMedicaid) {
                                $field = str_replace(' ', '_', strtolower($insuranceLabelFeeMedicaid->description));
                                if ($procedureFees == $field) {
                                    ProcedureFee::updateOrCreate([
                                        'insurance_label_fee_id' => $insuranceLabelFeeMedicaid->id,
                                        'procedure_id' => $procedure->id,
                                        'mac_locality_id' => $macLocality->id,
                                    ], [
                                        'fee' => $value,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

            DB::commit();

            return Procedure::whereId($procedure->id)->first();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function updateProcedureConsiderations(Procedure $procedure, array $data)
    {
        try {
            DB::beginTransaction();

            $considetation = ProcedureConsideration::updateOrCreate([
                'procedure_id' => $procedure->id,
            ], [
                'gender_id' => $data['gender_id'],
                'age_init' => $data['age_init'],
                'age_end' => $data['age_end'] ?? null,
                'age_type' => $data['age_type'] ?? 1,
                'discriminatory_id' => $data['discriminatory_id'],
                'claim_note' => $data['claim_note'] ?? false,
                'supervisor' => $data['supervisor'] ?? false,
                'authorization' => $data['authorization'] ?? false,
            ]);

            $considetation->frecuentDiagnoses()->sync($data['frequent_diagnoses'] ?? []);
            $considetation->frecuentModifiers()->sync($data['frequent_modifiers'] ?? []);

            DB::commit();

            return $procedure->load([
                'procedureCosiderations' => function ($query) {
                    $query->with(['frecuentDiagnoses', 'frecuentModifiers']);
                },
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return $e;
        }
    }

    public function updateProcedureNote(Procedure $procedure, ?string $note)
    {
        PublicNote::query()->when(null !== $note, function (Builder $query) use ($procedure, $note): void {
            $query->updateOrCreate([
                'publishable_type' => Procedure::class,
                'publishable_id' => $procedure->id,
            ], [
                'note' => $note,
            ]);
        },
            function (Builder $query) use ($procedure): void {
                $query->where([
                    'publishable_type' => Procedure::class,
                    'publishable_id' => $procedure->id,
                ])->delete();
            });

        return $procedure->load(['publicNote']);
    }

    /**
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id)
    {
        $procedure = Procedure::find($id);

        if (is_null($procedure)) {
            return null;
        }

        if ($status) {
            return $procedure->update(
                [
                    'active' => $status,
                    'end_date' => null,
                ]
            );
        } else {
            return $procedure->update(
                [
                    'active' => $status,
                    'end_date' => now(),
                ]
            );
        }
    }

    public function getListMacLocalities(Request $request)
    {
        try {
            $filters = [];
            if (isset($request->mac)) {
                $filters['mac'] = $request->mac;
            }
            if (isset($request->locality_number)) {
                $filters['locality_number'] = $request->locality_number;
            }
            if (isset($request->state)) {
                $filters['state'] = $request->state;
            }
            if (isset($request->fsa)) {
                $filters['fsa'] = $request->fsa;
            }
            if (isset($request->counties)) {
                $filters['counties'] = $request->counties;
            }
            $records['mac'] = MacLocality::where($filters)->distinct('mac')->get();
            $records['locality_number'] = MacLocality::where($filters)->distinct('locality_number')->get();
            $records['state'] = MacLocality::where($filters)->distinct('state')->get();
            $records['fsa'] = MacLocality::where($filters)->distinct('fsa')->get();
            $records['counties'] = MacLocality::where($filters)->distinct('counties')->get();

            $options = [
                'mac' => [],
                'locality_number' => [],
                'state' => [],
                'fsa' => [],
                'counties' => [],
            ];
            foreach ($records['mac'] as $rec) {
                array_push($options['mac'], ['id' => $rec->mac, 'name' => $rec->mac]);
            }
            foreach ($records['locality_number'] as $rec) {
                array_push($options['locality_number'], ['id' => $rec->locality_number, 'name' => $rec->locality_number]);
            }
            foreach ($records['state'] as $rec) {
                array_push($options['state'], ['id' => $rec->state, 'name' => $rec->state]);
            }
            foreach ($records['fsa'] as $rec) {
                array_push($options['fsa'], ['id' => $rec->fsa, 'name' => $rec->fsa]);
            }
            foreach ($records['counties'] as $rec) {
                array_push($options['counties'], ['id' => $rec->counties, 'name' => $rec->counties]);
            }

            return $options;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListMac()
    {
        try {
            return getList(MacLocality::class, ['mac']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListLocalityNumber()
    {
        try {
            return getList(MacLocality::class, ['locality_number']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListState()
    {
        try {
            return getList(MacLocality::class, ['state']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListFsa()
    {
        try {
            return getList(MacLocality::class, ['fsa']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListCounties()
    {
        try {
            return getList(MacLocality::class, ['counties']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListGenders()
    {
        return getList(Gender::class, 'description');
    }

    public function getListDiscriminatories()
    {
        return getList(Discriminatory::class, 'description');
    }

    public function getListDiagnoses($code = '', $except_ids = null)
    {
        try {
            return Diagnosis::query()
                ->whereNotIn('id', $except_ids ?? [])
                ->when('' != $code, function ($query) use ($code) {
                    $query->whereRaw('LOWER(code) LIKE (?)', [strtolower("%$code%")]);
                })
                ->select('id', 'code as name', 'description')
                ->toBase()
                ->get()
                ->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListModifiers(?string $modifier): AnonymousResourceCollection
    {
        $records = Modifier::query()
            ->when($modifier, function ($query) use ($modifier) {
                $query->whereRaw('LOWER(modifier) LIKE ?', [strtolower("%$modifier%")]);
            })
            ->get();

        return ListModifierResource::collection($records);
    }

    public function getListInsuranceCompanies($procedure_id = null)
    {
        try {
            if (null == $procedure_id) {
                return [];
            } else {
                $procedure = Procedure::whereId($procedure_id)->with([
                    'insuranceCompanies',
                ])->first();
                if (count($procedure->insuranceCompanies) > 0) {
                    return getList(
                        InsuranceCompany::class,
                        'name',
                        ['relationship' => 'procedures', 'where' => ['procedure_id' => $procedure_id]]
                    );
                } else {
                    return getList(InsuranceCompany::class);
                }
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getList($company_id = null, $search = '')
    {
        try {
            if (null == $company_id) {
                if ('' == $search) {
                    return Procedure::query()
                        ->where('type', '<>', '4')
                        ->select('id', 'code as name', 'description')
                        ->toBase()
                        ->get()
                        ->toArray();
                } else {
                    return Procedure::query()
                        ->where('type', '<>', '4')
                        ->select('id', 'code as name', 'description')
                        ->whereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")])
                        ->toBase()
                        ->get()
                        ->toArray();
                    /**return Procedure::search($search,
                        function (Indexes $searchEngine, string $query, array $options) {
                                $options['attributesToSearchOn'] = ['code'];
                                return $searchEngine->search($query, $options);
                            }
                        )
                        ->get()
                        ->map(function ($procedure) {
                            return [
                                'id' => $procedure->id,
                                'name' => $procedure->code,
                                'description' => $procedure->description,
                            ];
                        });*/
                }
            } else {
                return Procedure::query()
                    ->where('procedures.type', '<>', '4')
                    ->when('' !== $search, function ($query) use ($search, $company_id) {
                        $query->where(function ($query) use ($search, $company_id) {
                            $query->whereHas('companyServices', function ($query) use ($company_id) {
                                $query->where('company_id', $company_id);
                            })
                            ->where('code', 'like', "%$search%")
                            ->orWhere(function ($query) use ($search) {
                                $search = str_replace(['f', 'F'], '', $search);
                                $query->whereJsonContains('clasifications->general', 2)
                                    ->where('code', 'like', "%$search%F");
                            });
                        });
                    }, function ($query) use ($company_id) {
                        $query->whereHas('companyServices', function ($query) use ($company_id) {
                            $query->where('company_id', $company_id);
                        });
                    })
                    ->with(['companyServices' => function ($query) use ($company_id) {
                        $query->where('company_id', $company_id);
                    }])
                    ->get()
                    ->map(function ($procedure) use ($company_id) {
                        $medication = $procedure?->companyServices
                            ->firstWhere('company_id', $company_id)?->medication ?? null;

                        return [
                            'id' => $procedure->id,
                            'name' => $procedure->code,
                            'description' => $procedure->description,
                            'price' => (float) $procedure->companyServices
                                ->firstWhere('company_id', $company_id)?->price ?? 0,
                            'units_limit' => $medication?->units_limit ? (int) $medication?->units_limit : null,
                            'is_medication' => isset($medication),
                        ];
                    })
                    ->sortByDesc('price')
                    ->values()
                    ->toArray();
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListInsuranceLabelFees()
    {
        try {
            return getList(InsuranceLabelFee::class, 'description');
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param int $id
     *
     * @return Company|Builder|Model|object|null
     */
    public function getListInsuranceCompany()
    {
        try {
            return getList(InsuranceCompany::class, ['code', '-', 'name']);
        } catch (\Exception $e) {
            return [];
        }
    }
}
