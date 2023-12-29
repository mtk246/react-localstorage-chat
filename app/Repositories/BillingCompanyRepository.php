<?php

namespace App\Repositories;

use App\Http\Requests\ImgBillingCompanyRequest;
use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\BillingCompany\MembershipRole;
use App\Models\Contact;
use App\Models\Permissions\Permission;
use App\Models\User;
use App\Models\User\Role;
use Illuminate\Http\Request;

final class BillingCompanyRepository
{
    public function createBillingCompany(array $data)
    {
        if (isset($data['logo'])) {
            if (!file_exists(public_path('/img-billing-company'))) {
                mkdir(public_path('/img-billing-company/'));
            }

            $file = $data['logo'];
            $fullNameFile = strtotime('now') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img-billing-company/'), $fullNameFile);

            $pathNameFile = asset('/img-billing-company/' . $fullNameFile);
        }

        $company = BillingCompany::create([
            'tax_id' => $data['tax_id'],
            'name' => $data['name'],
            'abbreviation' => strtoupper($data['abbreviation'] ?? ''),
            'code' => generateNewCode(getPrefix($data['name']), 5, date('Y'), BillingCompany::class, 'code'),
            'logo' => $pathNameFile ?? '',
            'status' => true
        ]);

        collect(config('memberships.default_roles'))
            ->each(function (array $roleData) use($company) {
                $role = Role::query()->updateOrCreate(
                    ['slug' => $roleData['slug'] ,'billing_company_id' => $company->id],
                    $roleData
                );
                $permitsIds = Permission::query()
                    ->whereIn('slug', $roleData['permissions'])
                    ->get(['id'])
                    ->pluck('id')
                    ->toArray();

                $role->permissions()->syncWithPivotValues($permitsIds, ['authorizable_type' => Role::class], false);

            });

        if (isset($data['address']['address'])) {
            $data['address']['billing_company_id'] = $company->id;
            $data['address']['addressable_id'] = $company->id;
            $data['address']['addressable_type'] = BillingCompany::class;
            $data['address']['apt_suite'] = $data['address']['apt_suite'] ?? null;
            Address::create($data['address']);
        }
        if (isset($data['contact']['email'])) {
            $data['contact']['billing_company_id'] = $company->id;
            $data['contact']['contactable_id'] = $company->id;
            $data['contact']['contactable_type'] = BillingCompany::class;
            $data['contact']['contact_name'] = $data['contact']['contact_name'] ?? null;
            Contact::create($data['contact']);
        }

        return isset($company) ? $company->load('addresses', 'contacts') : null;
    }

    /**
     * @return BillingCompany|Builder|Model|object|null
     */
    public function update(array $data, int $id)
    {
        $billingCompany = BillingCompany::find($id);
        if (isset($billingCompany)) {
            $billingCompany->update([
                'tax_id' => $data['tax_id'],
                'name' => $data['name'],
                'abbreviation' => $data['abbreviation'] ?? '',
            ]);

            if (isset($data['address']['address'])) {
                $data['address']['billing_company_id'] = $id;
                $data['address']['addressable_id'] = $billingCompany->id;
                $data['address']['addressable_type'] = BillingCompany::class;
                $data['address']['apt_suite'] = $data['address']['apt_suite'] ?? null;
                $address = Address::updateOrCreate([
                    'billing_company_id' => $billingCompany->id,
                    'addressable_id' => $billingCompany->id,
                    'addressable_type' => BillingCompany::class,
                ], $data['address']);
            }
            if (isset($data['contact']['email'])) {
                $data['contact']['billing_company_id'] = $id;
                $data['contact']['contactable_id'] = $billingCompany->id;
                $data['contact']['contactable_type'] = BillingCompany::class;
                $data['contact_name'] = $data['contact']['contact_name'] ?? null;
                $contact = Contact::updateOrCreate([
                    'billing_company_id' => $billingCompany->id,
                    'contactable_id' => $billingCompany->id,
                    'contactable_type' => BillingCompany::class,
                ], $data['contact']);
            }
        }

        return isset($billingCompany) ? $billingCompany->load('contacts', 'addresses') : null;
    }

    public function getBillingCompany(string $id)
    {
        return BillingCompany::with([
            'addresses',
            'contacts',
        ])->find($id);
    }

    public function getAllBillingCompanyByUser($user_id)
    {
        return User::whereId($user_id)->with([
            'billingCompanies',
            'addresses',
            'contacts',
        ])->first();
    }

    public function getAllBillingCompany()
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $billingCompanies = BillingCompany::with([
                'users',
                'addresses',
                'contacts',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $billingCompanies = BillingCompany::whereId($bC)->with([
                'users',
                'addresses',
                'contacts',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        }

        return !is_null($billingCompanies) ? $billingCompanies : null;
    }

    public function getServerAllBillingCompanies(Request $request)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = BillingCompany::with([
                'users',
                'addresses',
                'contacts',
            ]);
        } else {
            $data = BillingCompany::whereId($bC)->with([
                'users',
                'addresses',
                'contacts',
            ]);
        }

        if (!empty($request->query('query')) && '{}' !== $request->query('query')) {
            $data = $data->search($request->query('query'));
        }
        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'email')) {
                $data = $data->orderBy('id', (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
                /**$data = $data->orderBy(Contact::select('email')
                             ->join('contacts', 'contacts.contactable_id', '=', 'billing_companies.id')
                             ->whereColumn('contacts.contactable_type', BillingCompany::class), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');*/
            } else {
                $data = $data->orderBy($request->sortBy, (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
        } else {
            $data = $data->orderBy('created_at', 'desc')->orderBy('id', 'asc');
        }

        $data = $data->paginate($request->itemsPerPage);

        return response()->json([
            'data' => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count' => $data->total(),
        ], 200);
    }

    public function getByCode($code)
    {
        return BillingCompany::whereCode($code)->first();
    }

    public function getByName($name)
    {
        return BillingCompany::whereRaw('LOWER(name) LIKE (?)', [strtolower("%$name%")])->with([
            'addresses',
            'contacts',
        ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
    }

    public function getList()
    {
        return getList(BillingCompany::class, 'name', ['status' => true]);
    }

    /**
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id)
    {
        $billingCompany = BillingCompany::find($id);

        if (is_null($billingCompany)) {
            return null;
        }

        $billingCompany->users()->update(['billing_company_user.status' => $status]);

        return $billingCompany->update(['status' => $status]);
    }

    /**
     * @param ImgProfileRequest $request
     *
     * @return string
     */
    public function uploadImage(ImgBillingCompanyRequest $request)
    {
        $billingCompany = BillingCompany::find($request->billing_company_id);

        if (!file_exists(public_path('/img-billing-company'))) {
            mkdir(public_path('/img-billing-company/'));
        }

        $file = $request->file('logo');
        if (isset($file)) {
            $fullNameFile = strtotime('now') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img-billing-company/'), $fullNameFile);

            $pathNameFile = asset('/img-billing-company/' . $fullNameFile);

            $billingCompany->logo = $pathNameFile;
            $billingCompany->save();
        }

        return $pathNameFile ?? null;
    }
}
