<?php

namespace App\Repositories;

use App\Models\BillingCompany;
use App\Models\Company;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CompanyRepository
{
    /**
     * @param array $data
     * @return Company|Model
     */
    public function createCompany(array $data) {
        $company = Company::create($data["company"]);
        $this->changeStatus(true, $company->id);

        $data["contact"]["company_id"] = $company->id;
        $data["address"]["company_id"] = $company->id;

        Address::create($data["address"]);
        Contact::create($data["contact"]);

        return $company;
    }

    /**
     * @return Company[]|Collection
     */
    public function getAllCompanies() {
        return Company::with([
            "address",
            "contact",
            "facilities",
        ])->get();
    }

    /**
     * @param int $id
     * @return Company|Builder|Model|object|null
     */
    public function getOneCompany(int $id) {
        $company = Company::whereId($id)->with([
            "address",
            "contact",
            "facilities"
        ])->first();

        if (is_null($company)) return null;

        return $company;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Company|Builder|Model|object|null
     */
    public function updateCompany(array $data, int $id) {
        if (isset($data["company"])) {
            $company = Company::whereId($id)->first();
            $company->update($data['company']);
        }

        if (isset($data['address'])) {
            $address = Address::updateOrCreate([
                'company_id' => $company->id
            ], $data["address"]);
        }

        if (isset($data['contact'])) {
            $contact = Contact::updateOrCreate([
                'company_id' => $company->id
            ], $data["contact"]);
        }

        return Company::whereId($id)->with([
            "address",
            "contact"
        ])->first();
    }

    /**
     * @param string $email
     * @return Company|Builder|Model|object|null
     */
    public function getOneByEmail(string $email) {
        return Company::where("email",$email)->with([
            "address",
            "contact"
        ])->first();
    }

    /**
     * @param string $name
     * @return Company[]|Builder[]|Collection
     */
    public function getByName(string $name) {
        return Company::where("name","ILIKE","%${name}%")->with([
            "address",
            "contact"
        ])->get();
    }

    /**
     * @param int $status
     * @param int $id
     * @return bool|int
     */
    public function changeStatus(bool $status, int $id) {
        $billingCompany = auth()->user()->billingCompanyUser->first();
        if (is_null($billingCompany)) return null;
        
        $company = Company::find($id);
        if (is_null($company->billingCompanies()->find($billingCompany->id))) {
            return $company->billingCompanies()->attach($billingCompany->id);
        } else {
            return $company->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    /**
     * @param  int $id
     * @return Company|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id) {
        $company = Company::find($id);
        if (is_null($company)) return null;

        $billingCompany = auth()->user()->billingCompanyUser->first();
        if (is_null($billingCompany)) return null;

        if (is_null($company->billingCompanies()->find($billingCompany->id))) {
            $company->billingCompanies()->attach($billingCompany->id);
        }
        return $company;
    }
}
