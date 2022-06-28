<?php

namespace App\Repositories;

use App\Repositories\BillingCompanyRepository;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use App\Models\User;

class BillingCompanyRepository
{
    public function createBillingCompany(array $data){
        $company = BillingCompany::create([
            "name" => $data["name"],
            "code" => generateNewCode("BC", 5, date("Y"), BillingCompany::class, "code")
        ]);

        if (isset($data['address']['address'])) {
            $data["address"]["billing_company_id"] = $company->id;
            $data["address"]["addressable_id"] = $company->id;
            $data["address"]["addressable_type"] = BillingCompany::class;
            Address::create($data["address"]);
        }
        if (isset($data["contact"]["email"])) {
            $data["contact"]["billing_company_id"] = $company->id;
            $data["contact"]["contactable_id"] = $company->id;
            $data["contact"]["contactable_type"] = BillingCompany::class;
            Contact::create($data["contact"]);
        }

        return $company;
    }

    /**
     * @param  array $data
     * @param  int $id
     * @return BillingCompany|Builder|Model|object|null
     */
    public function update(array $data, int $id) {
        $billingCompany = BillingCompany::find($id);
        if (isset($billingCompany)) {
            $billingCompany->update([
                "name" => $data["name"],
            ]);

            if (isset($data['address']['address'])) {
                $data["address"]["billing_company_id"] = $id;
                $data["address"]["addressable_id"] = $billingCompany->id;
                $data["address"]["addressable_type"] = BillingCompany::class;
                $address = Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id
                ], $data["address"]);
            }
            if (isset($data["contact"]["email"])) {
                $data["contact"]["billing_company_id"] = $id;
                $data["contact"]["contactable_id"] = $billingCompany->id;
                $data["contact"]["contactable_type"] = BillingCompany::class;
                $contact = Contact::updateOrCreate([
                    "billing_company_id" => $billingCompany->id
                ], $data["contact"]);
            }
        }
        return $billingCompany;
    }

    public function getBillingCompany($id) {
        return BillingCompany::with([
            "address",
            "contact"
        ])->find($id);
    }

    public function getAllBillingCompanyByUser($user_id) {
        return User::whereId($user_id)->with([
            "billingCompanies",
            "address",
            "contact"
        ])->first();
    }

    public function getAllBillingCompany(){
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $billingCompanies = BillingCompany::with([
                "users",
                "address",
                "contact"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $billingCompanies = BillingCompany::whereId($bC)->with([
                "users",
                "address",
                "contact"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }
        return !is_null($billingCompanies) ? $billingCompanies : null;
    }

    public function getServerAllBillingCompany(Request $request) {
        $sortBy   = $request->sortBy ?? 'id';
        $sortDesc = $request->sortDesc ?? false;
        $page = $request->page ?? 1;
        $itemsPerPage = $request->itemsPerPage ?? 5;
        $search = $request->search ?? '';

        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $records = BillingCompany::with([
                "users",
                "address",
                "contact"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->paginate($itemsPerPage);
        } else {
            $records = BillingCompany::whereId($bC)->with([
                "users",
                "address",
                "contact"
            ])->orderBy("created_at", "desc")->orderBy("id", "asc")->paginate($itemsPerPage);
        }
        return response()->json([
            'pagination'  => [
                'total'       => $records->total(),
                'currentPage' => $records->currentPage(),
                'perPage'     => $records->perPage(),
                'lastPage'    => $records->lastPage()
            ],
            'items' =>  $records->items()
        ], 200);
    }

    public function getByCode($code){
        return BillingCompany::whereCode($code)->first();
    }

    public function getByName($name){
        return BillingCompany::where("name","ilike","%${name}%")->get();
    }
    public function getList() {
        return getList(BillingCompany::class);
    }


    /**
     * @param bool $status
     * @param int $id
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id) {
        $billingCompany = BillingCompany::find($id);

        if (is_null($billingCompany)) return null;

        $billingCompany->users()->update(['status' => $status]);

        return $billingCompany->update(["status" => $status]);
    }
}
