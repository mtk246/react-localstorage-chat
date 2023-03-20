# Company Billing Gets request Docs

---
- [Get billing company](#get-billing-company)
- [Get all billing companies](#get-all-billing-companies)
- [Get all billing companies from server](#get-all-billing-companies-server)
- [Get billing company by code](#get-billing-company-by-code)
- [Get billing company by name](#get-billing-company-by-name)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |GET | `Get billing company`| `/billing-company/{billing_company_id}`        |yes            |Get one billing company|
| 2 |GET | `Get all billing companies`          | `/billing-company`|yes|Get all billing companies|
| 3 |GET | `Get all billing companies from server`          | `/billing-company/get-all-server`|yes|Get all billing companies from server|
| 4 |GET | `Get biling company by code`          | `/billing-company/get-by-code/{code}`|yes|Get one billing company by code|
| 5 |GET | `Get biling company by name`          | `/billing-company/get-by-name/{name}`|yes|Get one billing company by name|

>{primary} when url params have this symbol "?" mean not required, so you must to send null

<a name="get-billing-company"></a>
## Get companies by User

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data retorned

#
```json
{
    "name": "GreatotherCompany",
    "updated_at": "2022-01-13T18:59:46.000000Z",
    "created_at": "2022-01-13T18:59:46.000000Z",
    "id": 3
}
```

>{warning} possible errors: 404 when user not found 

<a name="get-all-billing-companies"></a>
## Get all billing companies

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data returned

#
```json
[
    {
        "id": 2,
        "name": "Renner Group",
        "created_at": "2022-03-15T11:15:44.000000Z",
        "updated_at": "2022-03-15T11:15:44.000000Z",
        "code": "BC-00002-2022",
        "status": false,
        "users": [],
        "address": {
            "id": 2,
            "address": "Rodeo Dr",
            "city": "Beverly Hills",
            "state": "California",
            "zip": "902122403",
            "billing_company_id": 2,
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "addressable_type": "App\\Models\\BillingCompany",
            "addressable_id": 2
        },
        "contact": {
            "id": 2,
            "phone": "+1 (734) 216-3450",
            "fax": "+1 (419) 672-0690",
            "email": "rosie47@klein.com",
            "billing_company_id": 2,
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "mobile": "(212) 690-2226",
            "contactable_type": "App\\Models\\BillingCompany",
            "contactable_id": 2
        }
    },
    {
        "id": 3,
        "name": "Dibbert, Pollich and Graham",
        "created_at": "2022-03-15T11:15:44.000000Z",
        "updated_at": "2022-03-15T11:15:44.000000Z",
        "code": "BC-00003-2022",
        "status": false,
        "users": [],
        "address": {
            "id": 3,
            "address": "Zoo Dr",
            "city": "Los Angeles",
            "state": "California",
            "zip": "900271422",
            "billing_company_id": 3,
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "addressable_type": "App\\Models\\BillingCompany",
            "addressable_id": 3
        },
        "contact": {
            "id": 3,
            "phone": "+1.925.386.8001",
            "fax": "(636) 904-4998",
            "email": "caden.witting@skiles.com",
            "billing_company_id": 3,
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "mobile": "667-366-9674",
            "contactable_type": "App\\Models\\BillingCompany",
            "contactable_id": 3
        }
    },
    {
        "id": 4,
        "name": "Bartell-Hansen",
        "created_at": "2022-03-15T11:15:44.000000Z",
        "updated_at": "2022-03-15T11:15:44.000000Z",
        "code": "BC-00004-2022",
        "status": false,
        "users": [],
        "address": null,
        "contact": {
            "id": 4,
            "phone": "",
            "fax": "",
            "email": "elwyn47@bergnaum.com",
            "billing_company_id": 4,
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "mobile": "",
            "contactable_type": "App\\Models\\BillingCompany",
            "contactable_id": 4
        }
    },
    {
        "id": 1,
        "name": "Medhurst-Schmidt",
        "created_at": "2022-03-15T11:15:43.000000Z",
        "updated_at": "2022-03-15T11:15:43.000000Z",
        "code": "BC-00001-2022",
        "status": false,
        "users": [
            {
                "id": 2,
                "email": "billingmanager@billing.com",
                "email_verified_at": null,
                "created_at": "2022-03-15T11:15:42.000000Z",
                "updated_at": "2022-03-15T11:15:42.000000Z",
                "token": null,
                "isLogged": false,
                "isBlocked": false,
                "usercode": "US-00002-2022",
                "userkey": null,
                "status": false,
                "last_login": null,
                "profile_id": 2,
                "billing_company_id": null,
                "pivot": {
                    "billing_company_id": 1,
                    "user_id": 2,
                    "status": true,
                    "created_at": "2022-03-15T11:15:44.000000Z",
                    "updated_at": "2022-03-15T11:15:44.000000Z"
                }
            }
        ],
        "address": {
            "id": 1,
            "address": "Singleton Rd",
            "city": "Calimesa",
            "state": "California",
            "zip": "923202207",
            "billing_company_id": 1,
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "addressable_type": "App\\Models\\BillingCompany",
            "addressable_id": 1
        },
        "contact": {
            "id": 1,
            "phone": "+1-830-587-6085",
            "fax": "737-883-3672",
            "email": "corine07@dooley.info",
            "billing_company_id": 1,
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "mobile": "930.984.6441",
            "contactable_type": "App\\Models\\BillingCompany",
            "contactable_id": 1
        }
    }
]
```


>{warning} possible errors: 404 when billing companies not found 



<a name="get-all-billing-companies-server"></a>
## Get all billing companies from server

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
            "id": 2,
            "name": "Renner Group",
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "code": "BC-00002-2022",
            "status": false,
            "users": [],
            "address": {
                "id": 2,
                "address": "Rodeo Dr",
                "city": "Beverly Hills",
                "state": "California",
                "zip": "902122403",
                "billing_company_id": 2,
                "created_at": "2022-03-15T11:15:44.000000Z",
                "updated_at": "2022-03-15T11:15:44.000000Z",
                "addressable_type": "App\\Models\\BillingCompany",
                "addressable_id": 2
            },
            "contact": {
                "id": 2,
                "phone": "+1 (734) 216-3450",
                "fax": "+1 (419) 672-0690",
                "email": "rosie47@klein.com",
                "billing_company_id": 2,
                "created_at": "2022-03-15T11:15:44.000000Z",
                "updated_at": "2022-03-15T11:15:44.000000Z",
                "mobile": "(212) 690-2226",
                "contactable_type": "App\\Models\\BillingCompany",
                "contactable_id": 2
            }
        },
        {
            "id": 3,
            "name": "Dibbert, Pollich and Graham",
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "code": "BC-00003-2022",
            "status": false,
            "users": [],
            "address": {
                "id": 3,
                "address": "Zoo Dr",
                "city": "Los Angeles",
                "state": "California",
                "zip": "900271422",
                "billing_company_id": 3,
                "created_at": "2022-03-15T11:15:44.000000Z",
                "updated_at": "2022-03-15T11:15:44.000000Z",
                "addressable_type": "App\\Models\\BillingCompany",
                "addressable_id": 3
            },
            "contact": {
                "id": 3,
                "phone": "+1.925.386.8001",
                "fax": "(636) 904-4998",
                "email": "caden.witting@skiles.com",
                "billing_company_id": 3,
                "created_at": "2022-03-15T11:15:44.000000Z",
                "updated_at": "2022-03-15T11:15:44.000000Z",
                "mobile": "667-366-9674",
                "contactable_type": "App\\Models\\BillingCompany",
                "contactable_id": 3
            }
        },
        {
            "id": 4,
            "name": "Bartell-Hansen",
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "code": "BC-00004-2022",
            "status": false,
            "users": [],
            "address": null,
            "contact": {
                "id": 4,
                "phone": "",
                "fax": "",
                "email": "elwyn47@bergnaum.com",
                "billing_company_id": 4,
                "created_at": "2022-03-15T11:15:44.000000Z",
                "updated_at": "2022-03-15T11:15:44.000000Z",
                "mobile": "",
                "contactable_type": "App\\Models\\BillingCompany",
                "contactable_id": 4
            }
        },
        {
            "id": 1,
            "name": "Medhurst-Schmidt",
            "created_at": "2022-03-15T11:15:43.000000Z",
            "updated_at": "2022-03-15T11:15:43.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "users": [
                {
                    "id": 2,
                    "email": "billingmanager@billing.com",
                    "email_verified_at": null,
                    "created_at": "2022-03-15T11:15:42.000000Z",
                    "updated_at": "2022-03-15T11:15:42.000000Z",
                    "token": null,
                    "isLogged": false,
                    "isBlocked": false,
                    "usercode": "US-00002-2022",
                    "userkey": null,
                    "status": false,
                    "last_login": null,
                    "profile_id": 2,
                    "billing_company_id": null,
                    "pivot": {
                        "billing_company_id": 1,
                        "user_id": 2,
                        "status": true,
                        "created_at": "2022-03-15T11:15:44.000000Z",
                        "updated_at": "2022-03-15T11:15:44.000000Z"
                    }
                }
            ],
            "address": {
                "id": 1,
                "address": "Singleton Rd",
                "city": "Calimesa",
                "state": "California",
                "zip": "923202207",
                "billing_company_id": 1,
                "created_at": "2022-03-15T11:15:44.000000Z",
                "updated_at": "2022-03-15T11:15:44.000000Z",
                "addressable_type": "App\\Models\\BillingCompany",
                "addressable_id": 1
            },
            "contact": {
                "id": 1,
                "phone": "+1-830-587-6085",
                "fax": "737-883-3672",
                "email": "corine07@dooley.info",
                "billing_company_id": 1,
                "created_at": "2022-03-15T11:15:44.000000Z",
                "updated_at": "2022-03-15T11:15:44.000000Z",
                "mobile": "930.984.6441",
                "contactable_type": "App\\Models\\BillingCompany",
                "contactable_id": 1
            }
        }
    ],
    "count": 10
}
```

<a name="get-billing-company-by-code"></a>
## Get billing company by code

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "code": string
}
```

## Response

> {success} 200 data returned

#
```json

    {
        "id": 1,
        "name": "Medhurst-Schmidt",
        "created_at": "2022-03-15T11:15:43.000000Z",
        "updated_at": "2022-03-15T11:15:43.000000Z",
        "code": "BC-00001-2022",
        "status": false,
        "address": {
            "id": 1,
            "address": "Singleton Rd",
            "city": "Calimesa",
            "state": "California",
            "zip": "923202207",
            "billing_company_id": 1,
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "addressable_type": "App\\Models\\BillingCompany",
            "addressable_id": 1
        },
        "contact": {
            "id": 1,
            "phone": "+1-830-587-6085",
            "fax": "737-883-3672",
            "email": "corine07@dooley.info",
            "billing_company_id": 1,
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "mobile": "930.984.6441",
            "contactable_type": "App\\Models\\BillingCompany",
            "contactable_id": 1
        }
    }

```


>{warning} possible errors: 404 when billing company not found 

<a name="get-billing-company-by-name"></a>
## Get billing company by name

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "name": string
}
```

## Response

> {success} 200 data returned

#
```json
[
    {
        "id": 1,
        "name": "Medhurst-Schmidt",
        "abbreviation": "MedSc",
        "created_at": "2022-03-15T11:15:43.000000Z",
        "updated_at": "2022-03-15T11:15:43.000000Z",
        "code": "BC-00001-2022",
        "status": false,
        "address": {
            "id": 1,
            "address": "Singleton Rd",
            "city": "Calimesa",
            "state": "California",
            "zip": "923202207",
            "billing_company_id": 1,
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "addressable_type": "App\\Models\\BillingCompany",
            "addressable_id": 1
        },
        "contact": {
            "id": 1,
            "phone": "+1-830-587-6085",
            "fax": "737-883-3672",
            "email": "corine07@dooley.info",
            "billing_company_id": 1,
            "created_at": "2022-03-15T11:15:44.000000Z",
            "updated_at": "2022-03-15T11:15:44.000000Z",
            "mobile": "930.984.6441",
            "contactable_type": "App\\Models\\BillingCompany",
            "contactable_id": 1
        }
    }
]
```


>{warning} possible errors: 404 when billing company not found 