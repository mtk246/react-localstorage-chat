# API Docs
---
- [Basic data](#basic-data)
- [Create ip restriction](#create-restriction)
- [Get all ip restriction](#get-all-restriction)
- [Get one ip restriction](#get-one-restriction)
- [Update one ip restriction](#update-one-restriction)
- [Delete one ip restriction](#delete-one-restriction)

<a name="basic-data"></a>
## Basic data to make request


| # |METHOD| Name           | URL          | Token required | Description|
| : |       |   :-           |  :           |                | |
| 1 |POST   | `create ip restriction`      | `/setting/ip-restriction`      | yes | Create ip restriction |
| 2 |GET    | `Get all ip restrictions`       | `/setting/ip-restriction`      | yes | Get all ip restriction|
| 3 |GET    | `Get one ip restriction`        | `/setting/ip-restriction/{id}` | yes | Get one ip restriction|
| 4 |PUT    | `Update one ip restriction`     | `/setting/ip-restriction/{id}` | yes | Update one ip restriction|
| 5 |Delete | `Delete one ip restriction`     | `/setting/ip-restriction/{id}` | yes | Delete one ip restriction|

<a name="create-restriction"></a>
## Create IP Restriction

### Body request example

```json
{
    "ip_beginning":"127.0.0.1",
    "ip_finish":null,
    "rank":false,
    "billing_company_id":null,
    "users":[2,3]
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
    "ip_beginning": "127.0.0.1",
    "ip_finish": null,
    "rank": false,
    "billing_company_id": null,
    "updated_at": "2022-04-06T11:45:44.000000Z",
    "created_at": "2022-04-06T11:45:44.000000Z",
    "id": 1
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
        "id": 1,
        "ip_beginning": "127.0.0.1",
        "ip_finish": null,
        "rank": false,
        "billing_company_id": null,
        "created_at": "2022-04-06T11:45:44.000000Z",
        "updated_at": "2022-04-06T11:45:44.000000Z",
        "deleted_at": null
    },
    {
        "id": 2,
        "ip_beginning": "192.168.0.110",
        "ip_finish": null,
        "rank": false,
        "billing_company_id": null,
        "created_at": "2022-04-06T11:55:34.000000Z",
        "updated_at": "2022-04-06T11:55:34.000000Z",
        "deleted_at": null
    }
]
```

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
    "id": 1,
    "ip_beginning": "127.0.0.1",
    "ip_finish": null,
    "rank": false,
    "billing_company_id": null,
    "created_at": "2022-04-06T11:45:44.000000Z",
    "updated_at": "2022-04-06T11:45:44.000000Z",
    "deleted_at": null,
    "users": [
        {
            "id": 2,
            "email": "billingmanager@billing.com",
            "email_verified_at": null,
            "created_at": "2022-04-05T12:13:26.000000Z",
            "updated_at": "2022-04-06T08:55:41.000000Z",
            "token": null,
            "isLogged": true,
            "isBlocked": false,
            "usercode": "US-00002-2022",
            "userkey": null,
            "status": false,
            "last_login": "2022-04-06 08:55:41",
            "profile_id": 2,
            "billing_company_id": null,
            "pivot": {
                "ip_restriction_id": 1,
                "restrictable_id": 2,
                "restrictable_type": "App\\Models\\User"
            }
        },
        {
            "id": 3,
            "email": "doctor@billing.com",
            "email_verified_at": null,
            "created_at": "2022-04-05T12:13:26.000000Z",
            "updated_at": "2022-04-05T12:13:26.000000Z",
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
                "ip_restriction_id": 1,
                "restrictable_id": 3,
                "restrictable_type": "App\\Models\\User"
            }
        }
    ]
}
```
<a name="update-one-restriction"></a>
## Update IP Restriction

### Body request example

```json
{
    "ip_beginning":"127.0.0.2",
    "ip_finish":null,
    "rank":false,
    "billing_company_id":null,
    "users":[3,4]
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
    "ip_beginning": "127.0.0.2",
    "ip_finish": null,
    "rank": false,
    "billing_company_id": null,
    "updated_at": "2022-04-06T11:45:44.000000Z",
    "created_at": "2022-04-06T11:45:44.000000Z",
    "id": 1
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