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
| 11 |GET | `Get list billing companies`| `/insurance-company/get-list-billing-companies/{insuranceCompanyId?}`        |yes            |Get list billing companies|



>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean





#


<a name="create-insurance-company"></a>
## Create Insurance Company

### Body request example

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "insurance":{
        "payer_id": 12,
        "name":"dsfsdfsfeddsddfg",
        "nickname":"alias insurance",
        "naic":"someNaic",
        "file_method_id": 1,
    },
    "billing_incomplete_reasons": [1,2,3],
    "time_failed": {
        "day_count": 30,
        "from_id": 2,
    },
    "appeals": [
        {
            "appeal_type_id": 1,
            "private_note": "Rules"
        }
    ],
    "address":{
        "address":"dfsdf",
        "city":"cdfsf",
        "state":"sdsfsd",
        "zip":"3234"
    },
    "contact":{
        "phone":"55433",
        "mobile":"55433",
        "fax":"fsdfs",
        "email":"dsfsd@gdrfg.com"
    },
    "public_note": "Note Public",
    "private_note": "Note Private"
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
            "nickname": "alias insurance",
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

<a name="update-insurance-company"></a>
## Update Insurance Company

### Body request example

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "insurance":{
        "name":"dsfsdfsfeddsddfg",
        "nickname":"alias insurance edit",
        "naic":"someNaic",
        "file_method":"someFileNaic"
    },
    "address":{
        "address":"dfsdf",
        "city":"cdfsf",
        "state":"sdsfsd",
        "zip":"3234"
    },
    "contact":{
        "phone":"55433",
        "fax":"fsdfs",
        "email":"dsfsd@gdrfg.com"
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
}
```

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