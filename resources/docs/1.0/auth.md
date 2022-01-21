# Authentication Docs

---

- [Authentication](#section-2)

<a name="section-2"></a>
## Basic data to make request


| # |METHOD| Name      | URL                   | Token required|Description|
| : ||   :-      |  :                    |               |                    |  
| 1 |POST| `login`   | `/auth/login`         |no             |to make login  |         
| 2 |GET| `logout`  | `/auth/logout`        |yes            |to logout from app|
| 2 |GET| `me`      | `/auth/me`            |yes            |get info from user authenticate|
| 2 |GET| `refresh-token`  | `/auth/refresh-token` |yes            |to refresh token auth|



<a name="section-3"></a>
## Login
### Body request example
```json
{
    "email":"admin@billing.com",
    "password":"helloworld"
}
```
> {success} code is 200 when is success the request to make login



### Response
```json
    {
    "user": {
        "id": 1,
        "username": "hola",
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

> {warning} code is 401 when the credencials are wrong

#

> {danger} code is 500 when is throw a exception


<a name="section-4"></a>
## Logout

### Params in header
```json
{
    "Authorization:": Bearer "<Token Bearer>"
}
```

### Response
> {success} Code 200



```json
{
    "message": "Successfully logged out"
}
```




<a name="section-5"></a>
## Me

### Params in header
```json
{
    "Authorization:": Bearer "<Token Bearer>"
}
```

### Response
> {success} Code 200



```json
{
    "id": 1,
    "username": "hola",
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
    ],
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
    ]
}
```



>{warning} 404 when user not found





<a name="section-5"></a>
## Refresh-Token


### Params in header
```json
{
    "Authorization:": Bearer "<Token Bearer>"
}
```

### Response
> {success} Code 200




```json
{
    "user": {
        "id": 1,
        "username": "hola",
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
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvdjFcL2F1dGhcL3JlZnJlc2gtdG9rZW4iLCJpYXQiOjE2NDE0MDAyODcsImV4cCI6MTY0MTQwNDExNywibmJmIjoxNjQxNDAwNTE3LCJqdGkiOiJxTHdXaDRuUE1lYXB1RkFiIiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.SsLPU-EkXh1I-B4OhNLnS_dZrzjtoaSrLOsbOMYJCpY",
    "token_type": "bearer",
    "expires_in": 3600
}
```
