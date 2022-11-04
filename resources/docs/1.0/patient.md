

# Patient Docs

---

- [Basic data](#basic-data)
- [Create patient](#create-patient)
- [Get all patient](#get-all-patient)
- [Get one patient](#get-one-patient)
- [Get one patient by ssn](#get-one-patient-by-ssn)
- [Update patient](#Update-patient)
- [Change status patient](#change-status-patient)
- [Get all patient subscribers](#get-all-patient-subscribers)
- [Add policy to patient](#add-policy-to-patient)
- [Edit policy to patient](#edit-policy-to-patient)
- [Remove policy to patient](#remove-policy-to-patient)
- [Get policy to patient](#get-policy-to-patient)
- [Get all policies to patient](#get-all-policies-to-patient)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Patient`                    | `/patient/`               |yes             |Create Patient|         
| 2 |GET | `Get all Patient`                   | `/patient/`        |yes            |Get all Patient|
| 3 |GET | `Get one Patient`                   | `/patient/{id}`|yes|Get one Patient|
| 4 |GET | `Get one Patient by ssn`            | `/patient/get-by-ssn{ssn}`|yes|Get one Patient by ssn|
| 5 |PUT | `Update Patient`                | `/patient/{id}`|yes|Update Patient|
| 6 |PATCH | `Change status Patient`           | `/patient/change-status/{id}`|yes|change status patient|
| 7 |GET | `Get all patient subscribers`| `/patient/get-subscribers/{ssn_patient}`        |yes            |Get all patient subscribers|
| 8 |PATCH | `Add policy to patient`           | `/patient/add-policy-to-patient/{patient_id}`|yes|add policy to patient|
| 9 |PATCH | `Edit policy to patient`           | `/patient/{patient_id}/edit-policy/{policy_id}`|yes|edit policy to patient|
| 10 |PATCH | `Remove policy to patient`           | `/patient/{patient_id}/remove-policy/{policy_id}`|yes|remove policy to patient|
| 11 |GET | `Get policy to patient`           | `/patient/get-policy/{policy_id}`|yes|get policy to patient|
| 11 |GET | `Get all policies to patient`           | `/patient/{patient_id}/get-policies`|yes|get all policies to patient|


>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean

<a name="create-patient"></a>
## Create Patient

### Body request example

```json
{
    "driver_license": "Driver License",
    "billing_company_id": 1, /** Only required by superuser */
    "public_note": "Some note publics",
    "private_note": "Some note privates",
    "patient_private":{
        "reference_num"     : "Ref-0001",
        "med_num"           : "Med-001",
        "patient_num"       : "Pat-001"
    },
    "patient_condition_related":{
        "employment":     false,
        "auto_accident":  false,
        "place_state":    "placeStatePatient",
        "other_accident": false
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
    "employments": [
        {
            "employer_name": "employer name",
            "employer_address": "employer address",
            "employer_phone": "employer phone",
            "position": "patient position"
        }
    ],
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
            "policy_number": 12344,
            "copay": 200,  //optional
            "group_number": 1234, //optional
            "eff_date": "2020-01-23",
            "end_date": "2022-01-23",  //optional
            "release_info": false,
            "assign_benefits": false,
            "own_insurance": true,
            "subscriber": null
        },
        {
            "insurance_company": 1,
            "insurance_plan": 2,
            "policy_number": 12344,
            "copay": 200,  //optional
            "group_number": 1234, //optional
            "eff_date": "2020-01-23",
            "end_date": "2022-01-23",  //optional
            "release_info": false,
            "assign_benefits": false,
            "own_insurance": false,
            "subscriber": {
                "ssn": "ssn subscriber",
                "first_name" : "firstName subscriber",
                "last_name"  : "lastName subscriber",
                "address": {
                    "address": "Direction address subscriber",
                    "city": "city address subscriber",
                    "state": "state address subscriber",
                    "zip": "123456789"
                },
                "contact": {
                    "phone": "04241234321",
                    "fax": "",
                    "mobile": "",
                    "email": "subscriber@gmail.com"
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

> {success} 200 Patient found

#


```json
[
    {
        "id": 1,
        "driver_license": "driver license",
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
        "companies": [],
        "employments": [
            {
                "employer_name": "employer name",
                "employer_address": "employer address",
                "employer_phone": "employer phone",
                "position": "patient position",
                "created_at": "2022-03-17T20:45:39.000000Z",
                "updated_at": "2022-03-17T20:45:39.000000Z"
            }
        ],
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
        "public_notes": [
            {
                "id": 2,
                "note": "Note public",
                "publishable_type": "App\\Models\\Patient",
                "publishable_id": 1,
                "created_at": "2022-04-20T21:53:26.000000Z",
                "updated_at": "2022-04-20T21:53:26.000000Z"
            }
        ],
        "private_notes": [
            {
                "id": 1,
                "note": "Note private",
                "billing_company_id": 1,
                "publishable_type": "App\\Models\\Patient",
                "publishable_id": 1,
                "created_at": "2022-04-20T21:53:26.000000Z",
                "updated_at": "2022-04-20T21:53:26.000000Z"
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


`````json
{
    "id": 1,
    "driver_license": "driver license",
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
    "companies": [
        {
            "id": 1,
            "code": "CO-00001-2022",
            "name": "company first",
            "npi": "222CF123",
            "created_at": "2022-05-02T14:45:27.000000Z",
            "updated_at": "2022-05-02T14:45:27.000000Z",
            "status": false,
            "pivot": {
                "patient_id": 1,
                "company_id": 1,
                "created_at": "2022-05-06T21:21:48.000000Z",
                "updated_at": "2022-05-06T21:21:48.000000Z"
            }
        },
        {
            "id": 3,
            "code": "CO-00003-2022",
            "name": "PANAMERICAN INTERNAL MEDICINE INC",
            "npi": "1396903308",
            "created_at": "2022-05-04T01:38:14.000000Z",
            "updated_at": "2022-05-04T01:38:14.000000Z",
            "status": false,
            "pivot": {
                "patient_id": 1,
                "company_id": 3,
                "created_at": "2022-05-06T21:21:48.000000Z",
                "updated_at": "2022-05-06T21:21:48.000000Z"
            }
        }
    ],
    "employments": [
        {
            "employer_name": "employer name",
            "employer_address": "employer address",
            "employer_phone": "employer phone",
            "position": "patient position",
            "created_at": "2022-03-17T20:45:39.000000Z",
            "updated_at": "2022-03-17T20:45:39.000000Z"
        }
    ],
    "emergency_contacts": [
        {
            "name": "name emergency contact 1",
            "cellphone": "cellphone emergency contacts 1",
            "relationship": "relationship emergency contacts 1",
            "created_at": "2022-03-17T20:45:39.000000Z",
            "updated_at": "2022-03-17T20:45:39.000000Z"
        }
    ],
    "public_notes": [
        {
            "id": 2,
            "note": "Note public",
            "publishable_type": "App\\Models\\Patient",
            "publishable_id": 1,
            "created_at": "2022-04-20T21:53:26.000000Z",
            "updated_at": "2022-04-20T21:53:26.000000Z"
        }
    ],
    "private_notes": [
        {
            "id": 1,
            "note": "Note private",
            "billing_company_id": 1,
            "publishable_type": "App\\Models\\Patient",
            "publishable_id": 1,
            "created_at": "2022-04-20T21:53:26.000000Z",
            "updated_at": "2022-04-20T21:53:26.000000Z"
        }
    ],
    "created_at": "2022-03-17T20:45:39.000000Z",
    "updated_at": "2022-03-17T20:45:39.000000Z"
}
`````

#
<a name="get-one-patient-by-ssn"></a>
## Get one patient by ssn

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "ssn": <string>
}
```

## Response

> {success} 200 Patient found

#


`````json
{
    "id": 1,
    "driver_license": "driver license",
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
    "companies": [
        {
            "id": 1,
            "code": "CO-00001-2022",
            "name": "company first",
            "npi": "222CF123",
            "created_at": "2022-05-02T14:45:27.000000Z",
            "updated_at": "2022-05-02T14:45:27.000000Z",
            "status": false,
            "pivot": {
                "patient_id": 1,
                "company_id": 1,
                "created_at": "2022-05-06T21:21:48.000000Z",
                "updated_at": "2022-05-06T21:21:48.000000Z"
            }
        },
        {
            "id": 3,
            "code": "CO-00003-2022",
            "name": "PANAMERICAN INTERNAL MEDICINE INC",
            "npi": "1396903308",
            "created_at": "2022-05-04T01:38:14.000000Z",
            "updated_at": "2022-05-04T01:38:14.000000Z",
            "status": false,
            "pivot": {
                "patient_id": 1,
                "company_id": 3,
                "created_at": "2022-05-06T21:21:48.000000Z",
                "updated_at": "2022-05-06T21:21:48.000000Z"
            }
        }
    ],
    "employments": [
        {
            "employer_name": "employer name",
            "employer_address": "employer address",
            "employer_phone": "employer phone",
            "position": "patient position",
            "created_at": "2022-03-17T20:45:39.000000Z",
            "updated_at": "2022-03-17T20:45:39.000000Z"
        }
    ],
    "emergency_contacts": [
        {
            "name": "name emergency contact 1",
            "cellphone": "cellphone emergency contacts 1",
            "relationship": "relationship emergency contacts 1",
            "created_at": "2022-03-17T20:45:39.000000Z",
            "updated_at": "2022-03-17T20:45:39.000000Z"
        }
    ],
    "public_notes": [
        {
            "id": 2,
            "note": "Note public",
            "publishable_type": "App\\Models\\Patient",
            "publishable_id": 1,
            "created_at": "2022-04-20T21:53:26.000000Z",
            "updated_at": "2022-04-20T21:53:26.000000Z"
        }
    ],
    "private_notes": [
        {
            "id": 1,
            "note": "Note private",
            "billing_company_id": 1,
            "publishable_type": "App\\Models\\Patient",
            "publishable_id": 1,
            "created_at": "2022-04-20T21:53:26.000000Z",
            "updated_at": "2022-04-20T21:53:26.000000Z"
        }
    ],
    "created_at": "2022-03-17T20:45:39.000000Z",
    "updated_at": "2022-03-17T20:45:39.000000Z"
}
`````

#


<a name="Update-patient"></a>
## Update Patient

### Body request example

```json
{
    "driver_license": "Driver License",
    "billing_company_id": 1, /** Only required by superuser */
    "public_note": "Note public",
    "private_note": "Note private",
    "patient_private":{
        "reference_num"     : "Ref-0001",
        "med_num"           : "Med-001",
        "patient_num"       : "Pat-001"
    },
    "patient_condition_related":{
        "employment":     false,
        "auto_accident":  false,
        "place_state":    "placeStatePatient",
        "other_accident": false
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
    "employments": [
        {
            "employer_name": "employer name",
            "employer_address": "employer address",
            "employer_phone": "employer phone",
            "position": "patient position"
        }
    ],
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
            "insurance_company_name": "Name Company",
            "payer_id": "Code Company",
            "insurance_company": 1,
            "insurance_plan": 1,
            "policy_number": 12344,
            "copay": 200,  //optional
            "group_number": 1234, //optional
            "eff_date": "2020-01-23",
            "end_date": "2022-01-23",  //optional
            "release_info": false,
            "assign_benefits": false,
            "own_insurance": true,
            "subscriber": null
        },
        {
            "insurance_company_name": "Name Company",
            "payer_id": "Code Company",
            "insurance_company": 1,
            "insurance_plan": 2,
            "policy_number": 12344,
            "copay": 200,  //optional
            "group_number": 1234, //optional
            "eff_date": "2020-01-23",
            "end_date": "2022-01-23",  //optional
            "release_info": false,
            "assign_benefits": false,
            "own_insurance": false,
            "subscriber": {
                "ssn": "ssn subscriber",
                "first_name" : "firstName subscriber",
                "last_name"  : "lastName subscriber",
                "address": {
                    "address": "Direction address subscriber",
                    "city": "city address subscriber",
                    "state": "state address subscriber",
                    "zip": "123456789"
                },
                "contact": {
                    "phone": "04241234321",
                    "fax": "",
                    "mobile": "",
                    "email": "subscriber@gmail.com"
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
    "user_id": 1,
    "created_at": "2022-03-17T20:45:39.000000Z",
    "updated_at": "2022-03-17T20:45:39.000000Z"
}
```

<a name="change-status-patient"></a>
## Change status Patient


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

## Body Param

```json
{
    "status": <boolean>
}
```

## Response

> {success} 204 Status changed


#

<a name="get-all-patient-subscribers"></a>
## Get All Patient Subscribers


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Patient Subscribers found

#

```json
[
    {
        "id": 1,
        "ssn": "ssn subscriber",
        "first_name": "firstName subscriber",
        "last_name": "lastName subscriber",
        "billing_company_id": 1,
        "created_at": "2022-04-08T16:03:46.000000Z",
        "updated_at": "2022-04-08T16:03:46.000000Z",
        "pivot": {
            "patient_id": 3,
            "subscriber_id": 1,
            "created_at": "2022-04-08T16:49:25.000000Z",
            "updated_at": "2022-04-08T16:49:25.000000Z"
        },
        "addresses": [
            {
                "id": 11,
                "address": "Direction address subscriber",
                "city": "city address subscriber",
                "state": "state address subscriber",
                "zip": "123456789",
                "billing_company_id": 1,
                "created_at": "2022-04-08T16:49:25.000000Z",
                "updated_at": "2022-04-08T16:49:25.000000Z",
                "addressable_type": "App\\Models\\Subscriber",
                "addressable_id": 1
            }
        ],
        "contacts": [
            {
                "id": 12,
                "phone": "04241234321",
                "fax": null,
                "email": "subscriber11@gmail.com",
                "billing_company_id": 1,
                "created_at": "2022-04-08T16:49:25.000000Z",
                "updated_at": "2022-04-08T16:49:25.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\Subscriber",
                "contactable_id": 1
            }
        ]
    }
]
```

<a name="add-policy-to-patient"></a>
## Add policy to patient

### Body request example 1

```json
{
    "insurance_company": 1,
    "insurance_plan": 1,
    "policy_number": 12344,
    "copay": 200,  //optional
    "group_number": 1234, //optional
    "eff_date": "2020-01-23",
    "end_date": "2022-01-23",  //optional
    "release_info": false,
    "assign_benefits": false,
    "own_insurance": true,
    "subscriber": null
}
```
### Body request example 2

```json
{
    "insurance_company": 1,
    "insurance_plan": 2,
    "policy_number": 13442,
    "copay": 200,  //optional
    "group_number": 1234, //optional
    "eff_date": "2020-01-23",
    "end_date": "2022-01-23",  //optional
    "release_info": false,
    "assign_benefits": false,
    "own_insurance": false,
    "subscriber": {
        "ssn": "ssn subscriber",
        "first_name" : "firstName subscriber",
        "last_name"  : "lastName subscriber",
        "address": {
            "address": "Direction address subscriber",
            "city": "city address subscriber",
            "state": "state address subscriber",
            "zip": "123456789"
        },
        "contact": {
            "phone": "04241234321",
            "fax": "",
            "mobile": "",
            "email": "subscriber@gmail.com"
        }
    }
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`patient_id required integer`


## Response

> {success} 200 Good response

```json
{
    "id": 8,
    "policy_number": "369851",
    "group_number": "1234",
    "payment_responsibility_level_code": null,
    "eff_date": "2020-01-23",
    "end_date": "2022-01-23",
    "copay": "200",
    "release_info": false,
    "assign_benefits": false,
    "insurance_plan_id": 2,
    "created_at": "2022-09-05T06:16:35.000000Z",
    "updated_at": "2022-09-05T15:04:54.000000Z",
    "insurance_company_name": "Dsfsdfsfeddsddfg",
    "insurance_company_id": 1,
    "subscriber": {
        "id": 3,
        "ssn": "85",
        "member_id": null,
        "first_name": "F Name",
        "last_name": "L Name",
        "created_at": "2022-09-05T05:27:41.000000Z",
        "updated_at": "2022-09-05T05:27:41.000000Z",
        "pivot": {
            "insurance_policy_id": 8,
            "subscriber_id": 3,
            "created_at": "2022-09-05T06:16:35.000000Z",
            "updated_at": "2022-09-05T06:16:35.000000Z"
        },
        "addresses": [
            {
                "id": 46,
                "address": "Address",
                "city": "City",
                "state": "state",
                "zip": "zip",
                "billing_company_id": 2,
                "created_at": "2022-09-05T05:27:41.000000Z",
                "updated_at": "2022-09-05T05:27:41.000000Z",
                "addressable_type": "App\\Models\\Subscriber",
                "addressable_id": 3
            }
        ],
        "contacts": [
            {
                "id": 51,
                "phone": "phone",
                "fax": "fax",
                "email": "correo@correo.com",
                "billing_company_id": 2,
                "created_at": "2022-09-05T05:27:41.000000Z",
                "updated_at": "2022-09-05T05:27:41.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\Subscriber",
                "contactable_id": 3
            }
        ]
    },
    "payer_id": "IC-00001-2022",
    "own": false,
    "pivot": {
        "patient_id": 30,
        "insurance_policy_id": 8,
        "own_insurance": false,
        "created_at": "2022-09-05T15:04:54.000000Z",
        "updated_at": "2022-09-05T15:04:54.000000Z"
    }
}
```

#

>{warning} 404 error add policy to patient

#

<a name="edit-policy-to-patient"></a>
## Edit policy to patient

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`patient_id required integer`
`policy_id  required integer`


### Body request example 1

```json
{
    "insurance_company": 1,
    "insurance_plan": 1,
    "policy_number": 12344,
    "copay": 200,  //optional
    "group_number": 1234, //optional
    "eff_date": "2020-01-23",
    "end_date": "2022-01-23",  //optional
    "release_info": false,
    "assign_benefits": false,
    "own_insurance": true,
    "subscriber": null
}
```
### Body request example 2

```json
{
    "insurance_company": 1,
    "insurance_plan": 2,
    "policy_number": 13442,
    "copay": 200,  //optional
    "group_number": 1234, //optional
    "eff_date": "2020-01-23",
    "end_date": "2022-01-23",  //optional
    "release_info": false,
    "assign_benefits": false,
    "own_insurance": false,
    "subscriber": {
        "ssn": "ssn subscriber",
        "first_name" : "firstName subscriber",
        "last_name"  : "lastName subscriber",
        "address": {
            "address": "Direction address subscriber",
            "city": "city address subscriber",
            "state": "state address subscriber",
            "zip": "123456789"
        },
        "contact": {
            "phone": "04241234321",
            "fax": "",
            "mobile": "",
            "email": "subscriber@gmail.com"
        }
    }
}
```

## Response

> {success} 200 Good response

```json
{
    "id": 8,
    "policy_number": "369851",
    "group_number": "1234",
    "payment_responsibility_level_code": null,
    "eff_date": "2020-01-23",
    "end_date": "2022-01-23",
    "copay": "200",
    "release_info": false,
    "assign_benefits": false,
    "insurance_plan_id": 2,
    "created_at": "2022-09-05T06:16:35.000000Z",
    "updated_at": "2022-09-05T15:04:54.000000Z",
    "insurance_company_name": "Dsfsdfsfeddsddfg",
    "insurance_company_id": 1,
    "subscriber": {
        "id": 3,
        "ssn": "85",
        "member_id": null,
        "first_name": "F Name",
        "last_name": "L Name",
        "created_at": "2022-09-05T05:27:41.000000Z",
        "updated_at": "2022-09-05T05:27:41.000000Z",
        "pivot": {
            "insurance_policy_id": 8,
            "subscriber_id": 3,
            "created_at": "2022-09-05T06:16:35.000000Z",
            "updated_at": "2022-09-05T06:16:35.000000Z"
        },
        "addresses": [
            {
                "id": 46,
                "address": "Address",
                "city": "City",
                "state": "state",
                "zip": "zip",
                "billing_company_id": 2,
                "created_at": "2022-09-05T05:27:41.000000Z",
                "updated_at": "2022-09-05T05:27:41.000000Z",
                "addressable_type": "App\\Models\\Subscriber",
                "addressable_id": 3
            }
        ],
        "contacts": [
            {
                "id": 51,
                "phone": "phone",
                "fax": "fax",
                "email": "correo@correo.com",
                "billing_company_id": 2,
                "created_at": "2022-09-05T05:27:41.000000Z",
                "updated_at": "2022-09-05T05:27:41.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\Subscriber",
                "contactable_id": 3
            }
        ]
    },
    "payer_id": "IC-00001-2022",
    "own": false,
    "pivot": {
        "patient_id": 30,
        "insurance_policy_id": 8,
        "own_insurance": false,
        "created_at": "2022-09-05T15:04:54.000000Z",
        "updated_at": "2022-09-05T15:04:54.000000Z"
    }
}
```

#

>{warning} 404 error edit policy to patient

#

<a name="remove-policy-to-patient"></a>
## Remove policy to patient

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`patient_id required integer`
`policy_id  required integer`


## Response

> {success} 200 Good response

```json
[
    {
        "id": 8,
        "policy_number": "369851",
        "group_number": "1234",
        "payment_responsibility_level_code": null,
        "eff_date": "2020-01-23",
        "end_date": "2022-01-23",
        "copay": "200",
        "release_info": false,
        "assign_benefits": false,
        "insurance_plan_id": 2,
        "created_at": "2022-09-05T06:16:35.000000Z",
        "updated_at": "2022-09-05T15:04:54.000000Z",
        "insurance_company_name": "Dsfsdfsfeddsddfg",
        "insurance_company_id": 1,
        "subscriber": {
            "id": 3,
            "ssn": "85",
            "member_id": null,
            "first_name": "F Name",
            "last_name": "L Name",
            "created_at": "2022-09-05T05:27:41.000000Z",
            "updated_at": "2022-09-05T05:27:41.000000Z",
            "pivot": {
                "insurance_policy_id": 8,
                "subscriber_id": 3,
                "created_at": "2022-09-05T06:16:35.000000Z",
                "updated_at": "2022-09-05T06:16:35.000000Z"
            },
            "addresses": [
                {
                    "id": 46,
                    "address": "Address",
                    "city": "City",
                    "state": "state",
                    "zip": "zip",
                    "billing_company_id": 2,
                    "created_at": "2022-09-05T05:27:41.000000Z",
                    "updated_at": "2022-09-05T05:27:41.000000Z",
                    "addressable_type": "App\\Models\\Subscriber",
                    "addressable_id": 3
                }
            ],
            "contacts": [
                {
                    "id": 51,
                    "phone": "phone",
                    "fax": "fax",
                    "email": "correo@correo.com",
                    "billing_company_id": 2,
                    "created_at": "2022-09-05T05:27:41.000000Z",
                    "updated_at": "2022-09-05T05:27:41.000000Z",
                    "mobile": null,
                    "contactable_type": "App\\Models\\Subscriber",
                    "contactable_id": 3
                }
            ]
        },
        "payer_id": "IC-00001-2022",
        "own": false,
        "pivot": {
            "patient_id": 30,
            "insurance_policy_id": 8,
            "own_insurance": false,
            "created_at": "2022-09-05T15:04:54.000000Z",
            "updated_at": "2022-09-05T15:04:54.000000Z"
        }
    }
]
```

#

>{warning} 404 error remove policy to patient

#

<a name="get-policy-to-patient"></a>
## Get policy to patient

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`policy_id  required integer`


## Response

> {success} 200 Good response

```json
{
    "id": 8,
    "policy_number": "369851",
    "group_number": "1234",
    "payment_responsibility_level_code": null,
    "eff_date": "2020-01-23",
    "end_date": "2022-01-23",
    "copay": "200",
    "release_info": false,
    "assign_benefits": false,
    "insurance_plan_id": 2,
    "created_at": "2022-09-05T06:16:35.000000Z",
    "updated_at": "2022-09-05T15:04:54.000000Z",
    "insurance_company_name": "Dsfsdfsfeddsddfg",
    "insurance_company_id": 1,
    "subscriber": {
        "id": 3,
        "ssn": "85",
        "member_id": null,
        "first_name": "F Name",
        "last_name": "L Name",
        "created_at": "2022-09-05T05:27:41.000000Z",
        "updated_at": "2022-09-05T05:27:41.000000Z",
        "pivot": {
            "insurance_policy_id": 8,
            "subscriber_id": 3,
            "created_at": "2022-09-05T06:16:35.000000Z",
            "updated_at": "2022-09-05T06:16:35.000000Z"
        },
        "addresses": [
            {
                "id": 46,
                "address": "Address",
                "city": "City",
                "state": "state",
                "zip": "zip",
                "billing_company_id": 2,
                "created_at": "2022-09-05T05:27:41.000000Z",
                "updated_at": "2022-09-05T05:27:41.000000Z",
                "addressable_type": "App\\Models\\Subscriber",
                "addressable_id": 3
            }
        ],
        "contacts": [
            {
                "id": 51,
                "phone": "phone",
                "fax": "fax",
                "email": "correo@correo.com",
                "billing_company_id": 2,
                "created_at": "2022-09-05T05:27:41.000000Z",
                "updated_at": "2022-09-05T05:27:41.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\Subscriber",
                "contactable_id": 3
            }
        ]
    },
    "payer_id": "IC-00001-2022",
    "own": false,
    "pivot": {
        "patient_id": 30,
        "insurance_policy_id": 8,
        "own_insurance": false,
        "created_at": "2022-09-05T15:04:54.000000Z",
        "updated_at": "2022-09-05T15:04:54.000000Z"
    }
}
```

#

>{warning} 404 error get policy to patient


#

<a name="get-all-policies-to-patient"></a>
## Get all policies to patient

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`patient_id  required integer`


## Response

> {success} 200 Good response

```json
[
    {
        "id": 8,
        "policy_number": "369851",
        "group_number": "1234",
        "payment_responsibility_level_code": null,
        "eff_date": "2020-01-23",
        "end_date": "2022-01-23",
        "copay": "200",
        "release_info": false,
        "assign_benefits": false,
        "insurance_plan_id": 2,
        "created_at": "2022-09-05T06:16:35.000000Z",
        "updated_at": "2022-09-05T15:04:54.000000Z",
        "insurance_company_name": "Dsfsdfsfeddsddfg",
        "insurance_company_id": 1,
        "subscriber": {
            "id": 3,
            "ssn": "85",
            "member_id": null,
            "first_name": "F Name",
            "last_name": "L Name",
            "created_at": "2022-09-05T05:27:41.000000Z",
            "updated_at": "2022-09-05T05:27:41.000000Z",
            "pivot": {
                "insurance_policy_id": 8,
                "subscriber_id": 3,
                "created_at": "2022-09-05T06:16:35.000000Z",
                "updated_at": "2022-09-05T06:16:35.000000Z"
            },
            "addresses": [
                {
                    "id": 46,
                    "address": "Address",
                    "city": "City",
                    "state": "state",
                    "zip": "zip",
                    "billing_company_id": 2,
                    "created_at": "2022-09-05T05:27:41.000000Z",
                    "updated_at": "2022-09-05T05:27:41.000000Z",
                    "addressable_type": "App\\Models\\Subscriber",
                    "addressable_id": 3
                }
            ],
            "contacts": [
                {
                    "id": 51,
                    "phone": "phone",
                    "fax": "fax",
                    "email": "correo@correo.com",
                    "billing_company_id": 2,
                    "created_at": "2022-09-05T05:27:41.000000Z",
                    "updated_at": "2022-09-05T05:27:41.000000Z",
                    "mobile": null,
                    "contactable_type": "App\\Models\\Subscriber",
                    "contactable_id": 3
                }
            ]
        },
        "payer_id": "IC-00001-2022",
        "own": false,
        "pivot": {
            "patient_id": 30,
            "insurance_policy_id": 8,
            "own_insurance": false,
            "created_at": "2022-09-05T15:04:54.000000Z",
            "updated_at": "2022-09-05T15:04:54.000000Z"
        }
    }
]
```

#

>{warning} 404 error get all policies to patient
