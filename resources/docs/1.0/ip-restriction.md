# API Docs
---
- [Basic data](#basic-data)
- [Create ip restriction](#create-restriction)
- [Get all ip restriction](#get-all-restriction)
- [Get all ip restriction from server](#get-all-restriction-server)
- [Get one ip restriction](#get-one-restriction)
- [Update one ip restriction](#update-one-restriction)
- [Delete one ip restriction](#delete-one-restriction)

<a name="basic-data"></a>
## Basic data to make request


| # |METHOD| Name           | URL          | Token required | Description|
| : |       |   :-           |  :           |                | |
| 1 |POST   | `create ip restriction`      | `/setting/ip-restriction`      | yes | Create ip restriction |
| 2 |GET    | `Get all ip restriction`       | `/setting/ip-restriction`      | yes | Get all ip restriction|
| 3 |GET    | `Get all ip restriction from server`  | `/setting/ip-restriction/get-all-server`|yes|Get all ip restriction from server|
| 4 |GET    | `Get one ip restriction`        | `/setting/ip-restriction/{id}` | yes | Get one ip restriction|
| 5 |PUT    | `Update one ip restriction`     | `/setting/ip-restriction/{id}` | yes | Update one ip restriction|
| 6 |Delete | `Delete one ip restriction`     | `/setting/ip-restriction/{id}` | yes | Delete one ip restriction|

<a name="create-restriction"></a>
## Create IP Restriction

### Body request example

```json
{
    "ip_restriction_mults": [
        {
            "ip_beginning":"127.0.0.1",
            "ip_finish":"127.0.0.5",
            "rank":true
        },
        {
            "ip_beginning":"127.0.0.6",
            "ip_finish":"",
            "rank":false
        }
    ],
    "entity": "billing_company",
    "billing_company_id":1,
    "users":[],
    "roles":[]
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 ip restriction found

#
```json
{
    "entity": "billing_company",
    "billing_company_id": 1,
    "updated_at": "2022-05-05T11:01:44.000000Z",
    "created_at": "2022-05-05T11:01:44.000000Z",
    "id": 3
}
```


<a name="get-all-restriction"></a>
## Get All IP Restriction


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 IP Restriction found 

#

```json
[
    {
        "id": 2,
        "billing_company_id": 1,
        "created_at": "2022-05-05T10:55:42.000000Z",
        "updated_at": "2022-05-05T10:55:42.000000Z",
        "deleted_at": null,
        "entity": "user",
        "users": [
            {
                "id": 2,
                "email": "billingmanager@billing.com",
                "email_verified_at": null,
                "created_at": "2022-04-20T21:52:52.000000Z",
                "updated_at": "2022-05-04T01:39:37.000000Z",
                "token": null,
                "isLogged": false,
                "isBlocked": false,
                "usercode": "US-00002-2022",
                "userkey": null,
                "status": false,
                "last_login": "2022-05-04 01:19:16",
                "profile_id": 2,
                "billing_company_id": null,
                "pivot": {
                    "ip_restriction_id": 2,
                    "restrictable_id": 2,
                    "restrictable_type": "App\\Models\\User"
                }
            },
            {
                "id": 3,
                "email": "healthprofessional@billing.com",
                "email_verified_at": null,
                "created_at": "2022-04-20T21:52:52.000000Z",
                "updated_at": "2022-04-20T21:52:52.000000Z",
                "token": null,
                "isLogged": false,
                "isBlocked": false,
                "usercode": "US-00003-2022",
                "userkey": null,
                "status": false,
                "last_login": null,
                "profile_id": 3,
                "billing_company_id": null,
                "pivot": {
                    "ip_restriction_id": 2,
                    "restrictable_id": 3,
                    "restrictable_type": "App\\Models\\User"
                }
            }
        ],
        "roles": [],
        "billing_company": {
            "id": 1,
            "name": "Zulauf Group",
            "created_at": "2022-04-20T21:52:55.000000Z",
            "updated_at": "2022-04-20T21:52:55.000000Z",
            "code": "BC-00001-2022",
            "status": false
        },
        "ip_restriction_mults": [
            {
                "id": 2,
                "ip_beginning": "127.0.0.1",
                "ip_finish": "127.0.0.5",
                "rank": true,
                "ip_restriction_id": 2,
                "created_at": "2022-05-05T10:55:42.000000Z",
                "updated_at": "2022-05-05T10:55:42.000000Z"
            }
        ]
    },
    {
        "id": 1,
        "billing_company_id": 1,
        "created_at": "2022-05-05T10:55:04.000000Z",
        "updated_at": "2022-05-05T10:55:04.000000Z",
        "deleted_at": null,
        "entity": "role",
        "users": [],
        "roles": [
            {
                "id": 2,
                "name": "Billing Manager",
                "slug": "billingmanager",
                "description": "Allows you to administer and manage all the functions of the application associated with a billing company",
                "level": 2,
                "created_at": "2022-04-20T21:52:51.000000Z",
                "updated_at": "2022-04-20T21:52:51.000000Z",
                "pivot": {
                    "ip_restriction_id": 1,
                    "restrictable_id": 2,
                    "restrictable_type": "App\\Roles\\Models\\Role"
                }
            },
            {
                "id": 3,
                "name": "Biller",
                "slug": "biller",
                "description": "Allows access to system functions for biller management",
                "level": 3,
                "created_at": "2022-04-20T21:52:51.000000Z",
                "updated_at": "2022-04-20T21:52:51.000000Z",
                "pivot": {
                    "ip_restriction_id": 1,
                    "restrictable_id": 3,
                    "restrictable_type": "App\\Roles\\Models\\Role"
                }
            }
        ],
        "billing_company": {
            "id": 1,
            "name": "Zulauf Group",
            "created_at": "2022-04-20T21:52:55.000000Z",
            "updated_at": "2022-04-20T21:52:55.000000Z",
            "code": "BC-00001-2022",
            "status": false
        },
        "ip_restriction_mults": [
            {
                "id": 1,
                "ip_beginning": "127.0.0.1",
                "ip_finish": "127.0.0.5",
                "rank": true,
                "ip_restriction_id": 1,
                "created_at": "2022-05-05T10:55:04.000000Z",
                "updated_at": "2022-05-05T10:55:04.000000Z"
            }
        ]
    }
]
```

#

<a name="get-all-restriction-server"></a>
## Get all ip restriction from server

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
            "billing_company_id": 1,
            "created_at": "2022-05-05T10:55:42.000000Z",
            "updated_at": "2022-05-05T10:55:42.000000Z",
            "deleted_at": null,
            "entity": "user",
            "users": [
                {
                    "id": 2,
                    "email": "billingmanager@billing.com",
                    "email_verified_at": null,
                    "created_at": "2022-04-20T21:52:52.000000Z",
                    "updated_at": "2022-05-04T01:39:37.000000Z",
                    "token": null,
                    "isLogged": false,
                    "isBlocked": false,
                    "usercode": "US-00002-2022",
                    "userkey": null,
                    "status": false,
                    "last_login": "2022-05-04 01:19:16",
                    "profile_id": 2,
                    "billing_company_id": null,
                    "pivot": {
                        "ip_restriction_id": 2,
                        "restrictable_id": 2,
                        "restrictable_type": "App\\Models\\User"
                    }
                },
                {
                    "id": 3,
                    "email": "healthprofessional@billing.com",
                    "email_verified_at": null,
                    "created_at": "2022-04-20T21:52:52.000000Z",
                    "updated_at": "2022-04-20T21:52:52.000000Z",
                    "token": null,
                    "isLogged": false,
                    "isBlocked": false,
                    "usercode": "US-00003-2022",
                    "userkey": null,
                    "status": false,
                    "last_login": null,
                    "profile_id": 3,
                    "billing_company_id": null,
                    "pivot": {
                        "ip_restriction_id": 2,
                        "restrictable_id": 3,
                        "restrictable_type": "App\\Models\\User"
                    }
                }
            ],
            "roles": [],
            "billing_company": {
                "id": 1,
                "name": "Zulauf Group",
                "created_at": "2022-04-20T21:52:55.000000Z",
                "updated_at": "2022-04-20T21:52:55.000000Z",
                "code": "BC-00001-2022",
                "status": false
            },
            "ip_restriction_mults": [
                {
                    "id": 2,
                    "ip_beginning": "127.0.0.1",
                    "ip_finish": "127.0.0.5",
                    "rank": true,
                    "ip_restriction_id": 2,
                    "created_at": "2022-05-05T10:55:42.000000Z",
                    "updated_at": "2022-05-05T10:55:42.000000Z"
                }
            ]
        },
        {
            "id": 1,
            "billing_company_id": 1,
            "created_at": "2022-05-05T10:55:04.000000Z",
            "updated_at": "2022-05-05T10:55:04.000000Z",
            "deleted_at": null,
            "entity": "role",
            "users": [],
            "roles": [
                {
                    "id": 2,
                    "name": "Billing Manager",
                    "slug": "billingmanager",
                    "description": "Allows you to administer and manage all the functions of the application associated with a billing company",
                    "level": 2,
                    "created_at": "2022-04-20T21:52:51.000000Z",
                    "updated_at": "2022-04-20T21:52:51.000000Z",
                    "pivot": {
                        "ip_restriction_id": 1,
                        "restrictable_id": 2,
                        "restrictable_type": "App\\Roles\\Models\\Role"
                    }
                },
                {
                    "id": 3,
                    "name": "Biller",
                    "slug": "biller",
                    "description": "Allows access to system functions for biller management",
                    "level": 3,
                    "created_at": "2022-04-20T21:52:51.000000Z",
                    "updated_at": "2022-04-20T21:52:51.000000Z",
                    "pivot": {
                        "ip_restriction_id": 1,
                        "restrictable_id": 3,
                        "restrictable_type": "App\\Roles\\Models\\Role"
                    }
                }
            ],
            "billing_company": {
                "id": 1,
                "name": "Zulauf Group",
                "created_at": "2022-04-20T21:52:55.000000Z",
                "updated_at": "2022-04-20T21:52:55.000000Z",
                "code": "BC-00001-2022",
                "status": false
            },
            "ip_restriction_mults": [
                {
                    "id": 1,
                    "ip_beginning": "127.0.0.1",
                    "ip_finish": "127.0.0.5",
                    "rank": true,
                    "ip_restriction_id": 1,
                    "created_at": "2022-05-05T10:55:04.000000Z",
                    "updated_at": "2022-05-05T10:55:04.000000Z"
                }
            ]
        }
    ],
    "count": 10
}
```

#

<a name="get-one-restriction"></a>
## Get One IP Restriction


### Param in Path

```json
{
    "id": required <integer>
}
```

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 IP Restriction found 

#

```json
{
    "id": 3,
    "billing_company_id": 1,
    "created_at": "2022-05-05T11:01:44.000000Z",
    "updated_at": "2022-05-05T11:01:44.000000Z",
    "deleted_at": null,
    "entity": "billing_company",
    "users": [],
    "roles": [],
    "billing_company": {
        "id": 1,
        "name": "Zulauf Group",
        "created_at": "2022-04-20T21:52:55.000000Z",
        "updated_at": "2022-04-20T21:52:55.000000Z",
        "code": "BC-00001-2022",
        "status": false
    },
    "ip_restriction_mults": [
        {
            "id": 3,
            "ip_beginning": "127.0.0.1",
            "ip_finish": "127.0.0.5",
            "rank": true,
            "ip_restriction_id": 3,
            "created_at": "2022-05-05T11:01:44.000000Z",
            "updated_at": "2022-05-05T11:01:44.000000Z"
        },
        {
            "id": 4,
            "ip_beginning": "127.0.0.6",
            "ip_finish": null,
            "rank": false,
            "ip_restriction_id": 3,
            "created_at": "2022-05-05T11:01:44.000000Z",
            "updated_at": "2022-05-05T11:01:44.000000Z"
        }
    ]
}
```
<a name="update-one-restriction"></a>
## Update IP Restriction

### Body request example

```json
{
    "ip_restriction_mults": [
        {
            "ip_beginning":"127.0.0.1",
            "ip_finish":"127.0.0.5",
            "rank":true
        },
        {
            "ip_beginning":"127.0.0.6",
            "ip_finish":"",
            "rank":false
        }
    ],
    "entity": "user",
    "billing_company_id":1,
    "users":[3,4],
    "roles":[]
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 ip restriction found

#
```json
{
    "id": 3,
    "billing_company_id": 1,
    "created_at": "2022-05-05T11:01:44.000000Z",
    "updated_at": "2022-05-05T11:05:36.000000Z",
    "deleted_at": null,
    "entity": "user"
}
```

<a name="delete-one-restriction"></a>
## Delete One IP Restriction


### Param in Path

```json
{
    "id": required <integer>
}
```

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 204 no content.