# Insurance Plan Docs

---

- [Basic data](#basic-data)
- [Create insurance plan](#create-insurance-plan)
- [Update insurance plan](#update-insurance-plan)
- [Change status insurance plan](#change-status-insurance-plan)
- [Add copays to insurance](#add-copay)
- [Add contract fees to insurance](#add-contracts-fee)
- [Get all insurance plan from server](#get-all-insurance-plan-server)
- [Get one insurance plan](#get-one-insurance-plan)
- [Get insurance plan by name](#get-insurance-plan-by-name)
- [Get list insurance plans](#get-list-insurance-plans)
- [Get list format](#get-list-formats)
- [Get list ins type](#get-list-ins-types)
- [Get list plan type](#get-list-plan-types)
- [Get list charge using](#get-list-charge-usings)
- [Get list file methods](#get-list-file-methods)
- [Get list from the date](#get-list-from-the-date)
- [Get list company](#get-list-companies)
- [Get list contract fee type](#get-list-contract-fee-types)
- [Get list mac localities](#get-list-mac-localities)
- [Get list procedures](#get-list-procedures)
- [Get list patients](#get-list-patients)

<a name="basic-data"></a>
## Basic data to make request

| #  | METHOD | Name                            | URL                                                        | Token required | Description                        |
| :  | :-     |  :                              | :                                                          | :-             | :-                                 |
| 1  | POST   | `Create Insurance plan`         | `/insurance-plan/`                                         | yes            | Create insurance plan              |
| 2  | PUT    | `Update Insurance plan`         | `/insurance-plan/{id}`                                     | yes            | Update insurance plan              |
| 3  | PATCH  | `Change status insurance plan`  | `/insurance-plan/{id}/change-status`                       | yes            | Change status insurance plan       |
| 4  | PATCH  | `Add copays to insurance`       | `/insurance-plan/add-copays-to-insurance-plan/{id}`        | yes            | Add copays to insurance plan       |
| 5  | PATCH  | `Add contract fee to insurance` | `/insurance-plan/add-contract-fees-to-insurance-plan/{id}` | yes            | Add contract fee to insurance plan |
| 6  | GET    | `Get all Insurance plan`        | `/insurance-plan/get-all-server`                           | yes            | Get all insurance plan from server |
| 7  | GET    | `Get one Insurance plan`        | `/insurance-plan/{id}`                                     | yes            | Get one insurance plan             |
| 8  | GET    | `Get Insurance plan by name`    | `/insurance-plan/{name}/get-by-name`                       | yes            | Get all insurance plan by name     |
| 9  | GET    | `Get list insurance plans`      | `/insurance-plan/get-list`                                 | yes            | Get list insurance plans           |
| 10 | GET    | `Get list formats`              | `/insurance-plan/get-list-formats`                         | yes            | Get list formats                   |
| 11 | GET    | `Get list ins types`            | `/insurance-plan/get-list-ins-types`                       | yes            | Get list ins types                 |
| 12 | GET    | `Get list plan types`           | `/insurance-plan/get-list-plan-types`                      | yes            | Get list plan types                |
| 13 | GET    | `Get list charge usings`        | `/insurance-plan/get-list-charge-usings`                   | yes            | Get list charge usings             |

> {primary} when url params have this symbol "?" mean not required, so you must to send null....

<a name="data-another-module"></a>
## Data from another module to make request

| #  | METHOD | Name                         | URL                                          | Token required | Description                 |
| :  |        | :-                           | :                                            | :-             | :-                          |
| 13 | GET    | `Get list file methods`      | `/insurance-company/get-list-file-methods`   | yes            | Get list file methods       |
| 14 | GET    | `Get list from the date`     | `/insurance-company/get-list-from-the-date`  | yes            | Get list from the date of   |
| 8  | GET    | `Get list company`           | `/company/get-list-by-billing-company/{id?}` | yes            | Get list of companies       |
| 15 | GET    | `Get list contract fee type` | `/company/get-list-contract-fee-types`       | yes            | Get list contract fee types |
| 7  | GET    | `Get list mac localities`    | `/procedure/get-list-mac-localities`         | yes            | Get list mac localities     |
| 14 | GET    | `Get list procedure`         | `/procedure/get-list`                        | yes            | Get list procedure          |
| 14 | GET    | `Get list patients`          | `/patient/get-list`                          | yes            | Get list all patients       |

> {primary} when url params have this symbol "?" mean not required, so you must to send null....

<a name="create-insurance-plan"></a>
## Create Insurance Plan

### Body request example

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "insurance_company_id":1, /** required */
    "name":"Name insurance", /** required */
    "nickname":"alias insurance plan", /** optional */
    "ins_type_id": 1, /** required */
    "plan_type_id": 1,  /** optional */
    "abbreviation":"Abbreviation", /** optional */
    "eff_date":"2022-01-23", /** required */
    "charge_using_id": 1, /** optional */
    
    "accept_assign":true, /** required */
    "pre_authorization":true, /** required */
    "file_zero_changes":true, /** required */
    "referral_required":true, /** required */
    "accrue_patient_resp":true, /** required */
    "require_abn":true, /** required */
    "pqrs_eligible":true, /** required */
    "allow_attached_files":true, /** required */
    
    "format_professional_id": 1, /** required */
    "format_cms_id": 1, /** required */
    "format_institutional_id": 1, /** required */
    "format_ub_id": 1, /** required */
    "file_method_id": 1, /** optional */
    "naic":"someNaic", /** optional */
    "time_failed": {
        "days": 30, /** optional */
        "from_id": 2, /** optional */
    },
    "address": { /** optional */
        "address":"Name address", /** optional */
        "city":"Name city", /** optional */
        "state":"Name state", /** optional */
        "zip":"3234", /** optional */
        "country": "Name country", /** optional */
        "country_subdivision_code": "Code", /** optional */
    },
    "contact": { /** optional */
        "contact_name": "Some name", /** optional */
        "phone":"55433", /** optional */
        "mobile":"55433", /** optional */
        "fax":"fsdfs", /** optional */
        "email":"dsfsd@gdrfg.com" /** optional */
    },
    "public_note": "Note Public", /** optioanl */
    "private_note": "Note Private" /** optional */
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 Insurance plan created

#

```json
{
    "code": "IP-00001-2022",
    "name": "someName",
    "ins_type": "some ins_type",
    "accept_assign": true,
    "pre_authorization": true,
    "file_zero_changes": true,
    "referral_required": true,
    "accrue_patient_resp": true,
    "require_abn": true,
    "pqrs_eligible": true,
    "allow_attached_files": true,
    "eff_date": "2022-01-23",
    "charge_using": "someCharge",
    "method": "someMethod",
    "naic": "someNaic",
    "insurance_company_id": 1,
    "updated_at": "2022-03-18T15:26:42.000000Z",
    "created_at": "2022-03-18T15:26:42.000000Z",
    "id": 4
}
```
#

<a name="update-insurance-plan"></a>
## Update Insurance plan

### Body request example

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "insurance_company_id":1, /** required */
    "name":"Name insurance", /** required */
    "nickname":"alias insurance plan", /** optional */
    "ins_type_id": 1, /** required */
    "plan_type_id": 1,  /** optional */
    "abbreviation":"Abbreviation", /** optional */
    "eff_date":"2022-01-23", /** required */
    "charge_using_id": 1, /** optional */
    
    "accept_assign":true, /** required */
    "pre_authorization":true, /** required */
    "file_zero_changes":true, /** required */
    "referral_required":true, /** required */
    "accrue_patient_resp":true, /** required */
    "require_abn":true, /** required */
    "pqrs_eligible":true, /** required */
    "allow_attached_files":true, /** required */
    
    "format_professional_id": 1, /** required */
    "format_cms_id": 1, /** required */
    "format_institutional_id": 1, /** required */
    "format_ub_id": 1, /** required */
    "file_method_id": 1, /** optional */
    "naic":"someNaic", /** optional */
    "time_failed": {
        "days": 30, /** optional */
        "from_id": 2, /** optional */
    },
    "address": { /** optional */
        "address":"Name address", /** optional */
        "city":"Name city", /** optional */
        "state":"Name state", /** optional */
        "zip":"3234", /** optional */
        "country": "Name country", /** optional */
        "country_subdivision_code": "Code", /** optional */
    },
    "contact": { /** optional */
        "contact_name": "Some name", /** optional */
        "phone":"55433", /** optional */
        "mobile":"55433", /** optional */
        "fax":"fsdfs", /** optional */
        "email":"dsfsd@gdrfg.com" /** optional */
    },
    "public_note": "Note Public", /** optioanl */
    "private_note": "Note Private" /** optional */
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Insurance company updated

#

```json
{
    "id": 4,
    "code": "IP-00001-2022",
    "name": "someName",
    "ins_type": "some ins_type edited",
    "accept_assign": true,
    "pre_authorization": true,
    "file_zero_changes": true,
    "referral_required": true,
    "accrue_patient_resp": true,
    "require_abn": true,
    "pqrs_eligible": true,
    "allow_attached_files": true,
    "eff_date": "2022-01-23",
    "charge_using": "someCharge",
    "method": "someMethod",
    "naic": "someNaic",
    "insurance_company_id": 1,
    "created_at": "2022-03-18T15:26:42.000000Z",
    "updated_at": "2022-03-18T15:38:58.000000Z"
}
```

#

<a name="change-status-insurance-plan"></a>
## Change Status


## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Body Param

```json
{
    "status": <boolean>
}
```

## Param in path

```json
"id": <integer>
```

## Response

> {success} 204 status changed

#

<a name="add-copay"></a>
## Add copays to insurance

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
insurance_plan_id required <integer>
```

## Param in body

```json
{
    "copays": [
        {
            "billing_company_id": 1, /** Only required by superuser */
            "procedure_ids": [1,2,3], /** required */
            "company_id": 1, /** optional */
            "copay": 150.2, /** required */
            "private_note": "Note private by billing_company"  /** optional */
        }
    ]
}
```


## Response

> {success} 200 Good response

```json
[
    {
        "billing_company_id": 1,
        "procedure_ids": [1,2,3],
        "company_id": 1,
        "copay": 150.2,
        "private_note": "Note private by billing_company"
    }
]
```

#

>{warning} 404 error add copays to insurance


<a name="add-contracts-fee"></a>
## Add contracts fee to insurance

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
insurance_plan_id required <integer>
```

## Param in body

```json
{
    "contract_fees": [
        {
            "billing_company_id": 1, /** Only required by superuser */
            "company_id": 1, /** optional */
            "type_id": 1, /** optional */
            "start_date": "2022-03-16", /** optional */
            "end_date": "2022-03-16", /** optional */
            "procedure_ids": [2,1,3], /** required */
            "modifier_id": 1, /** optional */
            "contract": 120.5, /** required */
            "mac": "02102", /** optional */
            "locality_number":"01", /** optional */
            "state": "ALASKA", /** optional */
            "fsa": "STATEWIDE", /** optional */
            "counties": "ALL COUNTIES", /** optional */
            "insurance_label_fee_id": 1, /** optional */
            "price_percentage": 70, /** optional */
            "private_note": "Note private by billing_company", /** optional */
            "patients": [ /** optional */
            {
                "patient_id": 1,
                "start_date": "2022-03-16",
                "end_date": "2022-03-16",
            }
        ]
        }
    ]
}
```


## Response

> {success} 200 Good response

```json
[
    {
        "billing_company_id": 1,
        "company_id": 1,
        "type_id": 1,
        "start_date": "2022-03-16",
        "end_date": "2022-03-16",
        "procedure_ids": [2,1,3],
        "modifier_id": 1,
        "contract": 120.5,
        "mac": "02102",
        "locality_number":"01",
        "state": "ALASKA",
        "fsa": "STATEWIDE",
        "counties": "ALL COUNTIES",
        "insurance_label_fee_id": 1,
        "price_percentage": 70,
        "private_note": "Note private by billing_company",
        "patients": [
            {
                "patient_id": 1,
                "start_date": "2022-03-16",
                "end_date": "2022-03-16",
            }
        ]
    }
]
```

> {warning} 404 error add contracts fee to insurance

#

<a name="get-all-insurance-plan-server"></a>
## Get all insurance company from server

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
query <string>
itemsPerPage <string>
page <integer>
sortBy <string>
sortDesc <boolean>
insurance_company_id <integer>
```

## Example path

>{primary} ?query=fieldSearch&itemsPerPage=5&sortDesc=1&page=1&sortBy=fieldName&insurance_company_id=1

## Response

> {success} 200 data returned

#
```json
{
    "data": [
        {
            "id": 5,
            "code": "IP-00002-2022",
            "name": "Name 2",
            "ins_type": "ins_type 2",
            "accept_assign": true,
            "pre_authorization": true,
            "file_zero_changes": true,
            "referral_required": true,
            "accrue_patient_resp": true,
            "require_abn": true,
            "pqrs_eligible": true,
            "allow_attached_files": true,
            "eff_date": "2022-01-23",
            "charge_using": "Charge 2",
            "method": "Method 2",
            "naic": "Naic 2",
            "insurance_company_id": 1,
            "created_at": "2022-03-18T15:28:30.000000Z",
            "updated_at": "2022-03-18T15:28:30.000000Z",
            "nicknames": [
                {
                    "id": 1,
                    "nickname": "alias Name2",
                    "nicknamable_type": "App\\Models\\InsurancePlan",
                    "nicknamable_id": 6,
                    "billing_company_id": 1,
                    "created_at": "2022-04-04T12:55:15.000000Z",
                    "updated_at": "2022-04-04T12:55:15.000000Z"
                }
            ],
        },
        {
            "id": 4,
            "code": "IP-00001-2022",
            "name": "someName",
            "ins_type": "some ins_type",
            "accept_assign": true,
            "pre_authorization": true,
            "file_zero_changes": true,
            "referral_required": true,
            "accrue_patient_resp": true,
            "require_abn": true,
            "pqrs_eligible": true,
            "allow_attached_files": true,
            "eff_date": "2022-01-23",
            "charge_using": "someCharge",
            "method": "someMethod",
            "naic": "someNaic",
            "insurance_company_id": 1,
            "created_at": "2022-03-18T15:26:42.000000Z",
            "updated_at": "2022-03-18T15:26:42.000000Z",
            "nicknames": [
                {
                    "id": 1,
                    "nickname": "alias someName",
                    "nicknamable_type": "App\\Models\\InsurancePlan",
                    "nicknamable_id": 6,
                    "billing_company_id": 1,
                    "created_at": "2022-04-04T12:55:15.000000Z",
                    "updated_at": "2022-04-04T12:55:15.000000Z"
                }
            ],
        }
    ],
    "count": 10
}
```

#

<a name="get-one-insurance-plan"></a>
## Get One Insurance Plan


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
"id": <integer>
```

## Response

> {success} 200 Insurance found

#


```json
{
    "id": 19,
    "code": "IP-00019-2023",
    "name": "Name Insurance",
    "accept_assign": true,
    "pre_authorization": true,
    "file_zero_changes": true,
    "referral_required": true,
    "accrue_patient_resp": true,
    "require_abn": true,
    "pqrs_eligible": true,
    "allow_attached_files": true,
    "eff_date": "2022-01-23",
    "ins_type_id": 1,
    "ins_type": "AETNA - Aetna",
    "plan_type_id": 2,
    "plan_type": "AUTO - Automobile Insurance",
    "charge_using_id": 3,
    "charge_using": "BCBS - Blue Cross an Blue Shield",
    "insurance_company_id": 1,
    "insurance_company": "Providence Administrative Services",
    "created_at": "2023-02-23T20:00:08.000000Z",
    "updated_at": "2023-02-23T20:00:08.000000Z",
    "last_modified": {
        "user": "Henry Paredes",
        "roles": [
            {
                "id": 1,
                "name": "Super User",
                "slug": "superuser",
                "description": "Allows you to administer and manage all the functions of the application",
                "level": 1,
                "created_at": "2023-02-10T09:47:23.000000Z",
                "updated_at": "2023-02-10T09:47:23.000000Z",
                "pivot": {
                    "user_id": 12,
                    "role_id": 1,
                    "created_at": "2023-02-10T09:47:56.000000Z",
                    "updated_at": "2023-02-10T09:47:56.000000Z"
                }
            }
        ]
    },
    "public_note": "Note public",
    "billing_companies": [
        {
            "id": 1,
            "name": "Medical Claims Consultants",
            "code": "BC-00001-2023",
            "abbreviation": "MCC",
            "private_insurance_plan": {
                "naic": "someNaic",
                "format_professional_id": 226,
                "format_professional": "Standart",
                "format_institutional_id": 226,
                "format_institutional": "Standart",
                "format_cms_id": 226,
                "format_cms": "Standart",
                "format_ub_id": 226,
                "format_ub": "Standart",
                "file_method_id": 5,
                "file_method": "CIGNA - Cigna",
                "status": true,
                "edit_name": true,
                "nickname": "Alias Insurance Plan",
                "abbreviation": "Abbreviation",
                "private_note": "Note private",
                "address": {
                    "zip": "3234",
                    "city": "Name City",
                    "state": "Name state",
                    "address": "Name Address",
                    "country": "Name country",
                    "address_type_id": null,
                    "country_subdivision_code": "Code"
                },
                "contact": {
                    "fax": "fsdfs",
                    "email": "dsfsd@gdrfg.com",
                    "phone": "55433",
                    "mobile": "55433",
                    "contact_name": "Some name"
                },
                "insurance_plan_time_failed": {
                    "days": 30,
                    "from": {
                        "id": 2,
                        "code": "AUTO",
                        "description": "Automobile Insurance",
                        "status": true,
                        "type_id": 1,
                        "created_at": "2023-02-10T09:52:04.000000Z",
                        "updated_at": "2023-02-10T09:52:04.000000Z"
                    },
                    "from_id": 2
                }
            }
        }
    ]
}
```
#

<a name="get-insurance-plan-by-name"></a>
## Get insurance plan by name


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
"name": <string> required
```

## Response

> {success} 200 Insurance found

#


```json
[
    {
        "id": 19,
        "code": "IP-00019-2023",
        "name": "Name Insurance",
        "accept_assign": true,
        "pre_authorization": true,
        "file_zero_changes": true,
        "referral_required": true,
        "accrue_patient_resp": true,
        "require_abn": true,
        "pqrs_eligible": true,
        "allow_attached_files": true,
        "eff_date": "2022-01-23",
        "ins_type_id": 1,
        "ins_type": "AETNA - Aetna",
        "plan_type_id": 2,
        "plan_type": "AUTO - Automobile Insurance",
        "charge_using_id": 3,
        "charge_using": "BCBS - Blue Cross an Blue Shield",
        "insurance_company_id": 1,
        "insurance_company": "Providence Administrative Services",
        "created_at": "2023-02-23T20:00:08.000000Z",
        "updated_at": "2023-02-23T20:00:08.000000Z",
        "public_note": "Note public"
    },
    {
        "id": 20,
        "code": "IP-00020-2023",
        "name": "Name Insurance 2",
        "accept_assign": true,
        "pre_authorization": true,
        "file_zero_changes": true,
        "referral_required": true,
        "accrue_patient_resp": true,
        "require_abn": true,
        "pqrs_eligible": true,
        "allow_attached_files": true,
        "eff_date": "2022-01-23",
        "ins_type_id": 1,
        "ins_type": "AETNA - Aetna",
        "plan_type_id": 2,
        "plan_type": "AUTO - Automobile Insurance",
        "charge_using_id": 3,
        "charge_using": "BCBS - Blue Cross an Blue Shield",
        "insurance_company_id": 1,
        "insurance_company": "Providence Administrative Services",
        "created_at": "2023-02-23T20:00:08.000000Z",
        "updated_at": "2023-02-23T20:00:08.000000Z",
        "public_note": "Note public"
    }
]
```

#


<a name="get-list-insurance-plans"></a>
## Get list insurance plans

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Insurance Plans found

#

```json
[
    {
        "id": 1,
        "name": "Fay-Hahn"
    },
    {
        "id": 2,
        "name": "Balistreri-Yost"
    },
    {
        "id": 3,
        "name": "Langosh Ltd"
    }
]
```

<a name="get-list-formats"></a>
## Get list formats


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Insurance plan formats found

#

```json
[
    {
        "id": 215,
        "name": "HCFA"
    },
    {
        "id": 216,
        "name": "UB92"
    },
    {
        "id": 217,
        "name": "MASS5"
    },
    {
        "id": 218,
        "name": "IGENERIC"
    },
    {
        "id": 219,
        "name": "ILTRHEAD"
    },
    {
        "id": 220,
        "name": "IPGPERPT"
    },
    {
        "id": 221,
        "name": "WCOMP"
    },
    {
        "id": 222,
        "name": "IL333"
    }
]
```

<a name="get-list-ins-types"></a>
## Get list ins types


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Insurance plan ins types found

#

```json
[
    {
        "id": 1,
        "name": "AETNA - Aetna"
    },
    {
        "id": 2,
        "name": "AUTO - Automobile Insurance"
    },
    {
        "id": 3,
        "name": "BCBS - Blue Cross an Blue Shield"
    },
    {
        "id": 4,
        "name": "CA - Capitation"
    },
    {
        "id": 5,
        "name": "CIGNA - Cigna"
    },
    {
        "id": 6,
        "name": "COMMERCIAL - Commercial Insurance"
    },
    {
        "id": 7,
        "name": "MEDICAID - Medicaid"
    },
    {
        "id": 8,
        "name": "MEDICARE - Medicare"
    },
    {
        "id": 9,
        "name": "UHC - United Health Care"
    },
    {
        "id": 10,
        "name": "WORKCOMP - Workers Compensation"
    }
]
```

<a name="get-list-plan-types"></a>
## Get list insurance plan types


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Insurance plan types found

#

```json
[
    {
        "id": 11,
        "name": "HMO - Health Maintenance Organization"
    },
    {
        "id": 12,
        "name": "PPO - Preferred Provider Organization"
    },
    {
        "id": 13,
        "name": "EPO - Exclusive Provider Organization"
    },
    {
        "id": 14,
        "name": "HDHP - High Deductible Health Plan"
    },
    {
        "id": 15,
        "name": "HSA - Health Savings Accounts"
    }
]
```

<a name="get-list-charge-usings"></a>
## Get list charge usings


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Insurance plan charge usings found

#

```json
[]
```

<a name="get-list-file-methods"></a>
## Get list file methods


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 File Methods found

#

```json
[
    {
        "id": 55,
        "name": "P - Paper"
    },
    {
        "id": 56,
        "name": "E - Electronic"
    },
    {
        "id": 57,
        "name": "B - Paper & Electronic"
    }
]
```

<a name="get-list-from-the-date"></a>
## Get list from the date


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 From the date found

#

```json
[
    {
        "id": 58,
        "name": "Service"
    },
    {
        "id": 59,
        "name": "Claim generation"
    }
]
```
#

<a name="get-list-companies"></a>
## Get list of company by billing company


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
"id": <integer>
```

## Response

> {success} 200 companies found

#

```json
[
    {
        "id": 2,
        "name": "company first11"
    },
    {
        "id": 3,
        "name": "PANAMERICAN INTERNAL MEDICINE INC"
    }
]
```
#

<a name="get-list-contract-fee-types"></a>
## Get list contract fee types


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Contract fee types found

#

```json
[
    {
        "id": 223,
        "name": "AUT"
    },
    {
        "id": 224,
        "name": "CAP"
    },
    {
        "id": 225,
        "name": "RVU"
    }
]
```
#

<a name="get-list-mac-localities"></a>
## Get list mac localities

### Param in header

```json
{
    "Authorization": bearer <token>
}
```
## Param in path

```json
"mac" <string> optional
"locality_number" <string> optional
"state" <string> optional
"fsa" <string> optional
"counties" <string> optional
```

## Example path

>{primary} get-list-mac-localities? mac=fieldMac &
                                    locality_number=fieldLocalityNumber &
                                    state=fieldState &
                                    fsa=fieldFsa &
                                    counties=fieldCounties

## Response

> {success} 200 Mac localities found

#

```json
{
    "mac": [
        {
            "id": "03302",
            "name": "03302"
        },
        {
            "id": "01182",
            "name": "01182"
        },
        {
            "id": "03502",
            "name": "03502"
        },
        {
            "id": "05302",
            "name": "05302"
        }
    ],
    "state": [
        {
            "id": "SOUTH DAKOTA",
            "name": "SOUTH DAKOTA"
        },
        {
            "id": "SOUTH CAROLINA",
            "name": "SOUTH CAROLINA"
        },
        {
            "id": "MAINE",
            "name": "MAINE"
        },
        {
            "id": "PUERTO RICO",
            "name": "PUERTO RICO"
        }
    ],
    "fsa": [
        {
            "id": "REST OF STATE*",
            "name": "REST OF STATE*"
        },
        {
            "id": "EAST ST. LOUIS",
            "name": "EAST ST. LOUIS"
        },
        {
            "id": "NYC SUBURBS/LONG ISLAND",
            "name": "NYC SUBURBS/LONG ISLAND"
        },
        {
            "id": "SALINAS",
            "name": "SALINAS"
        }
    ],
    "counties": [
        {
            "id": "BROWARD, COLLIER, INDIAN RIVER, LEE, MARTIN, PALM BEACH, AND ST. LUCIE",
            "name": "BROWARD, COLLIER, INDIAN RIVER, LEE, MARTIN, PALM BEACH, AND ST. LUCIE"
        },
        {
            "id": "ALL OTHER COUNTIES",
            "name": "ALL OTHER COUNTIES"
        },
        {
            "id": "SAN LUIS OBISPO",
            "name": "SAN LUIS OBISPO"
        },
        {
            "id": "BERGEN, ESSEX, HUDSON, HUNTERDON, MIDDLESEX, MORRIS, PASSAIC, SOMERSET, SUSSEX, UNION AND WARREN",
            "name": "BERGEN, ESSEX, HUDSON, HUNTERDON, MIDDLESEX, MORRIS, PASSAIC, SOMERSET, SUSSEX, UNION AND WARREN"
        },
        {
            "id": "CLAY, JACKSON AND PLATTE",
            "name": "CLAY, JACKSON AND PLATTE"
        },
        {
            "id": "STANISLAUS",
            "name": "STANISLAUS"
        }
    ]
}
```

<a name="get-list-procedures"></a>
## Get list procedures


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
"search": <string> optional
```

## Example path

>{primary} ?search=fieldSearch

## Response

> {success} 200 Procedures found

#

```json
[
    {
        "id": 11,
        "name": "Code procedure2",
        "description": "Description procedure2",
        "price": 231 
    },
    {
        "id": 12,
        "name": "Code procedure1",
        "description": "Description procedure1"
    },
    {
        "id": 13,
        "name": "Code procedure3",
        "description": "Description procedure3"
    }
]
```

<a name="get-list-patients"></a>
## Get list all patients


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path
```json
billing_company_id <integer> optional
```

## Example path Super user

> {info} /get-list?billing_company_id=1

## Example path Billing manager

> {info} /get-list

## Response

> {success} 200 Patients found

#

```json
[
    {
        "id": 17,
        "name": "PA-00001-2022 - Fisrt Name Last Name"
    },
    {
        "id": 49,
        "name": "PA-00010-23 - Johnatan Doe"
    }
]
```