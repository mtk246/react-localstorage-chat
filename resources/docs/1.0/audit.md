# Audit Docs
---
- [Basic data](#basic-data)
- [Get audit all](#get-audit-all)
- [Get audit one](#get-audit-one)

<a name="basic-data"></a>
## Basic data to make request


| # |METHOD| Name           | URL          | Token required | Description|
| : |      |   :-           |  :           |                | |
| 1 |POST   | `get audit all` | `/audit-all` | yes   | Get all records audited |
| 2 |POST  | `get audit one`  | `/audit-one` | yes   | Get the information corresponding to an audited record |

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
        "id": "eyJpdiI6IjZzdklSc016OW4wSzZEUjdNYzNiNmc9PSIsInZhbHVlIjoiWkU0YVJTdjFRMUNZUUFBOGJZSnlKdz09IiwibWFjIjoiNTczYjQxZjM2ZDU2OWEzM2RjMjk2Y2RlOGYyYzhjNGM1MmQ3M2M1NGI0Y2QyZTJmNmEyYjQ0MWJjNTZmYjc1YyIsInRhZyI6IiJ9",
        "event": "updated",
        "date": "11-03-2022 01:00:42 PM",
        "ip_address": "127.0.0.1",
        "module": "App\\Models\\User",
        "user": {
            "id": 1,
            "username": "Nikolas",
            "email": "admin@billing.com",
            "email_verified_at": null,
            "created_at": "2022-03-11T03:49:54.000000Z",
            "updated_at": "2022-03-11T03:49:54.000000Z",
            "sex": "M",
            "lastName": "Arjun",
            "firstName": "Christophe",
            "middleName": "Lewis",
            "token": null,
            "available": false,
            "isLogged": false,
            "img_profile": null,
            "ssn": null,
            "dateOfBirth": null,
            "isBlocked": false,
            "usercode": null,
            "billing_company_id": null
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
            "username": "Nikolas",
            "email": "admin@billing.com",
            "email_verified_at": null,
            "created_at": "2022-03-11T03:49:54.000000Z",
            "updated_at": "2022-03-11T03:49:54.000000Z",
            "sex": "M",
            "lastName": "Arjun",
            "firstName": "Christophe",
            "middleName": "Lewis",
            "token": null,
            "available": false,
            "isLogged": false,
            "img_profile": null,
            "ssn": null,
            "dateOfBirth": null,
            "isBlocked": false,
            "usercode": null,
            "billing_company_id": null
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
        "username": "Nikolas",
        "email": "admin@billing.com",
        "email_verified_at": null,
        "created_at": "2022-03-11T03:49:54.000000Z",
        "updated_at": "2022-03-11T03:49:54.000000Z",
        "sex": "M",
        "lastName": "Arjun",
        "firstName": "Christophe",
        "middleName": "Lewis",
        "token": null,
        "available": false,
        "isLogged": false,
        "img_profile": null,
        "ssn": null,
        "dateOfBirth": null,
        "isBlocked": false,
        "usercode": null,
        "billing_company_id": null
    }
}
```
