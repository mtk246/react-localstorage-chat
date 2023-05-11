# Procedure / Service Docs

---

- [Basic data](#basic-data)
- [Create procedure](#create-procedure)
- [Get all procedure](#get-all-procedure)
- [Get all procedure from server](#get-all-procedure-server)
- [Get one procedure](#get-one-procedure)
- [Get one procedure by code](#get-one-procedure-by-code)
- [Get price of procedure](#get-price-of-procedure)
- [Get list mac localities](#get-list-mac-localities)
- [Get list discriminatories](#get-list-discriminatories)
- [Get list genders](#get-list-genders)
- [Get list modifiers](#get-list-modifiers)
- [Get list diagnoses](#get-list-diagnoses)
- [Update procedure](#update-procedure)
- [Change status procedure](#change-status-procedure)
- [Get list procedure](#get-list)
- [Get list insurance label fees](#get-list-insurance-label-fees)
- [Get list insurance companies](#get-list-insurance-companies)
- [Add to company](#add-to-company)
- [Get to company](#get-procedures-to-company)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 |POST    | `Create procedure`  | `/procedure/`     | yes            | Create procedure  |         
| 2 |GET     | `Get all procedure` | `/procedure/`     | yes            | Get all procedures |
| 3 |GET     | `Get all procedure from server`         | `/procedure/get-all-server`|yes|Get all procedure from server|
| 4 |GET     | `Get one procedure` | `/procedure/{id}` | yes            | Get one procedure |
| 5 |GET     | `Get one procedure by code` | `/procedure/get-by-code/{code}` | yes            | Get one procedure by code|
| 6 |GET     | `Get price of procedure` | `/procedure/get-price-of-procedure` | yes            | Get prices of procedure|
| 7 |GET     | `Get list mac localities` | `/procedure/get-list-mac-localities` | yes            | Get list mac localities|
| 8 |GET     | `Get list discriminatories` | `/procedure/get-list-discriminatories` | yes            | Get list discriminatories|
| 9 |GET     | `Get list genders` | `/procedure/get-list-genders` | yes            | Get list genders|
| 10 |GET     | `Get list modifiers` | `/procedure/get-list-modifiers/{code?}` | yes            | Get list modifiers|
| 11 |GET     | `Get list diagnoses` | `/procedure/get-list-diagnoses/{code?}` | yes            | Get list diagnoses|
| 12 |PUT     | `Update procedure`  | `/procedure/{id}` | yes            | Update procedure  |
| 13 |PATCH   | `Change status procedure`  | `/procedure/change-status/{id}` | yes            | Change status procedure  |
| 14 |GET     | `Get list procedure` | `/procedure/get-list/{company_id?}` | yes            | Get list procedure|
| 15 |GET     | `Get list insurance label fees` | `/procedure/get-list-insurance-label-fees` | yes            | Get list insurance label fees|
| 16 |GET | `Get list insurance companies`| `/procedure/get-list-insurance-companies/{procedure_id?}`        |yes            |Get list insurance companies|
| 17 |PATCH | `Add to company`          | `/procedure/add-to-company/{company_id}`|yes|Add procedure/services to company|
| 18 |GET | `Get to company`          | `/procedure/get-to-company/{company_id}`|yes|Get procedure/services to company|


<a name="create-procedure"></a>
## Create procedure

### Body request example

```json
{
    "code": "Code procedure 1",
    "short_description":"Description procedure 1",
    "description": "long and detailed description of procedure 1",
    "insurance_companies": [1, 2],
    "specific_insurance_company": true,
    "start_date": "2022-07-05",
    "end_date": "2022-07-06", // nullable
    "type": 1, // type of preocedure
    "clasifications": {
        "general": 1,
        "specific": 3, // not required
        "sub_specific": null, // not required
    },
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
        "discriminatory_id": 1,
        "frequent_diagnoses": [1,2],
        "frequent_modifiers": [1,2]
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

#

<a name="get-all-procedure-server"></a>
## Get all procedure from server

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
    ],
    "count": 10
}
```

#

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

<a name="get-price-of-procedure"></a>
## Get price of procedure

### Param in header

```json
{
    "Authorization": bearer <token>
}
```
## Param in path

`procedure_id <integer>`
`modifier_id <integer>`
`mac <string>`
`locality_number <string>`
`state <string>`
`fsa <string>`
`counties <string>`

## Example path

>{primary} ?procedure_id=ID&modifier_id=ID&mac=fieldMac&locality_number=fieldLocalityNumber&state=fieldState&fsa=fieldFsa&counties=fieldCounties

## Response

> {success} 200 Mac locality with fees found

#

```json
{
    "id": 185,
    "mac": "01312",
    "state": "NEVADA",
    "fsa": "STATEWIDE",
    "counties": "ALL COUNTIES",
    "created_at": "2022-08-02T12:33:53.000000Z",
    "updated_at": "2022-08-02T12:33:53.000000Z",
    "locality_number": "00",
    "modifier": {
        "id": 2,
        "modifier": "M2",
        "special_coding_instructions": "Especial Coding Instructions Modifier 1 Edited",
        "active": true,
        "created_at": "2022-07-27T13:24:39.000000Z",
        "updated_at": "2022-07-27T13:24:39.000000Z",
        "start_date": "2022-07-06",
        "end_date": "2022-08-06"
    },
    "pivot": {
        "procedure_id": 33,
        "mac_locality_id": 185,
        "modifier_id": 2,
        "created_at": "2022-08-19T23:12:15.000000Z",
        "updated_at": "2022-08-19T23:12:15.000000Z"
    },
    "procedure_fees": [
        {
            "id": 65,
            "fee": "123",
            "procedure_id": 33,
            "created_at": "2022-08-19T20:51:16.000000Z",
            "updated_at": "2022-08-19T20:51:16.000000Z",
            "insurance_label_fee_id": 1,
            "mac_locality_id": 185,
            "fee_start_date": null,
            "fee_end_date": null,
            "insurance_label_fee": {
                "id": 1,
                "description": "Non facility price",
                "insurance_type_id": 1,
                "created_at": "2022-06-21T05:40:50.000000Z",
                "updated_at": "2022-06-21T05:40:50.000000Z"
            }
        },
        {
            "id": 66,
            "fee": "234",
            "procedure_id": 33,
            "created_at": "2022-08-19T20:51:16.000000Z",
            "updated_at": "2022-08-19T20:51:16.000000Z",
            "insurance_label_fee_id": 2,
            "mac_locality_id": 185,
            "fee_start_date": null,
            "fee_end_date": null,
            "insurance_label_fee": {
                "id": 2,
                "description": "Facility price",
                "insurance_type_id": 1,
                "created_at": "2022-06-21T05:40:50.000000Z",
                "updated_at": "2022-06-21T05:40:50.000000Z"
            }
        },
        {
            "id": 67,
            "fee": "345",
            "procedure_id": 33,
            "created_at": "2022-08-19T20:51:16.000000Z",
            "updated_at": "2022-08-19T20:51:16.000000Z",
            "insurance_label_fee_id": 3,
            "mac_locality_id": 185,
            "fee_start_date": null,
            "fee_end_date": null,
            "insurance_label_fee": {
                "id": 3,
                "description": "Non facility limiting charge",
                "insurance_type_id": 1,
                "created_at": "2022-06-21T05:40:50.000000Z",
                "updated_at": "2022-06-21T05:40:50.000000Z"
            }
        },
        {
            "id": 68,
            "fee": "456",
            "procedure_id": 33,
            "created_at": "2022-08-19T20:51:17.000000Z",
            "updated_at": "2022-08-19T20:51:17.000000Z",
            "insurance_label_fee_id": 4,
            "mac_locality_id": 185,
            "fee_start_date": null,
            "fee_end_date": null,
            "insurance_label_fee": {
                "id": 4,
                "description": "Facility limiting charge",
                "insurance_type_id": 1,
                "created_at": "2022-06-21T05:40:50.000000Z",
                "updated_at": "2022-06-21T05:40:50.000000Z"
            }
        },
        {
            "id": 69,
            "fee": "567",
            "procedure_id": 33,
            "created_at": "2022-08-19T20:51:17.000000Z",
            "updated_at": "2022-08-19T20:51:17.000000Z",
            "insurance_label_fee_id": 5,
            "mac_locality_id": 185,
            "fee_start_date": null,
            "fee_end_date": null,
            "insurance_label_fee": {
                "id": 5,
                "description": "Facility rate",
                "insurance_type_id": 2,
                "created_at": "2022-06-21T05:40:50.000000Z",
                "updated_at": "2022-06-21T05:40:50.000000Z"
            }
        },
        {
            "id": 70,
            "fee": "678",
            "procedure_id": 33,
            "created_at": "2022-08-19T20:51:17.000000Z",
            "updated_at": "2022-08-19T20:51:17.000000Z",
            "insurance_label_fee_id": 6,
            "mac_locality_id": 185,
            "fee_start_date": null,
            "fee_end_date": null,
            "insurance_label_fee": {
                "id": 6,
                "description": "Non facility rate",
                "insurance_type_id": 2,
                "created_at": "2022-06-21T05:40:51.000000Z",
                "updated_at": "2022-06-21T05:40:51.000000Z"
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
`state <string>`
`fsa <string>`
`counties <string>`

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

<a name="get-list-discriminatories"></a>
## Get list discriminatories


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Discriminatories found

#

```json
[
    {
        "id": 1,
        "name": "Greater or equal"
    },
    {
        "id": 2,
        "name": "Smaller or equal"
    },
    {
        "id": 3,
        "name": "Range"
    }
]
```

<a name="get-list-genders"></a>
## Get list genders


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Genders found

#

```json
[
    {
        "id": 1,
        "name": "Female"
    },
    {
        "id": 2,
        "name": "Male"
    },
    {
        "id": 3,
        "name": "Both"
    }
]
```

<a name="get-list-modifiers"></a>
## Get list modifiers


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

> {success} 200 Modifiers found

#

```json
[
    {
        "id": 1,
        "color": "#018ECC",
        "name": "M1"
    },
    {
        "id": 2,
        "color": "#FFFFFF",
        "name": "M2"
    },
    {
        "id": 3,
        "color": "#018ECC",
        "name": "M3"
    }
]
```

<a name="get-list-diagnoses"></a>
## Get list diagnoses


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

> {success} 200 Diagnoses found

#

```json
[
    {
        "id": 1,
        "name": "A000"
    },
    {
        "id": 2,
        "name": "A001"
    },
    {
        "id": 3,
        "name": "A009"
    },
    {
        "id": 4,
        "name": "A0100"
    }
]
```

<a name="update-procedure"></a>
## Update procedure

### Body request example

```json
{    
    "short_description":"Description procedure 1",
    "description": "long and detailed description of procedure 1",
    "insurance_companies": [1, 2],
    "specific_insurance_company": true,
    "start_date": "2022-07-05",
    "end_date": "2022-07-06", // nullable
    "type": 1, // type of preocedure
    "clasifications": {
        "general": 1,
        "specific": 3, // not required
        "sub_specific": null, // not required
    },
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
        "discriminatory_id": 1,
        "frequent_diagnoses": [1,2],
        "frequent_modifiers": [1,2]
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

#

<a name="get-list"></a>
## Get list procedures


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "company_id": <integer> optional
}
```

## Example path

>{primary} ?search=code & except_ids[]=1 & except_ids[]=2
## Response

> {success} 200 Procedures found

#

```json
[
    {
        "id": 11,
        "name": "Code procedure2",
        "description": "Description procedure2",
        "price": 231 //Only if the company_id field is specified and there is a price for the procedure
    },
    {
        "id": 12,
        "name": "Code procedure1",
        "description": "Description procedure1"
    },
    {
        "id": 13,
        "name": "Code procedure3",
        "description": "Description procedure3"
    }
]
```

<a name="get-list-insurance-label-fees"></a>
## Get list insurance label fees


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Insurance label fees found

#

```json
[
    {
        "id": 1,
        "name": "Non facility price"
    },
    {
        "id": 2,
        "name": "Facility price"
    },
    {
        "id": 3,
        "name": "Non facility limiting charge"
    },
    {
        "id": 4,
        "name": "Facility limiting charge"
    },
    {
        "id": 5,
        "name": "Facility rate"
    },
    {
        "id": 6,
        "name": "Non facility rate"
    }
]
```

<a name="get-list-insurance-companies"></a>
## Get list insurance companies


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`procedure_id required <integer>`

## Response

> {success} 200 Insurance companies found

#

```json
[
    {
        "id": 1,
        "name": "Fay-Hahn"
    },
    {
        "id": 2,
        "name": "Balistreri-Yost"
    },
    {
        "id": 3,
        "name": "Langosh Ltd"
    }
]
```

<a name="add-to-company"></a>
## Add to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required <integer>`


### Body request example

```json
{
  "mac_localities": [
    {
        "procedure_id": 26,
        "mac": "02102",
        "modifier_id": null,
        "locality_number":"01",
        "state": "ALASKA",
        "fsa": "STATEWIDE",
        "counties": "ALL COUNTIES",
        "procedure_fees": {
            "non_facility_price": "190.2",
            "facility_price": "136.5",
            "non_facility_limiting_charge": "60.5",
            "facility_limiting_charge": "55.9",
            "facility_rate": "60.5",
            "non_facility_rate": "60.5"
        },
        "company_procedure": {
            "price": 133.14,
            "price_percentage": "70"
        },
        "insurance_plan_procedure": {
            "price": 171.18,
            "price_percentage": "90",
            "insurance_plan_id": 1
        },
        "selectedPrice": "Non Facility Rate",
        "selectedPriceContractFee": ""
    }
  ]
}
```

## Response

> {success} 200 Added procedure/service to company

```json
{
    "id": 1,
    "code": "CO-00001-2022",
    "name": "Company First",
    "npi": "2222222222",
    "created_at": "2022-05-02T14:45:27.000000Z",
    "updated_at": "2022-08-28T23:16:16.000000Z",
    "status": false,
    "billing_companies": []
}
```

#

>{warning} 404 error add procedure/service to company


<a name="get-procedures-to-company"></a>
## Get procedures to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required <integer>`


## Response

> {success} 200 Procedure/Service to company found

```json
[
    {
        "procedure_id": 26,
        "modifier_id": 1,
        "mac": "02102",
        "state": "ALASKA",
        "fsa": "STATEWIDE",
        "counties": "ALL COUNTIES",
        "locality_number": "01",
        "procedure_fees": {
            "non_facility_price": "190.2",
            "facility_price": "136.5",
            "non_facility_limiting_charge": "60.5",
            "facility_limiting_charge": "60.5",
            "facility_rate": "",
            "non_facility_rate": ""
        },
        "company_procedure": {
            "price": "133.14",
            "price_percentage": "70"
        },
        "insurance_plan_procedure": {
            "price": "171.18",
            "price_percentage": "90",
            "insurance_company_id": 1,
            "insurance_plan_id": 1
        },
        "selectedPrice": "Facility Price",
        "selectedPriceContractFee": "Non Facility Rate"
    }
]
```

#

>{warning} 404 Error, get procedures to company not found
