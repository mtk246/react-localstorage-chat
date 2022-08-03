# Health Professional Docs

---

- [Basic data](#basic-data)
- [Create health professional](#create-health-professional)
- [Get all health professional](#get-all-health-professional)
- [Get one health professional](#get-one-health-professional)
- [Update health professional](#update-health-professional)
- [Get one health professional by npi](#get-one-health-professional-by-npi)
- [Change status health professional](#change-status-health-professional)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD| Name                                 | URL            | Token required|Description|
| : |       |   :-                 |  :            |               |                          |  
| 1 | POST  | `Create health professional`         | `/health-professional/`                  |yes|Create health professional|
| 2 | GET   | `Get all health professional`        | `/health-professional/`                  |yes|Get all health professional|
| 3 | GET   | `Get one health professional`        | `/health-professional/{id}`              |yes|Get one health professional|
| 4 | PUT   | `Update health professional`         | `/health-professional/{id}`              |yes|Update health professional|
| 5 | GET   | `Get one health professional by npi` | `/health-professional/{npi}/get-by-npi`  |yes|Get one health professional by npi|
| 6 | PATCH | `change status health professional`  | `/health-professional/{id}/change-status`|yes|change status health professional|



>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean




#



<a name="create-health-professional"></a>
## Create Health Professional

### Body request example

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "email":"user1@gmail.com",
    "npi":"123456719",
    "dea":"1234DEA",
    "taxonomies": [
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy Company",
            "primary": true
        },
        {
            "tax_id": "TAX01222",
            "name": "NameTaxonomy 2 Company",
            "primary": false
        }
    ],
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
        "phone": "4245675712",
        "fax": "userHealthP",
        "email": "user@gmail.com"
    }
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 Health Professional created


#



```json
{
    "npi": "123456789",
    "dea": "123DEA",
    "user_id": 8,
    "updated_at": "2022-03-17T08:47:13.000000Z",
    "created_at": "2022-03-17T08:47:13.000000Z",
    "id": 2
}
```


#

<a name="get-all-health-professional"></a>
## Get All Health Professionals


### Param in header

```json
{
    "Authorization": bearer <token>
}
```


## Response

> {success} 200 Health Professional found

#


```json
[
    {
        "id": 3,
        "npi": "123456719",
        "dea": "1234DEA",
        "user_id": 9,
        "created_at": "2022-03-17T08:58:40.000000Z",
        "updated_at": "2022-03-17T08:58:40.000000Z",
        "user": {
            "id": 9,
            "email": "user1@gmail.com",
            "email_verified_at": null,
            "created_at": "2022-03-17T08:58:40.000000Z",
            "updated_at": "2022-03-17T08:58:40.000000Z",
            "token": "eyJpdiI6Impxa3V4RkV0MGN6REVkZitqT2dZb0E9PSIsInZhbHVlIjoiUHBac1ZxOW1kTWc0dElJVkJLcWxZRVgrdnk0SXJ3MmhkcFNWMnVBS1VNST0iLCJtYWMiOiI4NjZiZGY0MzMzY2VhODUxMTI1MzQ4ZWRhNDlkY2RlYzgzZjliOWQxZmU1M2YyMDhjYWJjYTk2MjIzN2UxMzUxIiwidGFnIjoiIn0=",
            "isLogged": false,
            "isBlocked": false,
            "usercode": "US-00008-2022",
            "userkey": "eyJpdiI6ImRvR0VHQjQvcCs2RmhCUnVYRlRGWFE9PSIsInZhbHVlIjoibk5FVTArb25iT2tjeWdwcmQraDVORllMQSt6d0p2SEVLK01mYStPekFFOD0iLCJtYWMiOiJjNGRiNTk0ZGUzOWMwYzVjN2Y1MzA2N2RhMThiNDYzNGMxZTcxZDA2MDBjMjg0ODExZWE3ZjVkOTlkMTU2OTU4IiwidGFnIjoiIn0=",
            "status": false,
            "last_login": null,
            "profile_id": 9,
            "billing_company_id": null,
            "profile": {
                "id": 9,
                "ssn": "237891812",
                "first_name": "Fisrt Name",
                "middle_name": "Middle Name",
                "last_name": "Last Name",
                "sex": "m",
                "date_of_birth": "1990-11-11",
                "avatar": null,
                "credit_score": false,
                "created_at": "2022-03-17T08:58:39.000000Z",
                "updated_at": "2022-03-17T08:58:39.000000Z"
            },
            "roles": [
                {
                    "id": 8,
                    "name": "Health Professional",
                    "guard_name": "api",
                    "created_at": "2022-03-16T23:18:56.000000Z",
                    "updated_at": "2022-03-16T23:18:56.000000Z",
                    "pivot": {
                        "model_id": 9,
                        "role_id": 8,
                        "model_type": "App\\Models\\User"
                    }
                }
            ],
            "addresses": [
                {
                    "id": 12,
                    "address": "Direction address",
                    "city": "city address",
                    "state": "state address",
                    "zip": "123456789",
                    "billing_company_id": null,
                    "created_at": "2022-03-17T08:58:40.000000Z",
                    "updated_at": "2022-03-17T08:58:40.000000Z",
                    "addressable_type": "App\\Models\\User",
                    "addressable_id": 9
                }
            ],
            "contacts": [
                {
                    "id": 13,
                    "phone": "4245675712",
                    "fax": "userHealthP",
                    "email": "user@gmail.com",
                    "billing_company_id": null,
                    "created_at": "2022-03-17T08:58:40.000000Z",
                    "updated_at": "2022-03-17T08:58:40.000000Z",
                    "mobile": null,
                    "contactable_type": "App\\Models\\User",
                    "contactable_id": 9
                }
            ]
        },
        "taxonomies": [
            {
                "id": 1,
                "name": "NameTaxonomy Company",
                "created_at": "2022-03-17T08:58:40.000000Z",
                "updated_at": "2022-03-17T08:58:40.000000Z",
                "tax_id": "TAX01213",
                "primary": true,
                "pivot": {
                    "health_professional_id": 3,
                    "taxonomy_id": 1,
                    "created_at": "2022-03-17T08:58:40.000000Z",
                    "updated_at": "2022-03-17T08:58:40.000000Z"
                }
            },
            {
                "id": 2,
                "name": "NameTaxonomy 2 Company",
                "created_at": "2022-03-17T08:58:40.000000Z",
                "updated_at": "2022-03-17T08:58:40.000000Z",
                "tax_id": "TAX01222",
                "primary": false,
                "pivot": {
                    "health_professional_id": 3,
                    "taxonomy_id": 2,
                    "created_at": "2022-03-17T08:58:40.000000Z",
                    "updated_at": "2022-03-17T08:58:40.000000Z"
                }
            }
        ]
    },
]
```

#

<a name="get-one-health-professional"></a>
## Get One Health Professional

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

> {success} 200 Health Professional found

#


```json
{
    "id": 3,
    "npi": "123456719",
    "dea": "1234DEA",
    "user_id": 9,
    "created_at": "2022-03-17T08:58:40.000000Z",
    "updated_at": "2022-03-17T08:58:40.000000Z",
    "user": {
        "id": 9,
        "email": "user1@gmail.com",
        "email_verified_at": null,
        "created_at": "2022-03-17T08:58:40.000000Z",
        "updated_at": "2022-03-17T08:58:40.000000Z",
        "token": "eyJpdiI6Impxa3V4RkV0MGN6REVkZitqT2dZb0E9PSIsInZhbHVlIjoiUHBac1ZxOW1kTWc0dElJVkJLcWxZRVgrdnk0SXJ3MmhkcFNWMnVBS1VNST0iLCJtYWMiOiI4NjZiZGY0MzMzY2VhODUxMTI1MzQ4ZWRhNDlkY2RlYzgzZjliOWQxZmU1M2YyMDhjYWJjYTk2MjIzN2UxMzUxIiwidGFnIjoiIn0=",
        "isLogged": false,
        "isBlocked": false,
        "usercode": "US-00008-2022",
        "userkey": "eyJpdiI6ImRvR0VHQjQvcCs2RmhCUnVYRlRGWFE9PSIsInZhbHVlIjoibk5FVTArb25iT2tjeWdwcmQraDVORllMQSt6d0p2SEVLK01mYStPekFFOD0iLCJtYWMiOiJjNGRiNTk0ZGUzOWMwYzVjN2Y1MzA2N2RhMThiNDYzNGMxZTcxZDA2MDBjMjg0ODExZWE3ZjVkOTlkMTU2OTU4IiwidGFnIjoiIn0=",
        "status": false,
        "last_login": null,
        "profile_id": 9,
        "billing_company_id": null,
        "profile": {
            "id": 9,
            "ssn": "237891812",
            "first_name": "Fisrt Name",
            "middle_name": "Middle Name",
            "last_name": "Last Name",
            "sex": "m",
            "date_of_birth": "1990-11-11",
            "avatar": null,
            "credit_score": false,
            "created_at": "2022-03-17T08:58:39.000000Z",
            "updated_at": "2022-03-17T08:58:39.000000Z"
        },
        "roles": [
            {
                "id": 8,
                "name": "Health Professional",
                "guard_name": "api",
                "created_at": "2022-03-16T23:18:56.000000Z",
                "updated_at": "2022-03-16T23:18:56.000000Z",
                "pivot": {
                    "model_id": 9,
                    "role_id": 8,
                    "model_type": "App\\Models\\User"
                }
            }
        ],
        "addresses": [
            {
                "id": 12,
                "address": "Direction address",
                "city": "city address",
                "state": "state address",
                "zip": "123456789",
                "billing_company_id": null,
                "created_at": "2022-03-17T08:58:40.000000Z",
                "updated_at": "2022-03-17T08:58:40.000000Z",
                "addressable_type": "App\\Models\\User",
                "addressable_id": 9
            }
        ],
        "contacts": [
            {
                "id": 13,
                "phone": "4245675712",
                "fax": "userHealthP",
                "email": "user@gmail.com",
                "billing_company_id": null,
                "created_at": "2022-03-17T08:58:40.000000Z",
                "updated_at": "2022-03-17T08:58:40.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\User",
                "contactable_id": 9
            }
        ]
    },
    "taxonomies": [
        {
            "id": 1,
            "name": "NameTaxonomy Company",
            "created_at": "2022-03-17T08:58:40.000000Z",
            "updated_at": "2022-03-17T08:58:40.000000Z",
            "tax_id": "TAX01213",
            "primary": true,
            "pivot": {
                "health_professional_id": 3,
                "taxonomy_id": 1,
                "created_at": "2022-03-17T08:58:40.000000Z",
                "updated_at": "2022-03-17T08:58:40.000000Z"
            }
        },
        {
            "id": 2,
            "name": "NameTaxonomy 2 Company",
            "created_at": "2022-03-17T08:58:40.000000Z",
            "updated_at": "2022-03-17T08:58:40.000000Z",
            "tax_id": "TAX01222",
            "primary": false,
            "pivot": {
                "health_professional_id": 3,
                "taxonomy_id": 2,
                "created_at": "2022-03-17T08:58:40.000000Z",
                "updated_at": "2022-03-17T08:58:40.000000Z"
            }
        }
    ]
}
```

#

<a name="update-health-professional"></a>
## Update Health Professional

### Body request example

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "email":"user1edit@gmail.com",
    "npi":"123456719",
    "dea":"1234DEA",
    "taxonomies": [
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy Company",
            "primary": true
        },{
            "tax_id": "TAX01222",
            "name": "NameTaxonomy 2 Company",
            "primary": false
        }
    ],
    "profile": {
        "ssn":"237891812",
        "first_name":"Fisrt Name Edit",
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
        "phone": "4245675712",
        "fax": "userHealthP",
        "email": "user@gmail.com"
    }
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Health Professional updated


#



```json
{
    "id": 3,
    "npi": "123456719",
    "dea": "1234DEA",
    "user_id": 9,
    "created_at": "2022-03-17T08:58:40.000000Z",
    "updated_at": "2022-03-17T08:58:40.000000Z",
    "user": {
        "id": 9,
        "email": "user1edit@gmail.com",
        "email_verified_at": null,
        "created_at": "2022-03-17T08:58:40.000000Z",
        "updated_at": "2022-03-17T09:04:29.000000Z",
        "token": "eyJpdiI6Impxa3V4RkV0MGN6REVkZitqT2dZb0E9PSIsInZhbHVlIjoiUHBac1ZxOW1kTWc0dElJVkJLcWxZRVgrdnk0SXJ3MmhkcFNWMnVBS1VNST0iLCJtYWMiOiI4NjZiZGY0MzMzY2VhODUxMTI1MzQ4ZWRhNDlkY2RlYzgzZjliOWQxZmU1M2YyMDhjYWJjYTk2MjIzN2UxMzUxIiwidGFnIjoiIn0=",
        "isLogged": false,
        "isBlocked": false,
        "usercode": "US-00008-2022",
        "userkey": "eyJpdiI6ImRvR0VHQjQvcCs2RmhCUnVYRlRGWFE9PSIsInZhbHVlIjoibk5FVTArb25iT2tjeWdwcmQraDVORllMQSt6d0p2SEVLK01mYStPekFFOD0iLCJtYWMiOiJjNGRiNTk0ZGUzOWMwYzVjN2Y1MzA2N2RhMThiNDYzNGMxZTcxZDA2MDBjMjg0ODExZWE3ZjVkOTlkMTU2OTU4IiwidGFnIjoiIn0=",
        "status": false,
        "last_login": null,
        "profile_id": 9,
        "billing_company_id": null,
        "profile": {
            "id": 9,
            "ssn": "237891812",
            "first_name": "Fisrt Name Edit",
            "middle_name": "Middle Name",
            "last_name": "Last Name",
            "sex": "m",
            "date_of_birth": "1990-11-11",
            "avatar": null,
            "credit_score": false,
            "created_at": "2022-03-17T08:58:39.000000Z",
            "updated_at": "2022-03-17T09:04:29.000000Z"
        }
    }
}
```

#

<a name="get-one-health-professional-by-npi"></a>
##Get One Health Professional by NPI


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "npi": <string>
}
```

## Response

> {success} 200 Health Professional found

#


```json
{
    "id": 3,
    "npi": "123456719",
    "dea": "1234DEA",
    "user_id": 9,
    "created_at": "2022-03-17T08:58:40.000000Z",
    "updated_at": "2022-03-17T08:58:40.000000Z",
    "user": {
        "id": 9,
        "email": "user1@gmail.com",
        "email_verified_at": null,
        "created_at": "2022-03-17T08:58:40.000000Z",
        "updated_at": "2022-03-17T08:58:40.000000Z",
        "token": "eyJpdiI6Impxa3V4RkV0MGN6REVkZitqT2dZb0E9PSIsInZhbHVlIjoiUHBac1ZxOW1kTWc0dElJVkJLcWxZRVgrdnk0SXJ3MmhkcFNWMnVBS1VNST0iLCJtYWMiOiI4NjZiZGY0MzMzY2VhODUxMTI1MzQ4ZWRhNDlkY2RlYzgzZjliOWQxZmU1M2YyMDhjYWJjYTk2MjIzN2UxMzUxIiwidGFnIjoiIn0=",
        "isLogged": false,
        "isBlocked": false,
        "usercode": "US-00008-2022",
        "userkey": "eyJpdiI6ImRvR0VHQjQvcCs2RmhCUnVYRlRGWFE9PSIsInZhbHVlIjoibk5FVTArb25iT2tjeWdwcmQraDVORllMQSt6d0p2SEVLK01mYStPekFFOD0iLCJtYWMiOiJjNGRiNTk0ZGUzOWMwYzVjN2Y1MzA2N2RhMThiNDYzNGMxZTcxZDA2MDBjMjg0ODExZWE3ZjVkOTlkMTU2OTU4IiwidGFnIjoiIn0=",
        "status": false,
        "last_login": null,
        "profile_id": 9,
        "billing_company_id": null,
        "profile": {
            "id": 9,
            "ssn": "237891812",
            "first_name": "Fisrt Name",
            "middle_name": "Middle Name",
            "last_name": "Last Name",
            "sex": "m",
            "date_of_birth": "1990-11-11",
            "avatar": null,
            "credit_score": false,
            "created_at": "2022-03-17T08:58:39.000000Z",
            "updated_at": "2022-03-17T08:58:39.000000Z"
        },
        "roles": [
            {
                "id": 8,
                "name": "Health Professional",
                "guard_name": "api",
                "created_at": "2022-03-16T23:18:56.000000Z",
                "updated_at": "2022-03-16T23:18:56.000000Z",
                "pivot": {
                    "model_id": 9,
                    "role_id": 8,
                    "model_type": "App\\Models\\User"
                }
            }
        ],
        "addresses": [
            {
                "id": 12,
                "address": "Direction address",
                "city": "city address",
                "state": "state address",
                "zip": "123456789",
                "billing_company_id": null,
                "created_at": "2022-03-17T08:58:40.000000Z",
                "updated_at": "2022-03-17T08:58:40.000000Z",
                "addressable_type": "App\\Models\\User",
                "addressable_id": 9
            }
        ],
        "contacts": [
            {
                "id": 13,
                "phone": "4245675712",
                "fax": "userHealthP",
                "email": "user@gmail.com",
                "billing_company_id": null,
                "created_at": "2022-03-17T08:58:40.000000Z",
                "updated_at": "2022-03-17T08:58:40.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\User",
                "contactable_id": 9
            }
        ]
    },
    "taxonomies": [
        {
            "id": 1,
            "name": "NameTaxonomy Company",
            "created_at": "2022-03-17T08:58:40.000000Z",
            "updated_at": "2022-03-17T08:58:40.000000Z",
            "tax_id": "TAX01213",
            "primary": true,
            "pivot": {
                "health_professional_id": 3,
                "taxonomy_id": 1,
                "created_at": "2022-03-17T08:58:40.000000Z",
                "updated_at": "2022-03-17T08:58:40.000000Z"
            }
        },
        {
            "id": 2,
            "name": "NameTaxonomy 2 Company",
            "created_at": "2022-03-17T08:58:40.000000Z",
            "updated_at": "2022-03-17T08:58:40.000000Z",
            "tax_id": "TAX01222",
            "primary": false,
            "pivot": {
                "health_professional_id": 3,
                "taxonomy_id": 2,
                "created_at": "2022-03-17T08:58:40.000000Z",
                "updated_at": "2022-03-17T08:58:40.000000Z"
            }
        }
    ]
}
```



#

<a name="change-status-health-professional"></a>
## Change status Health Professional


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

> {success} 204 Status changed


#