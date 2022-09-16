# Claim Docs

---

- [Basic data](#basic-data)
- [Create claim](#create-claim)
- [Get list rev centers](#get-list-rev-centers)
- [Get list type of services](#get-list-type-of-services)
- [Get list place of services](#get-list-place-of-services)
- [Get list type formats](#get-list-type-formats)
- [Get list status claim](#get-list-status-claim)
- [Get all claim](#get-all-claim)
- [Get one claim](#get-one-claim)
- [Update claim](#update-claim)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |
| 1 |POST    | `Create claim`  | `/claim/`     | yes            | Create claim  |
| 2 |GET     | `Get list rev centers`  | `/claim/get-list-rev-centers`     | yes            | Get list rev centers |
| 3 |GET     | `Get list type of services`  | `/claim/get-list-type-of-services`     | yes            | Get list type of services |
| 4 |GET     | `Get list place of services`  | `/claim/get-list-place-of-services`     | yes            | Get list place of services |
| 5 |GET     | `Get list types formats`  | `/claim/get-list-type-formats`     | yes            | Get list type formats |
| 6 |GET     | `Get list status claim`  | `/claim/get-list-status`     | yes            | Get list status claim |
| 7 |GET     | `Get all claims` | `/claim/`     | yes            | Get all claims |
| 8 |GET     | `Get one claim` | `/claim/{id}` | yes            | Get one claim |
| 9 |PUT     | `Update claim`  | `/claim/{id}` | yes            | Update claim  |


<a name="create-claim"></a>
## Create claim

### Body request example

```json
{
    "format": 1,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_id": 1,
    "diagnoses": [1,2],
    "insurance_policies": [8,10],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "modifier_id": 1,
            "rev_center_id": 2,
            "place_of_service_id": null,
            "type_of_service_id": 2,
            "diagnostic_pointer_id": null,
            "std_id": null,
            "price": 200
        }
    ]
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
    "control_number": "000000001",
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_id": 1,
    "updated_at": "2022-09-16T13:23:19.000000Z",
    "created_at": "2022-09-16T13:23:19.000000Z",
    "id": 1
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
[]
```

#

<a name="get-list-type-formats"></a>
## Get list type formats


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Type formats of Claim found

#

```json
[
    {
        "id": 1,
        "name": "837P"
    },
    {
        "id": 2,
        "name": "837I"
    }
]
```

#

<a name="get-list-status-claim"></a>
## Get list status


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Status of Claim found

#

```json
[
    {
        "id": 1,
        "name": "Draft"
    },
    {
        "id": 2,
        "name": "Verified - Not submitted"
    },
    {
        "id": 3,
        "name": "Submitted - In approval"
    },
    {
        "id": 4,
        "name": "Accepted - Pending adjudication"
    },
    {
        "id": 5,
        "name": "Approved - Finished"
    },
    {
        "id": 6,
        "name": "Rejected"
    },
    {
        "id": 7,
        "name": "Denied - Under Review"
    },
    {
        "id": 8,
        "name": "Denied - Finished"
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
[
    {
        "id": 1,
        "qr_claim": null,
        "control_number": "000000001",
        "submitter_name": null,
        "submitter_contact": null,
        "submitter_phone": null,
        "company_id": 1,
        "facility_id": 1,
        "patient_id": 2,
        "health_professional_id": 1,
        "insurance_company_id": null,
        "claim_formattable_type": null,
        "claim_formattable_id": null,
        "created_at": "2022-09-16T13:23:19.000000Z",
        "updated_at": "2022-09-16T13:23:19.000000Z",
        "claim_services": [
            {
                "id": 1,
                "from_service": "2022-07-05",
                "to_service": "2022-07-05",
                "price": "200.00",
                "std_id": null,
                "claim_id": 1,
                "modifier_id": 1,
                "procedure_id": 11,
                "rev_center_id": 2,
                "place_of_service_id": null,
                "type_of_service_id": 2,
                "diagnostic_pointer_id": null,
                "created_at": "2022-09-16T13:23:19.000000Z",
                "updated_at": "2022-09-16T13:23:19.000000Z"
            }
        ],
        "company": {
            "id": 1,
            "code": "CO-00001-2022",
            "name": "Company First",
            "npi": "2222222222",
            "created_at": "2022-05-02T14:45:27.000000Z",
            "updated_at": "2022-08-28T23:16:16.000000Z",
            "status": false,
            "billing_companies": []
        },
        "patient": {
            "id": 2,
            "driver_license": "A123",
            "user_id": 21,
            "created_at": "2022-04-25T20:36:51.000000Z",
            "updated_at": "2022-04-25T20:36:51.000000Z",
            "credit_score": false,
            "code": null,
            "status": false,
            "last_modified": {
                "user": "Johan Julian",
                "roles": [
                    {
                        "id": 2,
                        "name": "Billing Manager",
                        "slug": "billingmanager",
                        "description": "Allows you to administer and manage all the functions of the application associated with a billing company",
                        "level": 2,
                        "created_at": "2022-04-20T21:52:51.000000Z",
                        "updated_at": "2022-04-20T21:52:51.000000Z",
                        "pivot": {
                            "user_id": 2,
                            "role_id": 2,
                            "created_at": "2022-07-20T21:03:58.000000Z",
                            "updated_at": "2022-07-20T21:03:58.000000Z"
                        }
                    }
                ]
            },
            "billing_companies": []
        }
    }
]
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
{
    "id": 1,
    "qr_claim": null,
    "control_number": "000000001",
    "submitter_name": null,
    "submitter_contact": null,
    "submitter_phone": null,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_id": 1,
    "insurance_company_id": null,
    "claim_formattable_type": null,
    "claim_formattable_id": null,
    "created_at": "2022-09-16T13:23:19.000000Z",
    "updated_at": "2022-09-16T13:23:19.000000Z",
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
            "last_modified": {
                "user": "Console",
                "roles": []
            },
            "pivot": {
                "claim_id": 1,
                "diagnosis_id": 1,
                "created_at": "2022-09-16T13:23:19.000000Z",
                "updated_at": "2022-09-16T13:23:19.000000Z"
            }
        },
        {
            "id": 2,
            "code": "A001",
            "description": "Cholera due to vibrio cholerae 01, biovar eltor",
            "active": true,
            "created_at": "2022-06-15T20:43:39.000000Z",
            "updated_at": "2022-06-15T20:43:39.000000Z",
            "start_date": null,
            "end_date": null,
            "last_modified": {
                "user": "Console",
                "roles": []
            },
            "pivot": {
                "claim_id": 1,
                "diagnosis_id": 2,
                "created_at": "2022-09-16T13:23:19.000000Z",
                "updated_at": "2022-09-16T13:23:19.000000Z"
            }
        }
    ],
    "claim_services": [
        {
            "id": 2,
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "price": "200.00",
            "std_id": null,
            "claim_id": 1,
            "modifier_id": 1,
            "procedure_id": 11,
            "rev_center_id": 2,
            "place_of_service_id": null,
            "type_of_service_id": 2,
            "diagnostic_pointer_id": null,
            "created_at": "2022-09-16T13:36:43.000000Z",
            "updated_at": "2022-09-16T13:36:43.000000Z"
        }
    ],
    "insurance_policies": [
        {
            "id": 10,
            "policy_number": "369851",
            "group_number": "1234",
            "payment_responsibility_level_code": null,
            "eff_date": "2020-01-23",
            "end_date": "2022-01-23",
            "copay": "200",
            "release_info": false,
            "assign_benefits": false,
            "insurance_plan_id": 1,
            "created_at": "2022-09-05T15:13:18.000000Z",
            "updated_at": "2022-09-05T15:13:18.000000Z",
            "insurance_company_name": "Dsfsdfsfeddsddfg",
            "insurance_company_id": 1
        }
    ]
}
```

<a name="update-claim"></a>
## Update claim

### Body request example

```json
{
    "format": 1,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_id": 1,
    "diagnoses": [1,2],
    "insurance_policies": [8,10],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "modifier_id": 1,
            "rev_center_id": 2,
            "place_of_service_id": null,
            "type_of_service_id": 2,
            "diagnostic_pointer_id": null,
            "std_id": null,
            "price": 200
        }
    ]
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

> {success} 200 claim updated

#

```json
{
    "id": 1,
    "qr_claim": null,
    "control_number": "000000001",
    "submitter_name": null,
    "submitter_contact": null,
    "submitter_phone": null,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_id": 1,
    "insurance_company_id": null,
    "claim_formattable_type": null,
    "claim_formattable_id": null,
    "created_at": "2022-09-16T13:23:19.000000Z",
    "updated_at": "2022-09-16T13:23:19.000000Z"
}
```