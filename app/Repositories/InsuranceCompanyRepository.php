<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\EntityAbbreviation;
use App\Models\EntityNickname;
use App\Models\InsuranceCompany;
use App\Models\InsuranceCompanyTimeFailed;
use App\Models\PrivateNote;
use App\Models\PublicNote;
use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class InsuranceCompanyRepository
{
    /**
     * @return null
     */
    public function createInsurance(array $data)
    {
        try {
            DB::beginTransaction();
            $insurance = InsuranceCompany::where('payer_id', $data['insurance']['payer_id'])->first();
            if (isset($insurance)) {
                $insurance->update([
                    'naic' => $data['insurance']['naic'] ?? '',
                    'file_method_id' => $data['insurance']['file_method_id'],
                ]);
            } else {
                $insurance = InsuranceCompany::create([
                    'code' => generateNewCode('IC', 5, date('Y'), InsuranceCompany::class, 'code'),
                    'name' => $data['insurance']['name'],
                    'naic' => $data['insurance']['naic'] ?? '',
                    'payer_id' => $data['insurance']['payer_id'],
                    'file_method_id' => $data['insurance']['file_method_id'],
                ]);
            }

            if (Gate::check('is-admin')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()->billing_company_id;
            }

            /* Attach or ubdate pivot status on relation with billing company */
            if (is_null($insurance->billingCompanies()->find($billingCompany))) {
                $insurance->billingCompanies()->attach($billingCompany);
            }
            else {
                $insurance->billingCompanies()->updateExistingPivot($billingCompany, [
                    'status' => true,
                ]);
            }

            if (isset($data['billing_incomplete_reasons'])) {
                foreach ($data['billing_incomplete_reasons'] as $bir) {
                    if (is_null($insurance->billingIncompleteReasons()
                            ->wherePivot('billing_company_id', $billingCompany)->find($bir))) {
                        $insurance->billingIncompleteReasons()->attach($bir, [
                            'billing_company_id' => $billingCompany,
                        ]);
                    } else {
                        $insurance->billingIncompleteReasons()
                                 ->wherePivot('billing_company_id', $billingCompany)
                                 ->updateExistingPivot($bir, [
                            'billing_company_id' => $billingCompany,
                        ]);
                    }
                }
            }

            if (isset($data['appeal_reasons'])) {
                foreach ($data['appeal_reasons'] as $ar) {
                    if (is_null($insurance->appealReasons()
                            ->wherePivot('billing_company_id', $billingCompany)->find($ar))) {
                        $insurance->appealReasons()->attach($ar, [
                            'billing_company_id' => $billingCompany,
                        ]);
                    } else {
                        $insurance->appealReasons()
                                 ->wherePivot('billing_company_id', $billingCompany)
                                 ->updateExistingPivot($ar, [
                            'billing_company_id' => $billingCompany,
                        ]);
                    }
                }
            }

            if (isset($data['time_failed']['days']) || isset($data['time_failed']['from_id'])) {
                InsuranceCompanyTimeFailed::updateOrCreate(
                    [
                        'billing_company_id' => $billingCompany,
                    ],
                    [
                        'days' => $data['time_failed']['days'],
                        'from_id' => $data['time_failed']['from_id'],
                        'insurance_company_id' => $insurance->id,
                    ]
                );
            }

            if (isset($data['insurance']['nickname'])) {
                EntityNickname::updateOrCreate(
                    [
                        'nicknamable_id' => $insurance->id,
                        'nicknamable_type' => InsuranceCompany::class,
                        'billing_company_id' => $billingCompany,
                    ],
                    [
                        'nickname' => $data['insurance']['nickname'],
                    ]
                );
            }

            if (isset($data['insurance']['abbreviation'])) {
                EntityAbbreviation::updateOrCreate(
                    [
                        'abbreviable_id' => $insurance->id,
                        'abbreviable_type' => InsuranceCompany::class,
                        'billing_company_id' => $billingCompany,
                    ],
                    [
                        'abbreviation' => $data['insurance']['abbreviation'],
                    ]
                );
            }

            if (isset($data['address']['address'])) {
                $data['address']['billing_company_id'] = $billingCompany;
                $data['address']['addressable_id'] = $insurance->id;
                $data['address']['addressable_type'] = InsuranceCompany::class;

                Address::updateOrCreate([
                    'addressable_id' => $insurance->id,
                    'addressable_type' => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany,
                ], $data['address']);
            }

            if (isset($data['contact']['phone'])) {
                $data['contact']['billing_company_id'] = $billingCompany;
                $data['contact']['contactable_id'] = $insurance->id;
                $data['contact']['contactable_type'] = InsuranceCompany::class;

                Contact::updateOrCreate([
                    'contactable_id' => $insurance->id,
                    'contactable_type' => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany,
                ], $data['contact']);
            }

            if (isset($data['private_note'])) {
                PrivateNote::updateOrCreate([
                    'publishable_type' => InsuranceCompany::class,
                    'publishable_id' => $insurance->id,
                    'billing_company_id' => $billingCompany,
                ], [
                    'note' => $data['private_note'],
                ]);
            }

            if (isset($data['public_note'])) {
                PublicNote::create([
                    'publishable_type' => InsuranceCompany::class,
                    'publishable_id' => $insurance->id,
                    'note' => $data['public_note'],
                ]);
            }

            DB::commit();

            return $insurance;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllInsurance()
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $insuranceCompanies = InsuranceCompany::with([
                'addresses',
                'contacts',
                'nicknames',
                'abbreviations',
                'fileMethod',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $insuranceCompanies = InsuranceCompany::whereHas('billingCompanies', function ($query) use ($bC) {
                $query->where('billing_company_id', $bC);
            })->with([
                'addresses' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'contacts' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'nicknames' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'abbreviations' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'fileMethod',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        }

        return !is_null($insuranceCompanies) ? $insuranceCompanies : null;
    }

    public function getServerAllInsurance(Request $request)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = InsuranceCompany::with([
                'addresses',
                'contacts',
                'nicknames',
                'abbreviations',
                'fileMethod',
                'billingCompanies',
                'insurancePlans' => function($query) {
                    $query->with(['planTypes', 'billingCompanies']);
                },
            ]);
        } else {
            $data = InsuranceCompany::whereHas('billingCompanies', function ($query) use ($bC) {
                $query->where('billing_company_id', $bC);
            })->with([
                'addresses' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'contacts' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'nicknames' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'abbreviations' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'billingCompanies' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'fileMethod',
                'insurancePlans' => function($query) use ($bC) {
                    $query->with([
                        'planTypes',
                        'billingCompanies' => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                    ]);
                },
            ]);
        }

        if (!empty($request->query('query')) && '{}' !== $request->query('query')) {
            $data = $data->search($request->query('query'));
        }

        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'insurance_companies.billing_company_id'), (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } /**elseif (str_contains($request->sortBy, 'email')) {
                $data = $data->orderBy(
                    Contact::select('email')->whereColumn('contats.id', 'companies.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } */ else {
                $data = $data->orderBy($request->sortBy, (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
        } else {
            $data = $data->orderBy('created_at', 'desc')->orderBy('id', 'asc');
        }

        $data = $data->paginate($request->itemsPerPage ?? 10);

        return response()->json([
            'data' => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count' => $data->total(),
        ], 200);
    }

    public function getOneInsurance(int $id)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $insurance = InsuranceCompany::whereId($id)->with([
                'addresses',
                'contacts',
                'nicknames',
                'abbreviations',
                'billingCompanies',
                'billingIncompleteReasons',
                'appealReasons',
                'fileMethod',
                'publicNote',
                'privateNotes',
                'insurancePlans' => function($query) {
                    $query->with(['planTypes', 'billingCompanies']);
                },
            ])->first();
        } else {
            $insurance = InsuranceCompany::whereId($id)->with([
                'addresses' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'contacts' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'nicknames' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'abbreviations' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'billingIncompleteReasons' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'appealReasons' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'billingCompanies' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'fileMethod',
                'publicNote',
                'privateNotes' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'insurancePlans' => function($query) use ($bC) {
                    $query->with([
                        'planTypes',
                        'billingCompanies' => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                    ]);
                },
            ])->first();
        }

        $record = [
            'id' => $insurance->id,
            'code' => $insurance->code,
            'name' => $insurance->name,
            'naic' => $insurance->naic,
            'payer_id' => $insurance->payer_id,
            'file_method_id' => $insurance->file_method_id,
            'file_method' => isset($insurance->fileMethod) ? $insurance->fileMethod->code.' - '.$insurance->fileMethod->description : null,
            'created_at' => $insurance->created_at,
            'updated_at' => $insurance->updated_at,
            'last_modified' => $insurance->last_modified,
            'abbreviations' => $insurance->abbreviations->setVisible(['id', 'abbreviation'])->toArray(),
            'public_note' => isset($insurance->publicNote) ? $insurance->publicNote->note : null,
            'insurance_plans' => $insurance->insurancePlans,
        ];
        $record['billing_companies'] = [];

        foreach ($insurance->billingCompanies as $billingCompany) {
            $abbreviation = EntityAbbreviation::where([
                'abbreviable_id' => $insurance->id,
                'abbreviable_type' => InsuranceCompany::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ])->first();
            $nickname = EntityNickname::where([
                'nicknamable_id' => $insurance->id,
                'nicknamable_type' => InsuranceCompany::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ])->first();
            $address = Address::where([
                'addressable_id' => $insurance->id,
                'addressable_type' => InsuranceCompany::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ])->first();
            $contact = Contact::where([
                'contactable_id' => $insurance->id,
                'contactable_type' => InsuranceCompany::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ])->first();
            $time_failed = InsuranceCompanyTimeFailed::where([
                'insurance_company_id' => $insurance->id,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ])->first();
            $private_note = PrivateNote::where([
                'publishable_id' => $insurance->id,
                'publishable_type' => InsuranceCompany::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ])->first();

            $billing_incomplete_reasons = $insurance->billingIncompleteReasons()
                                                    ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)->get();
            $appeal_reasons = $insurance->appealReasons()
                                        ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)->get();
            foreach ($appeal_reasons as $key => $field) {
                $appeal_reasons[$key]['rules_for_appeal'] = PrivateNote::where([
                    'billing_company_id' => null,
                    'publishable_type' => TypeCatalog::class,
                    'publishable_id' => $field->id,
                ])->first()->note ?? null;
            }

            if (isset($address)) {
                $insurance_address = [
                    'zip' => $address->zip,
                    'city' => $address->city,
                    'state' => $address->state,
                    'address' => $address->address,
                    'country' => $address->country,
                    'address_type_id' => $address->address_type_id,
                    'country_subdivision_code' => $address->country_subdivision_code,
                    'apt_suite' => $address->apt_suite
                ];
            }

            if (isset($contact)) {
                $insurance_contact = [
                    'fax' => $contact->fax,
                    'email' => $contact->email,
                    'phone' => $contact->phone,
                    'mobile' => $contact->mobile,
                    'contact_name' => $contact->contact_name,
                ];
            }
            if (isset($time_failed)) {
                $insurance_company_time_failed = [
                    'days' => $time_failed->days,
                    'from' => $time_failed->from,
                    'from_id' => $time_failed->from_id,
                ];
            }
            array_push($record['billing_companies'], [
                'id' => $billingCompany->id,
                'name' => $billingCompany->name,
                'code' => $billingCompany->code,
                'abbreviation' => $billingCompany->abbreviation,
                'private_insurance' => [
                    'status' => $billingCompany->pivot->status ?? false,
                    'edit_name' => isset($nickname->nickname) ? true : false,
                    'nickname' => $nickname->nickname ?? '',
                    'abbreviation' => $abbreviation->abbreviation ?? '',
                    'private_note' => $private_note->note ?? '',
                    'address' => isset($address) ? $insurance_address : null,
                    'contact' => isset($contact) ? $insurance_contact : null,

                    'insurance_company_time_failed' => isset($time_failed) ? $insurance_company_time_failed : null,
                    'billing_incomplete_reasons' => $billing_incomplete_reasons ?? [],
                    'appeal_reasons' => $appeal_reasons ?? [],
                ],
            ]);
        }

        return !is_null($insurance) ? $record : null;
    }

    public function getByPayer(string $payer)
    {
        $insurance = InsuranceCompany::query()
            ->whereRaw('LOWER(payer_id) LIKE (?)', [strtolower("$payer")])
            ->with('publicNote')
            ->first();

        if ($insurance) {
            $billingCompaniesException = $insurance->billingCompanies()
                ->get()
                ->pluck('id')
                ->toArray();

            $billingCompanies = BillingCompany::query()
                ->where('status', true)
                ->when(Gate::denies('is-admin'), function ($query) {
                    $billingCompaniesUser = auth()->user()->billingCompanies
                        ->take(1)
                        ->pluck('id')
                        ->toArray();

                    return $query->whereIn('billing_companies.id', $billingCompaniesUser ?? []);
                })
                ->whereNotIn('billing_companies.id', $billingCompaniesException ?? [])
                ->get()
                ->pluck('id')
                ->toArray();

            if (empty($billingCompanies)) {
                return ['result' => false];
            }
        }

        return !is_null($insurance) ? ['data' => $insurance, 'result' => true] : null;
    }

    public function getList(array $data)
    {
        try {
            if (Gate::check('is-admin')) {
                $billingCompany = $data['billing_company_id'] ?? null;
            } else {
                $billingCompany = auth()->user()?->billingCompanies->first();
            }

            return getList(
                InsuranceCompany::class,
                ['payer_id', '-', 'name'],
                ['relationship' => 'billingCompanies', 'where' => ['billing_company_id' => $billingCompany->id ?? $billingCompany]],
            );
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListBillingCompanies(Request $request)
    {
        $insuranceCompanyId = $request->insurance_company_id ?? null;
        $edit = $request->edit ?? 'false';

        if (is_null($insuranceCompanyId)) {
            return getList(BillingCompany::class, ['abbreviation', '-', 'name'], ['status' => true]);
        } else {
            $ids = [];
            $billingCompanies = InsuranceCompany::find($insuranceCompanyId)->billingCompanies;
            foreach ($billingCompanies as $field) {
                array_push($ids, $field->id);
            }
            if ('true' == $edit) {
                return getList(BillingCompany::class, ['abbreviation', '-', 'name'], ['where' => ['status' => true], 'exists' => 'insuranceCompanies', 'whereHas' => ['relationship' => 'insuranceCompanies', 'where' => ['insurance_company_id' => $insuranceCompanyId]]]);
            } else {
                return getList(BillingCompany::class, ['abbreviation', '-', 'name'], ['where' => ['status' => true], 'not_exists' => 'insuranceCompanies', 'orWhereHas' => ['relationship' => 'insuranceCompanies', 'where' => ['billing_company_id', $ids]]]);
            }
        }
    }

    public function getListFileMethods()
    {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'File method']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListFromTheDate()
    {
        try {
            return getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'From']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListBillingIncompleteReasons()
    {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Billing incomplete reasons']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListAppealReasons()
    {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Appeal reasons']], null);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @return mixed
     */
    public function searchByName(string $name)
    {
        return InsuranceCompany::where('name', 'ILIKE', "%{$name}%")
            ->with([
                'addresses',
                'contacts',
                'billingCompanies',
            ])->get();
    }

    public function changeStatus(bool $status, int $id)
    {
        $billingCompany = auth()->user()?->billingCompanies->first();
        if (is_null($billingCompany)) {
            return null;
        }

        $insuranceCompany = InsuranceCompany::find($id);
        if (is_null($insuranceCompany->billingCompanies()->find($billingCompany->id))) {
            $insuranceCompany->billingCompanies()->attach($billingCompany->id);

            return $insuranceCompany;
        } else {
            return $insuranceCompany->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    public function updateInsurance(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $insurance = InsuranceCompany::find($id);

            $insurance->update([
                'name' => $data['insurance']['name'],
                'naic' => $data['insurance']['naic'],
                'payer_id' => $data['insurance']['payer_id'],
                'file_method_id' => $data['insurance']['file_method_id'],
            ]);

            if (Gate::check('is-admin')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()->billing_company_id;
            }

            /* Attach billing company */
            if (is_null($insurance->billingCompanies()->find($billingCompany))) {
                $insurance->billingCompanies()->attach($billingCompany);
            } else {
                $insurance->billingCompanies()->updateExistingPivot($billingCompany, [
                    'status' => true,
                ]);
            }

            if (isset($data['billing_incomplete_reasons'])) {
                $insurance->billingIncompleteReasons()
                          ->wherePivot('billing_company_id', $billingCompany)->detach();

                foreach ($data['billing_incomplete_reasons'] as $bir) {
                    $insurance->billingIncompleteReasons()->attach($bir, [
                        'billing_company_id' => $billingCompany,
                    ]);
                }
            }

            if (isset($data['appeal_reasons'])) {
                $insurance->appealReasons()
                          ->wherePivot('billing_company_id', $billingCompany)->detach();

                foreach ($data['appeal_reasons'] as $ar) {
                    $insurance->appealReasons()->attach($ar, [
                        'billing_company_id' => $billingCompany,
                    ]);
                }
            }

            if (isset($data['time_failed']['days']) || isset($data['time_failed']['from_id'])) {
                InsuranceCompanyTimeFailed::updateOrCreate([
                    'billing_company_id' => $billingCompany,
                    'insurance_company_id' => $insurance->id,
                ], [
                    'days' => $data['time_failed']['days'],
                    'from_id' => $data['time_failed']['from_id'],
                ]);
            }

            if (isset($data['insurance']['nickname'])) {
                EntityNickname::updateOrCreate([
                    'nicknamable_id' => $insurance->id,
                    'nicknamable_type' => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany,
                ], [
                    'nickname' => $data['insurance']['nickname'],
                ]);
            }

            if (isset($data['insurance']['abbreviation'])) {
                EntityAbbreviation::updateOrCreate([
                    'abbreviable_id' => $insurance->id,
                    'abbreviable_type' => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'abbreviation' => $data['insurance']['abbreviation'],
                ]);
            }

            if (isset($data['address']['address'])) {
                Address::updateOrCreate([
                    'billing_company_id' => $billingCompany,
                    'addressable_id' => $insurance->id,
                    'addressable_type' => InsuranceCompany::class,
                ],
                    $data['address']);
            }
            if (isset($data['contact']['phone'])) {
                Contact::updateOrCreate([
                    'billing_company_id' => $billingCompany,
                    'contactable_id' => $insurance->id,
                    'contactable_type' => InsuranceCompany::class,
                ], $data['contact']);
            }

            if (isset($data['private_note'])) {
                PrivateNote::updateOrCreate([
                    'publishable_type' => InsuranceCompany::class,
                    'publishable_id' => $insurance->id,
                    'billing_company_id' => $billingCompany,
                ], [
                    'note' => $data['private_note'],
                ]);
            }

            if (isset($data['public_note'])) {
                PublicNote::updateOrCreate([
                    'publishable_type' => InsuranceCompany::class,
                    'publishable_id' => $insurance->id,
                ], [
                    'note' => $data['public_note'],
                ]);
            }
            DB::commit();

            return $this->getOneInsurance($id);
        } catch (\Exception $e) {
            DB::rollBack();

            return $e;
        }
    }

    /**
     * @return InsuranceCompany|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id)
    {
        $insuranceCompany = InsuranceCompany::find($id);
        if (is_null($insuranceCompany)) {
            return null;
        }

        $billingCompany = auth()->user()?->billingCompanies->first();
        if (is_null($billingCompany)) {
            return null;
        }

        if (is_null($insuranceCompany->billingCompanies()->find($billingCompany->id))) {
            $insuranceCompany->billingCompanies()->attach($billingCompany->id);
        }

        return $insuranceCompany;
    }
}
