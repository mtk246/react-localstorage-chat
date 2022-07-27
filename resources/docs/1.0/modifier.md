# Modifier Docs

---

- [Basic data](#basic-data)
- [Create modifier](#create-modifier)
- [Get all modifier](#get-all-modifier)
- [Get one modifier](#get-one-modifier)
- [Get one modifier by code](#get-one-modifier-by-code)
- [Update modifier](#update-modifier)
- [Change status modifier](#change-status-modifier)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 |POST    | `Create Modifier`  | `/modifier/`     | yes            | Create Modifier  |         
| 2 |GET     | `Get all Modifier` | `/modifier/`     | yes            | Get all Modifier |
| 3 |GET     | `Get one Modifier` | `/modifier/{id}` | yes            | Get one Modifier |
| 4 |GET     | `Get one Modifier by code` | `/modifier/get-by-code/{code}` | yes            | Get one Modifier by code|
| 5 |PUT     | `Update Modifier`  | `/modifier/{id}` | yes            | Update Modifier  |
| 6 |PATCH   | `Change status Modifier`  | `/modifier/change-status/{id}` | yes            | Change status Modifier  |


<a name="create-modifier"></a>
## Create Modifier

### Body request example

```json
{
    "modifier": "M1",
    "start_date": "2022-07-05",
    "end_date": "2022-08-05",
    "special_coding_instructions": "Especial coding instructions modifier 1",
    "modifier_invalid_combinations": [
        {"invalid_combination": "M2"}
    ],
    "note": "Note modifier 1"
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 Modifier created


#

```json
{
    "modifier": "M1",
    "start_date": "2022-07-05",
    "end_date": "2022-08-05",
    "special_coding_instructions": "Especial coding instructions modifier 1",
    "updated_at": "2022-06-13T11:39:28.000000Z",
    "created_at": "2022-06-13T11:39:28.000000Z",
    "id": 1
}
```


#

<a name="get-all-modifier"></a>
## Get All Modifier

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Modifier found

#


```json
[
    {
        "id": 1,
        "modifier": "M1",
        "special_coding_instructions": "Especial coding instructions modifier 1",
        "active": true,
        "created_at": "2022-06-13T11:39:28.000000Z",
        "updated_at": "2022-06-13T11:39:28.000000Z",
        "start_date": "2022-07-05",
        "end_date": "2022-08-05",
        "public_note": {
            "id": 11,
            "note": "Note modifier 1",
            "publishable_type": "App\\Models\\Modifier",
            "publishable_id": 1,
            "created_at": "2022-06-13T11:39:28.000000Z",
            "updated_at": "2022-06-13T11:39:28.000000Z"
        },
        "modifier_invalid_combinations": [
            {
                "id": 1,
                "invalid_combination": "M2",
                "modifier_id": 1,
                "created_at": "2022-06-13T11:39:28.000000Z",
                "updated_at": "2022-06-13T11:39:28.000000Z"
            }
        ]
    }
]
```

<a name="get-one-modifier"></a>
## Get One Modifier

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

> {success} 200 Modifier found

#


```json
{
    "id": 1,
    "modifier": "M1",
    "special_coding_instructions": "Especial coding instructions modifier 1",
    "active": true,
    "created_at": "2022-06-13T11:39:28.000000Z",
    "updated_at": "2022-06-13T11:39:28.000000Z",
    "start_date": "2022-07-05",
    "end_date": "2022-08-05",
    "public_note": {
        "id": 11,
        "note": "Note modifier 1",
        "publishable_type": "App\\Models\\Modifier",
        "publishable_id": 1,
        "created_at": "2022-06-13T11:39:28.000000Z",
        "updated_at": "2022-06-13T11:39:28.000000Z"
    },
    "modifier_invalid_combinations": [
        {
            "id": 1,
            "invalid_combination": "M2",
            "modifier_id": 1,
            "created_at": "2022-06-13T11:39:28.000000Z",
            "updated_at": "2022-06-13T11:39:28.000000Z"
        }
    ]
}
```

<a name="get-one-modifier-by-code"></a>
## Get One Modifier by code

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

> {success} 200 Modifier found

#


```json
{
    "id": 1,
    "modifier": "M1",
    "special_coding_instructions": "Especial coding instructions modifier 1",
    "active": true,
    "created_at": "2022-06-13T11:39:28.000000Z",
    "updated_at": "2022-06-13T11:39:28.000000Z",
    "start_date": "2022-07-05",
    "end_date": "2022-08-05",
    "public_note": {
        "id": 11,
        "note": "Note modifier 1",
        "publishable_type": "App\\Models\\Modifier",
        "publishable_id": 1,
        "created_at": "2022-06-13T11:39:28.000000Z",
        "updated_at": "2022-06-13T11:39:28.000000Z"
    },
    "modifier_invalid_combinations": [
        {
            "id": 1,
            "invalid_combination": "M2",
            "modifier_id": 1,
            "created_at": "2022-06-13T11:39:28.000000Z",
            "updated_at": "2022-06-13T11:39:28.000000Z"
        }
    ]
}
```

<a name="update-modifier"></a>
## Update Modifier

### Body request example

```json
{
    "modifier": "M1 edited",
    "start_date": "2022-07-05",
    "end_date": "2022-08-05",
    "special_coding_instructions": "Especial coding instructions modifier 1 Edited",
    "modifier_invalid_combinations": [
        {"invalid_combination": "M2"}
    ],
    "note": "Note modifier 1 edited"
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

> {success} 200 Modifier updated

#

```json
{
    "id": 1,
    "modifier": "M1",
    "start_date": "2022-07-05",
    "end_date": "2022-08-05",
    "special_coding_instructions": "Especial coding instructions modifier 1 Edited",
    "active": true,
    "created_at": "2022-06-13T11:39:28.000000Z",
    "updated_at": "2022-06-20T07:25:12.000000Z"
}
```

<a name="change-status-modifier"></a>
## Change status Modifier


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