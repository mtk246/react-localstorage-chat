# Clearing House Docs

---

- [User](#section-2)

<a name="section-2"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create clearing house`                    | `/clearing-house/`               |yes             |Create Clearing House  |         
| 2 |GET | `Get all clearing house`                   | `/clearing-house/`        |yes            |Get all Clearing House|
| 3 |GET | `Get one Clearing house`                   | `/clearing-house/{id}`|yes|Get one Clearing House|
| 4 |PUT | `Update one Clearing house`                | `/clearing-house/{id}`|yes|Update one Clearing House|
| 5 |GET | `Get one Clearing house by name`           | `/clearing-house/get-by-name/{name}`|yes|Get one Clearing House by name|
| 6 |PATCH | `Change status Clearing house`           | `/clearing-house/{id}`|yes|Get one Clearing House|



>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean


# 

#-Create Clearing House

<a name="section-3"></a>
## Body request example

```json
{
    "code":"someCode",
    "name":"someName",
    "address":{
        "address":"dfsdf",
        "city":"sdfsdf",
        "state":"dsfsdf",
        "zip":"234"
    },
    "contact":{
        "phone":"34324234",
        "fax":"567674576457",
        "email":"fg@gh.com"
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
    "code": "someCode",
    "name": "someName",
    "updated_at": "2022-01-22T19:47:10.000000Z",
    "created_at": "2022-01-22T19:47:10.000000Z",
    "id": 4
}
```


# 

#-Get All Clearing House


## Param in header

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
        "id": 1,
        "code": "someCode",
        "name": "someName",
        "created_at": "2022-01-22T19:44:24.000000Z",
        "updated_at": "2022-01-22T19:44:24.000000Z",
        "status": 0,
        "address": {
            "id": 2,
            "address": "dfsdf",
            "city": "sdfsdf",
            "state": "dsfsdf",
            "zip": "234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-01-22T19:44:24.000000Z",
            "updated_at": "2022-01-22T19:44:24.000000Z",
            "clearing_house_id": 1,
            "facility_id": null,
            "company_id": null
        },
        "contact": null
    },
    {
        "id": 2,
        "code": "someCode",
        "name": "someName",
        "created_at": "2022-01-22T19:46:01.000000Z",
        "updated_at": "2022-01-22T19:46:01.000000Z",
        "status": 0,
        "address": null,
        "contact": null
    },
    {
        "id": 3,
        "code": "someCode",
        "name": "someName",
        "created_at": "2022-01-22T19:46:40.000000Z",
        "updated_at": "2022-01-22T19:46:40.000000Z",
        "status": 0,
        "address": null,
        "contact": null
    },
    {
        "id": 4,
        "code": "someCode",
        "name": "someName",
        "created_at": "2022-01-22T19:47:10.000000Z",
        "updated_at": "2022-01-22T19:47:10.000000Z",
        "status": 0,
        "address": {
            "id": 4,
            "address": "dfsdf",
            "city": "sdfsdf",
            "state": "dsfsdf",
            "zip": "234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-01-22T19:47:10.000000Z",
            "updated_at": "2022-01-22T19:47:10.000000Z",
            "clearing_house_id": 4,
            "facility_id": null,
            "company_id": null
        },
        "contact": null
    },
    {
        "id": 5,
        "code": "someCodeere",
        "name": "someNameere",
        "created_at": "2022-02-02T17:49:35.000000Z",
        "updated_at": "2022-02-02T17:49:35.000000Z",
        "status": 0,
        "address": {
            "id": 12,
            "address": "dfsdf",
            "city": "sdfsdf",
            "state": "dsfsdf",
            "zip": "234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-02T17:49:35.000000Z",
            "updated_at": "2022-02-02T17:49:35.000000Z",
            "clearing_house_id": 5,
            "facility_id": null,
            "company_id": null
        },
        "contact": null
    },
    {
        "id": 6,
        "code": "someCodeereee",
        "name": "someNameereee",
        "created_at": "2022-02-02T17:51:14.000000Z",
        "updated_at": "2022-02-02T17:51:14.000000Z",
        "status": 0,
        "address": {
            "id": 13,
            "address": "dfsdf",
            "city": "sdfsdf",
            "state": "dsfsdf",
            "zip": "234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-02T17:51:14.000000Z",
            "updated_at": "2022-02-02T17:51:14.000000Z",
            "clearing_house_id": 6,
            "facility_id": null,
            "company_id": null
        },
        "contact": null
    },
    {
        "id": 7,
        "code": "someCodeereee",
        "name": "someNameereee",
        "created_at": "2022-02-02T17:52:11.000000Z",
        "updated_at": "2022-02-02T17:52:11.000000Z",
        "status": 0,
        "address": null,
        "contact": null
    },
    {
        "id": 8,
        "code": "someCodeereee44",
        "name": "someNameereee44",
        "created_at": "2022-02-02T17:53:44.000000Z",
        "updated_at": "2022-02-02T17:53:44.000000Z",
        "status": 0,
        "address": {
            "id": 14,
            "address": "dfsdf",
            "city": "sdfsdf",
            "state": "dsfsdf",
            "zip": "234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-02T17:53:44.000000Z",
            "updated_at": "2022-02-02T17:53:44.000000Z",
            "clearing_house_id": 8,
            "facility_id": null,
            "company_id": null
        },
        "contact": null
    },
    {
        "id": 9,
        "code": "someCodeereee44g",
        "name": "someNameereee44g",
        "created_at": "2022-02-02T17:56:41.000000Z",
        "updated_at": "2022-02-02T17:56:41.000000Z",
        "status": 0,
        "address": {
            "id": 15,
            "address": "dfsdf",
            "city": "sdfsdf",
            "state": "dsfsdf",
            "zip": "234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-02T17:56:41.000000Z",
            "updated_at": "2022-02-02T17:56:41.000000Z",
            "clearing_house_id": 9,
            "facility_id": null,
            "company_id": null
        },
        "contact": {
            "id": 13,
            "phone": "34324234",
            "fax": "567674576457",
            "email": "fg@gh.com",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-02T17:56:41.000000Z",
            "updated_at": "2022-02-02T17:56:41.000000Z",
            "clearing_house_id": 9,
            "facility_id": null,
            "company_id": null
        }
    }
]
```



#




#-Get One Clearing House


## Param in header

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
    "id": 9,
    "code": "someCodeereee44g",
    "name": "someNameereee44g",
    "created_at": "2022-02-02T17:56:41.000000Z",
    "updated_at": "2022-02-02T17:56:41.000000Z",
    "status": 0,
    "address": {
        "id": 15,
        "address": "dfsdf",
        "city": "sdfsdf",
        "state": "dsfsdf",
        "zip": "234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-02T17:56:41.000000Z",
        "updated_at": "2022-02-02T17:56:41.000000Z",
        "clearing_house_id": 9,
        "facility_id": null,
        "company_id": null
    },
    "contact": {
        "id": 13,
        "phone": "34324234",
        "fax": "567674576457",
        "email": "fg@gh.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-02T17:56:41.000000Z",
        "updated_at": "2022-02-02T17:56:41.000000Z",
        "clearing_house_id": 9,
        "facility_id": null,
        "company_id": null
    }
}
```


#

>{warning} 404 clearing found not found






# 

#-Update Clearing House

<a name="section-3"></a>
## Body request example

```json
{
    "clearing-house":{
        "code":"someCode",
        "name": "someName"
    },
    "address":{
        "address":"dfsdf",
        "city":"sdfsdf",
        "state":"dsfsdf",
        "zip":"234"
    },
    "contact":{
        "phone":"34324234",
        "fax":"567674576457",
        "email":"fg@gh.com"
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
    "id": 9,
    "code": "someCodeereee44g",
    "name": "someNameereee44g",
    "created_at": "2022-02-02T17:56:41.000000Z",
    "updated_at": "2022-02-02T17:56:41.000000Z",
    "status": 0,
    "address": {
        "id": 15,
        "address": "dfsdf",
        "city": "sdfsdf",
        "state": "dsfsdf",
        "zip": "234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-02T17:56:41.000000Z",
        "updated_at": "2022-02-02T17:56:41.000000Z",
        "clearing_house_id": 9,
        "facility_id": null,
        "company_id": null
    },
    "contact": {
        "id": 13,
        "phone": "34324234",
        "fax": "567674576457",
        "email": "fg@gh.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-02T17:56:41.000000Z",
        "updated_at": "2022-02-02T17:56:41.000000Z",
        "clearing_house_id": 9,
        "facility_id": null,
        "company_id": null
    }
}
```


# 

#-Get One Clearing House by name

<a name="section-3"></a>
## Param in Path

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
    "id": 9,
    "code": "someCodeereee44g",
    "name": "someNameereee44g",
    "created_at": "2022-02-02T17:56:41.000000Z",
    "updated_at": "2022-02-02T17:56:41.000000Z",
    "status": 0,
    "address": {
        "id": 15,
        "address": "dfsdf",
        "city": "sdfsdf",
        "state": "dsfsdf",
        "zip": "234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-02T17:56:41.000000Z",
        "updated_at": "2022-02-02T17:56:41.000000Z",
        "clearing_house_id": 9,
        "facility_id": null,
        "company_id": null
    },
    "contact": {
        "id": 13,
        "phone": "34324234",
        "fax": "567674576457",
        "email": "fg@gh.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-02T17:56:41.000000Z",
        "updated_at": "2022-02-02T17:56:41.000000Z",
        "clearing_house_id": 9,
        "facility_id": null,
        "company_id": null
    }
}
```




# 

#-Change status Clearing House

<a name="section-3"></a>
## Body request example

```json
{
    "status":"boolean"
}
```


## Response

> {success} 204 Good response


#
