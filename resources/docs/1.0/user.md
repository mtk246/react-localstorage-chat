# User Docs

---

- [Basic data](#basic-data)
- [Create users](#create-users)
- [Change status user](#change-status-user)
- [Edit users](#edit-users)
- [Get all users](#get-all-users)
- [Get one user](#get-one-user)
- [Send email to recovery password](#send-email-to-recovery-password)
- [Recovery user](#recovery-user)
- [Unlock user](#unlock-user)
- [Change password](#change-password)
- [Update image user](#update-image-user)
- [Update password](#update-password)
- [Search by ssn](#search-by-ssn)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `create users`          | `/user/`               |yes             |Create Users  |         
| 2 |PATCH | `change status user`| `/user/{user_id?}/change-status`        |yes            |change status users|
| 3 |PUT | `edit users`          | `/user/{user_id?}`|yes|Update data users|
| 4 |GET | `get all users`   | `/user/` |yes            |get all users|
| 5 |GET | `get one user`   | `/user/{user_id}` |yes            |get one user|
| 6 |POST | `send email to recovery password`   | `/user/send-email-rescue-pass` |no|send email to recovery password|
| 7 |POST | `recovery user`   | `/user/rescovery-user` |no|recovery user|
| 8 |POST | `unlock user`   | `/user/unlock-user` |no|unlock user by code OTP|
| 9 |POST | `change password`   | `/user/change-password/{token}` |no|change password user|
| 10 |POST | `update image user`   | `/user/img-profile` |yes|update image profile|
| 11|PATCH | `update password`   | `/user/update-password` |yes|update password|
| 12|GET | `search by ssn`   | `/user/{ssn}/get-by-ssn` |yes|Get by ssn|


>{primary} when url params have this symbol "?" mean not required, so you must to send null



<a name="create-users"></a>
## Create User

### Body request example

```json
{
    "username":"eedddfdfdf",
    "email":"eeeddd@test.com",
    "sex":"m",
    "firstName":"test",
    "lastName":"test",
    "middleName":"testing",
    "roles":["ACCOUNT_MANAGER"],
    "ssn":"345345",
    "dateOfBirth":"1990-11-11",
    "company-billing":1
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
    "username": "eedddfdfdf",
    "email": "eeeddd@test.com",
    "sex": "m",
    "firstName": "test",
    "lastName": "test",
    "middleName": "testing",
    "ssn": "345345",
    "dateOfBirth": "1990-11-11",
    "updated_at": "2022-01-25T13:49:58.000000Z",
    "created_at": "2022-01-25T13:49:58.000000Z",
    "id": 22,
    "token": "eyJpdiI6ImFNZmJNZjRyUnFaRzh5b2RuWlUwTEE9PSIsInZhbHVlIjoiK0NtSTRiS3JHWjFicU5ZZGhsZjNrR2xHMGU2M3RWNFVBdk9USzFlMDV3cz0iLCJtYWMiOiJkZTVhNmFkYTQzYzQyYTFhMjVmNTEzNzNmY2Q2ZDhkNjEwNmM0MmE4ZDQxMjcyMmU4YzVkMDgyZGVkMzhmNjJkIiwidGFnIjoiIn0=",
    "roles": [
        {
            "id": 6,
            "name": "ACCOUNT_MANAGER",
            "guard_name": "api",
            "created_at": "2021-12-23T18:08:35.000000Z",
            "updated_at": "2021-12-23T18:08:35.000000Z",
            "pivot": {
                "model_id": 22,
                "role_id": 6,
                "model_type": "App\\Models\\User"
            }
        }
    ]
}
```

>{warning} 400 to bad request , 422 missing data in the body , 500 some excepcion







<a name="change-status-user"></a>
## Change Status


### Param in header

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



<a name="edit-users"></a>
## Update User

## Param in header

```json
{
    "Authorization": bearer <token>
}
```


## Body request example

```json
{
    "id": 2,
    "username": "Cletus",
    "email": "billingmanager@billing.com",
    "sex": "M",
    "lastName": "Kyleigh",
    "firstName": "Garfield",
    "middleName": "Hank",
    "ssn": "23789183",
    "dateOfBirth": "1995-04-28",
    "company-billing": 1,
    "roles": ["BILLING_MANAGER"],
    "address": {
        "address":"mexico guadalar",
        "city":"ciudad de mexico",
        "state":"dsfsdf",
        "zip":"234"
    },
    "contact": {
        "phone":"111-111-1111",
        "fax":"+9999999"
    }
}
```

>{success} 200 user update successfully 

```json
{
    "id": 2,
    "username": "Cletus",
    "email": "billingmanager@billing.com",
    "email_verified_at": null,
    "created_at": "2022-03-03T10:34:43.000000Z",
    "updated_at": "2022-03-08T20:31:04.000000Z",
    "sex": "M",
    "lastName": "Kyleigh",
    "firstName": "Garfield",
    "middleName": "Hank",
    "token": null,
    "available": false,
    "isLogged": false,
    "img_profile": null,
    "ssn": "23789183",
    "dateOfBirth": "1995-04-28",
    "isBlocked": false,
    "usercode": null,
    "billing_company_id": null,
    "roles": [
        {
            "id": 2,
            "name": "BILLING_MANAGER",
            "guard_name": "api",
            "created_at": "2022-03-03T10:34:42.000000Z",
            "updated_at": "2022-03-03T10:34:42.000000Z",
            "pivot": {
                "model_id": 2,
                "role_id": 2,
                "model_type": "App\\Models\\User"
            }
        }
    ],
    "contact": [
        {
            "id": 51,
            "phone": "111-111-1111",
            "fax": "+9999999",
            "email": "billingmanager@billing.com",
            "user_id": 2,
            "billing_company_id": null,
            "created_at": "2022-03-08T20:23:33.000000Z",
            "updated_at": "2022-03-08T20:31:04.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": null,
            "insurance_company_id": null
        }
    ],
    "address": [
        {
            "id": 51,
            "address": "mexico guadalar",
            "city": "ciudad de mexico",
            "state": "dsfsdf",
            "zip": "234",
            "user_id": 2,
            "billing_company_id": null,
            "created_at": "2022-03-08T20:23:33.000000Z",
            "updated_at": "2022-03-08T20:30:25.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": null,
            "insurance_company_id": null
        }
    ]
}
```

#

>{warning} 404 user not found, 422 something is missing in the body, 500 some excepcion






<a name="get-all-users"></a>
## Get all users

### Param in header

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
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": null,
        "available": true
    }
]
```






<a name="get-one-user"></a>
## Get one user

### Param in header

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





<a name="send-email-to-recovery-password"></a>
## Send email to recovery password


### Body request example

```json
{
    "email":"admin@admin.com"
}
```

>{success} 204 response empty, email sent

#

>{warning} 404 user not found, 500 some exception

<a name="recovery-user"></a>
## Recovery user


### Body request example

```json
{
    "ssn": "5345",
    "dateOfBirth": "1990-11-11",
}
```

>{success} 200 response

```json
{
    "email":"admin@admin.com"
}
```

#

>{warning} 404 user not found, 500 some exception

<a name="unlock-user"></a>
## Unlock user


### Body request example

```json
{
    "email": "admin@billing.com",
    "usercode": "622635b68acb54.47488178",
}
```

>{success} 200 response

```json
{
    "user": {
        "id": 1,
        "username": "admin",
        "usercode": "eyJpdiI6IllUQ1pLYld4azErYmgxdEZvM05Bamc9PSIsInZhbHVlIjoiUlhLYnhLeXpaTFBtOU9lOXB3djVVdVRvTEVIMXY1bmlHRWlrMHhSTUNncz0iLCJtYWMiOiI2ZThkOTQxYWNiMjM3MjkwMjMwZGRmMWY1MDk0MWEzNTViOTUzYTY3Njc2NmJjODIwZGRiYWUzMDlhYTk5MzkyIiwidGFnIjoiIn0=",
        "email": "admin@billing.com",
        "email_verified_at": null,
        "created_at": "2021-12-23T18:08:35.000000Z",
        "updated_at": "2022-01-03T21:42:56.000000Z",
        "DOB": "2021-12-26",
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": null,
        "available": true,
        "permissions": [
            {
                "id": 1,
                "name": "edit articles",
                "guard_name": "api",
                "created_at": "2022-01-04T01:45:08.000000Z",
                "updated_at": "2022-01-04T01:45:08.000000Z",
                "pivot": {
                    "model_id": 1,
                    "permission_id": 1,
                    "model_type": "App\\Models\\User"
                }
            }
        ],
        "roles": [
            {
                "id": 1,
                "name": "SUPER_USER",
                "guard_name": "api",
                "created_at": "2021-12-23T18:08:35.000000Z",
                "updated_at": "2021-12-23T18:08:35.000000Z",
                "pivot": {
                    "model_id": 1,
                    "role_id": 1,
                    "model_type": "App\\Models\\User"
                }
            }
        ]
    },
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvdjFcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNjQxMzk5NDU1LCJleHAiOjE2NDE0MDMwNTUsIm5iZiI6MTY0MTM5OTQ1NSwianRpIjoiMjJFTmh5U2hIOHhVNnE0NSIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.73g-sUA9Mm86Z5qRsZjtDd-1mEwajPjT5neccmxHaUg",
    "token_type": "bearer",
    "expires_in": 3600
}
```

#

>{warning} 404 Error wrong otp code



<a name="change-password"></a>
##Change Password

### Param in path
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

<a name="update-image-user"></a>
## Change image user
### Body request example

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


#


<a name="search-by-ssn"></a>
## Search By Ssn

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`ssn required string`

>{success} 200 request made successfully

#

>{warning} response 404 when user not found
