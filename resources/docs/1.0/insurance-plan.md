# Insurance Plan Docs

---

- [Basic data](#basic-data)
- [Create insurance plan](#create-insurance-plan)
- [Get all insurance plan from server](#get-all-insurance-plan-from-server)
- [Get one insurance plan](#get-one-insurance-plan)
- [Update insurance plan](#update-insurance-plan)
- [Get insurance plan by name](#get-insurance-plan-by-name)
- [Change status plan company](#change-status-plan-company)
- [Get list insurance plans](#get-list-insurance-plans)
- [Get list format](#get-list-formats)
- [Get list ins type](#get-list-ins-types)
- [Get list plan type](#get-list-plan-types)
- [Get list charge using](#get-list-charge-usings)
- [Get list file methods](#get-list-file-methods)
- [Get list from the date](#get-list-from-the-date)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Insurance plan`                    | `/insurance-plan/`               |yes             |Create insurance plan|         
| 2 |GET | `Get all Insurance plan`                   | `/insurance-plan/get-all-server`        |yes      |Get all insurance plan from server|
| 3 |GET | `Get one Insurance plan`                   | `/insurance-plan/{id}`|yes|Get one insurance plan|
| 4 |PUT | `Update Insurance plan`                | `/insurance-plan/{id}`|yes|Update insurance plan|
| 5 |GET | `Get Insurance plan by name`           | `/insurance-plan/{name}/get-by-name`|yes|Get all insurance plan by name|
| 6 |PATCH | `Change status plan Company`           | `/insurance-plan/{id}/change-status`|yes|Change status insurance plan|
| 7 |GET | `Get list insurance plans`| `/insurance-plan/get-list`        |yes            |Get list insurance plans|
| 8 |GET | `Get list formats`| `/insurance-plan/get-list-formats`        |yes            |Get list formats|
| 9 |GET | `Get list ins types`| `/insurance-plan/get-list-ins-types`        |yes            |Get list ins types|
| 10 |GET | `Get list plan types`| `/insurance-plan/get-list-plan-types`        |yes            |Get list plan types|
| 11 |GET | `Get list charge usings`| `/insurance-plan/get-list-charge-usings`        |yes            |Get list charge usings|
| 12 |GET | `Get list file methods`| `/insurance-company/get-list-file-methods`        |yes            |Get list file methods|
| 13 |GET | `Get list from the date`| `/insurance-company/get-list-from-the-date`        |yes            |Get list from the date of|



>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean





#


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
    "cap_group":"someCapGroup", /** optional */
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
    
    "format_id": 1, /** optional */
    "file_method_id": 1, /** optional */
    "naic":"someNaic", /** optional */
    "time_failed": {
        "days": 30, /** optional */
        "from_id": 2, /** optional */
    },
    "file_capitated": true, /** required */
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
    "cap_group": "someCapGroup",
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
    "format": "y-m-d",
    "method": "someMethod",
    "naic": "someNaic",
    "insurance_company_id": 1,
    "updated_at": "2022-03-18T15:26:42.000000Z",
    "created_at": "2022-03-18T15:26:42.000000Z",
    "id": 4
}
```


#

<a name="get-all-insurance-plan"></a>
## Get All Insurance plan

### Param in header

```json
{
    "Authorization": bearer <token>
}
```


## Response

> {success} 200 Insurance found

#


```json
[
    {
        "id": 5,
        "code": "IP-00002-2022",
        "name": "Name 2",
        "ins_type": "ins_type 2",
        "cap_group": "CapGroup 2",
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
        "format": "y-m-d",
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
        "cap_group": "someCapGroup",
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
        "format": "y-m-d",
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
]
```


<a name="get-all-insurance-plan-server"></a>
## Get all insurance company from server

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`query <string>`
`itemsPerPage <string>`
`page <integer>`
`sortBy <string>`
`sortDesc <boolean>`
`insurance_company_id <integer>`

## Example path

>{primary} ?query=fieldSearch&itemsPerPage=5&sortDesc=1&page=1&sortBy=fieldName&insurnce_company_id=1

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
            "cap_group": "CapGroup 2",
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
            "format": "y-m-d",
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
            "cap_group": "someCapGroup",
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
            "format": "y-m-d",
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
{
    "id": <integer>
}
```

## Response

> {success} 200 Insurance found

#


```json
{
    "id": 5,
    "code": "IP-00002-2022",
    "name": "Name 2",
    "ins_type": "ins_type 2",
    "cap_group": "CapGroup 2",
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
    "format": "y-m-d",
    "method": "Method 2",
    "naic": "Naic 2",
    "insurance_company_id": 1,
    "created_at": "2022-03-18T15:28:30.000000Z",
    "updated_at": "2022-03-18T15:28:30.000000Z",
    "public_notes": [
        {
            "id": 2,
            "note": "Note 2",
            "publishable_type": "App\\Models\\InsurancePlan",
            "publishable_id": 5,
            "created_at": "2022-03-18T15:28:30.000000Z",
            "updated_at": "2022-03-18T15:28:30.000000Z"
        }
    ],
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
    "insurance_company": {
        "id": 1,
        "code": "IC-00001-2022",
        "name": "Insurance",
        "file_method": "second",
        "naic": "AX2131",
        "created_at": "2022-03-16T23:28:29.000000Z",
        "updated_at": "2022-03-16T23:28:29.000000Z",
        "status": false
    },
    "billing_companies": []
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
    "cap_group":"someCapGroup", /** optional */
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
    
    "format_id": 1, /** optional */
    "file_method_id": 1, /** optional */
    "naic":"someNaic", /** optional */
    "time_failed": {
        "days": 30, /** optional */
        "from_id": 2, /** optional */
    },
    "file_capitated": true, /** required */
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
    "cap_group": "someCapGroup",
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
    "format": "y-m-d",
    "method": "someMethod",
    "naic": "someNaic",
    "insurance_company_id": 1,
    "created_at": "2022-03-18T15:26:42.000000Z",
    "updated_at": "2022-03-18T15:38:58.000000Z"
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
{
    "name": <string>
}
```

## Response

> {success} 200 Insurance found

#


```json
[
    {
        "id": 5,
        "code": "IP-00002-2022",
        "name": "Name 2",
        "ins_type": "ins_type 2",
        "cap_group": "CapGroup 2",
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
        "format": "y-m-d",
        "method": "Method 2",
        "naic": "Naic 2",
        "insurance_company_id": 1,
        "created_at": "2022-03-18T15:28:30.000000Z",
        "updated_at": "2022-03-18T15:28:30.000000Z"
    },
    {
        "id": 4,
        "code": "IP-00001-2022",
        "name": "someName",
        "ins_type": "some ins_type edite",
        "cap_group": "someCapGroup",
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
        "format": "y-m-d",
        "method": "someMethod",
        "naic": "someNaic",
        "insurance_company_id": 1,
        "created_at": "2022-03-18T15:26:42.000000Z",
        "updated_at": "2022-03-18T15:38:58.000000Z"
    }
]
```

#


<a name="change-status-plan-company"></a>
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
{
    "id": <integer>
}
```

## Response

> {success} 204 status changed

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