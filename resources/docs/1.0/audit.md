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

<a name="get-npi"></a>
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
        "id": "eyJpdiI6IjhGM1VBMU5ZL1B5enliNStnd3N5c0E9PSIsInZhbHVlIjoicjVsNzlSdUx4U2NQV1FQeTNDeTVqQT09IiwibWFjIjoiY2M1MDk4ZmUzMDhiMThiODk5YWI0ZGYxYWU2NDIzOTA2NTI5OGIzMTc0Zjg3ZDA5NDNmNmUxYWViNDJlYWNmMiIsInRhZyI6IiJ9",
        "status": "updated",
        "date": "07-03-2022 04:41:26 PM",
        "ip": "127.0.0.1",
        "module": "App\\Models\\User",
        "users": "<b>Nombre:</b> Efrain Edward<br><b>Email:</b> admin@billing.com"
    },
    {
        "id": "eyJpdiI6ImxTakNJQzZDYm9aMlJMNU9DTSt6Z2c9PSIsInZhbHVlIjoiczkwNzFwMldwWW9LcGlPUEx1Z3lKQT09IiwibWFjIjoiNjAyNTkxMTE4YTFjNTAxNWQ5NTQ4NjhkZTA2NTJkZTI5YmI0MTlhZmI0NjFiMzdhZTM2YzEwOTg1OWZhM2M2MiIsInRhZyI6IiJ9",
        "status": "created",
        "date": "07-03-2022 04:41:26 PM",
        "ip": "127.0.0.1",
        "module": "App\\Models\\Address",
        "users": "<b>Nombre:</b> Efrain Edward<br><b>Email:</b> admin@billing.com"
    },
    {
        "id": "eyJpdiI6IlZkZCtlaldqQzlsK1BhY1VlNUo5T0E9PSIsInZhbHVlIjoiNlJDVWo0QllQNENJWjVic1B6ZUVKZz09IiwibWFjIjoiYjYwODI0ODU3ZmM5N2ZlNjhkNzAyN2M1ZDU1ZTlmZjYyZGI3Njg3YWFlNWE4YjE4MTU4MmNkMzc4Mjk3ZDRiZiIsInRhZyI6IiJ9",
        "status": "created",
        "date": "07-03-2022 04:41:26 PM",
        "ip": "127.0.0.1",
        "module": "App\\Models\\Contact",
        "users": "<b>Nombre:</b> Efrain Edward<br><b>Email:</b> admin@billing.com"
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
    "id": 120,
    "user_type": "App\\Models\\User",
    "user_id": 1,
    "event": "updated",
    "auditable_type": "App\\Models\\User",
    "auditable_id": 46,
    "old_values": {
        "token": null
    },
    "new_values": {
        "token": "eyJpdiI6ImhqTC9QSkVGWVlxUEh5OUJmT0tQaEE9PSIsInZhbHVlIjoiMW1ub0xxVFMxTlpRellxTVkxWGtZalBtNVpLWG9mSlVTRldTSGZMMDhqYnFJOE5XTWxRcjcvZDBXSFh0ZUpxdyIsIm1hYyI6IjY2NGNlYjUzNGI3Y2FmY2I3MmQ2NDNkMDkyMmMwYTg4ZGY0ZWNiNGEyODQ2NzAxNGFiMmYyODdhMzlmNmRkYzUiLCJ0YWciOiIifQ=="
    },
    "url": "http://127.0.0.1:8000/api/v1/user",
    "ip_address": "127.0.0.1",
    "user_agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36",
    "tags": null,
    "created_at": "2022-03-07T16:41:26.000000Z",
    "updated_at": "2022-03-07T16:41:26.000000Z"
}
```
