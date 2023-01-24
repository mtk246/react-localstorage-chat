# Clearing House Docs

---

- [Basic data](#basic-data)
- [Create clearing house](#create-clearing-house)
- [Get all clearing house](#get-all-clearing-house)
- [Get all clearing house from server](#get-all-clearing-house-server)
- [Get one clearing house](#get-one-clearing-house)
- [Update one clearing house](#update-one-clearing-house)
- [Get one Clearing house by name](#get-one-clearing-house-by-name)
- [Change status Clearing house](#change-status-clearing-house)
- [Add to billing company](#add-to-billing-company)
- [Get list transmission formats](#get-list-transmission-formats)
- [Get list transmission formats](#get-list-org-types)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create clearing house`                    | `/clearing-house/`               |yes             |Create Clearing House  |         
| 2 |GET | `Get all clearing house`                   | `/clearing-house/`        |yes            |Get all Clearing House|
| 3 |GET | `Get all clearing house from server`          | `/clearing-house/get-all-server`|yes|Get all clearing house from server|
| 4 |GET | `Get one Clearing house`                   | `/clearing-house/{id}`|yes|Get one Clearing House|
| 5 |PUT | `Update one Clearing house`                | `/clearing-house/{id}`|yes|Update one Clearing House|
| 6 |GET | `Get one Clearing house by name`           | `/clearing-house/get-by-name/{name}`|yes|Get one Clearing House by name|
| 7 |PATCH | `Change status Clearing house`           | `/clearing-house/{id}`|yes|Get one Clearing House|
| 8 |PATCH | `Add to billing company`                 | `/clearing-house/add-to-billing-company/{id}`|yes|Add clearing house to billing company|
| 9 |GET | `Get list transmission formats`| `/clearing-house/get-list-transmission-formats`        |yes            |Get list transmission formats|
| 10 |GET | `Get list org types`| `/clearing-house/get-list-org-types`        |yes            |Get list org types|



>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean


# 

<a name="create-clearing-house"></a>
## Create Clearing House

### Body request example

```json
{
    "name":"clearing first",
    "org_type":"222CH123",
    "ack_required":true,
    "nickname":"alias clearingName",
    "abbreviation":"ABBCLEARING",
    "transmission_format_id": 1,
    "billing_company_id": 1, /** Only required by superuser */
    "address": {
        "address":"address Clearing",
        "city":"city Clearing",
        "state":"state Clearing",
        "zip":234
    },
    "contact":{
        "phone":"34324234",
        "fax":"567674576457",
        "email":"clearing@cclearing.com"
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

> {success} 201 clearing house created


#

```json
{
    "code": "CH-00001-2022",
    "name": "clearing first",
    "org_type": "222CH123",
    "ack_required": true,
    "updated_at": "2022-03-16T11:00:09.000000Z",
    "created_at": "2022-03-16T11:00:09.000000Z",
    "id": 1,
    "status": true,
    "billing_companies": [
        {
            "id": 1,
            "name": "Hammes and Sons",
            "created_at": "2022-03-16T10:02:29.000000Z",
            "updated_at": "2022-03-16T10:02:29.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "pivot": {
                "clearing_house_id": 1,
                "billing_company_id": 1,
                "status": true,
                "created_at": "2022-03-16T11:00:09.000000Z",
                "updated_at": "2022-03-16T11:00:09.000000Z"
            }
        }
    ]
}
```


# 

<a name="get-all-clearing-house"></a>
## Get All Clearing House


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Clearing houses found 

#

```json
[
    {
        "id": 2,
        "code": "CH-00002-2022",
        "name": "clearing second",
        "created_at": "2022-03-16T11:02:28.000000Z",
        "updated_at": "2022-03-16T11:02:28.000000Z",
        "org_type": "222CH123",
        "ack_required": true,
        "status": true,
        "addresses": [
            {
                "id": 7,
                "address": "address Clearing 2",
                "city": "city Clearing 2",
                "state": "state Clearing 2",
                "zip": "234",
                "billing_company_id": 1,
                "created_at": "2022-03-16T11:02:28.000000Z",
                "updated_at": "2022-03-16T11:02:28.000000Z",
                "addressable_type": "App\\Models\\ClearingHouse",
                "addressable_id": 2
            }
        ],
        "contacts": [
            {
                "id": 8,
                "phone": "34324234",
                "fax": "567674576457",
                "email": "clearing2@cclearing.com",
                "billing_company_id": 1,
                "created_at": "2022-03-16T11:02:28.000000Z",
                "updated_at": "2022-03-16T11:02:28.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\ClearingHouse",
                "contactable_id": 2
            }
        ],
        "nicknames": [
            {
                "id": 1,
                "nickname": "alias clearingName second",
                "nicknamable_type": "App\\Models\\ClearingHouse",
                "nicknamable_id": 6,
                "billing_company_id": 1,
                "created_at": "2022-04-04T12:55:15.000000Z",
                "updated_at": "2022-04-04T12:55:15.000000Z"
            }
        ],
        "billing_companies": [
            {
                "id": 1,
                "name": "Hammes and Sons",
                "created_at": "2022-03-16T10:02:29.000000Z",
                "updated_at": "2022-03-16T10:02:29.000000Z",
                "code": "BC-00001-2022",
                "status": false,
                "pivot": {
                    "clearing_house_id": 2,
                    "billing_company_id": 1,
                    "status": true,
                    "created_at": "2022-03-16T11:02:28.000000Z",
                    "updated_at": "2022-03-16T11:02:28.000000Z"
                }
            }
        ]
    },
    {
        "id": 1,
        "code": "CH-00001-2022",
        "name": "clearing first",
        "created_at": "2022-03-16T11:00:09.000000Z",
        "updated_at": "2022-03-16T11:00:09.000000Z",
        "org_type": "222CH123",
        "ack_required": true,
        "status": true,
        "addresses": [
            {
                "id": 6,
                "address": "address Clearing",
                "city": "city Clearing",
                "state": "state Clearing",
                "zip": "234",
                "billing_company_id": 1,
                "created_at": "2022-03-16T11:00:09.000000Z",
                "updated_at": "2022-03-16T11:00:09.000000Z",
                "addressable_type": "App\\Models\\ClearingHouse",
                "addressable_id": 1
            }
        ],
        "contacts": [
            {
                "id": 7,
                "phone": "34324234",
                "fax": "567674576457",
                "email": "clearing@cclearing.com",
                "billing_company_id": 1,
                "created_at": "2022-03-16T11:00:09.000000Z",
                "updated_at": "2022-03-16T11:00:09.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\ClearingHouse",
                "contactable_id": 1
            }
        ],
        "nicknames": [
            {
                "id": 1,
                "nickname": "alias clearingName first",
                "nicknamable_type": "App\\Models\\ClearingHouse",
                "nicknamable_id": 6,
                "billing_company_id": 1,
                "created_at": "2022-04-04T12:55:15.000000Z",
                "updated_at": "2022-04-04T12:55:15.000000Z"
            }
        ],
        "billing_companies": [
            {
                "id": 1,
                "name": "Hammes and Sons",
                "created_at": "2022-03-16T10:02:29.000000Z",
                "updated_at": "2022-03-16T10:02:29.000000Z",
                "code": "BC-00001-2022",
                "status": false,
                "pivot": {
                    "clearing_house_id": 1,
                    "billing_company_id": 1,
                    "status": true,
                    "created_at": "2022-03-16T11:00:09.000000Z",
                    "updated_at": "2022-03-16T11:00:09.000000Z"
                }
            }
        ]
    }
]
```

#

<a name="get-all-clearing-house-server"></a>
## Get all clearing houses from server

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
            "code": "CH-00002-2022",
            "name": "clearing second",
            "created_at": "2022-03-16T11:02:28.000000Z",
            "updated_at": "2022-03-16T11:02:28.000000Z",
            "org_type": "222CH123",
            "ack_required": true,
            "status": true,
            "addresses": [
                {
                    "id": 7,
                    "address": "address Clearing 2",
                    "city": "city Clearing 2",
                    "state": "state Clearing 2",
                    "zip": "234",
                    "billing_company_id": 1,
                    "created_at": "2022-03-16T11:02:28.000000Z",
                    "updated_at": "2022-03-16T11:02:28.000000Z",
                    "addressable_type": "App\\Models\\ClearingHouse",
                    "addressable_id": 2
                }
            ],
            "contacts": [
                {
                    "id": 8,
                    "phone": "34324234",
                    "fax": "567674576457",
                    "email": "clearing2@cclearing.com",
                    "billing_company_id": 1,
                    "created_at": "2022-03-16T11:02:28.000000Z",
                    "updated_at": "2022-03-16T11:02:28.000000Z",
                    "mobile": null,
                    "contactable_type": "App\\Models\\ClearingHouse",
                    "contactable_id": 2
                }
            ],
            "nicknames": [
                {
                    "id": 1,
                    "nickname": "alias clearingName second",
                    "nicknamable_type": "App\\Models\\ClearingHouse",
                    "nicknamable_id": 6,
                    "billing_company_id": 1,
                    "created_at": "2022-04-04T12:55:15.000000Z",
                    "updated_at": "2022-04-04T12:55:15.000000Z"
                }
            ],
            "billing_companies": [
                {
                    "id": 1,
                    "name": "Hammes and Sons",
                    "created_at": "2022-03-16T10:02:29.000000Z",
                    "updated_at": "2022-03-16T10:02:29.000000Z",
                    "code": "BC-00001-2022",
                    "status": false,
                    "pivot": {
                        "clearing_house_id": 2,
                        "billing_company_id": 1,
                        "status": true,
                        "created_at": "2022-03-16T11:02:28.000000Z",
                        "updated_at": "2022-03-16T11:02:28.000000Z"
                    }
                }
            ]
        },
        {
            "id": 1,
            "code": "CH-00001-2022",
            "name": "clearing first",
            "created_at": "2022-03-16T11:00:09.000000Z",
            "updated_at": "2022-03-16T11:00:09.000000Z",
            "org_type": "222CH123",
            "ack_required": true,
            "status": true,
            "addresses": [
                {
                    "id": 6,
                    "address": "address Clearing",
                    "city": "city Clearing",
                    "state": "state Clearing",
                    "zip": "234",
                    "billing_company_id": 1,
                    "created_at": "2022-03-16T11:00:09.000000Z",
                    "updated_at": "2022-03-16T11:00:09.000000Z",
                    "addressable_type": "App\\Models\\ClearingHouse",
                    "addressable_id": 1
                }
            ],
            "contacts": [
                {
                    "id": 7,
                    "phone": "34324234",
                    "fax": "567674576457",
                    "email": "clearing@cclearing.com",
                    "billing_company_id": 1,
                    "created_at": "2022-03-16T11:00:09.000000Z",
                    "updated_at": "2022-03-16T11:00:09.000000Z",
                    "mobile": null,
                    "contactable_type": "App\\Models\\ClearingHouse",
                    "contactable_id": 1
                }
            ],
            "nicknames": [
                {
                    "id": 1,
                    "nickname": "alias clearingName first",
                    "nicknamable_type": "App\\Models\\ClearingHouse",
                    "nicknamable_id": 6,
                    "billing_company_id": 1,
                    "created_at": "2022-04-04T12:55:15.000000Z",
                    "updated_at": "2022-04-04T12:55:15.000000Z"
                }
            ],
            "billing_companies": [
                {
                    "id": 1,
                    "name": "Hammes and Sons",
                    "created_at": "2022-03-16T10:02:29.000000Z",
                    "updated_at": "2022-03-16T10:02:29.000000Z",
                    "code": "BC-00001-2022",
                    "status": false,
                    "pivot": {
                        "clearing_house_id": 1,
                        "billing_company_id": 1,
                        "status": true,
                        "created_at": "2022-03-16T11:00:09.000000Z",
                        "updated_at": "2022-03-16T11:00:09.000000Z"
                    }
                }
            ]
        }
    ],
    "count": 10
}
```

#



<a name="get-one-clearing-house"></a>
## Get One Clearing House


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Clearing house found

#

```json
{
    "id": 1,
    "code": "CH-00001-2022",
    "name": "clearing first",
    "created_at": "2022-03-16T11:00:09.000000Z",
    "updated_at": "2022-03-16T11:00:09.000000Z",
    "org_type": "222CH123",
    "ack_required": true,
    "status": true,
    "addresses": [
        {
            "id": 6,
            "address": "address Clearing",
            "city": "city Clearing",
            "state": "state Clearing",
            "zip": "234",
            "billing_company_id": 1,
            "created_at": "2022-03-16T11:00:09.000000Z",
            "updated_at": "2022-03-16T11:00:09.000000Z",
            "addressable_type": "App\\Models\\ClearingHouse",
            "addressable_id": 1
        }
    ],
    "contacts": [
        {
            "id": 7,
            "phone": "34324234",
            "fax": "567674576457",
            "email": "clearing@cclearing.com",
            "billing_company_id": 1,
            "created_at": "2022-03-16T11:00:09.000000Z",
            "updated_at": "2022-03-16T11:00:09.000000Z",
            "mobile": null,
            "contactable_type": "App\\Models\\ClearingHouse",
            "contactable_id": 1
        }
    ],
    "nicknames": [
        {
            "id": 1,
            "nickname": "alias clearingName first",
            "nicknamable_type": "App\\Models\\ClearingHouse",
            "nicknamable_id": 6,
            "billing_company_id": 1,
            "created_at": "2022-04-04T12:55:15.000000Z",
            "updated_at": "2022-04-04T12:55:15.000000Z"
        }
    ],
    "billing_companies": [
        {
            "id": 1,
            "name": "Hammes and Sons",
            "created_at": "2022-03-16T10:02:29.000000Z",
            "updated_at": "2022-03-16T10:02:29.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "pivot": {
                "clearing_house_id": 1,
                "billing_company_id": 1,
                "status": true,
                "created_at": "2022-03-16T11:00:09.000000Z",
                "updated_at": "2022-03-16T11:00:09.000000Z"
            }
        }
    ]
}
```


#

>{warning} 404 clearing found not found






# 

<a name="update-one-clearing-house"></a>
## Update One Clearing House

### Body request example

```json
{
    "name":"clearing first edited",
    "org_type":"222CH124",
    "ack_required":true,
    "nickname":"alias clearingName",
    "abbreviation":"ABBCLEARING",
    "transmission_format_id": 1,
    "billing_company_id": 1, /** Only required by superuser */
    "address": {
        "address":"address Clearing",
        "city":"city Clearing",
        "state":"state Clearing",
        "zip":234
    },
    "contact":{
        "phone":"34324234",
        "fax":"567674576457",
        "email":"clearing@cclearing.com"
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

> {success} 200 clearing house created


#

```json
{
    "code": "CH-00001-2022",
    "name": "clearing first edited",
    "org_type": "222CH124",
    "ack_required": true,
    "updated_at": "2022-03-16T11:00:09.000000Z",
    "created_at": "2022-03-16T11:00:09.000000Z",
    "id": 1,
    "status": true,
    "billing_companies": [
        {
            "id": 1,
            "name": "Hammes and Sons",
            "created_at": "2022-03-16T10:02:29.000000Z",
            "updated_at": "2022-03-16T10:02:29.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "pivot": {
                "clearing_house_id": 1,
                "billing_company_id": 1,
                "status": true,
                "created_at": "2022-03-16T11:00:09.000000Z",
                "updated_at": "2022-03-16T11:00:09.000000Z"
            }
        }
    ]
}
```


# 

<a name="get-one-clearing-house-by-name"></a>
## Get one Clearing House by name

### Param in Path

```json
{
    "name": someName <string>
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 clearing house created


#

```json
{
    "code": "CH-00001-2022",
    "name": "clearing first",
    "org_type": "222CH123",
    "ack_required": true,
    "updated_at": "2022-03-16T11:00:09.000000Z",
    "created_at": "2022-03-16T11:00:09.000000Z",
    "id": 1,
    "status": true,
}
```




# 

<a name="change-status-clearing-house"></a>
## Change status Clearing House

## Body request example

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

`clearing_house_id required integer`


## Response

> {success} 200 Good response

```json
{
    "code": "CH-00001-2022",
    "name": "clearing first",
    "org_type": "222CH123",
    "ack_required": true,
    "updated_at": "2022-03-16T11:00:09.000000Z",
    "created_at": "2022-03-16T11:00:09.000000Z",
    "id": 1,
    "status": true
}
```

#

>{warning} 404 error add clearing house to billing company

<a name="get-list-transmission-formats"></a>
## Get list transmission formats


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Transmission formats found

#

```json
[
    {
        "id": 190,
        "name": "JSON"
    },
    {
        "id": 191,
        "name": "ANSI X12"
    }
]
```

<a name="get-list-org-types"></a>
## Get list org types


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Transmission formats found

#

```json
[
    {
        "id": 1,
        "name": "Aetna"
    },
    {
        "id": 2,
        "name": "Automobile Insurance"
    },
    {
        "id": 3,
        "name": "Blue Cross an Blue Shield"
    },
    {
        "id": 4,
        "name": "Capitation"
    },
    {
        "id": 5,
        "name": "Cigna"
    },
    {
        "id": 6,
        "name": "Commercial Insurance"
    },
    {
        "id": 7,
        "name": "Medicaid"
    },
    {
        "id": 8,
        "name": "Medicare"
    },
    {
        "id": 9,
        "name": "United Health Care"
    },
    {
        "id": 10,
        "name": "Workers Compensation"
    }
]
```