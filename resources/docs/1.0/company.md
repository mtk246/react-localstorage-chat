# Company Docs

---

- [User](#section-2)

<a name="section-2"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create company`          | `/company/`               |yes             |Create company|         
| 2 |GET | `Get all company`| `/company/`        |yes            |Get all company|
| 3 |GET | `Get one company`          | `/company/{id}`|yes|Get one company|
| 4 |GET | `Get one company by name`          | `/company/get-by-name/{name}`|yes|Get company by name|
| 5 |GET | `Get one company by email`          | `/company/get-by-email/{email}`|yes|Get company by email|
| 6 |PUT | `Update company`          | `/company/{id}`|yes|update company|
| 7 |PUT | `Change status company`          | `/company/change-status/{id}`|yes|Change status company|



>{primary} when url params have this symbol "?" mean not required, so you must to send null


# 

#-Create Company

<a name="section-3"></a>
## Body request example


#

```json
{
    "company":{
        "code":"somecode",
        "name":"someName0101",
        "taxonomy":"45345345",
        "npi":"323efsd",
        "email": "some@email.com",
        "tax_id": 343
    },"address":{
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
    "code": "somecode",
    "name": "someName0101",
    "taxonomy": "45345345",
    "npi": "323efsd",
    "email": "some@email.com",
    "tax_id": 343,
    "updated_at": "2022-01-23T20:27:53.000000Z",
    "created_at": "2022-01-23T20:27:53.000000Z",
    "id": 2
}
```


# 

#-Get All Company


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
        "code": "somecode",
        "name": "someName",
        "status": false,
        "taxonomy": 45345345,
        "npi": "323efsd",
        "email": "some@email.com",
        "tax_id": 343,
        "created_at": "2022-01-23T20:27:45.000000Z",
        "updated_at": "2022-01-23T20:27:45.000000Z"
    },
    {
        "id": 2,
        "code": "somecode",
        "name": "someName0101",
        "status": false,
        "taxonomy": 45345345,
        "npi": "323efsd",
        "email": "some@email.com",
        "tax_id": 343,
        "created_at": "2022-01-23T20:27:53.000000Z",
        "updated_at": "2022-01-23T20:27:53.000000Z"
    }
]
```



#




#-Get One Company


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
    "code": "somecode",
    "name": "someName0101",
    "taxonomy": "45345345",
    "npi": "323efsd",
    "email": "some@email.com",
    "tax_id": 343,
    "updated_at": "2022-01-23T20:27:53.000000Z",
    "created_at": "2022-01-23T20:27:53.000000Z",
    "id": 2
}
```


#

>{warning} 404 clearing found not found
