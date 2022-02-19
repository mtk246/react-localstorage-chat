# Insurance Plan Docs

---

- [Basic data](#basic-data)
- [Create insurance plan](#create-insurance-plan)
- [Get all insurance plan](#get-all-insurance-plan)
- [Get one insurance plan](#get-one-insurance-plan)
- [Update insurance plan](#update-insurance-plan)
- [Get one insurance plan by name](#get-one-insurance-plan-by-name)
- [Change status plan company](#change-status-plan-company)
- [Get all insurance plan by insurance company](#get-all-insurance-plan-by-insurance-company)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Insurance plan`                    | `/insurance-plan/`               |yes             |Create Insurance Plan|         
| 2 |GET | `Get all Insurance plan`                   | `/insurance-plan/`        |yes            |Get all Insurance Plan|
| 3 |GET | `Get one Insurance plan`                   | `/insurance-plan/{id}`|yes|Get one Insurance Plan|
| 4 |PUT | `Update Insurance plan`                | `/insurance-plan/{id}`|yes|Update Insurance Plan|
| 5 |GET | `Get one Insurance plan by name`           | `/insurance-plan/{name}/get-by-name`|yes|Get one Insurance Plan by name|
| 6 |PATCH | `Change status plan Company`           | `/insurance-plan/{id}/change-status`|yes|Change status Insurance Plan|
| 7 |GET | `Get all insurance plan by insurance company`           | `/insurance-plan/insurance-company/{id}/get-by-insurance-company`|yes|Get all insurance plan by insurance company|



>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean





#


<a name="create-insurance-plan"></a>
## Create Insurance Plan

### Body request example

```json
{
    "ins_type":"some ins_type",
    "name":"someName3",
    "note":"someNote",
    "plan_type":"somePlanType",
    "cap_group":"someCapGroup",
    "accept_assign":true,
    "pre_authorization":true,
    "file_zero":true,
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

> {success} 201 Insurance Company created


#



```json
{
    "ins_type": "some ins_type",
    "name": "someName33",
    "note": "someNote",
    "plan_type": "somePlanType",
    "cap_group": "someCapGroup",
    "accept_assign": true,
    "pre_authorization": true,
    "file_zero": true,
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
    "code": "981793",
    "updated_at": "2022-02-04T03:47:27.000000Z",
    "created_at": "2022-02-04T03:47:27.000000Z",
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
        "id": 1,
        "code": "668953",
        "name": "someName",
        "status": false,
        "note": "someNote",
        "ins_type": "some ins_type",
        "plan_type": "somePlanType",
        "cap_group": "someCapGroup",
        "accept_assign": true,
        "pre_authorization": true,
        "file_zero": true,
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
        "created_at": "2022-02-04T03:21:07.000000Z",
        "updated_at": "2022-02-04T03:21:07.000000Z"
    },
    {
        "id": 2,
        "code": "039902",
        "name": "someName1",
        "status": false,
        "note": "someNote",
        "ins_type": "some ins_type",
        "plan_type": "somePlanType",
        "cap_group": "someCapGroup",
        "accept_assign": true,
        "pre_authorization": true,
        "file_zero": true,
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
        "created_at": "2022-02-04T03:23:03.000000Z",
        "updated_at": "2022-02-04T03:23:03.000000Z"
    },
    {
        "id": 3,
        "code": "805671",
        "name": "someName3",
        "status": false,
        "note": "someNote",
        "ins_type": "some ins_type",
        "plan_type": "somePlanType",
        "cap_group": "someCapGroup",
        "accept_assign": true,
        "pre_authorization": true,
        "file_zero": true,
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
        "created_at": "2022-02-04T03:26:53.000000Z",
        "updated_at": "2022-02-04T03:26:53.000000Z"
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
    "ins_type": "some ins_type",
    "name": "someName33",
    "note": "someNote",
    "plan_type": "somePlanType",
    "cap_group": "someCapGroup",
    "accept_assign": true,
    "pre_authorization": true,
    "file_zero": true,
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
    "code": "981793",
    "updated_at": "2022-02-04T03:47:27.000000Z",
    "created_at": "2022-02-04T03:47:27.000000Z",
    "id": 4
}
```


#

<a name="update-insurance-plan"></a>
## Update Insurance plan

### Body request example

```json
{
    "ins_type":"some ins_type",
    "note":"someNote",
    "plan_type":"somePlanType",
    "cap_group":"someCapGroup",
    "accept_assign":true,
    "pre_authorization":true,
    "file_zero":true,
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
    "ins_type": "some ins_type",
    "name": "someName33",
    "note": "someNote",
    "plan_type": "somePlanType",
    "cap_group": "someCapGroup",
    "accept_assign": true,
    "pre_authorization": true,
    "file_zero": true,
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
    "code": "981793",
    "updated_at": "2022-02-04T03:47:27.000000Z",
    "created_at": "2022-02-04T03:47:27.000000Z",
    "id": 4
}
```

#

<a name="get-one-insurance-plan-by-name"></a>
## Get One Insurance Plan by name


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
{
    "id": 1,
    "code": "668953",
    "name": "someName",
    "status": false,
    "note": "someNote",
    "ins_type": "some ins_type",
    "plan_type": "somePlanType",
    "cap_group": "someCapGroup",
    "accept_assign": true,
    "pre_authorization": true,
    "file_zero": true,
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
    "created_at": "2022-02-04T03:21:07.000000Z",
    "updated_at": "2022-02-04T03:21:07.000000Z"
}
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


