# Procedure Docs

---

- [Basic data](#basic-data)
- [Create procedure](#create-procedure)
- [Get all procedure](#get-all-procedure)
- [Get one procedure](#get-one-procedure)
- [Get one procedure by code](#get-one-procedure-by-code)
- [Get list mac localities](#get-list-mac-localities)
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
| 5 |GET     | `Get list mac localities` | `/procedure/get-list-mac-localities` | yes            | Get list mac localities|
| 6 |PUT     | `Update procedure`  | `/procedure/{id}` | yes            | Update procedure  |
| 7 |PATCH   | `Change status procedure`  | `/procedure/change-status/{id}` | yes            | Change status procedure  |


<a name="create-procedure"></a>
## Create procedure

### Body request example

```json
{
    "code": "Code procedure 1",
    "description": "Description procedure 1",
    "insurance_companies": [1, 2],
    "specific_insurance_company": true,
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

<a name="get-list-mac-localities"></a>
## Get list mac localities


### Param in header

```json
{
    "Authorization": bearer <token>
}
```
## Param in path

`mac <string>`
`locality_number <string>`
`state <integer>`
`fsa <string>`
`counties <boolean>`

## Example path

>{primary} ?mac=fieldMac&locality_number=fieldLocalityNumber&state=fieldState&fsa=fieldFsa&counties=fieldCounties

## Response

> {success} 200 Mac localities found

#

```json
{
    "mac": [
        {
            "id": "03302",
            "name": "03302"
        },
        {
            "id": "01182",
            "name": "01182"
        },
        {
            "id": "03502",
            "name": "03502"
        },
        {
            "id": "05302",
            "name": "05302"
        }
    ],
    "state": [
        {
            "id": "SOUTH DAKOTA",
            "name": "SOUTH DAKOTA"
        },
        {
            "id": "SOUTH CAROLINA",
            "name": "SOUTH CAROLINA"
        },
        {
            "id": "MAINE",
            "name": "MAINE"
        },
        {
            "id": "PUERTO RICO",
            "name": "PUERTO RICO"
        }
    ],
    "fsa": [
        {
            "id": "REST OF STATE*",
            "name": "REST OF STATE*"
        },
        {
            "id": "EAST ST. LOUIS",
            "name": "EAST ST. LOUIS"
        },
        {
            "id": "NYC SUBURBS/LONG ISLAND",
            "name": "NYC SUBURBS/LONG ISLAND"
        },
        {
            "id": "SALINAS",
            "name": "SALINAS"
        }
    ],
    "counties": [
        {
            "id": "BROWARD, COLLIER, INDIAN RIVER, LEE, MARTIN, PALM BEACH, AND ST. LUCIE",
            "name": "BROWARD, COLLIER, INDIAN RIVER, LEE, MARTIN, PALM BEACH, AND ST. LUCIE"
        },
        {
            "id": "ALL OTHER COUNTIES",
            "name": "ALL OTHER COUNTIES"
        },
        {
            "id": "SAN LUIS OBISPO",
            "name": "SAN LUIS OBISPO"
        },
        {
            "id": "BERGEN, ESSEX, HUDSON, HUNTERDON, MIDDLESEX, MORRIS, PASSAIC, SOMERSET, SUSSEX, UNION AND WARREN",
            "name": "BERGEN, ESSEX, HUDSON, HUNTERDON, MIDDLESEX, MORRIS, PASSAIC, SOMERSET, SUSSEX, UNION AND WARREN"
        },
        {
            "id": "CLAY, JACKSON AND PLATTE",
            "name": "CLAY, JACKSON AND PLATTE"
        },
        {
            "id": "STANISLAUS",
            "name": "STANISLAUS"
        }
    ]
}
```

<a name="update-procedure"></a>
## Update procedure

### Body request example

```json
{    
    "description": "Description procedure edit",
    "insurance_companies": [1, 2],
    "specific_insurance_company": true,
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