# Diagnosis Docs

---

- [Basic data](#basic-data)
- [Create diagnosis](#create-diagnosis)
- [Get all diagnosis](#get-all-diagnosis)
- [Get all diagnosis from server](#get-all-diagnosis-server)
- [Get one diagnosis](#get-one-diagnosis)
- [Get one diagnosis by code](#get-one-diagnosis-by-code)
- [Update diagnosis](#update-diagnosis)
- [Change status diagnosis](#change-status-diagnosis)
- [Get classification type](#get-classification)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 |POST    | `Create Diagnosis`  | `/diagnosis/`     | yes            | Create diagnosis  |         
| 2 |GET     | `Get all Diagnoses` | `/diagnosis/`     | yes            | Get all diagnoses |
| 3 |GET     | `Get all Diagnoses from server`          | `/diagnosis/get-all-server`|yes|Get all diagnoses from server|
| 4 |GET     | `Get one Diagnosis` | `/diagnosis/{id}` | yes            | Get one diagnosis |
| 5 |GET     | `Get one Diagnosis by code` | `/diagnosis/get-by-code/{code}` | yes            | Get one diagnosis by code|
| 6 |PUT     | `Update Diagnosis`  | `/diagnosis/{id}` | yes            | Update diagnosis  |
| 7 |PATCH   | `Change status Diagnosis`  | `/diagnosis/change-status/{id}` | yes            | Change status diagnosis  |
| 8 |GET | `Get classification types`| `/diagnosis/type/{type}/classification`|yes|Get classification types based on select|


<a name="create-diagnosis"></a>
## Create Diagnosis

### Body request example

```json
{
    "code": "D1",
    "start_date": "2022-07-05",
    "description": "Description diagnosis 1",
    "injury_date_required": true,
    "note": "Note diagnosis 1",
    "type": 1, // type of preocedure
    "clasifications": {
        "specific": 2, // not required
        "sub_specific": 2 // not required
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

#

<a name="get-all-diagnosis-server"></a>
## Get all diagnosis from server

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`query <string>`
`itemsPerPage <string>`
`page <integer>`
`sortBy <string>`
`sortDesc <boolean>`

## Example path

>{primary} ?query=fieldSearch&itemsPerPage=5&sortDesc=1&page=1&sortBy=fieldName

## Response

> {success} 200 data returned

#
```json
{
    "data": [
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
    ],
    "count": 10
}
```

#

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
    "end_date": "2022-08-05", // Optional
    "description": "Description diagnosis 1 edited",
    "injury_date_required": true, // Optional
    "description_long": "Descripcion larga", // Optional
    "gender_id":1, // Optional
    "age": "20", // Optional
    "age_end": "23", // Optional
    "type": 2, // required
    "clasifications": {
        "general": 5, // Not required
        "specific": 5 // Not required
    }
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

> {success} 200 Status changed
```json
{
    "active": true
}
```

<a name="get-type"></a>
## Get diagnosis type

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 

```json
[
    {
        "id": 2,
        "name": "ICD-10"
    }
]
```

<a name="get-classification"></a>
## Get diagnosis classification types

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`general optional <general>`


## Response

> {success} 200 

```json
{
    "general": [
        {
            "id": 1,
            "color": "#FFFFFF",
            "name": "Certain Infectious and Parasitic Diseases"
        },
        {
            "id": 2,
            "color": "#FF9B95",
            "name": "Neoplasms"
        },
        {
            "id": 3,
            "color": "#980E04",
            "name": "Disease of the blood and blood-forming organs and certain disorders involving the immune mechanism"
        },
    ],
    "specific": [
        {
            "id": 1,
            "name": "Acute upper respiratory infections"
        },
        {
            "id": 2,
            "name": "Influenza and pneumonia"
        },
        {
            "id": 3,
            "name": "Other acute lower respiratory infections"
        },
    ]
}
```

#

>{warning} 404 Error, get procedures to company not found