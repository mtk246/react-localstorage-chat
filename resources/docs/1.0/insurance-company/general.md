# Insurance Company Docs

---

- [Basic data](#basic-data)
- [Create insurance company](#create-insurance-company)
- [Get all insurance company](#get-all-insurance-company)
- [Get all insurance company from server](#get-all-insurance-company-server)
- [Get one insurance company](#get-one-insurance-company)
- [Update insurance company](#update-insurance-company)
- [Get one insurance company by name](#get-one-insurance-company-by-name)
- [Get one Insurance Company by company](#get-one-insurance-company-by-company)
- [Change status insurance company](#change-status-insurance-company)
- [Add to billing company](#add-to-billing-company)
- [Get list insurance companies](#get-list-insurance-companies)
- [Get list billing companies](#get-list-billing-companies)
- [Get one insurance company by payer](#get-one-insurance-company-by-payer)
- [Get list file methods](#get-list-file-methods)
- [Get list from the date](#get-list-from-the-date)
- [Get list billing incomplete reasons](#get-list-billing-incomplete-reasons)
- [Get list appeal reasons](#get-list-appeal-reasons)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Insurance Company`                    | `/insurance-company/`               |yes             |Create Insurance Company|         
| 2 |GET | `Get all Insurance Company`                   | `/insurance-company/`        |yes            |Get all Insurance Company|
| 3 |GET | `Get all Insurance Company from server`       | `/insurance-company/get-all-server`|yes|Get all insurance company from server|
| 4 |GET | `Get one Insurance Company`                   | `/insurance-company/{id}`|yes|Get one Insurance Company|
| 5 |PUT | `Update Insurance Company`                | `/insurance-company/{id}`|yes|Update Insurance Company|
| 6 |GET | `Get one Insurance Company by name`           | `/insurance-company/{name}/get-by-name`|yes|Get one Insurance Company by name|
| 7 |GET | `Get one Insurance Company by company`           | `/insurance-company/{companyName}/get-by-company`|yes|Get one Insurance Company by name|
| 8 |PATCH | `Change status Insurance Company`           | `/insurance-company/{id}/change-status`|yes|Change status Insurance Company|
| 9 |PATCH | `Add to billing company`                    | `/insurance-company/add-to-billing-company/{id}`|yes|Add insurance company to billing company|
| 10 |GET | `Get list insurance companies`| `/insurance-company/get-list`        |yes            |Get list insurance companies|
| 11 |GET | `Get list billing companies`| `/insurance-company/get-list-billing-companies?insurance_company_id={InsuranceID?}&edit={edit?}`        |yes            |Get list billing companies|
| 12 |GET | `Get one insurance companies by payer ID`| `/insurance-company/get-by-payer-id/{payerID}`        |yes            |Get one insurance company|
| 13 |GET | `Get list file methods`| `/insurance-company/get-list-file-methods`        |yes            |Get list file methods|
| 14 |GET | `Get list from the date`| `/insurance-company/get-list-from-the-date`        |yes            |Get list from the date of|
| 15 |GET | `Get list billing incomplete reasons`| `/insurance-company/get-list-billing-incomplete-reasons`        |yes            |Get list billing incomplete reasons|
| 16 |GET | `Get list appeal reasons`| `/insurance-company/get-list-appeal-reasons`        |yes            |Get list appeal reasons|


>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean

<a name="create-insurance-company"></a>
## Create Insurance Company

### Body request example

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "insurance":{
        "payer_id": 12, /** required */
        "name":"Name insurance", /** required */
        "abbreviations": ["Abbreviation 1", "Abbreviation 2"], /** required */
        "nickname":"alias insurance", /** optional */
        "naic":"someNaic",  /** optional */
        "file_method_id": 1, /** required */
    },
    "time_failed": {
        "days": 30, /** optional */
        "from_id": 2, /** optional */
    },
    "billing_incomplete_reasons": [1,2,3], /** optional */
    "appeal_reasons": [1,2,3], /** optional */
    "address": {
        "address":"Name address", /** required */
        "city":"Name city", /** required */
        "state":"Name state", /** required */
        "zip":"3234", /** required */
        "country": "Name country", /** consultar monser */
        "country_subdivision_code": "Code", /** consultar monser */
    },
    "contact": {
        "contact_name": "Some name", /** consultar monser */
        "phone":"55433", /** required */
        "mobile":"55433", /** optional */
        "fax":"fsdfs", /** optional */
        "email":"dsfsd@gdrfg.com" /** required */
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

> {success} 201 Insurance Company created


#



```json
{
    "name": "dsfsdfsfffeddsddfg",
    "naic": "someNffaic",
    "file_method": "soffmeFileNaic",
    "code": "389245",
    "updated_at": "2022-02-03T21:30:51.000000Z",
    "created_at": "2022-02-03T21:30:51.000000Z",
    "id": 3,
    "address": {
        "id": 23,
        "address": "dfsdf",
        "city": "cdfsf",
        "state": "sdsfsd",
        "zip": "3234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    },
    "contact": {
        "id": 21,
        "phone": "55433",
        "fax": "fsdfs",
        "email": "dsfsd@gdrfg.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    }
}
```



#


<a name="get-all-insurance-company"></a>
## Get All Insurance company


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
        "code": "042151",
        "name": "dsfsdfsfesddfg",
        "file_method": "someFileNaic",
        "naic": "someNaic",
        "created_at": "2022-02-03T20:13:40.000000Z",
        "updated_at": "2022-02-03T20:13:40.000000Z",
        "status": false,
        "address": null,
        "contact": null,
        "nicknames": [
            {
                "id": 1,
                "nickname": "alias insurance",
                "nicknamable_type": "App\\Models\\InsuranceCompany",
                "nicknamable_id": 6,
                "billing_company_id": 1,
                "created_at": "2022-04-04T12:55:15.000000Z",
                "updated_at": "2022-04-04T12:55:15.000000Z"
            }
        ],
    },
    {
        "id": 2,
        "code": "391961",
        "name": "dsfsdfsfeddsddfg",
        "file_method": "someFileNaic",
        "naic": "someNaic",
        "created_at": "2022-02-03T20:17:32.000000Z",
        "updated_at": "2022-02-03T20:17:32.000000Z",
        "status": false,
        "address": {
            "id": 22,
            "address": "dfsdf",
            "city": "cdfsf",
            "state": "sdsfsd",
            "zip": "3234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-03T20:17:32.000000Z",
            "updated_at": "2022-02-03T20:17:32.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": null,
            "insurance_company_id": 2
        },
        "contact": {
            "id": 20,
            "phone": "55433",
            "fax": "fsdfs",
            "email": "dsfsd@gdrfg.com",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-03T20:17:32.000000Z",
            "updated_at": "2022-02-03T20:17:32.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": null,
            "insurance_company_id": 2
        },
        "nicknames": [
            {
                "id": 1,
                "nickname": "alias insurance",
                "nicknamable_type": "App\\Models\\InsuranceCompany",
                "nicknamable_id": 6,
                "billing_company_id": 1,
                "created_at": "2022-04-04T12:55:15.000000Z",
                "updated_at": "2022-04-04T12:55:15.000000Z"
            }
        ],
    },
    {
        "id": 3,
        "code": "389245",
        "name": "dsfsdfsfffeddsddfg",
        "file_method": "soffmeFileNaic",
        "naic": "someNffaic",
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "status": false,
        "address": {
            "id": 23,
            "address": "dfsdf",
            "city": "cdfsf",
            "state": "sdsfsd",
            "zip": "3234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-03T21:30:51.000000Z",
            "updated_at": "2022-02-03T21:30:51.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": null,
            "insurance_company_id": 3
        },
        "contact": {
            "id": 21,
            "phone": "55433",
            "fax": "fsdfs",
            "email": "dsfsd@gdrfg.com",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-03T21:30:51.000000Z",
            "updated_at": "2022-02-03T21:30:51.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": null,
            "insurance_company_id": 3
        },
        "nicknames": [
            {
                "id": 1,
                "nickname": "alias insurance",
                "nicknamable_type": "App\\Models\\InsuranceCompany",
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

<a name="get-all-insurance-company-server"></a>
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
            "code": "042151",
            "name": "dsfsdfsfesddfg",
            "file_method": "someFileNaic",
            "naic": "someNaic",
            "created_at": "2022-02-03T20:13:40.000000Z",
            "updated_at": "2022-02-03T20:13:40.000000Z",
            "status": false,
            "address": null,
            "contact": null,
            "nicknames": [
                {
                    "id": 1,
                    "nickname": "alias insurance",
                    "nicknamable_type": "App\\Models\\InsuranceCompany",
                    "nicknamable_id": 6,
                    "billing_company_id": 1,
                    "created_at": "2022-04-04T12:55:15.000000Z",
                    "updated_at": "2022-04-04T12:55:15.000000Z"
                }
            ],
        },
        {
            "id": 2,
            "code": "391961",
            "name": "dsfsdfsfeddsddfg",
            "file_method": "someFileNaic",
            "naic": "someNaic",
            "created_at": "2022-02-03T20:17:32.000000Z",
            "updated_at": "2022-02-03T20:17:32.000000Z",
            "status": false,
            "address": {
                "id": 22,
                "address": "dfsdf",
                "city": "cdfsf",
                "state": "sdsfsd",
                "zip": "3234",
                "user_id": null,
                "billing_company_id": null,
                "created_at": "2022-02-03T20:17:32.000000Z",
                "updated_at": "2022-02-03T20:17:32.000000Z",
                "clearing_house_id": null,
                "facility_id": null,
                "company_id": null,
                "insurance_company_id": 2
            },
            "contact": {
                "id": 20,
                "phone": "55433",
                "fax": "fsdfs",
                "email": "dsfsd@gdrfg.com",
                "user_id": null,
                "billing_company_id": null,
                "created_at": "2022-02-03T20:17:32.000000Z",
                "updated_at": "2022-02-03T20:17:32.000000Z",
                "clearing_house_id": null,
                "facility_id": null,
                "company_id": null,
                "insurance_company_id": 2
            },
            "nicknames": [
                {
                    "id": 1,
                    "nickname": "alias insurance",
                    "nicknamable_type": "App\\Models\\InsuranceCompany",
                    "nicknamable_id": 6,
                    "billing_company_id": 1,
                    "created_at": "2022-04-04T12:55:15.000000Z",
                    "updated_at": "2022-04-04T12:55:15.000000Z"
                }
            ],
        },
        {
            "id": 3,
            "code": "389245",
            "name": "dsfsdfsfffeddsddfg",
            "file_method": "soffmeFileNaic",
            "naic": "someNffaic",
            "created_at": "2022-02-03T21:30:51.000000Z",
            "updated_at": "2022-02-03T21:30:51.000000Z",
            "status": false,
            "address": {
                "id": 23,
                "address": "dfsdf",
                "city": "cdfsf",
                "state": "sdsfsd",
                "zip": "3234",
                "user_id": null,
                "billing_company_id": null,
                "created_at": "2022-02-03T21:30:51.000000Z",
                "updated_at": "2022-02-03T21:30:51.000000Z",
                "clearing_house_id": null,
                "facility_id": null,
                "company_id": null,
                "insurance_company_id": 3
            },
            "contact": {
                "id": 21,
                "phone": "55433",
                "fax": "fsdfs",
                "email": "dsfsd@gdrfg.com",
                "user_id": null,
                "billing_company_id": null,
                "created_at": "2022-02-03T21:30:51.000000Z",
                "updated_at": "2022-02-03T21:30:51.000000Z",
                "clearing_house_id": null,
                "facility_id": null,
                "company_id": null,
                "insurance_company_id": 3
            },
            "nicknames": [
                {
                    "id": 1,
                    "nickname": "alias insurance",
                    "nicknamable_type": "App\\Models\\InsuranceCompany",
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

<a name="get-one-insurance-company"></a>
## Get One Insurance company


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
    "id": 4,
    "code": "IC-00004-2023",
    "name": "Name Insurance",
    "naic": "someNaic",
    "payer_id": "12",
    "file_method_id": 1,
    "file_method": "AETNA - Aetna",
    "created_at": "2023-02-03T14:13:36.000000Z",
    "updated_at": "2023-02-03T14:13:36.000000Z",
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
            "private_insurance": {
                "status": true,
                "edit_name": true,
                "nickname": "Alias Insurance",
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
                "insurance_company_time_failed": {
                    "id": 1,
                    "days": 30,
                    "from_id": 2,
                    "billing_company_id": 1,
                    "insurance_company_id": 4,
                    "created_at": "2023-02-03T14:13:36.000000Z",
                    "updated_at": "2023-02-03T14:13:36.000000Z",
                    "from": {
                        "id": 2,
                        "code": "AUTO",
                        "description": "Automobile Insurance",
                        "status": true,
                        "type_id": 1
                    }
                },
                "billing_incomplete_reasons": [
                    {
                        "id": 1,
                        "code": "AETNA",
                        "description": "Aetna",
                        "status": true,
                        "type_id": 1
                    },
                    {
                        "id": 2,
                        "code": "AUTO",
                        "description": "Automobile Insurance",
                        "status": true,
                        "type_id": 1
                    },
                    {
                        "id": 3,
                        "code": "BCBS",
                        "description": "Blue Cross an Blue Shield",
                        "status": true,
                        "type_id": 1
                    }
                ],
                "appeal_reasons": [
                    {
                        "id": 1,
                        "code": "AETNA",
                        "description": "Aetna",
                        "status": true,
                        "type_id": 1
                    },
                    {
                        "id": 2,
                        "code": "AUTO",
                        "description": "Automobile Insurance",
                        "status": true,
                        "type_id": 1
                    },
                    {
                        "id": 3,
                        "code": "BCBS",
                        "description": "Blue Cross an Blue Shield",
                        "status": true,
                        "type_id": 1
                    }
                ]
            }
        },
        {
            "id": 2,
            "name": "Billing Paradise Revenue Cyde Master",
            "code": "BC-00002-2023",
            "abbreviation": "BillingP",
            "private_insurance": {
                "status": true,
                "edit_name": false,
                "nickname": "",
                "abbreviations": [
                    {
                        "id": 13,
                        "abbreviation": "Abbreviation 1",
                        "abbreviable_type": "App\\Models\\InsuranceCompany",
                        "abbreviable_id": 5,
                        "billing_company_id": 1,
                        "created_at": null,
                        "updated_at": null
                    },
                    {
                        "id": 14,
                        "abbreviation": "Abbreviation 2",
                        "abbreviable_type": "App\\Models\\InsuranceCompany",
                        "abbreviable_id": 5,
                        "billing_company_id": 1,
                        "created_at": null,
                        "updated_at": null
                    }
                ],
                "private_note": "",
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
                "insurance_company_time_failed": null,
                "billing_incomplete_reasons": [],
                "appeal_reasons": []
            }
        }
    ]
}
```



#

<a name="update-insurance-company"></a>
## Update Insurance Company

### Body request example

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "insurance":{
        "payer_id": 12, /** required */
        "name":"Name insurance", /** required */
        "abbreviations": ["Abbreviation 1", "Abbreviation 2"], /** required */
        "nickname":"alias insurance", /** optional */
        "naic":"someNaic",  /** optional */
        "file_method_id": 1, /** required */
    },
    "time_failed": {
        "days": 30, /** optional */
        "from_id": 2, /** optional */
    },
    "billing_incomplete_reasons": [1,2,3], /** optional */
    "appeal_reasons": [1,2,3], /** optional */
    "address": {
        "address":"Name address", /** required */
        "city":"Name city", /** required */
        "state":"Name state", /** required */
        "zip":"3234", /** required */
        "country": "Name country", /** consultar monser */
        "country_subdivision_code": "Code", /** consultar monser */
    },
    "contact": {
        "contact_name": "Some name", /** consultar monser */
        "phone":"55433", /** required */
        "mobile":"55433", /** optional */
        "fax":"fsdfs", /** optional */
        "email":"dsfsd@gdrfg.com" /** required */
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
    "name": "dsfsdfsfffeddsddfg",
    "naic": "someNffaic",
    "file_method": "soffmeFileNaic",
    "code": "389245",
    "updated_at": "2022-02-03T21:30:51.000000Z",
    "created_at": "2022-02-03T21:30:51.000000Z",
    "id": 3,
    "address": {
        "id": 23,
        "address": "dfsdf",
        "city": "cdfsf",
        "state": "sdsfsd",
        "zip": "3234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    },
    "contact": {
        "id": 21,
        "phone": "55433",
        "fax": "fsdfs",
        "email": "dsfsd@gdrfg.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    },
    "nicknames": [
        {
            "id": 1,
            "nickname": "alias insurance edit",
            "nicknamable_type": "App\\Models\\InsuranceCompany",
            "nicknamable_id": 6,
            "billing_company_id": 1,
            "created_at": "2022-04-04T12:55:15.000000Z",
            "updated_at": "2022-04-04T12:55:15.000000Z"
        }
    ]
}
```



#


<a name="get-one-insurance-company-by-name"></a>
## Get One Insurance company by name


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
    "name": "dsfsdfsfffeddsddfg",
    "naic": "someNffaic",
    "file_method": "soffmeFileNaic",
    "code": "389245",
    "updated_at": "2022-02-03T21:30:51.000000Z",
    "created_at": "2022-02-03T21:30:51.000000Z",
    "id": 3,
    "address": {
        "id": 23,
        "address": "dfsdf",
        "city": "cdfsf",
        "state": "sdsfsd",
        "zip": "3234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    },
    "contact": {
        "id": 21,
        "phone": "55433",
        "fax": "fsdfs",
        "email": "dsfsd@gdrfg.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    }
}
```



#



<a name="change-status-insurance-company"></a>
## Change Status


### Param in header

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


<a name="add-to-billing-company"></a>
## Add to billing company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`insurance_company_id required integer`


## Response

> {success} 200 Good response

```json
{
    "id": 1,
    "code": "insurance_code",
    "name": "insurance_name",
    "file_method": "method 1",
    "naic": "insurance_naic",
    "created_at": null,
    "updated_at": null,
    "status": false
}
```


#

>{warning} 404 error add insurance company to billing company

<a name="get-list-insurance-companies"></a>
## Get list insurance companies


### Param in header

```json
{
    "Authorization": bearer <token>
}
```
### Param in path

```json
{
    "billing_company_id": <integer>
}
```

## Example path

>{primary} /get-list?billing_company_id=2

## Response

> {success} 200 Insurance Companies found

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
    "insurance_company_id": <integer>
    "edit": <boolean>
}
```

## Example path

>{primary} /get-list-billing-companies?insurance_company_id=2&edit=false


> /get-list-billing-companies?insurance_company_id=2&edit=true

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

<a name="get-one-insurance-company-by-payer"></a>
## Get One Insurance company by payer ID


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "payer_id": <string>
}
```

## Response

> {success} 200 Insurance found

#


```json
{
    "id": 2,
    "code": "IC-00002-2022",
    "name": "Name",
    "naic": "naic",
    "created_at": "2022-10-31T12:41:23.000000Z",
    "updated_at": "2022-10-31T12:41:23.000000Z",
    "payer_id": "10G",
    "file_method_id": null,
    "status": false,
    "last_modified": {
        "user": "Henry Paredes",
        "roles": [
            {
                "id": 1,
                "name": "Super User",
                "slug": "superuser",
                "description": "Allows you to administer and manage all the functions of the application",
                "level": 1,
                "created_at": "2022-04-20T21:52:51.000000Z",
                "updated_at": "2022-04-20T21:52:51.000000Z",
                "pivot": {
                    "user_id": 14,
                    "role_id": 1,
                    "created_at": "2022-07-20T21:04:22.000000Z",
                    "updated_at": "2022-07-20T21:04:22.000000Z"
                }
            }
        ]
    }
}
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


<a name="get-list-billing-incomplete-reasons"></a>
## Get list billing incomplete reasons


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Billing incomplete reasons found

#

```json
[
    {
        "id": 60,
        "name": "00001 - Missing patient date of birthday"
    },
    {
        "id": 61,
        "name": "00002 - Missing hospital admit date"
    },
    {
        "id": 62,
        "name": "00003 - Missing or deleted diagnosis"
    },
    {
        "id": 63,
        "name": "00004 - Authorized quantity exceeded"
    },
    {
        "id": 64,
        "name": "00005 - Missing sex in patient record"
    }
]
```

<a name="get-list-appeal-reasons"></a>
## Get list appeal reasons


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Appeal reasons found

#

```json
[
    {
        "id": 153,
        "name": "1 - Any denial that involves a determination that a treatment is experimental or investigational"
    },
    {
        "id": 154,
        "name": "2 - Any denial that involves medical judgment where you or your provider may disagree with the health insurance plan"
    },
    {
        "id": 155,
        "name": "3 - The benefit is not offered under your health plan"
    },
    {
        "id": 156,
        "name": "4 - Your medical problem began before you joined the plan"
    }
]
```