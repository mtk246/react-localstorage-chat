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
- [New token](#new-token)


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
| 7 |POST | `recovery user`   | `/user/recovery-user` |no|recovery user|
| 8 |POST | `unlock user`   | `/user/unlock-user` |no|unlock user by code OTP|
| 9 |POST | `change password`   | `/user/change-password/{token}` |no|change password user|
| 10 |POST | `update image user`   | `/user/img-profile` |yes|update image profile|
| 11|PATCH | `update password`   | `/user/update-password` |yes|update password|
| 12|GET | `search by ssn`   | `/user/{ssn}/get-by-ssn` |yes|Get by ssn|
| 13 |POST | `new token`   | `/user/new-token` |no|generate new token user|

>{primary} when url params have this symbol "?" mean not required, so you must to send null



<a name="create-users"></a>
## Create User

### Body request example

```json
{
    "profile": {
        "ssn":"237891836",
        "first_name":"Fisrt Name",
        "last_name":"Last Name",
        "middle_name":"Middle Name",
        "sex":"m",
        "date_of_birth":"1990-11-11",
        "social_medias": [
            {
                "name": "nameSocialMedia1",
                "link": "URLSocialMedia1"
            },
            {
                "name": "nameSocialMedia2",
                "link": "URLSocialMedia2"
            }
        ]
    },
    "email":"user@gmail.com",
    "company-billing": 1,
    "roles":[
        "BILLING_MANAGER"
    ],"address": {
        "address": "Direction address",
        "city": "city address",
        "state": "state address",
        "zip": "123456789"
    },"contact": {
        "phone": "",
        "fax": "",
        "mobile": "",
        "email": "user@gmail.com"
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
    "usercode": "US-00005-2022",
    "email": "user@gmail.com",
    "userkey": "eyJpdiI6IjlUdUVSYUhBdUpIYTNDZm43QUJQZVE9PSIsInZhbHVlIjoiclBTY010UjNteGY0NHhEMzNJeDhoalNFSldrZ2RQQVBYRUhaTXNCc3VSZz0iLCJtYWMiOiIwYTE0ZmJkNzVjODg0NzFmMDk3Y2VhODY5YzQ5MTA3NmY3ZjQ3NzQ4MTMxMzU0ODFmOWE4NzgzNjg2NDkzNTJmIiwidGFnIjoiIn0=",
    "profile_id": 5,
    "updated_at": "2022-03-15T09:06:25.000000Z",
    "created_at": "2022-03-15T09:06:25.000000Z",
    "id": 5,
    "token": "eyJpdiI6ImxBaC9wbURHOW0rZ2RuVENEOEljb3c9PSIsInZhbHVlIjoibWV3K211L1JJeUFhZElFTVR6aTVJTGlxTjZPQnRLbXF2dUZWTU14eDhTTT0iLCJtYWMiOiI4MDRjYjg3NzMxZjExMGU0NTE5MzdiYjAxNmYwZGQ4NTQ2YjQzYWRkMDJkYTYyMWY2ODZiNWFlNDI4YmMzNmZiIiwidGFnIjoiIn0=",
    "billing_company_id": null,
    "roles": [
        {
            "id": 2,
            "name": "BILLING_MANAGER",
            "guard_name": "api",
            "created_at": "2022-03-14T20:49:19.000000Z",
            "updated_at": "2022-03-14T20:49:19.000000Z",
            "pivot": {
                "model_id": 5,
                "role_id": 2,
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
    "status":true
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
    "profile": {
        "ssn":"237891836",
        "first_name":"Fisrt Name",
        "last_name":"Last Name",
        "middle_name":"Middle Name",
        "sex":"m",
        "date_of_birth":"1990-11-11",
        "social_medias": [
            {
                "name": "nameSocialMedia1",
                "link": "URLSocialMedia1"
            },
            {
                "name": "nameSocialMedia2",
                "link": "URLSocialMedia2"
            }
        ]
    },
    "email":"user@gmail.com",
    "company-billing": 1,
    "roles":[
        "BILLING_MANAGER"
    ],"address": {
        "address": "Direction address",
        "city": "city address",
        "state": "state address",
        "zip": "123456789"
    },"contact": {
        "phone": "",
        "fax": "",
        "mobile": "",
        "email": "user@gmail.com"
    }
}
```

>{success} 200 user update successfully 

```json
{
    "id": 5,
    "email": "user@gmail.com",
    "email_verified_at": null,
    "created_at": "2022-03-15T09:06:25.000000Z",
    "updated_at": "2022-03-15T09:06:25.000000Z",
    "token": "eyJpdiI6ImxBaC9wbURHOW0rZ2RuVENEOEljb3c9PSIsInZhbHVlIjoibWV3K211L1JJeUFhZElFTVR6aTVJTGlxTjZPQnRLbXF2dUZWTU14eDhTTT0iLCJtYWMiOiI4MDRjYjg3NzMxZjExMGU0NTE5MzdiYjAxNmYwZGQ4NTQ2YjQzYWRkMDJkYTYyMWY2ODZiNWFlNDI4YmMzNmZiIiwidGFnIjoiIn0=",
    "isLogged": false,
    "isBlocked": false,
    "usercode": "US-00005-2022",
    "userkey": "eyJpdiI6IjlUdUVSYUhBdUpIYTNDZm43QUJQZVE9PSIsInZhbHVlIjoiclBTY010UjNteGY0NHhEMzNJeDhoalNFSldrZ2RQQVBYRUhaTXNCc3VSZz0iLCJtYWMiOiIwYTE0ZmJkNzVjODg0NzFmMDk3Y2VhODY5YzQ5MTA3NmY3ZjQ3NzQ4MTMxMzU0ODFmOWE4NzgzNjg2NDkzNTJmIiwidGFnIjoiIn0=",
    "status": false,
    "last_login": null,
    "profile_id": 5,
    "billing_company_id": null,
    "profile": {
        "id": 5,
        "ssn": "237891836",
        "first_name": "Fisrt Name",
        "middle_name": "Middle Name",
        "last_name": "Last Name",
        "sex": "m",
        "date_of_birth": "1990-11-11",
        "avatar": null,
        "credit_score": false,
        "created_at": "2022-03-15T09:06:25.000000Z",
        "updated_at": "2022-03-15T09:06:25.000000Z"
    },
    "roles": [
        {
            "id": 2,
            "name": "BILLING_MANAGER",
            "guard_name": "api",
            "created_at": "2022-03-14T20:49:19.000000Z",
            "updated_at": "2022-03-14T20:49:19.000000Z",
            "pivot": {
                "model_id": 5,
                "role_id": 2,
                "model_type": "App\\Models\\User"
            }
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
        "id": 3,
        "email": "doctor@billing.com",
        "email_verified_at": null,
        "created_at": "2022-03-14T20:49:20.000000Z",
        "updated_at": "2022-03-14T20:49:20.000000Z",
        "token": null,
        "isLogged": false,
        "isBlocked": false,
        "usercode": "US-00003-2022",
        "userkey": null,
        "status": false,
        "last_login": null,
        "profile_id": 3,
        "billing_company_id": null,
        "profile": {
            "id": 3,
            "ssn": "587997674",
            "first_name": "Ned",
            "middle_name": "Dell",
            "last_name": "Isaiah",
            "sex": "M",
            "date_of_birth": "1990-04-01",
            "avatar": null,
            "credit_score": false,
            "created_at": "2022-03-14T20:49:20.000000Z",
            "updated_at": "2022-03-14T20:49:20.000000Z"
        },
        "roles": [
            {
                "id": 8,
                "name": "DOCTOR",
                "guard_name": "api",
                "created_at": "2022-03-14T20:49:19.000000Z",
                "updated_at": "2022-03-14T20:49:19.000000Z",
                "pivot": {
                    "model_id": 3,
                    "role_id": 8,
                    "model_type": "App\\Models\\User"
                }
            }
        ],
        "billing_companies": []
    },
    {
        "id": 4,
        "email": "patient@billing.com",
        "email_verified_at": null,
        "created_at": "2022-03-14T20:49:20.000000Z",
        "updated_at": "2022-03-14T20:49:20.000000Z",
        "token": null,
        "isLogged": false,
        "isBlocked": false,
        "usercode": "US-00004-2022",
        "userkey": null,
        "status": false,
        "last_login": null,
        "profile_id": 4,
        "billing_company_id": null,
        "profile": {
            "id": 4,
            "ssn": "128285957",
            "first_name": "Geovanny",
            "middle_name": "Janick",
            "last_name": "Jeramy",
            "sex": "M",
            "date_of_birth": "1990-04-01",
            "avatar": null,
            "credit_score": false,
            "created_at": "2022-03-14T20:49:20.000000Z",
            "updated_at": "2022-03-14T20:49:20.000000Z"
        },
        "roles": [
            {
                "id": 9,
                "name": "PATIENT",
                "guard_name": "api",
                "created_at": "2022-03-14T20:49:19.000000Z",
                "updated_at": "2022-03-14T20:49:19.000000Z",
                "pivot": {
                    "model_id": 4,
                    "role_id": 9,
                    "model_type": "App\\Models\\User"
                }
            }
        ],
        "billing_companies": []
    },
    {
        "id": 1,
        "email": "admin@billing.com",
        "email_verified_at": null,
        "created_at": "2022-03-14T20:49:19.000000Z",
        "updated_at": "2022-03-15T08:59:12.000000Z",
        "token": null,
        "isLogged": true,
        "isBlocked": false,
        "usercode": "US-00001-2022",
        "userkey": null,
        "status": false,
        "last_login": "2022-03-15 08:59:12",
        "profile_id": 1,
        "billing_company_id": null,
        "profile": {
            "id": 1,
            "ssn": "905620308",
            "first_name": "Cornelius",
            "middle_name": "Darius",
            "last_name": "Earl",
            "sex": "M",
            "date_of_birth": "1990-04-01",
            "avatar": null,
            "credit_score": false,
            "created_at": "2022-03-14T20:49:19.000000Z",
            "updated_at": "2022-03-14T20:49:19.000000Z"
        },
        "roles": [
            {
                "id": 1,
                "name": "SUPER_USER",
                "guard_name": "api",
                "created_at": "2022-03-14T20:49:19.000000Z",
                "updated_at": "2022-03-14T20:49:19.000000Z",
                "pivot": {
                    "model_id": 1,
                    "role_id": 1,
                    "model_type": "App\\Models\\User"
                }
            }
        ],
        "billing_companies": []
    },
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

## Response


>{success} 200 request made successfully

```json
{
    "id": 1,
    "email": "admin@billing.com",
    "email_verified_at": null,
    "created_at": "2022-03-14T20:49:19.000000Z",
    "updated_at": "2022-03-15T08:59:12.000000Z",
    "token": null,
    "isLogged": true,
    "isBlocked": false,
    "usercode": "US-00001-2022",
    "userkey": null,
    "status": false,
    "last_login": "2022-03-15 08:59:12",
    "profile_id": 1,
    "billing_company_id": null,
    "roles": [
        {
            "id": 1,
            "name": "SUPER_USER",
            "guard_name": "api",
            "created_at": "2022-03-14T20:49:19.000000Z",
            "updated_at": "2022-03-14T20:49:19.000000Z",
            "pivot": {
                "model_id": 1,
                "role_id": 1,
                "model_type": "App\\Models\\User"
            }
        }
    ],
    "addresses": [
        {
            "id": 1,
            "address": "Singleton Rd",
            "city": "Calimesa",
            "state": "California",
            "zip": "923202207",
            "billing_company_id": null,
            "created_at": "2022-03-14T20:49:20.000000Z",
            "updated_at": "2022-03-14T20:49:20.000000Z",
            "addressable_type": "App\\Models\\User",
            "addressable_id": 1
        }
    ],
    "contacts": [
        {
            "id": 1,
            "phone": "(740) 208-8506",
            "fax": "(918) 534-7718",
            "email": "dach.leopold@nikolaus.com",
            "billing_company_id": null,
            "created_at": "2022-03-14T20:49:20.000000Z",
            "updated_at": "2022-03-14T20:49:20.000000Z",
            "mobile": "218-885-3211",
            "contactable_type": "App\\Models\\User",
            "contactable_id": 1
        }
    ],
    "billing_companies": []
}
```

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
    "userkey": "622635b68acb54.47488178",
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

```json
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

<a name="new-token"></a>
##Generate new token user

## Body request example

```json
{
    "token_old": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvdjFcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNjQxMzk5NDU1LCJleHAiOjE2NDE0MDMwNTUsIm5iZiI6MTY0MTM5OTQ1NSwianRpIjoiMjJFTmh5U2hIOHhVNnE0NSIsInN1YiI6MSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.73g-sUA9Mm86Z5qRsZjtDd-1mEwajPjT5neccmxHaUg"
}
```

>{success} 204 response empty, token generate

#

>{warning} 404 user not found, 500 some exception


#