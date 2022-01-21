# Company Billing Docs

---

- [Company Billing](#section-2)

<a name="section-2"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Billing Company`          | `/billing-company/create`               |yes             |Create Companies  |         
| 2 |GET | `Get company by user`| `/billing-company/user/{user_id}`        |yes            |Get Companies By Users|
| 3 |GET | `Get all Companies`          | `/billing-company`|yes|Get All Companies|
| 4 |GET | `Get Company by code`          | `/billing-company/get-by-code/{code}`|yes|Get Company by code|
| 5 |GET | `Get Company by name`          | `/billing-company/get-by-name/{name}`|yes|Get Company by name|


>{primary} when url params have this symbol "?" mean not required, so you must to send null


#-Create Company

<a name="section-3"></a>
## Body request example

```json
{
    "name":"fdgf",
    "code":"someCode",
    "address":{
        "address":"dfsdf",
        "city":"cdfsf",
        "state":"sdsfsd",
        "zip":"3234"
    },
    "contact":{
        "phone":"55433",
        "fax":"fsdfs",
        "email":"dsfsd@.com"
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

> {success} 201 user created

#
```json
{
    "id": 13,
    "name": "test",
    "email": "testffddsdf@test.com",
    "email_verified_at": null,
    "created_at": "2022-01-13T19:05:45.000000Z",
    "updated_at": "2022-01-13T19:05:45.000000Z",
    "DOB": "2021-12-26",
    "sex": "m",
    "lastName": "test",
    "firstName": "test",
    "middleName": "testing",
    "token": null,
    "available": false,
    "billing_company_user": [
        {
            "id": 4,
            "name": "HolaMundo",
            "created_at": "2022-01-13T19:05:45.000000Z",
            "updated_at": "2022-01-13T19:05:45.000000Z",
            "pivot": {
                "user_id": 13,
                "billing_company_id": 4
            }
        }
    ]
}
```


>{warning} possible errors: 422 when is missing some data 


#-Get companies by User

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data retorned

#
```json
{
    "name": "GreatotherCompany",
    "updated_at": "2022-01-13T18:59:46.000000Z",
    "created_at": "2022-01-13T18:59:46.000000Z",
    "id": 3
}
```


>{warning} possible errors: 404 when user not found 


#

#-Get All Companies

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data returned

#
```json
[
    {
        "id": 1,
        "name": "someCompany",
        "created_at": "2022-01-13T18:59:15.000000Z",
        "updated_at": "2022-01-13T18:59:15.000000Z"
    },
    {
        "id": 2,
        "name": "otherCompany",
        "created_at": "2022-01-13T18:59:32.000000Z",
        "updated_at": "2022-01-13T18:59:32.000000Z"
    },
    {
        "id": 3,
        "name": "GreatotherCompany",
        "created_at": "2022-01-13T18:59:46.000000Z",
        "updated_at": "2022-01-13T18:59:46.000000Z"
    },
    {
        "id": 4,
        "name": "HolaMundo",
        "created_at": "2022-01-13T19:05:45.000000Z",
        "updated_at": "2022-01-13T19:05:45.000000Z"
    }
]
```


>{warning} possible errors: 404 when user not found 



#

#-Get Company by code

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "code": string
}
```

## Response

> {success} 200 data returned

#
```json

    {
        "id": 1,
        "name": "someCompany",
        "created_at": "2022-01-13T18:59:15.000000Z",
        "updated_at": "2022-01-13T18:59:15.000000Z"
    }

```


>{warning} possible errors: 404 when user not found 




#

#-Get Company by name

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "name": string
}
```

## Response

> {success} 200 data returned

#
```json

    {
        "id": 1,
        "name": "someCompany",
        "created_at": "2022-01-13T18:59:15.000000Z",
        "updated_at": "2022-01-13T18:59:15.000000Z"
    }

```


>{warning} possible errors: 404 when user not found 

