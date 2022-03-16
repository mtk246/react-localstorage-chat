# Clearing House Docs

---

- [Basic data](#basic-data)
- [Create clearing house](#create-clearing-house)
- [Get all clearing house](#get-all-clearing-house)
- [Get one clearing house](#get-one-clearing-house)
- [Update one clearing house](#update-one-clearing-house)
- [Get one Clearing house by name](#get-one-clearing-house-by-name)
- [Change status Clearing house](#change-status-clearing-house)
- [Add to billing company](#add-to-billing-company)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create clearing house`                    | `/clearing-house/`               |yes             |Create Clearing House  |         
| 2 |GET | `Get all clearing house`                   | `/clearing-house/`        |yes            |Get all Clearing House|
| 3 |GET | `Get one Clearing house`                   | `/clearing-house/{id}`|yes|Get one Clearing House|
| 4 |PUT | `Update one Clearing house`                | `/clearing-house/{id}`|yes|Update one Clearing House|
| 5 |GET | `Get one Clearing house by name`           | `/clearing-house/get-by-name/{name}`|yes|Get one Clearing House by name|
| 6 |PATCH | `Change status Clearing house`           | `/clearing-house/{id}`|yes|Get one Clearing House|
| 7 |PATCH | `Add to billing company`                 | `/clearing-house/add-to-billing-company/{id}`|yes|Add clearing house to billing company|



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
## Get One Clearing House by name

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