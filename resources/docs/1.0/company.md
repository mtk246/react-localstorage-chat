# Company Docs

---

- [Basic data](#basic-data)
- [Create company](#create-company)
- [Get all company](#get-all-company)
- [Get all company from server](#get-all-company-server)
- [Get one company](#get-one-company)
- [Get one company by name](#get-one-company-by-name)
- [Get one company by email](#get-one-company-by-email)
- [Get one company by npi](#get-one-company-by-npi)
- [Get list company by billing company](#get-list)
- [Get list name suffix](#get-list-name-suffix)
- [Get list statement rules](#get-list-statement-rules)
- [Get list statement when](#get-list-statement-when)
- [Get list statement apply to](#get-list-statement-apply-to)
- [Get list billing companies](#get-list-billing-companies)
- [Update company](#update-company)
- [Change status company](#change-status-company)
- [Add to billing company](#add-to-billing-company)
- [Add facilities to company](#add-facilities)
- [Add service to company](#add-services)
- [Add service to company](#add-copay)
- [Add service to contract fee](#add-contracts-fee)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create company`          | `/company/`               |yes             |Create company|         
| 2 |GET | `Get all company`| `/company/`        |yes            |Get all company|
| 3 |GET | `Get all company from server`          | `/company/get-all-server`|yes|Get all company from server|
| 4 |GET | `Get one company`          | `/company/{id}`|yes|Get one company|
| 5 |GET | `Get one company by name`          | `/company/get-by-name/{name}`|yes|Get company by name|
| 6 |GET | `Get one company by email`          | `/company/get-by-email/{email}`|yes|Get company by email|
| 7 |GET | `Get one company by npi`          | `/company/get-by-npi/{npi}`|yes|Get company by npi|
| 8 |GET | `Get list company by billing company`          | `/company/get-list-by-billing-company/{id?}`|yes|Get all companies by billing company|
| 9 |GET | `Get list name suffix`          | `/company/get-list-name-suffix`|yes|Get all name suffix|
| 10 |GET | `Get list statement rules`          | `/company/get-list-statement-rules`|yes|Get all statement rules|
| 12 |GET | `Get list statement when`          | `/company/get-list-statement-when`|yes|Get all statement when|
| 13 |GET | `Get list statement apply to`          | `/company/get-list-statement-apply-to`|yes|Get all statement apply to|
| 14 |GET | `Get list billing companies`| `/company/get-list-billing-companies?company_id={companyID?}&edit={edit?}`        |yes            |Get list billing companies|
| 14 |PUT | `Update company`          | `/company/{id}`|yes|update company|
| 15 |PATCH | `Change status company`          | `/company/change-status/{id}`|yes|Change status company|
| 16 |PATCH | `Add to billing company`          | `/company/add-to-billing-company/{id}`|yes|Add company to billing company|
| 17 |PATCH | `Add facilities to company`       | `/company/add-facilities-to-company/{id}`|yes|Add facilities to company|
| 18 |PATCH | `Add services to company`       | `/company/add-services-to-company/{id}`|yes|Add services to company|
| 19 |PATCH | `Add copays to company`       | `/company/add-copays-to-company/{id}`|yes|Add copays to company|
| 20 |PATCH | `Add contract fee to company`       | `/company/add-contract-fee-to-company/{id}`|yes|Add contract fee to company|



>{primary} when url params have this symbol "?" mean not required, so you must to send null


# 

<a name="create-company"></a>
## Create Company

### Body request example


#

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "npi":"222123", /** required */
    "ein":"1234321", /** required only number max 9 */
    "upin":"222CF123", /** optional alfanumeric max 50 */
    "clia":"222CF123", /** optional alfanumeric max 50 */
    "name":"company first", /** required */
    "nickname":"alias company first", /** optional */
    "name_suffix_id": 1, /** optional */
    "abbreviation": "ABB", /** optional */
    "taxonomies": [
        {
            "tax_id": "TAX01213", /** required if exist*/
            "name": "NameTaxonomy Company", /** required if exist */
            "primary": true /** required if exist */
        },
        {
            "tax_id": "TAX01222", /** required if exist */
            "name": "NameTaxonomy 2 Company", /** required if exist */
            "primary": false /** required if exist */
        }
    ],
    "contact": {
        "contact_name": "Name Contact", /** optional */
        "phone":"34324234", /** optional */
        "mobile":"34324234", /** optional */
        "fax":"567674576457", /** optional */
        "email":"company@company.com" /** required */
    },
    "address": {
        "address":"address Company", /** required */
        "city":"city Company", /** required */
        "state":"state Company", /** required */
        "zip": "123234", /** required */
        "country": "Name country", /** optional */
        "country_subdivision_code": "code" /** optional */
    },
    "payment_address": { /** optional */
        "address":"address Company", /** required if exist */
        "city":"city Company", /** required if exist */
        "state":"state Company", /** required if exist */
        "zip": "123234", /** required if exist */
        "country": "Name country", /** optional */
        "country_subdivision_code": "code" /** optional */
    },
    "statements": [
        {
            "rule_id": 1, /** optional */
            "when_id": 1, /** optional */
            "apply_to_ids": [1,2,3], /** optional */
            "start_date": "2022-02-03", /** required if when content 'period' */
            "end_date": "2022-02-03", /** required if when content 'period', example 'In a defined period' */
        }
    ],
    "exception_insurance_companies": [1,2,3], /** optional */
    "public_note": "Public Note", /** optional */
    "private_note": "Private Note" /** optional */
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 company created


#

```json
{
    "code": "CO-00001-2022",
    "name": "company first",
    "npi": "222CF123",
    "updated_at": "2022-03-16T09:44:57.000000Z",
    "created_at": "2022-03-16T09:44:57.000000Z",
    "id": 1,
    "status": false
}
```


# 

<a name="get-all-company"></a>
## Get All Company


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company found

#

```json
[
    {
        "id": 2,
        "code": "CO-00002-2022",
        "name": "company second",
        "npi": "222CF1222",
        "created_at": "2022-03-16T09:49:06.000000Z",
        "updated_at": "2022-03-16T09:49:06.000000Z",
        "status": false,
        "addresses": [
            {
                "id": 5,
                "address": "address Company2",
                "city": "city Company2",
                "state": "state Company2",
                "zip": "234",
                "billing_company_id": null,
                "created_at": "2022-03-16T09:49:06.000000Z",
                "updated_at": "2022-03-16T09:49:06.000000Z",
                "addressable_type": "App\\Models\\Company",
                "addressable_id": 2
            }
        ],
        "contacts": [
            {
                "id": 6,
                "phone": "34324234",
                "fax": "567674576457",
                "email": "company2@company.com",
                "billing_company_id": null,
                "created_at": "2022-03-16T09:49:06.000000Z",
                "updated_at": "2022-03-16T09:49:06.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\Company",
                "contactable_id": 2
            }
        ],
        "nicknames": [
            {
                "id": 1,
                "nickname": "alias company second",
                "nicknamable_type": "App\\Models\\Company",
                "nicknamable_id": 6,
                "billing_company_id": 1,
                "created_at": "2022-04-04T12:55:15.000000Z",
                "updated_at": "2022-04-04T12:55:15.000000Z"
            }
        ],
    },
    {
        "id": 1,
        "code": "CO-00001-2022",
        "name": "company first",
        "npi": "222CF123",
        "created_at": "2022-03-16T09:44:57.000000Z",
        "updated_at": "2022-03-16T09:44:57.000000Z",
        "status": false,
        "addresses": [
            {
                "id": 4,
                "address": "address Company",
                "city": "city Company",
                "state": "state Company",
                "zip": "234",
                "billing_company_id": null,
                "created_at": "2022-03-16T09:44:57.000000Z",
                "updated_at": "2022-03-16T09:44:57.000000Z",
                "addressable_type": "App\\Models\\Company",
                "addressable_id": 1
            }
        ],
        "contacts": [
            {
                "id": 5,
                "phone": "34324234",
                "fax": "567674576457",
                "email": "company@company.com",
                "billing_company_id": null,
                "created_at": "2022-03-16T09:44:57.000000Z",
                "updated_at": "2022-03-16T09:44:57.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\Company",
                "contactable_id": 1
            }
        ],
        "nicknames": [
            {
                "id": 1,
                "nickname": "alias company first",
                "nicknamable_type": "App\\Models\\Company",
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

<a name="get-all-company-server"></a>
## Get all company from server

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
            "code": "CO-00002-2022",
            "name": "company second",
            "npi": "222CF1222",
            "created_at": "2022-03-16T09:49:06.000000Z",
            "updated_at": "2022-03-16T09:49:06.000000Z",
            "status": false,
            "addresses": [
                {
                    "id": 5,
                    "address": "address Company2",
                    "city": "city Company2",
                    "state": "state Company2",
                    "zip": "234",
                    "billing_company_id": null,
                    "created_at": "2022-03-16T09:49:06.000000Z",
                    "updated_at": "2022-03-16T09:49:06.000000Z",
                    "addressable_type": "App\\Models\\Company",
                    "addressable_id": 2
                }
            ],
            "contacts": [
                {
                    "id": 6,
                    "phone": "34324234",
                    "fax": "567674576457",
                    "email": "company2@company.com",
                    "billing_company_id": null,
                    "created_at": "2022-03-16T09:49:06.000000Z",
                    "updated_at": "2022-03-16T09:49:06.000000Z",
                    "mobile": null,
                    "contactable_type": "App\\Models\\Company",
                    "contactable_id": 2
                }
            ],
            "nicknames": [
                {
                    "id": 1,
                    "nickname": "alias company second",
                    "nicknamable_type": "App\\Models\\Company",
                    "nicknamable_id": 6,
                    "billing_company_id": 1,
                    "created_at": "2022-04-04T12:55:15.000000Z",
                    "updated_at": "2022-04-04T12:55:15.000000Z"
                }
            ],
        },
        {
            "id": 1,
            "code": "CO-00001-2022",
            "name": "company first",
            "npi": "222CF123",
            "created_at": "2022-03-16T09:44:57.000000Z",
            "updated_at": "2022-03-16T09:44:57.000000Z",
            "status": false,
            "addresses": [
                {
                    "id": 4,
                    "address": "address Company",
                    "city": "city Company",
                    "state": "state Company",
                    "zip": "234",
                    "billing_company_id": null,
                    "created_at": "2022-03-16T09:44:57.000000Z",
                    "updated_at": "2022-03-16T09:44:57.000000Z",
                    "addressable_type": "App\\Models\\Company",
                    "addressable_id": 1
                }
            ],
            "contacts": [
                {
                    "id": 5,
                    "phone": "34324234",
                    "fax": "567674576457",
                    "email": "company@company.com",
                    "billing_company_id": null,
                    "created_at": "2022-03-16T09:44:57.000000Z",
                    "updated_at": "2022-03-16T09:44:57.000000Z",
                    "mobile": null,
                    "contactable_type": "App\\Models\\Company",
                    "contactable_id": 1
                }
            ],
            "nicknames": [
                {
                    "id": 1,
                    "nickname": "alias company first",
                    "nicknamable_type": "App\\Models\\Company",
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



<a name="get-one-company"></a>
## Get One Company


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company house found

#

```json
{
    "id": 6,
    "code": "CO-00006-2023",
    "name": "Company Four",
    "npi": "22212312",
    "ein": "1234321",
    "upin": "222CF123",
    "clia": "222CF123",
    "name_suffix_id": 1,
    "name_suffix": "Aetna",
    "created_at": "2023-02-03T16:35:34.000000Z",
    "updated_at": "2023-02-03T16:35:34.000000Z",
    "last_modified": {
        "user": "Henry Paredes",
        "roles": [
            {
                "id": 1,
                "name": "Super User",
                "slug": "superuser",
                "description": "Allows you to administer and manage all the functions of the application",
                "level": 1,
                "created_at": "2023-02-01T14:25:01.000000Z",
                "updated_at": "2023-02-01T14:25:01.000000Z",
                "pivot": {
                    "user_id": 12,
                    "role_id": 1,
                    "created_at": "2023-02-01T14:25:35.000000Z",
                    "updated_at": "2023-02-01T14:25:35.000000Z"
                }
            }
        ]
    },
    "public_note": "Public note",
    "taxonomies": [
        {
            "id": 8,
            "name": "Nametaxonomy Company",
            "created_at": "2023-02-03T16:11:53.000000Z",
            "updated_at": "2023-02-03T16:11:53.000000Z",
            "tax_id": "TAX01213",
            "primary": true,
            "pivot": {
                "company_id": 6,
                "taxonomy_id": 8,
                "created_at": "2023-02-03T16:35:34.000000Z",
                "updated_at": "2023-02-03T16:35:34.000000Z"
            }
        },
        {
            "id": 9,
            "name": "Nametaxonomy 2 Company",
            "created_at": "2023-02-03T16:11:53.000000Z",
            "updated_at": "2023-02-03T16:11:53.000000Z",
            "tax_id": "TAX01222",
            "primary": false,
            "pivot": {
                "company_id": 6,
                "taxonomy_id": 9,
                "created_at": "2023-02-03T16:35:34.000000Z",
                "updated_at": "2023-02-03T16:35:34.000000Z"
            }
        }
    ],
    "facilities": [],
    "billing_companies": [
        {
            "id": 1,
            "name": "Medical Claims Consultants",
            "code": "BC-00001-2023",
            "abbreviation": "MCC",
            "private_company": {
                "status": true,
                "edit_name": true,
                "nickname": "Alias Company First",
                "abbreviation": "ABB212",
                "private_note": "Private note",
                "address": {
                    "zip": "123234",
                    "city": "City Company",
                    "state": "state Company",
                    "address": "Address Company",
                    "country": "Name country",
                    "address_type_id": null,
                    "country_subdivision_code": "code"
                },
                "payment_address": {
                    "zip": "123234",
                    "city": "City Company",
                    "state": "state Company",
                    "address": "Address Company",
                    "country": "Name country",
                    "address_type_id": 3,
                    "country_subdivision_code": "code"
                },
                "contact": {
                    "fax": "567674576457",
                    "email": "company33221@company.com",
                    "phone": "34324234",
                    "mobile": "34324234",
                    "contact_name": "Name Contact"
                },
                "exception_insurance_companies": [
                    {
                        "id": 1,
                        "code": "IC-00001-2023",
                        "name": "Providence Administrative Services",
                        "payer_id": "PAS01"
                    },
                    {
                        "id": 2,
                        "code": "IC-00002-2023",
                        "name": "Kg Administrative Services",
                        "payer_id": "KGA15"
                    }
                ],
                "statements": [
                    {
                        "id": 1,
                        "start_date": "2022-02-03",
                        "end_date": "2022-02-03",
                        "rule_id": 1,
                        "rule": "Aetna",
                        "when_id": 1,
                        "when": "Aetna",
                        "apply_to_ids": [
                            1
                        ]
                    }
                ]
            }
        }
    ]
}
```
#

>{warning} 404 company found not found

<a name="get-one-company-by-name"></a>
## Get One Company by name


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "name": <string>
}
```

## Response

> {success} 200 company house found

#

```json
{
    "id": 2,
    "code": "CO-00002-2022",
    "name": "PANAMERICAN INTERNAL MEDICINE INC",
    "npi": "1396903308",
    "created_at": "2022-03-17T23:00:59.000000Z",
    "updated_at": "2022-03-17T23:00:59.000000Z",
    "status": true,
    "taxonomies": [
        {
            "id": 4,
            "name": "Health Maintenance Organization",
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "tax_id": "302R00000X",
            "primary": true,
            "pivot": {
                "company_id": 2,
                "taxonomy_id": 4,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ],
    "addresses": [
        {
            "id": 14,
            "address": "Avenue of the Giants",
            "city": "Merida",
            "state": "California",
            "zip": "123456789",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "addressable_type": "App\\Models\\Company",
            "addressable_id": 2
        }
    ],
    "contacts": [
        {
            "id": 15,
            "phone": "239-410-2887",
            "fax": "+9999999",
            "email": "titu@gmai.com",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "mobile": null,
            "contactable_type": "App\\Models\\Company",
            "contactable_id": 2
        }
    ],
    "facilities": [],
    "billing_companies": [
        {
            "id": 1,
            "name": "Block-Walsh",
            "created_at": "2022-03-16T23:18:59.000000Z",
            "updated_at": "2022-03-16T23:18:59.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "pivot": {
                "company_id": 2,
                "billing_company_id": 1,
                "status": true,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ]
}
```

#

>{warning} 404 company found not found

<a name="get-one-company-by-email"></a>
## Get One Company by email


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "email": <string>
}
```

## Response

> {success} 200 company house found

#

```json
{
    "id": 2,
    "code": "CO-00002-2022",
    "name": "PANAMERICAN INTERNAL MEDICINE INC",
    "npi": "1396903308",
    "created_at": "2022-03-17T23:00:59.000000Z",
    "updated_at": "2022-03-17T23:00:59.000000Z",
    "status": true,
    "taxonomies": [
        {
            "id": 4,
            "name": "Health Maintenance Organization",
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "tax_id": "302R00000X",
            "primary": true,
            "pivot": {
                "company_id": 2,
                "taxonomy_id": 4,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ],
    "addresses": [
        {
            "id": 14,
            "address": "Avenue of the Giants",
            "city": "Merida",
            "state": "California",
            "zip": "123456789",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "addressable_type": "App\\Models\\Company",
            "addressable_id": 2
        }
    ],
    "contacts": [
        {
            "id": 15,
            "phone": "239-410-2887",
            "fax": "+9999999",
            "email": "titu@gmai.com",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "mobile": null,
            "contactable_type": "App\\Models\\Company",
            "contactable_id": 2
        }
    ],
    "facilities": [],
    "billing_companies": [
        {
            "id": 1,
            "name": "Block-Walsh",
            "created_at": "2022-03-16T23:18:59.000000Z",
            "updated_at": "2022-03-16T23:18:59.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "pivot": {
                "company_id": 2,
                "billing_company_id": 1,
                "status": true,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ]
}
```
#

>{warning} 404 company found not found

<a name="get-one-company-by-npi"></a>
## Get one company by npi


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "npi": <string>
}
```

## Response

> {success} 200 company house found

#

```json
{
    "id": 2,
    "code": "CO-00002-2022",
    "name": "PANAMERICAN INTERNAL MEDICINE INC",
    "npi": "1396903308",
    "created_at": "2022-03-17T23:00:59.000000Z",
    "updated_at": "2022-03-17T23:00:59.000000Z",
    "status": true,
    "taxonomies": [
        {
            "id": 4,
            "name": "Health Maintenance Organization",
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "tax_id": "302R00000X",
            "primary": true,
            "pivot": {
                "company_id": 2,
                "taxonomy_id": 4,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ],
    "addresses": [
        {
            "id": 14,
            "address": "Avenue of the Giants",
            "city": "Merida",
            "state": "California",
            "zip": "123456789",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "addressable_type": "App\\Models\\Company",
            "addressable_id": 2
        }
    ],
    "contacts": [
        {
            "id": 15,
            "phone": "239-410-2887",
            "fax": "+9999999",
            "email": "titu@gmai.com",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "mobile": null,
            "contactable_type": "App\\Models\\Company",
            "contactable_id": 2
        }
    ],
    "facilities": [],
    "billing_companies": [
        {
            "id": 1,
            "name": "Block-Walsh",
            "created_at": "2022-03-16T23:18:59.000000Z",
            "updated_at": "2022-03-16T23:18:59.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "pivot": {
                "company_id": 2,
                "billing_company_id": 1,
                "status": true,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ]
}
```
#

>{warning} 404 company found not found

<a name="get-list"></a>
## Get all company by billing company


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "id": <integer>
}
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

<a name="get-list-name-suffix"></a>
## Get all company name suffix


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "id": <integer>
}
```

## Response

> {success} 200 Company name suffix found

#

```json
[
    {
        "id": 182,
        "name": "I"
    },
    {
        "id": 183,
        "name": "II"
    },
    {
        "id": 184,
        "name": "III"
    },
    {
        "id": 185,
        "name": "IV"
    },
    {
        "id": 186,
        "name": "Jr"
    },
    {
        "id": 187,
        "name": "Sr"
    }
]
```

<a name="get-list-statement-rules"></a>
## Get all statement rules


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "id": <integer>
}
```

## Response

> {success} 200 Statement rules found

#

```json
[
    {
        "id": 174,
        "name": "Send to all"
    },
    {
        "id": 175,
        "name": "Send to none"
    },
    {
        "id": 176,
        "name": "Send if plan is"
    },
    {
        "id": 177,
        "name": "Do not send if plan is"
    },
    {
        "id": 178,
        "name": "Send on payment"
    }
]
```

<a name="get-list-statement-when"></a>
## Get all statement when


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "id": <integer>
}
```

## Response

> {success} 200 Statement when found

#

```json
[
    {
        "id": 179,
        "name": "When registering the payment"
    },
    {
        "id": 180,
        "name": "In a defined period"
    },
    {
        "id": 181,
        "name": "Specific date"
    }
]
```
<a name="get-list-statement-apply-to"></a>
## Get all statement apply to


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "id": <integer>
}
```

## Response

> {success} 200 Statement apply to found

#

```json
[
    {
        "id": 188,
        "name": "Apply to 1"
    },
    {
        "id": 189,
        "name": "Apply to 2"
    }
]
```

<a name="get-list-billing-companies"></a>
## Get list billing companies


### Param in header

```json
{
    "Authorization": bearer <token>
}
```
### Param in path

```json
{
    "company_id": <integer>
    "edit": <boolean>
}
```

## Example path

>{primary} /get-list-billing-companies?company_id=2&edit=false

> /get-list-billing-companies?company_id=2&edit=true

## Response

> {success} 200 Billing Companies found

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
    },
    {
        "id": 4,
        "name": "Halvorson, Deckow and Bode"
    }
]
```

#
<a name="update-company"></a>
## Update Company


### Body request example


#

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "npi":"222123", /** required */
    "ein":"1234321", /** required only number max 9 */
    "upin":"222CF123", /** optional alfanumeric max 50 */
    "clia":"222CF123", /** optional alfanumeric max 50 */
    "name":"company first", /** required */
    "nickname":"alias company first", /** optional */
    "name_suffix_id": 1, /** optional */
    "abbreviation": "ABB", /** optional */
    "taxonomies": [
        {
            "tax_id": "TAX01213", /** required if exist*/
            "name": "NameTaxonomy Company", /** required if exist */
            "primary": true /** required if exist */
        },
        {
            "tax_id": "TAX01222", /** required if exist */
            "name": "NameTaxonomy 2 Company", /** required if exist */
            "primary": false /** required if exist */
        }
    ],
    "contact": {
        "contact_name": "Name Contact", /** optional */
        "phone":"34324234", /** optional */
        "mobile":"34324234", /** optional */
        "fax":"567674576457", /** optional */
        "email":"company@company.com" /** required */
    },
    "address": {
        "address":"address Company", /** required */
        "city":"city Company", /** required */
        "state":"state Company", /** required */
        "zip": "123234", /** required */
        "country": "Name country", /** optional */
        "country_subdivision_code": "code" /** optional */
    },
    "payment_address": { /** optional */
        "address":"address Company", /** required if exist */
        "city":"city Company", /** required if exist */
        "state":"state Company", /** required if exist */
        "zip": "123234", /** required if exist */
        "country": "Name country", /** optional */
        "country_subdivision_code": "code" /** optional */
    },
    "statements": [
        {
            "rule_id": 1, /** optional */
            "when_id": 1, /** optional */
            "apply_to_ids": [1,2,3], /** optional */
            "start_date": "2022-02-03", /** required if when content 'period' */
            "end_date": "2022-02-03", /** required if when content 'period', example 'In a defined period' */
        }
    ],
    "exception_insurance_companies": [1,2,3], /** optional */
    "public_note": "Public Note", /** optional */
    "private_note": "Private Note" /** optional */
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

> {success} 200 company created


#

```json
{
    "code": "CO-00001-2022",
    "name": "company first",
    "npi": "222CF123",
    "updated_at": "2022-03-16T09:44:57.000000Z",
    "created_at": "2022-03-16T09:44:57.000000Z",
    "id": 1,
    "status": false
}
```



#


<a name="change-status-company"></a>
## Change status Company


### Body request example

```json
{
    "status":"boolean"
}
```


## Response

> {success} 204 Good response


#


<a name="add-to-billing-company"></a>
## Add to billing company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required integer`


## Response

> {success} 200 Good response

```json
{
    "code": "CO-00001-2022",
    "name": "company first",
    "npi": "222CF123",
    "updated_at": "2022-03-16T09:44:57.000000Z",
    "created_at": "2022-03-16T09:44:57.000000Z",
    "id": 1,
    "status": true
}
```

#

>{warning} 404 error add company to billing company


<a name="add-facilities"></a>
## Add facilities to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required integer`

## Param in body

```json
{
    "facilities": [
        {
            "billing_company_id": 1, /** Only required by superuser */
            "facility_id": 1,
        },
        {
            "billing_company_id": 1,
            "facility_id": 2,
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
        "facility_id": 2,
        "facility_type_id": 6,
        "billing_company": "Medical Claims Consultants",
        "facility": "Isa Home Corp.",
        "facility_type": "AL - Assisted Living Facility"
    }
]
```

#

>{warning} 404 error add facilities to company


<a name="add-services"></a>
## Add services to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required integer`

## Param in body

```json
{
    "services": [
        {
            "billing_company_id": 1, /** Only required by superuser */
            "procedure_id": 1,
            "description": "Description procedure",
            "modifier_id": 2,
            "price": 20.2,
            "mac": "02102",
            "locality_number":"01",
            "state": "ALASKA",
            "fsa": "STATEWIDE",
            "counties": "ALL COUNTIES",
            "insurance_label_fee_id": 1,
            "price_percentage": "70",
            "clia": "00001A",
            "medication_application": true,
            "medications": [
                {
                    "date": "2022-03-16",
                    "drug_code": "001A23X",
                    "batch": "0101AS",
                    "quantity": 2,
                    "frequency": 3
                },
                {
                    "date": "2022-03-16",
                    "drug_code": "002A23X",
                    "batch": "0201AS",
                    "quantity": 2,
                    "frequency": 3
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
            "billing_company_id": 1, /** Only required by superuser */
            "procedure_id": 1,
            "description": "Description procedure",
            "modifier_id": 2,
            "price": 20.2,
            "mac": "02102",
            "locality_number":"01",
            "state": "ALASKA",
            "fsa": "STATEWIDE",
            "counties": "ALL COUNTIES",
            "insurance_label_fee_id": 1,
            "price_percentage": "70",
            "clia": "00001A",
            "medication_application": true,
            "medications": [
                {
                    "code": "000001",
                    "date": "2022-03-16",
                    "drug_code": "001A23X",
                    "batch": "0101AS",
                    "quantity": 2,
                    "frequency": 3
                },
                {
                    "code": "000002",
                    "date": "2022-03-16",
                    "drug_code": "002A23X",
                    "batch": "0201AS",
                    "quantity": 2,
                    "frequency": 3
                }
            ]

        }
    ]
```

#

>{warning} 404 error add services to company


<a name="add-copay"></a>
## Add copays to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required integer`

## Param in body

```json
{
    "copays": [
        {
            "billing_company_id": 1, /** Only required by superuser */
            "procedure_ids": [1,2,3],
            "insurance_plan_id": 1,
            "insurance_company_id": 1,
            "copay": 150.2,
            "private_note": "Note private by billing_company"
        }
    ]
}
```


## Response

> {success} 200 Good response

```json
[
    {
        "billing_company_id": 1, /** Only required by superuser */
        "procedure_id": 1,
        "insurance_plan_id": 1,
        "insurance_company_id": 1,
        "copay": 150.2,
        "private_note": "Note private by billing_company"
    }
]
```

#

>{warning} 404 error add copays to company


<a name="add-contracts-fee"></a>
## Add contracts fee to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required integer`

## Param in body

```json
{
    "contract_fees": [
        {
            "billing_company_id": 1, /** Only required by superuser */
            "insurance_company_id": 1,
            "insurance_plan_id": 1,
            "type_id": 1,
            "start_date": "2022-03-16",
            "end_date": "2022-03-16",
            "procedure_id": 2,
            "modifier_id": 1,
            "contract": 120.5,
            "mac": "02102",
            "locality_number":"01",
            "state": "ALASKA",
            "fsa": "STATEWIDE",
            "counties": "ALL COUNTIES",
            "insurance_label_fee_id": 1,
            "price_percentage": "70",
            "private_note": "Note private by billing_company"
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
        "insurance_company_id": 1,
        "insurance_plan_id": 1,
        "type_id": 1,
        "start_date": "2022-03-16",
        "end_date": "2022-03-16",
        "procedure_id": 2,
        "modifier_id": 1,
        "contract": 120.5,
        "mac": "02102",
        "locality_number":"01",
        "state": "ALASKA",
        "fsa": "STATEWIDE",
        "counties": "ALL COUNTIES",
        "insurance_label_fee_id": 1,
        "price_percentage": "70",
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

#

>{warning} 404 error add contracts fee to company