# Audit Docs
---
- [Basic data](#basic-data)
- [Get audit all](#get-audit-all)
- [Get audit all server](#get-audit-all-server)
- [Get audit all by user](#get-audit-all-by-user)
- [Get audit all by billing company](#get-audit-all-by-billing-company)
- [Get audit one](#get-audit-one)

<a name="basic-data"></a>
## Basic data to make request


| # |METHOD| Name           | URL          | Token required | Description|
| : |      |   :-           |  :           |                | |
| 1 |POST   | `get audit all` | `/audit-all` | yes   | Get all records audited |
| 2 |GET   | `get audit all server` | `/audit-all` | yes   | Get all records audited |
| 3 |POST   | `get audit all by user` | `/audit-all-by-user` | yes   | Get all records audited by user|
| 4 |POST   | `get audit all by billing company` | `/audit-all-by--billing-company` | yes   | Get all records audited by billing company|
| 5 |POST  | `get audit one`  | `/audit-one` | yes   | Get the information corresponding to an audited record |

<a name="get-audit-all"></a>
## Get audit all

### Params in header
```json
{
    "Authorization:": Bearer "<Token Bearer>"
}
```

## Response

> {success} 200

#


```json
[
    {
        "id": "eyJpdiI6IkQwUE5sYmxqdlZYdk5kcDVyMGkvVUE9PSIsInZhbHVlIjoiUWtBUE9pU3NEQWZYZzdsaHl4M1NpQT09IiwibWFjIjoiZGM3Njk3ZjdmNjlkMzllMzExZmM1ZmE4OWZkYzQ5OGFhNjlmOTYxOTYzY2JhZjFlNDY3Y2ZmYjFkMTJiNTM5NiIsInRhZyI6IiJ9",
        "event": "created",
        "date": "16-03-2022 10:02:27 AM",
        "ip_address": "127.0.0.1",
        "module": "App\\Models\\User",
        "user": null,
        "url": "console",
        "user_agent": "Symfony"
    },
    {
        "id": "eyJpdiI6IjZzdklSc016OW4wSzZEUjdNYzNiNmc9PSIsInZhbHVlIjoiWkU0YVJTdjFRMUNZUUFBOGJZSnlKdz09IiwibWFjIjoiNTczYjQxZjM2ZDU2OWEzM2RjMjk2Y2RlOGYyYzhjNGM1MmQ3M2M1NGI0Y2QyZTJmNmEyYjQ0MWJjNTZmYjc1YyIsInRhZyI6IiJ9",
        "event": "updated",
        "date": "11-03-2022 01:00:42 PM",
        "ip_address": "127.0.0.1",
        "module": "App\\Models\\User",
        "user": {
            "id": 1,
            "email": "admin@billing.com",
            "email_verified_at": null,
            "created_at": "2022-03-16T10:02:27.000000Z",
            "updated_at": "2022-03-16T11:20:56.000000Z",
            "token": null,
            "isLogged": true,
            "isBlocked": false,
            "usercode": "US-00001-2022",
            "userkey": null,
            "status": false,
            "last_login": "2022-03-16 11:20:56",
            "profile_id": 1,
            "billing_company_id": 1,
            "profile": {
                "id": 1,
                "ssn": "476180382",
                "first_name": "Isaiah",
                "middle_name": "Davion",
                "last_name": "Wilfrid",
                "sex": "M",
                "date_of_birth": "1990-04-01",
                "avatar": null,
                "credit_score": false,
                "created_at": "2022-03-16T10:02:27.000000Z",
                "updated_at": "2022-03-16T10:02:27.000000Z"
            }
        },
        "url": "http://127.0.0.1:8000/api/v1/user",
        "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36"
    },
        {
        "id": "eyJpdiI6IkNFNHBYQ0VRWHBUN25jY3BjU3lvTXc9PSIsInZhbHVlIjoiamFWaEp2RHowdFlENzg5czV5Zmd2QT09IiwibWFjIjoiNjU3YmU5NTI0ZDZjZjYzZjljMjk2MTM0ZjhjMTA4Mzg0YTA0MTM5NDMxNjg4MTE1YzM2YjQ3MmQzMDFhZWM0YiIsInRhZyI6IiJ9",
        "event": "created",
        "date": "11-03-2022 01:00:42 PM",
        "ip_address": "127.0.0.1",
        "module": "App\\Models\\Address",
        "user": {
            "id": 1,
            "email": "admin@billing.com",
            "email_verified_at": null,
            "created_at": "2022-03-16T10:02:27.000000Z",
            "updated_at": "2022-03-16T11:20:56.000000Z",
            "token": null,
            "isLogged": true,
            "isBlocked": false,
            "usercode": "US-00001-2022",
            "userkey": null,
            "status": false,
            "last_login": "2022-03-16 11:20:56",
            "profile_id": 1,
            "billing_company_id": 1,
            "profile": {
                "id": 1,
                "ssn": "476180382",
                "first_name": "Isaiah",
                "middle_name": "Davion",
                "last_name": "Wilfrid",
                "sex": "M",
                "date_of_birth": "1990-04-01",
                "avatar": null,
                "credit_score": false,
                "created_at": "2022-03-16T10:02:27.000000Z",
                "updated_at": "2022-03-16T10:02:27.000000Z"
            }
        },
        "url": "http://127.0.0.1:8000/api/v1/user",
        "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36"
    },
    {
        "id": "eyJpdiI6ImpsbzNUektxLzBReDcvN2llSmRmNVE9PSIsInZhbHVlIjoiT1RmeFlqcFVGdVlRbHMvcDRLQWUzdz09IiwibWFjIjoiZGFmYTAyZDBiNDA5MGRkMjA5NjhiM2M2MzMxZTEwZDA4ODE3NDNmZWYxNzJkZWIxODYyM2M0NDg3ZDdmYjAxNSIsInRhZyI6IiJ9",
        "event": "created",
        "date": "11-03-2022 03:49:54 AM",
        "ip_address": "127.0.0.1",
        "module": "App\\Models\\User",
        "user": null,
        "url": "console",
        "user_agent": "Symfony"
    }
]
```

<a name="get-audit-all-server"></a>
## Get audit all server

### Params in header
```json
{
    "Authorization:": Bearer "<Token Bearer>"
}
```

### Param in path

```json
{
    "search":       <string>
    "page":         <integer>
    "itemsPerPage": <string>
    "sortBy":       <string>
    "sortDesc":     <boolean>
}
```

## Response

> {success} 200

#


```json
{
    "pagination": {
        "total": 137,
        "currentPage": 1,
        "perPage": "10",
        "lastPage": 14
    },
    "items": [
        {
            "id": 1,
            "event": "created",
            "date": "2022-04-20 21:52:51",
            "ip_address": "127.0.0.1",
            "module": "App\\Roles\\Models\\Role",
            "module_id": 1,
            "user_id": null,
            "user_type": null,
            "url": "console",
            "user_agent": "Symfony",
            "user": null
        },
        {
            "id": 2,
            "event": "created",
            "date": "2022-04-20 21:52:51",
            "ip_address": "127.0.0.1",
            "module": "App\\Roles\\Models\\Role",
            "module_id": 2,
            "user_id": null,
            "user_type": null,
            "url": "console",
            "user_agent": "Symfony",
            "user": null
        },
        {
            "id": 3,
            "event": "created",
            "date": "2022-04-20 21:52:51",
            "ip_address": "127.0.0.1",
            "module": "App\\Roles\\Models\\Role",
            "module_id": 3,
            "user_id": null,
            "user_type": null,
            "url": "console",
            "user_agent": "Symfony",
            "user": null
        },
        {
            "id": 4,
            "event": "created",
            "date": "2022-04-20 21:52:51",
            "ip_address": "127.0.0.1",
            "module": "App\\Roles\\Models\\Role",
            "module_id": 4,
            "user_id": null,
            "user_type": null,
            "url": "console",
            "user_agent": "Symfony",
            "user": null
        },
        {
            "id": 5,
            "event": "created",
            "date": "2022-04-20 21:52:51",
            "ip_address": "127.0.0.1",
            "module": "App\\Roles\\Models\\Role",
            "module_id": 5,
            "user_id": null,
            "user_type": null,
            "url": "console",
            "user_agent": "Symfony",
            "user": null
        },
        {
            "id": 6,
            "event": "created",
            "date": "2022-04-20 21:52:51",
            "ip_address": "127.0.0.1",
            "module": "App\\Roles\\Models\\Role",
            "module_id": 6,
            "user_id": null,
            "user_type": null,
            "url": "console",
            "user_agent": "Symfony",
            "user": null
        },
        {
            "id": 7,
            "event": "created",
            "date": "2022-04-20 21:52:51",
            "ip_address": "127.0.0.1",
            "module": "App\\Roles\\Models\\Role",
            "module_id": 7,
            "user_id": null,
            "user_type": null,
            "url": "console",
            "user_agent": "Symfony",
            "user": null
        },
        {
            "id": 8,
            "event": "created",
            "date": "2022-04-20 21:52:51",
            "ip_address": "127.0.0.1",
            "module": "App\\Roles\\Models\\Role",
            "module_id": 8,
            "user_id": null,
            "user_type": null,
            "url": "console",
            "user_agent": "Symfony",
            "user": null
        },
        {
            "id": 9,
            "event": "created",
            "date": "2022-04-20 21:52:51",
            "ip_address": "127.0.0.1",
            "module": "App\\Roles\\Models\\Role",
            "module_id": 9,
            "user_id": null,
            "user_type": null,
            "url": "console",
            "user_agent": "Symfony",
            "user": null
        },
        {
            "id": 10,
            "event": "created",
            "date": "2022-04-20 21:52:51",
            "ip_address": "127.0.0.1",
            "module": "App\\Roles\\Models\\Role",
            "module_id": 10,
            "user_id": null,
            "user_type": null,
            "url": "console",
            "user_agent": "Symfony",
            "user": null
        }
    ]
}
```

<a name="get-audit-all-by-user"></a>
## Get audit all by user

### Body request example

```json
{
    "user_id":2,
}
```

### Params in header
```json
{
    "Authorization:": Bearer "<Token Bearer>"
}
```

## Response

> {success} 200

#


```json
[
    {
        "id": "eyJpdiI6IlQxMFZMN0F4bnFTdlFsS3lML2lUZlE9PSIsInZhbHVlIjoiMHEyc0RMNkp3em9ocU5rR3BnRDJFUT09IiwibWFjIjoiNzdmMzdlMTEyNGVmNDk4M2ViY2E1YmJlN2U5N2Q5ZDhiYmU3OGIzNDYyMzE2Y2VjMWExYTViNjY0Y2JjN2I0NSIsInRhZyI6IiJ9",
        "event": "created",
        "date": "02-04-2022 02:01:39 AM",
        "ip_address": "127.0.0.1",
        "module": "App\\Models\\Taxonomy",
        "user": {
            "id": 2,
            "email": "billingmanager@billing.com",
            "email_verified_at": null,
            "created_at": "2022-03-25T11:11:50.000000Z",
            "updated_at": "2022-04-02T01:59:47.000000Z",
            "token": null,
            "isLogged": true,
            "isBlocked": false,
            "usercode": "US-00017-2022",
            "userkey": null,
            "status": false,
            "last_login": "2022-04-02 01:59:47",
            "profile_id": 31,
            "billing_company_id": null,
            "profile": {
                "id": 31,
                "ssn": "206166101",
                "first_name": "Gay",
                "middle_name": "Caleb",
                "last_name": "Alejandrin",
                "sex": "M",
                "date_of_birth": "1990-04-01",
                "avatar": null,
                "credit_score": false,
                "created_at": "2022-03-25T17:01:01.000000Z",
                "updated_at": "2022-03-25T17:01:01.000000Z"
            }
        },
        "url": "http://127.0.0.1:8000/api/v1/company",
        "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36"
    },
    {
        "id": "eyJpdiI6InZEdmU3NWttRm9VaFFPVnVNSWl2R0E9PSIsInZhbHVlIjoieHVWVGpNSjRvcXRibWxzZnVreG9wQT09IiwibWFjIjoiOTEzNDgzNGQ2OTQyYjM1YmE5NGI0MTU5YjA2NTI5NGIxMjgzMDU4ZjNiNzA5OWI3M2I2ODM5NWE0YzUyOTdiNiIsInRhZyI6IiJ9",
        "event": "created",
        "date": "02-04-2022 02:01:39 AM",
        "ip_address": "127.0.0.1",
        "module": "App\\Models\\Address",
        "user": {
            "id": 2,
            "email": "billingmanager@billing.com",
            "email_verified_at": null,
            "created_at": "2022-03-25T11:11:50.000000Z",
            "updated_at": "2022-04-02T01:59:47.000000Z",
            "token": null,
            "isLogged": true,
            "isBlocked": false,
            "usercode": "US-00017-2022",
            "userkey": null,
            "status": false,
            "last_login": "2022-04-02 01:59:47",
            "profile_id": 31,
            "billing_company_id": null,
            "profile": {
                "id": 31,
                "ssn": "206166101",
                "first_name": "Gay",
                "middle_name": "Caleb",
                "last_name": "Alejandrin",
                "sex": "M",
                "date_of_birth": "1990-04-01",
                "avatar": null,
                "credit_score": false,
                "created_at": "2022-03-25T17:01:01.000000Z",
                "updated_at": "2022-03-25T17:01:01.000000Z"
            }
        },
        "url": "http://127.0.0.1:8000/api/v1/company",
        "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36"
    },
    {
        "id": "eyJpdiI6Inp2YXZVMkppZUV3U3BtNFI5SzdIcmc9PSIsInZhbHVlIjoiOXoydmRxdExHWEZxUEhTRS9FU0JGUT09IiwibWFjIjoiYzI3MTIwODYxYzEyZTJkYjYwZWM2OGY1NDhmMGE1Y2NlNDk4MjczNTgxZjFhMjYxNDJmMmMyM2Y4OTc3YzAwMyIsInRhZyI6IiJ9",
        "event": "created",
        "date": "02-04-2022 02:01:39 AM",
        "ip_address": "127.0.0.1",
        "module": "App\\Models\\Contact",
        "user": {
            "id": 2,
            "email": "billingmanager@billing.com",
            "email_verified_at": null,
            "created_at": "2022-03-25T11:11:50.000000Z",
            "updated_at": "2022-04-02T01:59:47.000000Z",
            "token": null,
            "isLogged": true,
            "isBlocked": false,
            "usercode": "US-00017-2022",
            "userkey": null,
            "status": false,
            "last_login": "2022-04-02 01:59:47",
            "profile_id": 31,
            "billing_company_id": null,
            "profile": {
                "id": 31,
                "ssn": "206166101",
                "first_name": "Gay",
                "middle_name": "Caleb",
                "last_name": "Alejandrin",
                "sex": "M",
                "date_of_birth": "1990-04-01",
                "avatar": null,
                "credit_score": false,
                "created_at": "2022-03-25T17:01:01.000000Z",
                "updated_at": "2022-03-25T17:01:01.000000Z"
            }
        },
        "url": "http://127.0.0.1:8000/api/v1/company",
        "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36"
    }
]
```

<a name="get-audit-all-by-billing-company"></a>
## Get audit all by billing company

### Body request example

```json
{
    "billing_company_id":1,
}
```

### Params in header
```json
{
    "Authorization:": Bearer "<Token Bearer>"
}
```

## Response

> {success} 200

#


```json
[
    {
        "id": "eyJpdiI6IlQxMFZMN0F4bnFTdlFsS3lML2lUZlE9PSIsInZhbHVlIjoiMHEyc0RMNkp3em9ocU5rR3BnRDJFUT09IiwibWFjIjoiNzdmMzdlMTEyNGVmNDk4M2ViY2E1YmJlN2U5N2Q5ZDhiYmU3OGIzNDYyMzE2Y2VjMWExYTViNjY0Y2JjN2I0NSIsInRhZyI6IiJ9",
        "event": "created",
        "date": "02-04-2022 02:01:39 AM",
        "ip_address": "127.0.0.1",
        "module": "App\\Models\\Taxonomy",
        "user": {
            "id": 2,
            "email": "billingmanager@billing.com",
            "email_verified_at": null,
            "created_at": "2022-03-25T11:11:50.000000Z",
            "updated_at": "2022-04-02T01:59:47.000000Z",
            "token": null,
            "isLogged": true,
            "isBlocked": false,
            "usercode": "US-00017-2022",
            "userkey": null,
            "status": false,
            "last_login": "2022-04-02 01:59:47",
            "profile_id": 31,
            "billing_company_id": null,
            "profile": {
                "id": 31,
                "ssn": "206166101",
                "first_name": "Gay",
                "middle_name": "Caleb",
                "last_name": "Alejandrin",
                "sex": "M",
                "date_of_birth": "1990-04-01",
                "avatar": null,
                "credit_score": false,
                "created_at": "2022-03-25T17:01:01.000000Z",
                "updated_at": "2022-03-25T17:01:01.000000Z"
            }
        },
        "url": "http://127.0.0.1:8000/api/v1/company",
        "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36"
    },
    {
        "id": "eyJpdiI6InZEdmU3NWttRm9VaFFPVnVNSWl2R0E9PSIsInZhbHVlIjoieHVWVGpNSjRvcXRibWxzZnVreG9wQT09IiwibWFjIjoiOTEzNDgzNGQ2OTQyYjM1YmE5NGI0MTU5YjA2NTI5NGIxMjgzMDU4ZjNiNzA5OWI3M2I2ODM5NWE0YzUyOTdiNiIsInRhZyI6IiJ9",
        "event": "created",
        "date": "02-04-2022 02:01:39 AM",
        "ip_address": "127.0.0.1",
        "module": "App\\Models\\Address",
        "user": {
            "id": 2,
            "email": "billingmanager@billing.com",
            "email_verified_at": null,
            "created_at": "2022-03-25T11:11:50.000000Z",
            "updated_at": "2022-04-02T01:59:47.000000Z",
            "token": null,
            "isLogged": true,
            "isBlocked": false,
            "usercode": "US-00017-2022",
            "userkey": null,
            "status": false,
            "last_login": "2022-04-02 01:59:47",
            "profile_id": 31,
            "billing_company_id": null,
            "profile": {
                "id": 31,
                "ssn": "206166101",
                "first_name": "Gay",
                "middle_name": "Caleb",
                "last_name": "Alejandrin",
                "sex": "M",
                "date_of_birth": "1990-04-01",
                "avatar": null,
                "credit_score": false,
                "created_at": "2022-03-25T17:01:01.000000Z",
                "updated_at": "2022-03-25T17:01:01.000000Z"
            }
        },
        "url": "http://127.0.0.1:8000/api/v1/company",
        "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36"
    },
    {
        "id": "eyJpdiI6Inp2YXZVMkppZUV3U3BtNFI5SzdIcmc9PSIsInZhbHVlIjoiOXoydmRxdExHWEZxUEhTRS9FU0JGUT09IiwibWFjIjoiYzI3MTIwODYxYzEyZTJkYjYwZWM2OGY1NDhmMGE1Y2NlNDk4MjczNTgxZjFhMjYxNDJmMmMyM2Y4OTc3YzAwMyIsInRhZyI6IiJ9",
        "event": "created",
        "date": "02-04-2022 02:01:39 AM",
        "ip_address": "127.0.0.1",
        "module": "App\\Models\\Contact",
        "user": {
            "id": 2,
            "email": "billingmanager@billing.com",
            "email_verified_at": null,
            "created_at": "2022-03-25T11:11:50.000000Z",
            "updated_at": "2022-04-02T01:59:47.000000Z",
            "token": null,
            "isLogged": true,
            "isBlocked": false,
            "usercode": "US-00017-2022",
            "userkey": null,
            "status": false,
            "last_login": "2022-04-02 01:59:47",
            "profile_id": 31,
            "billing_company_id": null,
            "profile": {
                "id": 31,
                "ssn": "206166101",
                "first_name": "Gay",
                "middle_name": "Caleb",
                "last_name": "Alejandrin",
                "sex": "M",
                "date_of_birth": "1990-04-01",
                "avatar": null,
                "credit_score": false,
                "created_at": "2022-03-25T17:01:01.000000Z",
                "updated_at": "2022-03-25T17:01:01.000000Z"
            }
        },
        "url": "http://127.0.0.1:8000/api/v1/company",
        "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36"
    }
]
```


<a name="get-audit-one"></a>
## Get audit one

### Params in header
```json
{
    "Authorization:": Bearer "<Token Bearer>"
}
```

### Body request example

```json
{
    "id":"eyJpdiI6InpzdnhPbGJPQUZJWFFnUjZuQm5lVHc9PSIsInZhbHVlIjoiREdHYXpGQjlOSFAzNGxuZFU2UU9EZz09IiwibWFjIjoiNjQ4OTg0YmEzNzc3NzVkNzlhYjYyMWMwMmI3Y2FlOWIxNmJiYjg2MmQzZmNjN2E3YzI1NjVhYjcyZjY0N2I5ZSIsInRhZyI6IiJ9",
}
```

## Response

> {success} 200


#


```json
{
    "id": 45,
    "user_type": "App\\Models\\User",
    "user_id": 1,
    "event": "created",
    "auditable_type": "App\\Models\\Address",
    "auditable_id": 5,
    "old_values": [],
    "new_values": {
        "address": "Santa juana",
        "city": "Merida",
        "state": "state",
        "zip": "51010",
        "user_id": 5,
        "updated_at": "2022-03-11 13:00:42",
        "created_at": "2022-03-11 13:00:42",
        "id": 5
    },
    "url": "http://127.0.0.1:8000/api/v1/user",
    "ip_address": "127.0.0.1",
    "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36",
    "tags": null,
    "created_at": "2022-03-11T13:00:42.000000Z",
    "updated_at": "2022-03-11T13:00:42.000000Z",
    "user": {
        "id": 1,
        "email": "admin@billing.com",
        "email_verified_at": null,
        "created_at": "2022-03-16T10:02:27.000000Z",
        "updated_at": "2022-03-16T11:20:56.000000Z",
        "token": null,
        "isLogged": true,
        "isBlocked": false,
        "usercode": "US-00001-2022",
        "userkey": null,
        "status": false,
        "last_login": "2022-03-16 11:20:56",
        "profile_id": 1,
        "billing_company_id": 1,
        "profile": {
            "id": 1,
            "ssn": "476180382",
            "first_name": "Isaiah",
            "middle_name": "Davion",
            "last_name": "Wilfrid",
            "sex": "M",
            "date_of_birth": "1990-04-01",
            "avatar": null,
            "credit_score": false,
            "created_at": "2022-03-16T10:02:27.000000Z",
            "updated_at": "2022-03-16T10:02:27.000000Z"
        }
    }
}
```
