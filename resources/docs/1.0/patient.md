

# Patient Docs

---

- [Basic data](#basic-data)
- [Create patient](#create-patient)
- [Get all patient](#get-all-patient)
- [Get all patient from server](#get-all-patient-server)
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
- [Get list type diags](#get-list-type-diags)
- [Get list marital status](#get-list-marital-status)
- [Get list address type](#get-list-address-type)
- [Get list address type](#get-list-responsibility-type)
- [Get list address type](#get-list-relationship)
- [Get list insurance policy type](#get-list-insurance-policy-type)
- [Search](#search)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Patient`                    | `/patient/`               |yes             |Create Patient|         
| 2 |GET | `Get all Patient`                   | `/patient/`        |yes            |Get all Patient|
| 3 |GET | `Get all Patient from server`       | `/patient/get-all-server`|yes|Get all Patient from server|
| 4 |GET | `Get one Patient`                   | `/patient/{id}`|yes|Get one Patient|
| 5 |GET | `Get one Patient by ssn`            | `/patient/get-by-ssn{ssn}`|yes|Get one Patient by ssn|
| 6 |PUT | `Update Patient`                | `/patient/{id}`|yes|Update Patient|
| 7 |PATCH | `Change status Patient`           | `/patient/change-status/{id}`|yes|change status patient|
| 8 |GET | `Get all patient subscribers`| `/patient/get-subscribers/{ssn_patient}`        |yes            |Get all patient subscribers|
| 9 |PATCH | `Add policy to patient`           | `/patient/add-policy-to-patient/{patient_id}`|yes|add policy to patient|
| 10 |PATCH | `Edit policy to patient`           | `/patient/{patient_id}/edit-policy/{policy_id}`|yes|edit policy to patient|
| 11 |PATCH | `Remove policy to patient`           | `/patient/{patient_id}/remove-policy/{policy_id}`|yes|remove policy to patient|
| 12 |GET | `Get policy to patient`           | `/patient/get-policy/{policy_id}`|yes|get policy to patient|
| 13 |GET | `Get all policies to patient`           | `/patient/{patient_id}/get-policies`|yes|get all policies to patient|
| 14  |GET     | `Get list marital status`  | `/patient/get-list-marital-status`     | yes    | Get list marital status |
| 15  |GET     | `Get list address type`  | `/patient/get-list-address-type`     | yes    | Get list address type |
| 16  |GET     | `Get list responsibility type`  | `/patient/get-list-responsibility-type`     | yes    | Get list responsibility type |
| 17  |GET     | `Get list relationship`  | `/patient/get-list-relationship`     | yes    | Get list relationship |
| 18  |GET     | `Get list insurance policy type`  | `/patient/get-list-insurance-policy-type`     | yes    | Get list insurance policy type |
| 19|GET | `search`   | `/patient/search?date_of_birth={date}&last_name={last_name}&first_name={fisrt_name}&ssn={ssn?}` |yes|Get patients |



>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean

<a name="create-patient"></a>
## Create Patient

### Body request example

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "driver_license": "Driver License", /** Optional */
    "profile": {
        "ssn":"237891812", /** Optional */
        "first_name":"Fisrt Name", /** Required */
        "last_name":"Last Name", /** Required */
        "middle_name":"Middle Name", /** Optional */
        "date_of_birth":"1990-11-11", /** Required */
        "sex":"m", /** Optional */
        "social_medias": [  /** Optional */
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
    "marital_status_id": 1, /** Optional */
    "marital": { /** required if marital status maried */
        "spuse_name": "Spuse name",
        "spuse_work": "Spuse work",
        "spuse_work_phone": "Spuse phone"

    },
    "company_id": 1, /** required */
    "company_med_num": "0001", /** Optional */
    "language": "en", /** Optional */

    "contact": {
        "phone": "04241234321", /** Optional */
        "mobile": "", /** Optional */
        "fax": "", /** Optional */
        "email": "user@gmail.com" /** Required */
    },
    "addresses": [
        {
            "address_type_id": 1, /** Required */
            "address": "Direction address", /** Required */
            "city": "city address", /** Required */
            "state": "state address", /** Required */
            "zip": "123456789" /** Required */
        }
    ],
    "insurance_policies": [
        {
            "policy_number": 12344, /** Required */
            "group_number": 1234, /** Optional */
            "insurance_company": 1, /** Required */
            "insurance_plan": 1, /** Required */
            "type_responsibility_id": 1, /** Required */
            "insurance_policy_type_id": 1, /** Optional */
            "eff_date": "2020-01-23", /** Optional */
            "end_date": "2022-01-23", /** Optional */
            "assign_benefits": false,  /** Required */
            "release_info": false, /** Required */
            "own_insurance": true, /** Required */
            "subscriber": null /** Optional */
        },
        {
            "policy_number": 12344, /** Required */
            "group_number": 1234, /** Optional */
            "insurance_company": 1, /** Required */
            "insurance_plan": 1, /** Required */
            "type_responsibility_id": 1, /** Required */
            "insurance_policy_type_id": 1, /** Optional */
            "eff_date": "2020-01-23", /** Optional */
            "end_date": "2022-01-23", /** Optional */
            "assign_benefits": false,  /** Required */
            "release_info": false, /** Required */
            "own_insurance": true, /** Required */
            "subscriber": {
                "relationship_id": 1, /** Optional */
                "ssn": "ssn subscriber",
                "date_of_birth":"1990-11-11", /** Optional */
                "first_name" : "firstName subscriber", /** Required */
                "last_name"  : "lastName subscriber", /** Required */
                "address": {
                    "address": "Direction address subscriber", /** Optional */
                    "city": "city address subscriber", /** Optional */
                    "state": "state address subscriber", /** Optional */
                    "zip": "123456789" /** Optional */
                },
                "contact": {
                    "phone": "04241234321", /** Optional */
                    "fax": "", /** Optional */
                    "mobile": "", /** Optional */
                    "email": "subscriber@gmail.com"  /** Optional */
                }
            }
        }
    ],
    "guarantor": {
        "name": "name", /** Optional */
        "phone": "phone" /** Optional */
    },
    "emergency_contacts": [
        {
            "name": "name emergency contact 1", /** Optional */
            "cellphone": "cellphone emergency contacts 1", /** Optional */
            "relationship_id": 1 /** Optional */
        },
        {
            "name": "name emergency contact 2", /** Optional */
            "cellphone": "cellphone emergency contacts 2", /** Optional */
            "relationship_id": 2 /** Optional */
        }
    ],
    "employments": [
        {
            "employer_name": "employer name", /** Optional */
            "employer_address": "employer address", /** Optional */
            "employer_phone": "employer phone", /** Optional */
            "position": "patient position" /** Optional */
        }
    ],
    "public_note": "Some note publics",
    "private_note": "Some note privates",
    "save_as_draft": false
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


<a name="get-all-patient-server"></a>
## Get all patient from server

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

## Example path

>{primary} ?query=fieldSearch&itemsPerPage=5&sortDesc=1&page=1&sortBy=fieldName

## Response

> {success} 200 data returned

#
```json
{
    "data": [
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
        
    ],
    "count": 10
}
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
    "billing_company_id": 1, /** Only required by superuser */
    "driver_license": "Driver License", /** Optional */
    "profile": {
        "ssn":"237891812", /** Optional */
        "first_name":"Fisrt Name", /** Required */
        "last_name":"Last Name", /** Required */
        "middle_name":"Middle Name", /** Optional */
        "date_of_birth":"1990-11-11", /** Required */
        "sex":"m", /** Optional */
        "social_medias": [  /** Optional */
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
    "marital_status_id": 1, /** Optional */
    "marital": { /** required if marital status maried */
        "spuse_name": "Spuse name",
        "spuse_work": "Spuse work",
        "spuse_work_phone": "Spuse phone"

    },
    "companies": [
        {
            "company_id": 1, /** required */
            "company_med_num": "0001", /** Optional */
        },
        {
            "company_id": 2, /** required */
            "company_med_num": "0002", /** Optional */
        }
    ],
    "language": "en", /** Optional */

    "contact": {
        "phone": "04241234321", /** Optional */
        "mobile": "", /** Optional */
        "fax": "", /** Optional */
        "email": "user@gmail.com" /** Required */
    },
    "addresses": [
        {
            "address_type_id": 1, /** Required */
            "address": "Direction address", /** Required */
            "city": "city address", /** Required */
            "state": "state address", /** Required */
            "zip": "123456789" /** Required */
        }
    ],
    "insurance_policies": [
        {
            "policy_number": 12344, /** Required */
            "group_number": 1234, /** Optional */
            "insurance_company": 1, /** Required */
            "insurance_plan": 1, /** Required */
            "type_responsibility_id": 1, /** Required */
            "insurance_policy_type_id": 1, /** Optional */
            "eff_date": "2020-01-23", /** Optional */
            "end_date": "2022-01-23", /** Optional */
            "assign_benefits": false,  /** Required */
            "release_info": false, /** Required */
            "own_insurance": true, /** Required */
            "subscriber": null /** Optional */
        },
        {
            "policy_number": 12344, /** Required */
            "group_number": 1234, /** Optional */
            "insurance_company": 1, /** Required */
            "insurance_plan": 1, /** Required */
            "type_responsibility_id": 1, /** Required */
            "insurance_policy_type_id": 1, /** Optional */
            "eff_date": "2020-01-23", /** Optional */
            "end_date": "2022-01-23", /** Optional */
            "assign_benefits": false,  /** Required */
            "release_info": false, /** Required */
            "own_insurance": true, /** Required */
            "subscriber": {
                "relationship_id": 1, /** Optional */
                "ssn": "ssn subscriber",
                "date_of_birth":"1990-11-11", /** Optional */
                "first_name" : "firstName subscriber", /** Required */
                "last_name"  : "lastName subscriber", /** Required */
                "address": {
                    "address": "Direction address subscriber", /** Optional */
                    "city": "city address subscriber", /** Optional */
                    "state": "state address subscriber", /** Optional */
                    "zip": "123456789" /** Optional */
                },
                "contact": {
                    "phone": "04241234321", /** Optional */
                    "fax": "", /** Optional */
                    "mobile": "", /** Optional */
                    "email": "subscriber@gmail.com"  /** Optional */
                }
            }
        }
    ],
    "guarantor": {
        "name": "name", /** Optional */
        "phone": "phone" /** Optional */
    },
    "emergency_contacts": [
        {
            "name": "name emergency contact 1", /** Optional */
            "cellphone": "cellphone emergency contacts 1", /** Optional */
            "relationship_id": 1 /** Optional */
        },
        {
            "name": "name emergency contact 2", /** Optional */
            "cellphone": "cellphone emergency contacts 2", /** Optional */
            "relationship_id": 2 /** Optional */
        }
    ],
    "employments": [
        {
            "employer_name": "employer name", /** Optional */
            "employer_address": "employer address", /** Optional */
            "employer_phone": "employer phone", /** Optional */
            "position": "patient position" /** Optional */
        }
    ],
    "public_note": "Some note publics",
    "private_note": "Some note privates",
    "save_as_draft": false
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

#

<a name="get-list-marital-status"></a>
## Get list marital status


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Marital status of patient found

#

```json
[
    {
        "id": 1,
        "name": "Single"
    },
    {
        "id": 2,
        "name": "Married"
    }
]
```

#

<a name="get-list-address-type"></a>
## Get list address type


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Address type of patient found

#

```json
[
    {
        "id": 1,
        "name": "Work"
    },
    {
        "id": 2,
        "name": "House / Residence"
    },
    {
        "id": 3,
        "name": "Other"
    }
]
```

#

<a name="get-list-responsibility-type"></a>
## Get list responsibility type


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Responsibility type of patient found

#

```json
[
    {
        "id": 47,
        "name": "R1 - Responsibility type 1"
    },
    {
        "id": 48,
        "name": "R2 - Responsibility type 2"
    }
]
```

#

<a name="get-list-relationship"></a>
## Get list relationship


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Relationship of patient found

#

```json
[
    {
        "id": 28,
        "name": "1 - Self/Patient is Insured"
    },
    {
        "id": 29,
        "name": "2 - Spouse"
    },
    {
        "id": 30,
        "name": "3 - Natural Child/Insured Financial Resp."
    },
    {
        "id": 31,
        "name": "4 - Natural Child/Insured no Financial Resp."
    },
    {
        "id": 32,
        "name": "5 - Step Child"
    },
    {
        "id": 33,
        "name": "6 - Foster Child"
    },
    {
        "id": 34,
        "name": "7 - Ward of the Court"
    },
    {
        "id": 35,
        "name": "8 - Employee"
    },
    {
        "id": 36,
        "name": "9 - Other"
    },
    {
        "id": 37,
        "name": "10 - Handicapped Dependent"
    },
    {
        "id": 38,
        "name": "11 - Organ Donor"
    },
    {
        "id": 39,
        "name": "12 - Cadaver Donor"
    },
    {
        "id": 40,
        "name": "13 - Grandchild"
    },
    {
        "id": 41,
        "name": "14 - Nice/Nephew"
    },
    {
        "id": 42,
        "name": "15 - Injured Plaintiff"
    },
    {
        "id": 43,
        "name": "16 - Sponsored Dependent"
    },
    {
        "id": 44,
        "name": "17 - Minor Dependent of a Minor Dependent"
    },
    {
        "id": 45,
        "name": "18 - Parent"
    },
    {
        "id": 46,
        "name": "19 - Granparent"
    }
]
```

#

<a name="get-list-insurance-policy-type"></a>
## Get list insurance policy type


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Insurance policy type of patient found

#

```json
[
    {
        "id": 1,
        "name": "Health"
    },
    {
        "id": 2,
        "name": "Auto"
    },
    {
        "id": 3,
        "name": "Work Comp"
    },
    {
        "id": 4,
        "name": "Industrial"
    },
    {
        "id": 5,
        "name": "Liability"
    },
    {
        "id": 6,
        "name": "Other"
    }
]
```
#


<a name="search"></a>
## Search

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`date_of_birth required string`
`last_name     required string`
`first_name    required string`
`ssn           optional string  last 4 digits`

## Example path

>{primary} /search?date_of_birth=1990-11-11&last_name=Last Name&first_name=Fisrt Name&ssn=1812

#

>{success} 200 request made successfully

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
]
```
#