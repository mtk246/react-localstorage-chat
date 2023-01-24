# Insurance Plan Docs

---

- [Basic data](#basic-data)
- [Create insurance plan](#create-insurance-plan)
- [Get all insurance plan](#get-all-insurance-plan)
- [Get one insurance plan](#get-one-insurance-plan)
- [Update insurance plan](#update-insurance-plan)
- [Get insurance plan by name](#get-insurance-plan-by-name)
- [Change status plan company](#change-status-plan-company)
- [Get all insurance plan by insurance company](#get-all-insurance-plan-by-insurance-company)
- [Get list insurance plans](#get-list-insurance-plans)
- [Get list insurance plans by insurance company](#get-list-insurance-plans-by-insurance-company)
- [Get list file methods](#get-list-file-methods)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Insurance plan`                    | `/insurance-plan/`               |yes             |Create Insurance Plan|         
| 2 |GET | `Get all Insurance plan`                   | `/insurance-plan/`        |yes            |Get all Insurance Plan|
| 3 |GET | `Get one Insurance plan`                   | `/insurance-plan/{id}`|yes|Get one Insurance Plan|
| 4 |PUT | `Update Insurance plan`                | `/insurance-plan/{id}`|yes|Update Insurance Plan|
| 5 |GET | `Get Insurance plan by name`           | `/insurance-plan/{name}/get-by-name`|yes|Get all Insurance Plan by name|
| 6 |PATCH | `Change status plan Company`           | `/insurance-plan/{id}/change-status`|yes|Change status Insurance Plan|
| 7 |GET | `Get all insurance plan by insurance company`           | `/insurance-plan/insurance-company/{id}/get-by-insurance-company`|yes|Get all insurance plan by insurance company|
| 8 |GET | `Get list insurance plans`| `/insurance-plan/get-list`        |yes            |Get list insurance plans|
| 9 |GET | `Get list insurance plans by insurance company`| `/insurance-plan/get-list-by-company/{insurance_company}`        |yes            |Get list insurance plans by insurance company|
| 10 |GET | `Get list file methods`| `/insurance-company/get-list-file-methods`        |yes            |Get list file methods|



>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean





#


<a name="create-insurance-plan"></a>
## Create Insurance Plan

### Body request example

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "ins_type":"some ins_type",
    "name":"someName",
    "nickname":"nickname plan someName",
    "note":"someNote",
    "cap_group":"someCapGroup",
    "accept_assign":true,
    "pre_authorization":true,
    "file_zero_changes":true,
    "referral_required":true,
    "accrue_patient_resp":true,
    "require_abn":true,
    "pqrs_eligible":true,
    "allow_attached_files":true,
    "eff_date":"2022-01-23",
    "charge_using":"someCharge",
    "format":"y-m-d",
    "method":"someMethod",
    "naic":"someNaic",
    "insurance_company_id":1
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
    "ins_type":"some ins_type edited",
    "name":"someName",
    "nickname":"nickname plan someName edit",
    "note":"someNote",
    "cap_group":"someCapGroup",
    "accept_assign":true,
    "pre_authorization":true,
    "file_zero_changes":true,
    "referral_required":true,
    "accrue_patient_resp":true,
    "require_abn":true,
    "pqrs_eligible":true,
    "allow_attached_files":true,
    "eff_date":"2022-01-23",
    "charge_using":"someCharge",
    "format":"y-m-d",
    "method":"someMethod",
    "naic":"someNaic",
    "insurance_company_id":1
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

<a name="get-list-insurance-plans-by-insurance-company"></a>
## Get list insurance plans by insurance company

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "insurance_company_id": required <integer>
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