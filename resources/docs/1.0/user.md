# User Docs

---

- [User](#section-2)

<a name="section-2"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `create users`          | `/user/`               |yes             |Create Users  |         
| 2 |PATCH | `change status user`| `/user/{user_id?}/change-status`        |yes            |change status users|
| 3 |PUT | `edit users`          | `/user/{user_id?}`|yes|Update data users|
| 4 |GET | `get all users`   | `/user/` |yes            |get all users|
| 5 |GET | `get one user`   | `/user/{user_id}` |yes            |get one user|
| 6 |POST | `send email to recovery password`   | `/user/send-email-rescue-pass` |no|send email to recovery password|
| 7 |POST | `change password`   | `/user/change-password/{token}` |no|change password user|
| 8 |PATCH | `update image user`   | `/user/img-profile` |yes|update image profile|


>{primary} when url params have this symbol "?" mean not required, so you must to send null




#-Create User

<a name="section-3"></a>
## Body request example

```json
{
    "username":"tesfvrtrdt",
    "email":"ghgfvbgfr@test.com",
    "DOB":"2021-12-26",
    "sex":"m",
    "firstName":"test",
    "lastName":"test",
    "middleName":"testing",
    "roles":["ACCOUNT_MANAGER"],
    "company-billing":{
        "name":"someNameCompanyBilling",
        "code":"Somecode"
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





```json
{
    "username": "test",
    "email": "testffddf@test.com",
    "DOB": "2021-12-26",
    "sex": "m",
    "firstName": "test",
    "lastName": "test",
    "middleName": "testing",
    "updated_at": "2022-01-05T17:55:17.000000Z",
    "created_at": "2022-01-05T17:55:17.000000Z",
    "id": 12,
    "roles": [
        {
            "id": 6,
            "name": "ACCOUNT_MANAGER",
            "guard_name": "api",
            "created_at": "2021-12-23T18:08:35.000000Z",
            "updated_at": "2021-12-23T18:08:35.000000Z",
            "pivot": {
                "model_id": 12,
                "role_id": 6,
                "model_type": "App\\Models\\User"
            }
        }
    ]
}
```

>{warning} 400 to bad request , 422 missing data in the body , 500 some excepcion







#-Change Status


## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Body request example

```json
{
    "available":true
}
```

>{success} 204 empty content



#-Update User

## Param in header

```json
{
    "Authorization": bearer <token>
}
```


## Body request example

```json
{
    "username":"hola",
    "email":"admin@admin.com",
    "DOB":"2021-12-26",
    "sex":"m",
    "firstName":"test",
    "lastName":"test",
    "middleName":"testing"
}
```

>{success} 200 user update successfully 

#

>{warning} 404 user not found, 422 something is missing in the body, 500 some excepcion







#-Get all users

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

>{success} 200 request made successfully

#

>{primary} response 200 too when is empty


```json
[
    {
        "id": 2,
        "username": "usertes",
        "email": "usertest@test.com",
        "email_verified_at": null,
        "created_at": "2021-12-27T07:02:27.000000Z",
        "updated_at": "2021-12-27T07:02:27.000000Z",
        "DOB": "2021-12-26",
        "sex": "m",
        "lastName": "testest",
        "firstName": "usertest",
        "middleName": "testing",
        "token": null,
        "available": false
    },
    {
        "id": 4,
        "username": "test",
        "email": "test1@test.com",
        "email_verified_at": null,
        "created_at": "2021-12-27T07:07:58.000000Z",
        "updated_at": "2021-12-27T07:07:58.000000Z",
        "DOB": "2021-12-26",
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": null,
        "available": false
    },
    {
        "id": 5,
        "username": "test",
        "email": "test2@test.com",
        "email_verified_at": null,
        "created_at": "2021-12-27T07:14:29.000000Z",
        "updated_at": "2021-12-27T07:14:29.000000Z",
        "DOB": "2021-12-26",
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": null,
        "available": false
    },
    {
        "id": 6,
        "username": "test",
        "email": "test2ee@test.com",
        "email_verified_at": null,
        "created_at": "2021-12-27T07:52:28.000000Z",
        "updated_at": "2021-12-27T07:52:28.000000Z",
        "DOB": "2021-12-26",
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": null,
        "available": false
    },
    {
        "id": 7,
        "username": "test",
        "email": "test244ee@test.com",
        "email_verified_at": null,
        "created_at": "2021-12-27T08:01:07.000000Z",
        "updated_at": "2021-12-27T08:01:07.000000Z",
        "DOB": "2021-12-26",
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": null,
        "available": false
    },
    {
        "id": 8,
        "username": "test",
        "email": "test565@test.com",
        "email_verified_at": null,
        "created_at": "2021-12-27T08:19:42.000000Z",
        "updated_at": "2021-12-27T08:19:42.000000Z",
        "DOB": "2021-12-26",
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": null,
        "available": false
    },
    {
        "id": 10,
        "username": "test",
        "email": "testfff@test.com",
        "email_verified_at": null,
        "created_at": "2022-01-03T15:05:57.000000Z",
        "updated_at": "2022-01-03T15:05:57.000000Z",
        "DOB": "2021-12-26",
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": null,
        "available": false
    },
    {
        "id": 3,
        "username": "test",
        "email": "test@test.com",
        "email_verified_at": null,
        "created_at": "2021-12-27T07:03:51.000000Z",
        "updated_at": "2022-01-04T12:07:10.000000Z",
        "DOB": "2021-12-26",
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": "eyJpdiI6ImVQWTJtWHdPbGNhWVpuVVBHWjAyMEE9PSIsInZhbHVlIjoiRy93d1d1cGFmQWdLeGI1TURzaDJJa0tocHVJRU0xVE9oMTl6aXJRb2dRTT0iLCJtYWMiOiIwZDU0NWU4YWE3ODJkYmRiMmNiMWNmZWNjYTUxZDlmNzAzNDAxMmQ0NzMyYTgyYzA5M2FlMTc5NjM4NjU0ZDkzIiwidGFnIjoiIn0=",
        "available": false
    },
    {
        "id": 12,
        "username": "test",
        "email": "testffddf@test.com",
        "email_verified_at": null,
        "created_at": "2022-01-05T17:55:17.000000Z",
        "updated_at": "2022-01-05T17:55:17.000000Z",
        "DOB": "2021-12-26",
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": null,
        "available": false
    },
    {
        "id": 1,
        "username": "hola",
        "email": "admin@billing.com",
        "email_verified_at": null,
        "created_at": "2021-12-23T18:08:35.000000Z",
        "updated_at": "2022-01-05T18:02:27.000000Z",
        "DOB": "2021-12-26",
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": null,
        "available": true
    }
]
```






#-Get one user

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`user_id required integer`

>{success} 200 request made successfully

#

>{warning} response 404 when is empty






#-Send email to recovery password


## Body request example

```json
{
    "email":"admin@admin.com"
}
```

>{success} 204 response empty, email sent

#

>{warning} 404 user not found, 500 some exception





#-Change Password
## Param in path
`token string`
## Body request example

```json
{
    "password":"some password"
}
```

>{success} 204 response empty, password changed

#

>{warning} 404 user not found, 500 some exception


#

#-Change image user
## Body request example

```json
{
    "img":"file"
}
```

>{success} 200 Response 
> ```json
{
    "path":"somepath"
}
```


#


>{warning} 404 user not found, 500 some exception
