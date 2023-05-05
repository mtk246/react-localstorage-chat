# Modifier Docs

---

- [Basic data](#basic-data)
- [Create modifier](#create-modifier)
- [Get all modifier](#get-all-modifier)
- [Get all modifier from server](#get-all-modifier-server)
- [Get one modifier](#get-one-modifier)
- [Get one modifier by code](#get-one-modifier-by-code)
- [Get list modifiers](#get-list-modifiers)
- [Update modifier](#update-modifier)
- [Change status modifier](#change-status-modifier)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 |POST    | `Create Modifier`  | `/modifier/`     | yes            | Create Modifier  |         
| 2 |GET     | `Get all Modifier` | `/modifier/`     | yes            | Get all Modifier |
| 3 |GET     | `Get all Modifier from server`          | `/modifier/get-all-server`|yes|Get all modifier from server|
| 4 |GET     | `Get one Modifier` | `/modifier/{id}` | yes            | Get one Modifier |
| 5 |GET     | `Get one Modifier by code` | `/modifier/get-by-code/{code}` | yes            | Get one Modifier by code|
| 6 |GET     | `Get list modifiers `| `/modifier/get-list`        |yes            |Get list modifier|
| 7 |PUT     | `Update Modifier`  | `/modifier/{id}` | yes            | Update Modifier  |
| 8 |PATCH   | `Change status Modifier`  | `/modifier/change-status/{id}` | yes            | Change status Modifier  |


<a name="create-modifier"></a>
## Create Modifier

### Body request example

```json
{
    "modifier": "M1",
    "start_date": "2022-07-05",
    "end_date": "2022-01-05", // not required
    "special_coding_instructions": "Especial coding instructions modifier 1",
    "modifier_invalid_combinations": ["M2", "M1"],
    "classification": 1,
    "type": 1,
    "description": "short modifier description",
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
  "id": 356,
  "modifier": "M1",
  "special_coding_instructions": "Especial Coding Instructions Modifier 1",
  "active": null,
  "start_date": "2022-07-05",
  "end_date": null,
  "classification": {
    "id": 1,
    "color": "#FFFFFF",
    "name": "General"
  },
  "type": {
    "id": 1,
    "color": "#FFFAEC",
    "name": "Informative"
  },
  "description": "short modifier description",
  "public_note": {
    "id": 17,
    "note": "Note modifier 1",
    "publishable_type": "App\\Models\\Modifier",
    "publishable_id": 357,
    "created_at": "2023-05-05T12:35:00.000000Z",
    "updated_at": "2023-05-05T12:35:00.000000Z",
    "last_modified": {
      "user": "Maikel Bello",
      "roles": [
        {
          "id": 1,
          "name": "Super User",
          "slug": "superuser",
          "description": "Allows you to administer and manage all the functions of the application",
          "level": 1,
          "created_at": "2023-04-28T11:21:30.000000Z",
          "updated_at": "2023-04-28T11:21:30.000000Z",
          "pivot": {
            "user_id": 12,
            "role_id": 1,
            "created_at": "2023-04-28T11:21:50.000000Z",
            "updated_at": "2023-04-28T11:21:50.000000Z"
          }
        }
      ]
    }
  },
  "modifier_invalid_combinations": [
    {
      "id": 103,
      "invalid_combination": "M2",
      "modifier_id": 357,
      "created_at": "2023-05-05T12:35:00.000000Z",
      "updated_at": "2023-05-05T12:35:00.000000Z"
    },
    {
      "id": 104,
      "invalid_combination": "M1",
      "modifier_id": 357,
      "created_at": "2023-05-05T12:35:00.000000Z",
      "updated_at": "2023-05-05T12:35:00.000000Z"
    }
  ],
  "created_at": "2023-05-05T12:35:00.000000Z",
  "updated_at": "2023-05-05T12:35:00.000000Z",
  "last_modified": {
    "user": "Maikel Bello",
    "roles": [
      {
        "id": 1,
        "name": "Super User",
        "slug": "superuser",
        "description": "Allows you to administer and manage all the functions of the application",
        "level": 1,
        "created_at": "2023-04-28T11:21:30.000000Z",
        "updated_at": "2023-04-28T11:21:30.000000Z",
        "pivot": {
          "user_id": 12,
          "role_id": 1,
          "created_at": "2023-04-28T11:21:50.000000Z",
          "updated_at": "2023-04-28T11:21:50.000000Z"
        }
      }
    ]
  }
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
    "id": 356,
    "modifier": "z6",
    "special_coding_instructions": "Especial Coding Instructions Modifier 1",
    "active": true,
    "start_date": "2022-07-05",
    "end_date": null,
    "classification": {
      "id": 1,
      "color": "#FFFFFF",
      "name": "General"
    },
    "type": {
      "id": 1,
      "color": "#FFFAEC",
      "name": "Informative"
    },
    "description": "short modifier description",
    "public_note": {
      "id": 16,
      "note": "Note modifier 1",
      "publishable_type": "App\\Models\\Modifier",
      "publishable_id": 356,
      "created_at": "2023-05-05T12:21:06.000000Z",
      "updated_at": "2023-05-05T12:21:06.000000Z",
      "last_modified": {
        "user": "Maikel Bello",
        "roles": [
          {
            "id": 1,
            "name": "Super User",
            "slug": "superuser",
            "description": "Allows you to administer and manage all the functions of the application",
            "level": 1,
            "created_at": "2023-04-28T11:21:30.000000Z",
            "updated_at": "2023-04-28T11:21:30.000000Z",
            "pivot": {
              "user_id": 12,
              "role_id": 1,
              "created_at": "2023-04-28T11:21:50.000000Z",
              "updated_at": "2023-04-28T11:21:50.000000Z"
            }
          }
        ]
      }
    },
    "modifier_invalid_combinations": [
      {
        "id": 101,
        "invalid_combination": "M2",
        "modifier_id": 356,
        "created_at": "2023-05-05T12:21:06.000000Z",
        "updated_at": "2023-05-05T12:21:06.000000Z"
      },
      {
        "id": 102,
        "invalid_combination": "M1",
        "modifier_id": 356,
        "created_at": "2023-05-05T12:21:06.000000Z",
        "updated_at": "2023-05-05T12:21:06.000000Z"
      }
    ],
    "created_at": "2023-05-05T12:21:06.000000Z",
    "updated_at": "2023-05-05T12:21:06.000000Z",
    "last_modified": {
      "user": "Maikel Bello",
      "roles": [
        {
          "id": 1,
          "name": "Super User",
          "slug": "superuser",
          "description": "Allows you to administer and manage all the functions of the application",
          "level": 1,
          "created_at": "2023-04-28T11:21:30.000000Z",
          "updated_at": "2023-04-28T11:21:30.000000Z",
          "pivot": {
            "user_id": 12,
            "role_id": 1,
            "created_at": "2023-04-28T11:21:50.000000Z",
            "updated_at": "2023-04-28T11:21:50.000000Z"
          }
        }
      ]
    }
  },
  ...
]
```

#

<a name="get-all-modifier-server"></a>
## Get all modifier from server

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
    ],
    "count": 10
}
```

#

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

<a name="get-list-modifiers"></a>
## Get list modifiers


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Modifiers found

#

```json
[
    {
        "id": 1,
        "name": "M1"
    },
    {
        "id": 2,
        "name": "M2"
    }
]
```

<a name="update-modifier"></a>
## Update Modifier

### Body request example

```json
{
    "start_date": "2022-07-05",
    "end_date": "2022-08-05",
    "special_coding_instructions": "Especial coding instructions modifier 1 Edited",
    "modifier_invalid_combinations": ["M2"],
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