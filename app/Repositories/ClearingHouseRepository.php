<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\ClearingHouse;
use App\Models\Contact;
use App\Models\EntityAbbreviation;
use App\Models\EntityNickname;
use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClearingHouseRepository
{
    /**
     * @return ClearingHouse|Model
     */
    public function create(array $data)
    {
        try {
            DB::beginTransaction();
            $clearing = ClearingHouse::create([
                'code' => generateNewCode(getPrefix($data['name']), 5, date('Y'), ClearingHouse::class, 'code'),
                'name' => $data['name'],
                'org_type_id' => $data['org_type_id'],
                'transmission_format_id' => $data['transmission_format_id'],
            ]);

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()?->billingCompanies->first();
            }

            /* Attach billing company */
            $clearing->billingCompanies()->attach($billingCompany->id ?? $billingCompany);

            if (isset($data['nickname'])) {
                EntityNickname::create([
                    'nickname' => $data['nickname'],
                    'nicknamable_id' => $clearing->id,
                    'nicknamable_type' => ClearingHouse::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            if (isset($data['abbreviation'])) {
                EntityAbbreviation::create([
                    'abbreviation' => $data['abbreviation'],
                    'abbreviable_id' => $clearing->id,
                    'abbreviable_type' => ClearingHouse::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            if (isset($data['address']['address'])) {
                $data['address']['billing_company_id'] = $billingCompany->id ?? $billingCompany;
                $data['address']['addressable_id'] = $clearing->id;
                $data['address']['addressable_type'] = ClearingHouse::class;
                Address::create($data['address']);
            }
            if (isset($data['contact']['email'])) {
                $data['contact']['billing_company_id'] = $billingCompany->id ?? $billingCompany;
                $data['contact']['contactable_id'] = $clearing->id;
                $data['contact']['contactable_type'] = ClearingHouse::class;
                Contact::create($data['contact']);
            }
            DB::commit();

            return $clearing;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @return ClearingHouse[]|Collection
     */
    public function getAllClearingHouse()
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $clearings = ClearingHouse::with([
                'addresses',
                'contacts',
                'nicknames',
                'abbreviations',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $clearings = ClearingHouse::whereHas('billingCompanies', function ($query) use ($bC) {
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
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        }

        return !is_null($clearings) ? $clearings : null;
    }

    public function getServerAllClearingHouse(Request $request)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = ClearingHouse::with([
                'addresses',
                'contacts',
                'nicknames',
                'abbreviations',
            ]);
        } else {
            $data = ClearingHouse::whereHas('billingCompanies', function ($query) use ($bC) {
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
            ]);
        }

        if (!empty($request->query('query')) && '{}' !== $request->query('query')) {
            $data = $data->search($request->query('query'));
        }

        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'name')) {
                $data = $data->orderBy('name', (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } elseif (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'clearing_houses.billing_company_id'), (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } else {
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

    /**
     * @return ClearingHouse|Builder|Model|object|null
     */
    public function getOneClearingHouse(int $id)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $clearing = ClearingHouse::whereId($id)->with([
                'addresses',
                'contacts',
                'billingCompanies',
                'nicknames',
                'abbreviations',
                'transmissionFormat',
                'orgType',
            ])->first();
        } else {
            $clearing = ClearingHouse::whereId($id)->with([
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
                'transmissionFormat',
                'orgType',
                'billingCompanies',
            ])->first();
        }

        return !is_null($clearing) ? $clearing : null;
    }

    public function updateClearingHouse(array $data, int $id)
    {
        try {
            DB::beginTransaction();

            $clearing = ClearingHouse::find($id);
            $clearing->update([
                'name' => $data['name'],
                'org_type_id' => $data['org_type_id'],
                'transmission_format_id' => $data['transmission_format_id'],
            ]);

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()?->billingCompanies->first();
            }

            /* Attach billing company */
            if (is_null($clearing->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $clearing->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $clearing->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                    'status' => true,
                ]);
            }

            if (isset($data['nickname'])) {
                EntityNickname::updateOrCreate([
                    'nicknamable_id' => $clearing->id,
                    'nicknamable_type' => ClearingHouse::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'nickname' => $data['nickname'],
                ]);
            }

            if (isset($data['contact'])) {
                Contact::updateOrCreate([
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'contactable_id' => $clearing->id,
                    'contactable_type' => ClearingHouse::class,
                ], $data['contact']);
            }

            if (isset($data['address'])) {
                Address::updateOrCreate([
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'addressable_id' => $clearing->id,
                    'addressable_type' => ClearingHouse::class,
                ], $data['address']);
            }
            DB::commit();

            return ClearingHouse::whereId($id)->first();
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function getByName(string $name)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $clearing = ClearingHouse::whereRaw('LOWER(name) LIKE (?)', [strtolower("$name")])->with([
                'addresses',
                'contacts',
                'billingCompanies',
            ])->first();
        } else {
            $clearing = ClearingHouse::whereRaw('LOWER(name) LIKE (?)', [strtolower("$name")])->with([
                'addresses' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'contacts' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'billingCompanies',
            ])->first();
        }

        return !is_null($clearing) ? $clearing : null;
    }

    public function changeStatus(bool $status, int $id)
    {
        $billingCompany = auth()->user()?->billingCompanies->first();
        if (is_null($billingCompany)) {
            return null;
        }

        $clearingHouse = ClearingHouse::find($id);
        if (is_null($clearingHouse->billingCompanies()->find($billingCompany->id))) {
            $clearingHouse->billingCompanies()->attach($billingCompany->id);

            return $clearingHouse;
        } else {
            return $clearingHouse->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    /**
     * @return ClearingHouse|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id)
    {
        $clearingHouse = ClearingHouse::find($id);
        if (is_null($clearingHouse)) {
            return null;
        }

        $billingCompany = auth()->user()?->billingCompanies->first();
        if (is_null($billingCompany)) {
            return null;
        }

        if (is_null($clearingHouse->billingCompanies()->find($billingCompany->id))) {
            $clearingHouse->billingCompanies()->attach($billingCompany->id);
        }

        return $clearingHouse;
    }

    public function getListTransmissionFormats()
    {
        try {
            return getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'Transmission format']], null);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListOrgTypes()
    {
        try {
            return getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'Ins type']], null);
        } catch (\Exception $e) {
            return [];
        }
    }
}
