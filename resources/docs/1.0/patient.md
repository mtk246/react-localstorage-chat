

# Patient Docs

---

- [Basic data](#basic-data)
- [Create patient](#create-patient)
- [Get all patient](#get-all-patient)
- [Get one patient](#get-one-patient)
- [Update patient](#Update-patient)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Patient`                    | `/patient/`               |yes             |Create Patient|         
| 2 |GET | `Get all Patient`                   | `/patient/`        |yes            |Get all Patient|
| 3 |GET | `Get one Patient`                   | `/patient/{id}`|yes|Get one Patient|
| 4 |PUT | `Update Patient`                | `/patient/{id}`|yes|Update Patient|


>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean

<a name="create-patient"></a>
## Create Patient

### Body request example

```json
{
    "driver_license": "Driver License",
    "credit_score": "Credit Score",
    "patient_private":{
        "reference_num"     : "Ref-0001",
        "med_num"           : "Med-001",
        "patient_num"       : "Pat-001"
    },
    "profile": {
        "ssn":"237891812",
        "first_name":"Fisrt Name",
        "last_name":"Last Name",
        "middle_name":"Middle Name",
        "sex":"m",
        "date_of_birth":"1990-11-11",
        "social_medias": [
            {
                "name": "nameSocialMedia1",
                "link": "URLSocialMedia1"
            },
            {
                "name": "nameSocialMedia2",
                "link": "URLSocialMedia2"
            }
        ]
    },
    "address": {
        "address": "Direction address",
        "city": "city address",
        "state": "state address",
        "zip": "123456789"
    },
    "contact": {
        "phone": "04241234321",
        "fax": "",
        "mobile": "",
        "email": "user@gmail.com"
    },
    "marital": {
        "spuse_name": "Spuse name",
        "spuse_work": "Spuse work",
        "spuse_work_phone": "Spuse phone"

    },
    "guarantor": {
        "name": "name",
        "phone": "phone"
    },
    "employment": {
        "employer_name": "employer name",
        "employer_address": "employer address",
        "employer_phone": "employer phone",
        "position": "patient position"
    },
    "emergency_contacts": [
        {
            "name": "name emergency contact 1",
            "cellphone": "cellphone emergency contacts 1",
            "relationship": "relationship emergency contacts 1"
        },
        {
            "name": "name emergency contact 2",
            "cellphone": "cellphone emergency contacts 2",
            "relationship": "relationship emergency contacts 2"
        }
    ],
    "insurance_policies": [
        {
            "insurance_company": 1,
            "insurance_plan": 1,
            "own_insurance": true
        },
        {
            "insurance_company": 1,
            "insurance_plan": 2,
            "own_insurance": false,
            "suscriber": {
                "ssn": "ssn suscriber",
                "first_name" : "firstName suscriber",
                "last_name"  : "lastName suscriber",
                "address": {
                    "address": "Direction address suscriber",
                    "city": "city address suscriber",
                    "state": "state address suscriber",
                    "zip": "123456789"
                },
                "contact": {
                    "phone": "04241234321",
                    "fax": "",
                    "mobile": "",
                    "email": "suscriber@gmail.com"
                }
            }
        }
    ]
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 Patient created


#



```json
{
    "id": 1,
    "driver_license": "driver license",
    "credit_score": "credit score",
    "user_id": 1,
    "created_at": "2022-03-17T20:45:39.000000Z",
    "updated_at": "2022-03-17T20:45:39.000000Z"
}
```


#

<a name="get-all-patient"></a>
## Get All Patient

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Doctor found

#


```json
[
    {
        "id": 1,
        "driver_license": "driver license",
        "credit_score": "credit score",
        "user_id": 1,
        "user": {
            "id": 1,
            "email": "user@billing.com",
            "email_verified_at": null,
            "created_at": "2022-03-14T20:49:19.000000Z",
            "updated_at": "2022-03-15T08:59:12.000000Z",
            "token": null,
            "isLogged": true,
            "isBlocked": false,
            "usercode": "US-00001-2022",
            "userkey": null,
            "status": false,
            "last_login": "2022-03-15 08:59:12",
            "profile_id": 1,
            "billing_company_id": null,
            "roles": [
                {
                    "id": 1,
                    "name": "PATIENT",
                    "guard_name": "api",
                    "created_at": "2022-03-14T20:49:19.000000Z",
                    "updated_at": "2022-03-14T20:49:19.000000Z",
                    "pivot": {
                        "model_id": 1,
                        "role_id": 1,
                        "model_type": "App\\Models\\User"
                    }
                }
            ],
            "addresses": [
                {
                    "id": 1,
                    "address": "Singleton Rd",
                    "city": "Calimesa",
                    "state": "California",
                    "zip": "923202207",
                    "billing_company_id": null,
                    "created_at": "2022-03-14T20:49:20.000000Z",
                    "updated_at": "2022-03-14T20:49:20.000000Z",
                    "addressable_type": "App\\Models\\User",
                    "addressable_id": 1
                }
            ],
            "contacts": [
                {
                    "id": 1,
                    "phone": "(740) 208-8506",
                    "fax": "(918) 534-7718",
                    "email": "dach.leopold@nikolaus.com",
                    "billing_company_id": null,
                    "created_at": "2022-03-14T20:49:20.000000Z",
                    "updated_at": "2022-03-14T20:49:20.000000Z",
                    "mobile": "218-885-3211",
                    "contactable_type": "App\\Models\\User",
                    "contactable_id": 1
                }
            ]

        },
        "marital": {
            "spuse_name": "Spuse name",
            "spuse_work": "Spuse work",
            "spuse_work_phone": "Spuse phone",
            "created_at": "2022-03-17T20:45:39.000000Z",
            "updated_at": "2022-03-17T20:45:39.000000Z"
        },
        "guarantor": {
            "name": "name",
            "phone": "phone",
            "created_at": "2022-03-17T20:45:39.000000Z",
            "updated_at": "2022-03-17T20:45:39.000000Z"
        },
        "employment": {
            "employer_name": "employer name",
            "employer_address": "employer address",
            "employer_phone": "employer phone",
            "position": "patient position",
            "created_at": "2022-03-17T20:45:39.000000Z",
            "updated_at": "2022-03-17T20:45:39.000000Z"
        },
        "emergency_contacts": [
            {
                "name": "name emergency contact 1",
                "cellphone": "cellphone emergency contacts 1",
                "relationship": "relationship emergency contacts 1",
                "created_at": "2022-03-17T20:45:39.000000Z",
                "updated_at": "2022-03-17T20:45:39.000000Z"
            },
            {
                "name": "name emergency contact 2",
                "cellphone": "cellphone emergency contacts 2",
                "relationship": "relationship emergency contacts 2",
                "created_at": "2022-03-17T20:45:39.000000Z",
                "updated_at": "2022-03-17T20:45:39.000000Z"
            }
        ],
        "public_notes": [],
        "private_notes": [],
        "insurance_plans": [
            {
                "id": 1,
                "code": "663611",
                "name": "sdafdasf",
                "ins_type": "dfssdfads",
                "cap_group": "3242",
                "accept_assign": true,
                "pre_authorization": true,
                "file_zero_changes": false,
                "referral_required": true,
                "accrue_patient_resp": true,
                "require_abn": true,
                "pqrs_eligible": true,
                "allow_attached_files": true,
                "eff_date": "2022-03-17",
                "charge_using": "324234",
                "format": "d-m-y",
                "method": "324234",
                "naic": "324234",
                "insurance_company_id": 1,
                "suscriber": {
                    "ssn": "ssn suscriber",
                    "first_name" : "firstName suscriber",
                    "last_name"  : "lastName suscriber",
                },
                "created_at": "2022-03-17T20:45:39.000000Z",
                "updated_at": "2022-03-17T20:45:39.000000Z"
            }
        ],
        "created_at": "2022-03-17T20:45:39.000000Z",
        "updated_at": "2022-03-17T20:45:39.000000Z"
    }
    
]
```

#


<a name="get-one-patient"></a>
## Get One Patient

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

> {success} 200 Patient found

#


```json
{
    "id": 1,
    "driver_license": "driver license",
    "credit_score": "credit score",
    "user_id": 1,
    "user": {
        "id": 1,
        "email": "user@billing.com",
        "email_verified_at": null,
        "created_at": "2022-03-14T20:49:19.000000Z",
        "updated_at": "2022-03-15T08:59:12.000000Z",
        "token": null,
        "isLogged": true,
        "isBlocked": false,
        "usercode": "US-00001-2022",
        "userkey": null,
        "status": false,
        "last_login": "2022-03-15 08:59:12",
        "profile_id": 1,
        "billing_company_id": null,
        "roles": [
            {
                "id": 1,
                "name": "PATIENT",
                "guard_name": "api",
                "created_at": "2022-03-14T20:49:19.000000Z",
                "updated_at": "2022-03-14T20:49:19.000000Z",
                "pivot": {
                    "model_id": 1,
                    "role_id": 1,
                    "model_type": "App\\Models\\User"
                }
            }
        ],
        "addresses": [
            {
                "id": 1,
                "address": "Singleton Rd",
                "city": "Calimesa",
                "state": "California",
                "zip": "923202207",
                "billing_company_id": null,
                "created_at": "2022-03-14T20:49:20.000000Z",
                "updated_at": "2022-03-14T20:49:20.000000Z",
                "addressable_type": "App\\Models\\User",
                "addressable_id": 1
            }
        ],
        "contacts": [
            {
                "id": 1,
                "phone": "(740) 208-8506",
                "fax": "(918) 534-7718",
                "email": "dach.leopold@nikolaus.com",
                "billing_company_id": null,
                "created_at": "2022-03-14T20:49:20.000000Z",
                "updated_at": "2022-03-14T20:49:20.000000Z",
                "mobile": "218-885-3211",
                "contactable_type": "App\\Models\\User",
                "contactable_id": 1
            }
        ]

    },
    "marital": {
        "spuse_name": "Spuse name",
        "spuse_work": "Spuse work",
        "spuse_work_phone": "Spuse phone",
        "created_at": "2022-03-17T20:45:39.000000Z",
        "updated_at": "2022-03-17T20:45:39.000000Z"
    },
    "guarantor": {
        "name": "name",
        "phone": "phone",
        "created_at": "2022-03-17T20:45:39.000000Z",
        "updated_at": "2022-03-17T20:45:39.000000Z"
    },
    "employment": {
        "employer_name": "employer name",
        "employer_address": "employer address",
        "employer_phone": "employer phone",
        "position": "patient position",
        "created_at": "2022-03-17T20:45:39.000000Z",
        "updated_at": "2022-03-17T20:45:39.000000Z"
    },
    "emergency_contacts": [
        {
            "name": "name emergency contact 1",
            "cellphone": "cellphone emergency contacts 1",
            "relationship": "relationship emergency contacts 1",
            "created_at": "2022-03-17T20:45:39.000000Z",
            "updated_at": "2022-03-17T20:45:39.000000Z"
        },
        {
            "name": "name emergency contact 2",
            "cellphone": "cellphone emergency contacts 2",
            "relationship": "relationship emergency contacts 2",
            "created_at": "2022-03-17T20:45:39.000000Z",
            "updated_at": "2022-03-17T20:45:39.000000Z"
        }
    ],
    "public_notes": [],
    "private_notes": [],
    "insurance_plans": [
        {
            "id": 1,
            "code": "663611",
            "name": "sdafdasf",
            "ins_type": "dfssdfads",
            "cap_group": "3242",
            "accept_assign": true,
            "pre_authorization": true,
            "file_zero_changes": false,
            "referral_required": true,
            "accrue_patient_resp": true,
            "require_abn": true,
            "pqrs_eligible": true,
            "allow_attached_files": true,
            "eff_date": "2022-03-17",
            "charge_using": "324234",
            "format": "d-m-y",
            "method": "324234",
            "naic": "324234",
            "insurance_company_id": 1,
            "suscriber": {
                "ssn": "ssn suscriber",
                "first_name" : "firstName suscriber",
                "last_name"  : "lastName suscriber",
            },
            "created_at": "2022-03-17T20:45:39.000000Z",
            "updated_at": "2022-03-17T20:45:39.000000Z"
        }
    ],
    "created_at": "2022-03-17T20:45:39.000000Z",
    "updated_at": "2022-03-17T20:45:39.000000Z"
}
```

#


<a name="Update-patient"></a>
## Update Patient

### Body request example

```json
{
    "driver_license": "Driver License",
    "credit_score": "Credit Score",
    "patient_private":{
        "reference_num"     : "Ref-0001",
        "med_num"           : "Med-001",
        "patient_num"       : "Pat-001"
    },
    "profile": {
        "ssn":"237891812",
        "first_name":"Fisrt Name",
        "last_name":"Last Name",
        "middle_name":"Middle Name",
        "sex":"m",
        "date_of_birth":"1990-11-11",
        "social_medias": [
            {
                "name": "nameSocialMedia1",
                "link": "URLSocialMedia1"
            },
            {
                "name": "nameSocialMedia2",
                "link": "URLSocialMedia2"
            }
        ]
    },
    "address": {
        "address": "Direction address",
        "city": "city address",
        "state": "state address",
        "zip": "123456789"
    },
    "contact": {
        "phone": "04241234321",
        "fax": "",
        "mobile": "",
        "email": "user@gmail.com"
    },
    "marital": {
        "spuse_name": "Spuse name",
        "spuse_work": "Spuse work",
        "spuse_work_phone": "Spuse phone"

    },
    "guarantor": {
        "name": "name",
        "phone": "phone"
    },
    "employment": {
        "employer_name": "employer name",
        "employer_address": "employer address",
        "employer_phone": "employer phone",
        "position": "patient position"
    },
    "emergency_contacts": [
        {
            "name": "name emergency contact 1",
            "cellphone": "cellphone emergency contacts 1",
            "relationship": "relationship emergency contacts 1"
        },
        {
            "name": "name emergency contact 2",
            "cellphone": "cellphone emergency contacts 2",
            "relationship": "relationship emergency contacts 2"
        }
    ],
    "insurance_policies": [
        {
            "insurance_company": 1,
            "insurance_plan": 1,
            "own_insurance": true
        },
        {
            "insurance_company": 1,
            "insurance_plan": 2,
            "own_insurance": false,
            "suscriber": {
                "ssn": "ssn suscriber",
                "first_name" : "firstName suscriber",
                "last_name"  : "lastName suscriber",
                "address": {
                    "address": "Direction address suscriber",
                    "city": "city address suscriber",
                    "state": "state address suscriber",
                    "zip": "123456789"
                },
                "contact": {
                    "phone": "04241234321",
                    "fax": "",
                    "mobile": "",
                    "email": "suscriber@gmail.com"
                }
            }
        }
    ]
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Patient updated


#



```json
{
    "id": 1,
    "driver_license": "driver license",
    "credit_score": "credit score",
    "user_id": 1,
    "created_at": "2022-03-17T20:45:39.000000Z",
    "updated_at": "2022-03-17T20:45:39.000000Z"
}
```