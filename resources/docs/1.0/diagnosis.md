# Diagnosis Docs

---

- [Basic data](#basic-data)
- [Create diagnosis](#create-diagnosis)
- [Get all diagnosis](#get-all-diagnosis)
- [Get one diagnosis](#get-one-diagnosis)
- [Update diagnosis](#update-diagnosis)
- [Change status diagnosis](#change-status-diagnosis)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 |POST    | `Create Diagnosis`  | `/diagnosis/`     | yes            | Create diagnosis  |         
| 2 |GET     | `Get all Diagnoses` | `/diagnosis/`     | yes            | Get all diagnoses |
| 3 |GET     | `Get one Diagnosis` | `/diagnosis/{id}` | yes            | Get one diagnosis |
| 4 |PUT     | `Update Diagnosis`  | `/diagnosis/{id}` | yes            | Update diagnosis  |
| 5 |PATCH   | `Change status Diagnosis`  | `/diagnosis/change-status/{id}` | yes            | Change status diagnosis  |


<a name="create-diagnosis"></a>
## Create Diagnosis

### Body request example

```json
{
    "code": "D1",
    "description": "Description diagnosis 1",
    "note": "Note diagnosis 1"
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 Diagnosis created


#

```json
{
    "code": "D1",
    "description": "Description diagnosis 1",
    "updated_at": "2022-06-20T07:53:23.000000Z",
    "created_at": "2022-06-20T07:53:23.000000Z",
    "id": 72751
}
```


#

<a name="get-all-diagnosis"></a>
## Get all diagnosis

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 diagnosis found

#


```json
[
    {
        "id": 72751,
        "code": "D1",
        "description": "Description diagnosis 1",
        "active": true,
        "created_at": "2022-06-20T07:53:23.000000Z",
        "updated_at": "2022-06-20T07:53:23.000000Z",
        "public_note": {
            "id": 12,
            "note": "Note diagnosis 1",
            "publishable_type": "App\\Models\\Diagnosis",
            "publishable_id": 72751,
            "created_at": "2022-06-20T07:53:23.000000Z",
            "updated_at": "2022-06-20T07:53:23.000000Z"
        }
    }
]
```

<a name="get-one-diagnosis"></a>
## Get One diagnosis

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

> {success} 200 diagnosis found

#


```json
{
    "id": 72751,
    "code": "D1",
    "description": "Description diagnosis 1",
    "active": true,
    "created_at": "2022-06-20T07:53:23.000000Z",
    "updated_at": "2022-06-20T07:53:23.000000Z",
    "public_note": {
        "id": 12,
        "note": "Note diagnosis 1",
        "publishable_type": "App\\Models\\Diagnosis",
        "publishable_id": 72751,
        "created_at": "2022-06-20T07:53:23.000000Z",
        "updated_at": "2022-06-20T07:53:23.000000Z"
    }
}
```

<a name="update-diagnosis"></a>
## Update diagnosis

### Body request example

```json
{
    "code": "D1 edited",
    "description": "Description diagnosis 1 edited",
    "note": "Note diagnosis 1 edited"
}
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

> {success} 200 diagnosis updated

#

```json
{
    "id": 72751,
    "code": "D1 edited",
    "description": "Description diagnosis 1 edited",
    "active": true,
    "created_at": "2022-06-20T07:53:23.000000Z",
    "updated_at": "2022-06-20T08:04:59.000000Z"
}
```

<a name="change-status-diagnosis"></a>
## Change status diagnosis


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

## Body Param

```json
{
    "status": <boolean>
}
```

## Response

> {success} 204 Status changed