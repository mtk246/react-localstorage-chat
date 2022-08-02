# Procedure Docs

---

- [Basic data](#basic-data)
- [Create procedure](#create-procedure)
- [Get all procedure](#get-all-procedure)
- [Get one procedure](#get-one-procedure)
- [Get one procedure by code](#get-one-procedure-by-code)
- [Get list mac](#get-list-mac)
- [Get list locality number](#get-list-locality-number)
- [Get list state](#get-list-state)
- [Get list fsa](#get-list-fsa)
- [Get list counties](#get-list-counties)
- [Update procedure](#update-procedure)
- [Change status procedure](#change-status-procedure)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 |POST    | `Create procedure`  | `/procedure/`     | yes            | Create procedure  |         
| 2 |GET     | `Get all procedures` | `/procedure/`     | yes            | Get all procedures |
| 3 |GET     | `Get one procedure` | `/procedure/{id}` | yes            | Get one procedure |
| 4 |GET     | `Get one procedure by code` | `/procedure/get-by-code/{code}` | yes            | Get one procedure by code|
| 5 |GET     | `Get list mac localities` | `/procedure/get-list-mac` | yes            | Get list mac localities|
| 6 |GET     | `Get list mac localities` | `/procedure/get-list-locality-number` | yes            | Get list locality number|
| 7 |GET     | `Get list state` | `/procedure/get-list-state` | yes            | Get list state|
| 8 |GET     | `Get list fsa` | `/procedure/get-list-fsa` | yes            | Get list fsa|
| 9 |GET     | `Get list counties` | `/procedure/get-list-counties` | yes            | Get list counties|
| 10 |PUT     | `Update procedure`  | `/procedure/{id}` | yes            | Update procedure  |
| 11 |PATCH   | `Change status procedure`  | `/procedure/change-status/{id}` | yes            | Change status procedure  |


<a name="create-procedure"></a>
## Create procedure

### Body request example

```json
{
    "code": "Code procedure 1",
    "description": "Description procedure 1",
    "companies": [1, 2],
    "specific_company": true,
    "start_date": "2022-07-05",
    "mac_localities": [
        {
            "modifier_id": 1,
            "mac": "02102",
            "locality_number": "01",
            "state": "ALASKA",
            "fsa": "STATEWIDE",
            "counties": "ALL COUNTIES",
            "procedure_fees": {
                "non_facility_price": "190.20",
                "facility_price": "136.50",
                "non_facility_limiting_charge": "60.50",
                "facility_limiting_charge": "190.00",
                "facility_rate": "200.10",
                "non_facility_rate": "55.90"
            }
        }
    ],
    "procedure_considerations": {
        "gender_id": 1,
        "age_init": "2020",
        "age_end": null,
        "discriminatory_id": 1
    },
    "modifiers": [1,2,3],
    "diagnoses": [5,6,7],
    "note": "Note procedure 1"
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 Procedure created


#

```json
{
    "code": "Code procedure1",
    "start_date": "2022-07-05",
    "description": "Description procedure",
    "updated_at": "2022-08-02T13:25:35.000000Z",
    "created_at": "2022-08-02T13:25:35.000000Z",
    "id": 12
}
```


#

<a name="get-all-procedure"></a>
## Get all procedures

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 procedures found

#


```json
[
    {
        "id": 12,
        "code": "Code procedure1",
        "description": "Description procedure",
        "active": true,
        "created_at": "2022-08-02T13:25:35.000000Z",
        "updated_at": "2022-08-02T13:25:35.000000Z",
        "start_date": "2022-07-05",
        "end_date": null,
        "public_note": {
            "id": 19,
            "note": "Note procedure 1",
            "publishable_type": "App\\Models\\Procedure",
            "publishable_id": 12,
            "created_at": "2022-08-02T13:25:35.000000Z",
            "updated_at": "2022-08-02T13:25:35.000000Z"
        }
    },
    {
        "id": 11,
        "code": "Code procedure2",
        "description": "Description procedure",
        "active": true,
        "created_at": "2022-08-02T13:24:48.000000Z",
        "updated_at": "2022-08-02T13:24:48.000000Z",
        "start_date": "2022-07-05",
        "end_date": null,
        "public_note": {
            "id": 18,
            "note": "Note procedure 2",
            "publishable_type": "App\\Models\\Procedure",
            "publishable_id": 11,
            "created_at": "2022-08-02T13:24:48.000000Z",
            "updated_at": "2022-08-02T13:24:48.000000Z"
        }
    }
]
```

<a name="get-one-procedure"></a>
## Get One procedure

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

> {success} 200 procedure found

#


```json
{
    "id": 12,
    "code": "Code procedure1",
    "description": "Description procedure edit",
    "active": true,
    "created_at": "2022-08-02T13:25:35.000000Z",
    "updated_at": "2022-08-02T13:56:14.000000Z",
    "start_date": "2022-07-05",
    "end_date": null,
    "public_note": {
        "id": 19,
        "note": "Note procedure 1",
        "publishable_type": "App\\Models\\Procedure",
        "publishable_id": 12,
        "created_at": "2022-08-02T13:25:35.000000Z",
        "updated_at": "2022-08-02T13:25:35.000000Z"
    },
    "procedure_cosiderations": [
        {
            "id": 3,
            "procedure_id": 12,
            "gender_id": 1,
            "age_init": 2020,
            "age_end": null,
            "created_at": "2022-08-02T13:25:35.000000Z",
            "updated_at": "2022-08-02T13:25:35.000000Z",
            "discriminatory_id": 1
        }
    ],
    "companies": [],
    "diagnoses": [
        {
            "id": 1,
            "code": "A000",
            "description": "Cholera due to vibrio cholerae 01, biovar cholerae",
            "active": true,
            "created_at": "2022-06-15T20:43:39.000000Z",
            "updated_at": "2022-06-15T20:43:39.000000Z",
            "start_date": null,
            "end_date": null,
            "pivot": {
                "procedure_id": 12,
                "diagnoses_id": 1,
                "created_at": "2022-08-02T13:25:35.000000Z",
                "updated_at": "2022-08-02T13:25:35.000000Z"
            }
        }
    ],
    "modifiers": [
        {
            "id": 1,
            "modifier": "M1",
            "special_coding_instructions": "Especial Coding Instructions Modifier 1 Edited",
            "active": true,
            "created_at": "2022-06-13T11:39:28.000000Z",
            "updated_at": "2022-06-20T07:36:26.000000Z",
            "start_date": null,
            "end_date": null,
            "pivot": {
                "procedure_id": 12,
                "modifier_id": 1,
                "created_at": "2022-08-02T13:25:35.000000Z",
                "updated_at": "2022-08-02T13:25:35.000000Z"
            }
        },
        {
            "id": 2,
            "modifier": "M2",
            "special_coding_instructions": "Especial Coding Instructions Modifier 1 Edited",
            "active": true,
            "created_at": "2022-07-27T13:24:39.000000Z",
            "updated_at": "2022-07-27T13:24:39.000000Z",
            "start_date": "2022-07-06",
            "end_date": "2022-08-06",
            "pivot": {
                "procedure_id": 12,
                "modifier_id": 2,
                "created_at": "2022-08-02T13:25:35.000000Z",
                "updated_at": "2022-08-02T13:25:35.000000Z"
            }
        },
        {
            "id": 3,
            "modifier": "M3",
            "special_coding_instructions": "Especial Coding Instructions Modifier 1 Edited2",
            "active": true,
            "created_at": "2022-08-01T15:54:05.000000Z",
            "updated_at": "2022-08-01T16:03:36.000000Z",
            "start_date": "2022-07-05",
            "end_date": "2022-07-05",
            "pivot": {
                "procedure_id": 12,
                "modifier_id": 3,
                "created_at": "2022-08-02T13:25:35.000000Z",
                "updated_at": "2022-08-02T13:25:35.000000Z"
            }
        }
    ],
    "mac_localities": [
        {
            "id": 114,
            "mac": "02102",
            "state": "ALASKA",
            "fsa": "STATEWIDE",
            "counties": "ALL COUNTIES",
            "created_at": "2022-08-02T12:33:51.000000Z",
            "updated_at": "2022-08-02T12:33:51.000000Z",
            "locality_number": "01",
            "pivot": {
                "procedure_id": 12,
                "mac_locality_id": 114,
                "created_at": "2022-08-02T13:56:14.000000Z",
                "updated_at": "2022-08-02T13:56:14.000000Z"
            }
        }
    ]
}
```

<a name="get-one-procedure-by-code"></a>
## Get One procedure by code

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

> {success} 200 procedure found

#


```json
{
    "id": 12,
    "code": "Code procedure1",
    "description": "Description procedure edit",
    "active": true,
    "created_at": "2022-08-02T13:25:35.000000Z",
    "updated_at": "2022-08-02T13:56:14.000000Z",
    "start_date": "2022-07-05",
    "end_date": null,
    "public_note": {
        "id": 19,
        "note": "Note procedure 1",
        "publishable_type": "App\\Models\\Procedure",
        "publishable_id": 12,
        "created_at": "2022-08-02T13:25:35.000000Z",
        "updated_at": "2022-08-02T13:25:35.000000Z"
    },
    "procedure_cosiderations": [
        {
            "id": 3,
            "procedure_id": 12,
            "gender_id": 1,
            "age_init": 2020,
            "age_end": null,
            "created_at": "2022-08-02T13:25:35.000000Z",
            "updated_at": "2022-08-02T13:25:35.000000Z",
            "discriminatory_id": 1
        }
    ],
    "companies": [],
    "diagnoses": [
        {
            "id": 1,
            "code": "A000",
            "description": "Cholera due to vibrio cholerae 01, biovar cholerae",
            "active": true,
            "created_at": "2022-06-15T20:43:39.000000Z",
            "updated_at": "2022-06-15T20:43:39.000000Z",
            "start_date": null,
            "end_date": null,
            "pivot": {
                "procedure_id": 12,
                "diagnoses_id": 1,
                "created_at": "2022-08-02T13:25:35.000000Z",
                "updated_at": "2022-08-02T13:25:35.000000Z"
            }
        }
    ],
    "modifiers": [
        {
            "id": 1,
            "modifier": "M1",
            "special_coding_instructions": "Especial Coding Instructions Modifier 1 Edited",
            "active": true,
            "created_at": "2022-06-13T11:39:28.000000Z",
            "updated_at": "2022-06-20T07:36:26.000000Z",
            "start_date": null,
            "end_date": null,
            "pivot": {
                "procedure_id": 12,
                "modifier_id": 1,
                "created_at": "2022-08-02T13:25:35.000000Z",
                "updated_at": "2022-08-02T13:25:35.000000Z"
            }
        },
        {
            "id": 2,
            "modifier": "M2",
            "special_coding_instructions": "Especial Coding Instructions Modifier 1 Edited",
            "active": true,
            "created_at": "2022-07-27T13:24:39.000000Z",
            "updated_at": "2022-07-27T13:24:39.000000Z",
            "start_date": "2022-07-06",
            "end_date": "2022-08-06",
            "pivot": {
                "procedure_id": 12,
                "modifier_id": 2,
                "created_at": "2022-08-02T13:25:35.000000Z",
                "updated_at": "2022-08-02T13:25:35.000000Z"
            }
        },
        {
            "id": 3,
            "modifier": "M3",
            "special_coding_instructions": "Especial Coding Instructions Modifier 1 Edited2",
            "active": true,
            "created_at": "2022-08-01T15:54:05.000000Z",
            "updated_at": "2022-08-01T16:03:36.000000Z",
            "start_date": "2022-07-05",
            "end_date": "2022-07-05",
            "pivot": {
                "procedure_id": 12,
                "modifier_id": 3,
                "created_at": "2022-08-02T13:25:35.000000Z",
                "updated_at": "2022-08-02T13:25:35.000000Z"
            }
        }
    ],
    "mac_localities": [
        {
            "id": 114,
            "mac": "02102",
            "state": "ALASKA",
            "fsa": "STATEWIDE",
            "counties": "ALL COUNTIES",
            "created_at": "2022-08-02T12:33:51.000000Z",
            "updated_at": "2022-08-02T12:33:51.000000Z",
            "locality_number": "01",
            "pivot": {
                "procedure_id": 12,
                "mac_locality_id": 114,
                "created_at": "2022-08-02T13:56:14.000000Z",
                "updated_at": "2022-08-02T13:56:14.000000Z"
            }
        }
    ]
}
```

<a name="get-list-mac"></a>
## Get list mac


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Mac localities found

#

```json
[
    {
        "id": 113,
        "name": "10112"
    },
    {
        "id": 114,
        "name": "02102"
    },
    {
        "id": 115,
        "name": "03102"
    },
    {
        "id": 116,
        "name": "07102"
    }
]
```

<a name="get-list-locality-number"></a>
## Get list locality numbers


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Locality numbers found

#

```json
[
    {
        "id": 113,
        "name": "00"
    },
    {
        "id": 114,
        "name": "01"
    },
    {
        "id": 115,
        "name": "00"
    },
    {
        "id": 116,
        "name": "13"
    },
    {
        "id": 117,
        "name": "26"
    },
    {
        "id": 118,
        "name": "18"
    },
    {
        "id": 119,
        "name": "52"
    }
]
```

<a name="get-list-state"></a>
## Get list state


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 State found

#

```json
[
    {
        "id": 113,
        "name": "ALABAMA"
    },
    {
        "id": 114,
        "name": "ALASKA"
    },
    {
        "id": 115,
        "name": "ARIZONA"
    },
    {
        "id": 116,
        "name": "ARKANSAS"
    },
    {
        "id": 117,
        "name": "CALIFORNIA"
    }
]
```

<a name="get-list-fsa"></a>
## Get list fsa


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Fee Schedule Area found

#

```json
[
    {
        "id": 113,
        "name": "STATEWIDE"
    },
    {
        "id": 114,
        "name": "STATEWIDE"
    },
    {
        "id": 115,
        "name": "STATEWIDE"
    },
    {
        "id": 116,
        "name": "STATEWIDE"
    },
    {
        "id": 117,
        "name": "LOS ANGELES-LONG BEACH-ANAHEIM (ORANGE CNTY)"
    },
    {
        "id": 118,
        "name": "LOS ANGELES-LONG BEACH-ANAHEIM (LOS ANGELES CNTY)"
    }
]
```

<a name="get-list-counties"></a>
## Get list counties


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Counties found

#

```json
[
    {
        "id": 116,
        "name": "ALL COUNTIES"
    },
    {
        "id": 117,
        "name": "ORANGE"
    },
    {
        "id": 118,
        "name": "LOS ANGELES"
    },
    {
        "id": 119,
        "name": "MARIN"
    },
    {
        "id": 120,
        "name": "ALAMEDA AND CONTRA COSTA"
    },
    {
        "id": 121,
        "name": "SAN FRANCISCO"
    },
    {
        "id": 122,
        "name": "SAN MATEO"
    }
]
```

<a name="update-procedure"></a>
## Update procedure

### Body request example

```json
{    
    "description": "Description procedure edit",
    "companies": [1, 2],
    "specific_company": true,
    "start_date": "2022-07-05",
    "mac_localities": [
        {
            "modifier_id": 1,
            "mac": "02102",
            "locality_number": "01",
            "state": "ALASKA",
            "fsa": "STATEWIDE",
            "counties": "ALL COUNTIES",
            "procedure_fees": {
                "non_facility_price": "190.20",
                "facility_price": "136.50",
                "non_facility_limiting_charge": "60.50",
                "facility_limiting_charge": "190.00",
                "facility_rate": "200.10",
                "non_facility_rate": "55.90"
            }
        }
    ],
    "procedure_considerations": {
        "gender_id": 1,
        "age_init": "2020",
        "age_end": null,
        "discriminatory_id": 1
    },
    "modifiers": [1,2,3],
    "diagnoses": [1],
    "note": "Note procedure 1"
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

> {success} 200 procedure updated

#

```json
{
    "id": 12,
    "code": "Code procedure1",
    "description": "Description procedure edit",
    "active": true,
    "created_at": "2022-08-02T13:25:35.000000Z",
    "updated_at": "2022-08-02T13:56:14.000000Z",
    "start_date": "2022-07-05",
    "end_date": null
}
```

<a name="change-status-procedure"></a>
## Change status procedure


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