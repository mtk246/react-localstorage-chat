# Authentication Docs

---

- [Basic data](#basic-data)
- [Login](#login)
- [Logout](#logout)
- [Me](#me)
- [Refresh token](#refresh-token)
- [Check token](#check-token)

<a name="basic-data"></a>
## Basic data to make request


| # |METHOD| Name      | URL                   | Token required|Description|
| : ||   :-      |  :                    |               |                    |  
| 1 |POST| `login`   | `/auth/login`         |no             |to make login  |         
| 2 |GET| `logout`  | `/auth/logout`        |yes            |to logout from app|
| 3 |GET| `me`      | `/auth/me`            |yes            |get info from user authenticate|
| 4 |GET| `refresh-token`  | `/auth/refresh-token` |yes            |to refresh token auth|
| 5 |GET| `check-token`  | `/auth/check-token?token={token}` |yes            |to refresh token auth|



<a name="login"></a>
## Login
### Body request example
```json
{
    "email":"admin@billing.com",
    "password":"helloworld",
    "code":"xxxxxx"
}
```
> {success} code is 200 when is success the request to make login



### Response
```json
{
    "user": {
        "id": 1,
        "email": "admin@billing.com",
        "email_verified_at": null,
        "created_at": "2022-03-14T20:49:19.000000Z",
        "updated_at": "2022-03-14T23:42:30.000000Z",
        "token": null,
        "isLogged": false,
        "isBlocked": false,
        "usercode": "US-00001-2022",
        "userkey": null,
        "status": false,
        "last_login": null,
        "profile_id": 1,
        "billing_company_id": null,
        "permissions": [],
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
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2NDczMDE1MDQsImV4cCI6MTY0NzMwNTEwNCwibmJmIjoxNjQ3MzAxNTA0LCJqdGkiOiJsWEhyUUJZZHNGRWI0bFZPIiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.WYDpxMS9r3X0eU44k7jsAKjjnGw9kNIwIMOvsNHddSI",
    "token_type": "bearer",
    "expires_in": 3600
}
```

> {warning} code is 401 when the credencials are wrong

### Response
```json
{
    "error": "Bad Credencials"
}
```

> {warning} code is 403 when the login new device

### Response
```json
{
    "error": "You are trying to access from a new device. Enter the code sent to your email."
}
```

<a name="logout"></a>
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




<a name="me"></a>
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
    "email": "admin@billing.com",
    "email_verified_at": null,
    "created_at": "2022-03-14T20:49:19.000000Z",
    "updated_at": "2022-03-14T23:42:30.000000Z",
    "token": null,
    "isLogged": true,
    "isBlocked": false,
    "usercode": "US-00001-2022",
    "userkey": null,
    "status": false,
    "last_login": null,
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
    "permissions": [],
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
        "updated_at": "2022-03-14T20:49:19.000000Z",
        "social_medias": []
    },
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
}
```



>{warning} 404 when user not found





<a name="refresh-token"></a>
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
"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvYXV0aFwvcmVmcmVzaC10b2tlbiIsImlhdCI6MTY0NzMxNDE0NSwiZXhwIjoxNjQ3MzE3Nzc5LCJuYmYiOjE2NDczMTQxNzksImp0aSI6IkFJMEtRM243cWxmVlNIWjEiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.NKYOANWqHT42mEviQgQMgZXi1RkZ3bbN1rFdBupvzLI"
```


<a name="check-token"></a>
## Check token

### Param in path

```json
{
    "token": <string>
}
```
> {success} code is 200 when is success the token valid



### Response
```json
{
    "status": "Token is valid"
}
```

> {warning} code is 400 when the token is blacklisted

### Response
```json
{
    "status": "Token is Blancklisted"
}
```

> {warning} code is 401 when the token is expired

### Response
```json
{
    "status": "Token is Expired"
}
```

> {warning} code is 403 when the token is invalid

### Response
```json
{
    "status": "Token is Invalid"
}
```