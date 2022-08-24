# claim Docs

---

- [Basic data](#basic-data)
- [Create claim](#create-claim)
- [Get list rev centers](#get-list-rev-centers)
- [Get list type of services](#get-list-type-of-services)
- [Get list place of services](#get-list-type-of-services)
- [Get all claim](#get-all-claim)
- [Get one claim](#get-one-claim)
- [Update claim](#update-claim)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |
| 1 |POST    | `Create claim`  | `/claim/`     | yes            | Create claim  |
| 2 |GET    | `Get list rev centers`  | `/claim/get-list-rev-centers`     | yes            | Get list rev centers |
| 3 |GET    | `Get list type of services`  | `/claim/get-list-type-of-services`     | yes            | Get list type of services |
| 4 |GET    | `Get list place of services`  | `/claim/get-list-place-of-services`     | yes            | Get list place of services |
| 5 |GET     | `Get all claims` | `/claim/`     | yes            | Get all claims |
| 6 |GET     | `Get one claim` | `/claim/{id}` | yes            | Get one claim |
| 7 |PUT     | `Update claim`  | `/claim/{id}` | yes            | Update claim  |


<a name="create-claim"></a>
## Create claim

### Body request example

```json
{
    
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 claim created


#

```json
{
}
```

#

<a name="get-list-rev-centers"></a>
## Get list Rev. Centers


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Rev. Centers found

#

```json
[
    {
        "id":1,
        "name":"AD"
    },
    {
        "id":2,
        "name":"CO"
    },
    {
        "id":3,
        "name":"DM"
    },
    {
        "id":4,
        "name":"EP"
    },
    {
        "id":5,
        "name":"HV"
    },
    {
        "id":6,
        "name":"IN"
    },
    {
        "id":7,
        "name":"LB"
    },
    {
        "id":8,
        "name":"ME"
    },
    {
        "id":9,
        "name":"MI"
    },
    {
        "id":10,
        "name":"NP"
    },
    {
        "id":11,
        "name":"PR"
    },
    {
        "id":12,
        "name":"RA"
    },
    {
        "id":13,
        "name":"SP"
    },
    {
        "id":14,
        "name":"SU"
    }
]
```

#

<a name="get-list-type-of-services"></a>
## Get list Type of Service


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Type of Service found

#

```json
[
    {
        "id": 1,
        "name": "01"
    },
    {
        "id": 2,
        "name": "02"
    },
    {
        "id": 3,
        "name": "03"
    },
    {
        "id": 4,
        "name": "04"
    },
    {
        "id": 5,
        "name": "05"
    },
    {
        "id": 6,
        "name": "06"
    },
    {
        "id": 7,
        "name": "07"
    },
    {
        "id": 8,
        "name": "08"
    },
    {
        "id": 9,
        "name": "09"
    },
    {
        "id": 10,
        "name": "10"
    },
    {
        "id": 11,
        "name": "11"
    },
    {
        "id": 12,
        "name": "12"
    },
    {
        "id": 13,
        "name": "13"
    },
    {
        "id": 14,
        "name": "14"
    },
    {
        "id": 15,
        "name": "15"
    },
    {
        "id": 16,
        "name": "16"
    },
    {
        "id": 17,
        "name": "17"
    },
    {
        "id": 18,
        "name": "18"
    },
    {
        "id": 19,
        "name": "19"
    },
    {
        "id": 20,
        "name": "20"
    },
    {
        "id": 21,
        "name": "21"
    },
    {
        "id": 22,
        "name": "22"
    },
    {
        "id": 23,
        "name": "99"
    },
    {
        "id": 24,
        "name": "MA"
    }
]
```

#

<a name="get-list-place-of-services"></a>
## Get list place of Service


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Type of Service found

#

```json
[
    {
        "id": 1,
        "name": "01"
    },
    {
        "id": 2,
        "name": "02"
    },
    {
        "id": 3,
        "name": "03"
    },
    {
        "id": 4,
        "name": "04"
    },
    {
        "id": 5,
        "name": "05"
    },
    {
        "id": 6,
        "name": "06"
    },
    {
        "id": 7,
        "name": "07"
    },
    {
        "id": 8,
        "name": "08"
    },
    {
        "id": 9,
        "name": "09"
    },
    {
        "id": 10,
        "name": "10"
    },
    {
        "id": 11,
        "name": "11"
    },
    {
        "id": 12,
        "name": "12"
    },
    {
        "id": 13,
        "name": "13"
    },
    {
        "id": 14,
        "name": "14"
    },
    {
        "id": 15,
        "name": "15"
    },
    {
        "id": 16,
        "name": "16"
    },
    {
        "id": 17,
        "name": "17"
    },
    {
        "id": 18,
        "name": "18"
    },
    {
        "id": 19,
        "name": "19"
    },
    {
        "id": 20,
        "name": "20"
    },
    {
        "id": 21,
        "name": "21"
    },
    {
        "id": 22,
        "name": "22"
    },
    {
        "id": 23,
        "name": "99"
    },
    {
        "id": 24,
        "name": "MA"
    }
]
```
#

<a name="get-all-claim"></a>
## Get all claim

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 claim found

#


```json

```

<a name="get-one-claim"></a>
## Get One claim

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "id": <integer>
}
```

## Response

> {success} 200 claim found

#


```json

```

<a name="update-claim"></a>
## Update claim

### Body request example

```json

```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "id": <integer>
}
```

## Response

> {success} 200 claim updated

#

```json

```