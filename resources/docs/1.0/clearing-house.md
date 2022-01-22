# Clearing House Docs

---

- [User](#section-2)

<a name="section-2"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create clearing house`          | `/clearing-house/`               |yes             |Create Clearing House  |         
| 2 |GET | `Get all clearing house`| `/clearing-house/`        |yes            |Get all Clearing House|
| 3 |GET | `Get one Clearing house`          | `/clearing-house/{id}`|yes|Get one Clearing House|



>{primary} when url params have this symbol "?" mean not required, so you must to send null


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
        "ack": false,
        "org_type": 0,
        "created_at": "2022-01-22T19:44:24.000000Z",
        "updated_at": "2022-01-22T19:44:24.000000Z"
    },
    {
        "id": 2,
        "code": "someCode",
        "name": "someName",
        "ack": false,
        "org_type": 0,
        "created_at": "2022-01-22T19:46:01.000000Z",
        "updated_at": "2022-01-22T19:46:01.000000Z"
    },
    {
        "id": 3,
        "code": "someCode",
        "name": "someName",
        "ack": false,
        "org_type": 0,
        "created_at": "2022-01-22T19:46:40.000000Z",
        "updated_at": "2022-01-22T19:46:40.000000Z"
    },
    {
        "id": 4,
        "code": "someCode",
        "name": "someName",
        "ack": false,
        "org_type": 0,
        "created_at": "2022-01-22T19:47:10.000000Z",
        "updated_at": "2022-01-22T19:47:10.000000Z"
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
        "id": 1,
        "code": "someCode",
        "name": "someName",
        "ack": false,
        "org_type": 0,
        "created_at": "2022-01-22T19:44:24.000000Z",
        "updated_at": "2022-01-22T19:44:24.000000Z"
    }
```


#

>{warning} 404 clearing found not found
