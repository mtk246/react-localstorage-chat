<?php

namespace App\Repositories;

use App\Http\Resources\Facility\CompanyResource;
use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\EntityAbbreviation;
use App\Models\EntityNickname;
use App\Models\Facility;
use App\Models\FacilityType;
use App\Models\Taxonomy;
use App\Models\PublicNote;
use App\Models\PrivateNote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class FacilityRepository
{
    /**
     * @return Facility|Model
     */
    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            $facility = Facility::query()->create([
                'code' => generateNewCode(getPrefix($data['name']), 5, date('Y'), Facility::class, 'code'),
                'name' => $data['name'] ,
                'npi' => $data['npi'],
                'facility_type_id' => $data['facility_type_id'],
                'nppes_verified_at' => now(),
                'other_name' => $data['other_name']
            ]);

            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $facility->taxonomies()->sync($tax_array);
            }

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            if (isset($data['companies'])) {
                $companies = $facility->companies()
                    ->where('billing_company_id', $billingCompany->id ?? $billingCompany)
                    ->get();
                foreach ($companies ?? [] as $companyDB) {
                    $validated = false;
                    foreach ($data['companies'] as $index => $company) {
                        if ($companyDB['id'] == $company) {
                            $validated = true;
                            unset($data['companies'][$index]);
                            break;
                        }
                    }
                    if (!$validated) {
                        $companyDB->facilities()->wherePivot(
                            'billing_company_id', $billingCompany->id ?? $billingCompany,
                        )->detach($facility->id);
                    }
                }

                foreach ($data['companies'] as $company) {
                    $facility->companies()->attach($company, [
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ]);
                }
            }

            /* Attach billing company */
            $facility->billingCompanies()->attach($billingCompany->id ?? $billingCompany, [
                'status' => true,
            ]);

            if (isset($data['place_of_services'])) {
                foreach ($data['place_of_services'] as $pos) {
                    if (is_null($facility->placeOfServices()
                            ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)->find($pos))) {
                        $facility->placeOfServices()->attach($pos, [
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ]);
                    } else {
                        $facility->placeOfServices()
                                 ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)
                                 ->updateExistingPivot($pos, [
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ]);
                    }
                }
            }

            if (isset($data['nickname'])) {
                EntityNickname::create([
                    'nickname' => $data['nickname'],
                    'nicknamable_id' => $facility->id,
                    'nicknamable_type' => Facility::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            if (isset($data['abbreviation'])) {
                EntityAbbreviation::create([
                    'abbreviation' => $data['abbreviation'],
                    'abbreviable_id' => $facility->id,
                    'abbreviable_type' => Facility::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            if (isset($data['address']['address'])) {
                $data['address']['billing_company_id'] = $billingCompany->id ?? $billingCompany;
                $data['address']['addressable_id'] = $facility->id;
                $data['address']['addressable_type'] = Facility::class;
                Address::create($data['address']);
            }
            if (isset($data['contact']['email']) || isset($data['contact']['phone']) || isset($data['contact']['fax'])) {
                Contact::create([
                    'contact_name' => $data['contact']['contact_name'] ?? null,
                    'phone' => $data['contact']['phone'] ?? null,
                    'fax' => $data['contact']['fax'] ?? null,
                    'email' => $data['contact']['email'] ?? "",
                    'mobile' => $data['contact']['mobile'] ?? null,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'contactable_id' => $facility->id,
                    'contactable_type' => Facility::class,
                ]);
            }

            if (isset($data['private_note'])) {
                PrivateNote::create([
                    'publishable_type' => Facility::class,
                    'publishable_id' => $facility->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'note' => $data['private_note'],
                ]);
            }

            if (isset($data['public_note'])) {
                PublicNote::create([
                    'publishable_type' => Facility::class,
                    'publishable_id' => $facility->id,
                    'note' => $data['public_note'],
                ]);
            }

            if (isset($data['types'])) {
                $facility->facilityTypes()->attach($data['types']);
            }

            if(isset($data['bill_classifications'])) {
                $facility->billClassifications()->attach($data['bill_classifications']);
            }

            DB::commit();

            return $facility;

        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
        
    }

    /**
     * @return FacilityType[]|Collection
     */
    public function getListFacilityTypes()
    {
        $records = FacilityType::all();
        /** Inicia la opción vacia por defecto */
        $options = [];
        foreach ($records as $rec) {
            $text = $rec->type;
            array_push($options, ['id' => $rec->id, 'name' => $text]);
        }

        return $options;
    }

    public function getList(Request $request)
    {
        try {
            $billingCompanyId = $request->billing_company_id ?? null;
            $companyId = $request->company_id ?? null;

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $billingCompanyId;
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            $facilities = Facility::with('facilityType');

            if (isset($billingCompany)) {
                $facilities = $facilities->whereHas('billingCompanies', function ($query) use ($billingCompany) {
                    $query->where('billing_company_id', $billingCompany->id ?? $billingCompany);
                });
            }
            if (isset($companyId)) {
                $facilities = $facilities->whereHas('companies', function ($query) use ($companyId) {
                    $query->where('company_id', $companyId);
                });
            }
            if (!isset($billingCompany) && !isset($companyId)) {
                $facilities = Facility::with('facilityType')->get();
            } else {
                $facilities = $facilities->get();
            }

            $records = [];
            foreach ($facilities as $facility) {
                array_push($records, [
                    'id' => $facility->id,
                    'name' => $facility->name,
                ]);
            }

            return $records;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @return Facility[]|Collection
     */
    public function getAllFacilities()
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $facilities = Facility::with([
                'addresses',
                'contacts',
                'nicknames',
                'abbreviations',
                'companies',
                'facilityType',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $facilities = Facility::whereHas('billingCompanies', function ($query) use ($bC) {
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
                'companies',
                'facilityType',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        }

        return !is_null($facilities) ? $facilities : null;
    }

    /**
     * @return Facility[]|Collection
     */
    public function getAllByCompany($company_id)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $facilities = Facility::with([
                'addresses',
                'contacts',
                'nicknames',
                'abbreviations',
                'companies',
                'facilityType',
            ])->whereHas('companies', function ($query) use ($company_id) {
                $query->where('company_id', $company_id);
            })->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $facilities = Facility::with([
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
                    'companies',
                    'facilityType',
            ])->whereHas('companies', function ($query) use ($company_id) {
                $query->where('company_id', $company_id);
            })->whereHas('billingCompanies', function ($query) use ($bC) {
                $query->where('billing_company_id', $bC);
            })->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        }

        return !is_null($facilities) ? $facilities : null;
    }

    public function getServerAllFacilities(Request $request)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = Facility::with([
                'addresses',
                'contacts',
                'nicknames',
                'abbreviations',
                'companies',
                'facilityType',
                'billingCompanies',
            ]);
        } else {
            $data = Facility::whereHas('billingCompanies', function ($query) use ($bC) {
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
                'companies',
                'facilityType',
                'billingCompanies' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
            ]);
        }

        if (!empty($request->query('query')) && '{}' !== $request->query('query')) {
            $data = $data->search($request->query('query'));
        }

        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'facilities.billing_company_id'), (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
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
     * @return Facility|Builder|Model|object|null
     */
    public function getOneFacility(int $id)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $facility = Facility::whereId($id)->with([
                'taxonomies',
                'addresses',
                'contacts',
                'companies',
                'billingCompanies',
                'nicknames',
                'abbreviations',
                'facilityTypes',
                'publicNote'
            ])->first();
        } else {
            $facility = Facility::whereId($id)->with([
                'publicNote',
                'taxonomies',
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
                'companies',
                'facilityTypes',
                'placeOfServices' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
                'billingCompanies' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                },
            ])->first();
        }

        if (!is_null($facility)) {
            $taxonomies = $facility->taxonomies;

            $record = [
                'id' => $facility->id,
                'code' => $facility->code,
                'name' => $facility->name,
                'npi' => $facility->npi,
                'facility_type_id' => $facility->facility_type_id,
                'facility_type' => $facility->facilityType->type,
                'taxonomies' => $taxonomies ?? [],
                'verified_on_nppes' => $facility->verified_on_nppes,
                'nppes_verified_at' => $facility->nppes_verified_at,
                'created_at' => $facility->created_at,
                'updated_at' => $facility->updated_at,
                'last_modified' => $facility->last_modified,
                'public_note' => $facility->publicNote,
                'facility_types' => $facility->facilityTypes
            ];
            $record['billing_companies'] = [];

            foreach ($facility->billingCompanies as $billingCompany) {
                $abbreviation = EntityAbbreviation::where([
                    'abbreviable_id' => $facility->id,
                    'abbreviable_type' => Facility::class,
                    'billing_company_id' => $billingCompany->id ?? $bC,
                ])->first();
                $nickname = EntityNickname::where([
                    'nicknamable_id' => $facility->id,
                    'nicknamable_type' => Facility::class,
                    'billing_company_id' => $billingCompany->id ?? $bC,
                ])->first();
                $address = Address::where([
                    'addressable_id' => $facility->id,
                    'addressable_type' => Facility::class,
                    'billing_company_id' => $billingCompany->id ?? $bC,
                ])->first();
                $contact = Contact::query()->where([
                    'contactable_id' => $facility->id,
                    'contactable_type' => Facility::class,
                    'billing_company_id' => $billingCompany->id ?? $bC,
                ])->first();
                $companies = $facility->companies()
                    ->wherePivot('billing_company_id', $billingCompany->id ?? $bC)->get();

                $placeOfServices = $facility->placeOfServices()
                    ->wherePivot('billing_company_id', $billingCompany->id ?? $bC)->get();

                $privateNote = $facility->privateNotes()
                    ->where('billing_company_id', $billingCompany->id ?? $bC)->get();

                if (isset($address)) {
                    $facility_address = [
                        'zip' => $address->zip,
                        'city' => $address->city,
                        'state' => $address->state,
                        'address' => $address->address,
                        'country' => $address->country,
                    ];
                }

                if (isset($contact)) {
                    $facility_contact = [
                        'fax' => $contact->fax,
                        'email' => $contact->email,
                        'phone' => $contact->phone,
                        'mobile' => $contact->mobile,
                        'contact_name' => $contact->contact_name,
                    ];
                }

                array_push($record['billing_companies'], [
                    'id' => $billingCompany->id,
                    'name' => $billingCompany->name,
                    'code' => $billingCompany->code,
                    'abbreviation' => $billingCompany->abbreviation,
                    'private_facility' => [
                        'status' => $billingCompany->pivot->status ?? false,
                        'edit_name' => isset($nickname->nickname) ? true : false,
                        'nickname' => $nickname->nickname ?? '',
                        'abbreviation' => $abbreviation->abbreviation ?? '',
                        'companies' => CompanyResource::collection($companies),
                        'address' => isset($facility_address) ? $facility_address : null,
                        'contact' => isset($facility_contact) ? $facility_contact : null,
                        'place_of_services' => $placeOfServices ?? [],
                        'private_note' => $privateNote,
                    ],
                ]);
            }
        }

        return !is_null($facility) ? $record : null;
    }

    /**
     * @return Facility|Builder|Model|object|null
     */
    public function updateFacility(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $facility = Facility::find($id);

            $facility->update([
                'name' => $data['name'],
                'npi' => $data['npi'],
                'facility_type_id' => $data['facility_type_id'],
            ]);

            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate([
                        'tax_id' => $taxonomy['tax_id'],
                    ], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $facility->taxonomies()->sync($tax_array);
            }

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            $companies = $facility->companies()
                ->where('billing_company_id', $billingCompany->id ?? $billingCompany)
                ->get();
            foreach ($companies ?? [] as $companyDB) {
                $validated = false;
                foreach ($data['companies'] as $index => $company) {
                    if ($companyDB['id'] == $company) {
                        $validated = true;
                        unset($data['companies'][$index]);
                        break;
                    }
                }
                if (!$validated) {
                    $companyDB->facilities()->wherePivot(
                        'billing_company_id', $billingCompany->id ?? $billingCompany,
                    )->detach($facility->id);
                }
            }

            foreach ($data['companies'] as $company) {
                $facility->companies()->attach($company, [
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            $facility->placeOfServices()
                ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)
                ->detach();

            if (isset($data['place_of_services'])) {
                foreach (array_unique($data['place_of_services']) as $pos) {
                    $facility->placeOfServices()->attach($pos, [
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ]);
                }
            }

            /* Attach billing company */
            if (is_null($facility->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $facility->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $facility->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                    'status' => true,
                ]);
            }

            if (isset($data['nickname'])) {
                EntityNickname::updateOrCreate([
                    'nicknamable_id' => $facility->id,
                    'nicknamable_type' => Facility::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'nickname' => $data['nickname'],
                ]);
            }

            if (isset($data['abbreviation'])) {
                EntityAbbreviation::updateOrCreate([
                    'abbreviable_id' => $facility->id,
                    'abbreviable_type' => Facility::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'abbreviation' => $data['abbreviation'],
                ]);
            }

            if (isset($data['contact'])) {
                Contact::updateOrCreate([
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'contactable_id' => $facility->id,
                    'contactable_type' => Facility::class,
                ], $data['contact']);
            }

            if (isset($data['address'])) {
                Address::updateOrCreate([
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'addressable_id' => $facility->id,
                    'addressable_type' => Facility::class,
                ], $data['address']);
            }

            if (isset($data['private_note'])) {
                PrivateNote::updateOrCreate([
                    'publishable_type' => Facility::class,
                    'publishable_id' => $facility->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note' => $data['private_note'],
                ]);
            }
    
            if (isset($data['public_note'])) {
                PublicNote::updateOrCreate([
                    'publishable_type' => Facility::class,
                    'publishable_id' => $facility->id,
                ], [
                    'note' => $data['public_note'],
                ]);
            }

            if (isset($data['types'])) {
                $facility->facilityTypes()->sync($data['types']);
            }

            if (isset($data['bill_classifications'])) {
                $facility->billClassifications()->sync($data['bill_classifications']);
            }

            DB::commit();
            $bC = auth()->user()->billing_company_id ?? null;
            if (!$bC) {
                return Facility::whereId($id)->with(['nicknames', 'abbreviations', 'companies'])->first();
            } else {
                return Facility::whereId($id)->with([
                    'nicknames' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    'abbreviations' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    'companies',
                ])->first();
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @return Facility[]|Builder[]|Collection
     */
    public function getByName(string $name)
    {
        return Facility::where('name', 'ilike', "%{$name}%")->get();
    }

    /**
     * @return Company|Builder|Collection
     */
    public function getOneByNpi(string $npi)
    {
        $facility = Facility::whereNpi($npi)->with([
            'addresses', 'contacts', 'billingCompanies',
        ])->first();

        return !is_null($facility) ? $facility : null;
    }

    public function getListBillingCompanies(Request $request)
    {
        $facilityId = $request->facility_id ?? null;
        $edit = $request->edit ?? 'false';

        if (is_null($facilityId)) {
            return getList(BillingCompany::class, 'name', ['status' => true]);
        } else {
            $ids = [];
            $billingCompanies = Facility::find($facilityId)->billingCompanies;
            foreach ($billingCompanies as $field) {
                array_push($ids, $field->id);
            }
            if ('true' == $edit) {
                return getList(BillingCompany::class, 'name', ['where' => ['status' => true], 'exists' => 'facilities', 'whereHas' => ['relationship' => 'facilities', 'where' => ['facility_id' => $facilityId]]]);
            } else {
                return getList(BillingCompany::class, 'name', ['where' => ['status' => true], 'not_exists' => 'facilities', 'orWhereHas' => ['relationship' => 'facilities', 'where' => ['billing_company_id', $ids]]]);
            }
        }
    }

    /**
     * @return bool|int
     */
    public function changeStatus(bool $status, int $id)
    {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) {
            return null;
        }

        $facility = Facility::find($id);
        if (is_null($facility->billingCompanies()->find($billingCompany->id))) {
            $facility->billingCompanies()->attach($billingCompany->id);

            return $facility;
        } else {
            return $facility->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    /**
     * @return Facility|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id)
    {
        $facility = Facility::find($id);
        if (is_null($facility)) {
            return null;
        }

        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) {
            return null;
        }

        if (is_null($facility->billingCompanies()->find($billingCompany->id))) {
            $facility->billingCompanies()->attach($billingCompany->id);
        }

        return $facility;
    }

    /**
     * @param int $id
     *
     * @return Facility|Builder|Model|object|null
     */
    public function addToCompany($facility, $data)
    {
        
        foreach($data['companies'] as $company) {
            
            $check = is_null($facility->companies()
                ->where([
                    'billing_company_id' => $company['billing_company_id'],
                    'company_id' => $company['company_id']
                ])->first()
            );

            if ($check) {
                $facility->companies()->attach($company['company_id'], 
                    ['billing_company_id' => $company['billing_company_id']]
                );
            }
        }

        return $facility;
    }

    /**
     * @param int $id
     *
     * @return Facility|Builder|Model|object|null
     */
    public function removeToCompany($facility, $data)
    {
        $check = is_null($facility->companies()
                ->where([
                    'billing_company_id' => $data['billing_company_id'] ?? null,
                    'company_id' => $data['company_id']
                ])->first()
            );

        if ($check) {
            return $facility;
        } else {
            $facility->companies()->wherePivot('billing_company_id', $data['billing_company_id'] ?? null)->detach($data['company_id']);
            return $facility;
        }
    }
}
