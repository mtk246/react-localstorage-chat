# Diagnosis Docs

---

- [Basic data](#basic-data)
- [Create diagnosis](#create-diagnosis)
- [Get all diagnosis](#get-all-diagnosis)
- [Get one diagnosis](#get-one-diagnosis)
- [Get one diagnosis by code](#get-one-diagnosis-by-code)
- [Update diagnosis](#update-diagnosis)
- [Change status diagnosis](#change-status-diagnosis)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 |POST    | `Create Diagnosis`  | `/diagnosis/`     | yes            | Create diagnosis  |         
| 2 |GET     | `Get all Diagnoses` | `/diagnosis/`     | yes            | Get all diagnoses |
| 3 |GET     | `Get one Diagnosis` | `/diagnosis/{id}` | yes            | Get one diagnosis |
| 4 |GET     | `Get one Diagnosis by code` | `/diagnosis/get-by-code/{code}` | yes            | Get one diagnosis by code|
| 5 |PUT     | `Update Diagnosis`  | `/diagnosis/{id}` | yes            | Update diagnosis  |
| 6 |PATCH   | `Change status Diagnosis`  | `/diagnosis/change-status/{id}` | yes            | Change status diagnosis  |


<a name="create-diagnosis"></a>
## Create Diagnosis

### Body request example

```json
{
    "code": "D1",
    "start_date": "2022-07-05",
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
    "start_date": "2022-07-05",
    "end_date": null,
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
        "start_date": "2022-07-05",
        "end_date": "2022-08-05",
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
    "start_date": "2022-07-05",
    "end_date": "2022-08-05",
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

<a name="get-one-diagnosis-by-code"></a>
## Get One diagnosis by code

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "code": <string>
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
    "start_date": "2022-07-05",
    "end_date": "2022-08-05",
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
    "start_date": "2022-07-05",
    "end_date": "2022-08-05",
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
    "code": "D1",
    "description": "Description diagnosis 1 edited",
    "start_date": "2022-07-05",
    "end_date": "2022-08-05",
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