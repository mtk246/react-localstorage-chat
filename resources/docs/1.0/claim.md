# Claim Docs

---

- [Basic data](#basic-data)
- [Create claim](#create-claim)
- [Get list type of services](#get-list-type-of-services)
- [Get list place of services](#get-list-place-of-services)
- [Get list type formats](#get-list-type-formats)
- [Get list type diags](#get-list-type-diags)
- [Get list status claim](#get-list-status-claim)
- [Get all claim](#get-all-claim)
- [Get one claim](#get-one-claim)
- [Update claim](#update-claim)
- [Save as draft claim](#save-as-draft-claim)
- [Update as draft claim](#update-as-draft-claim)
- [Draft and Check eligibility](#draft-check-eligibility-claim)
- [Validation claim](#validation-claim)
- [verify and register claim](#verify-register)
- [Show claim report preview](#preview-claim)



<a name="basic-data"></a>
## Basic data to make request


| #  | METHOD | Name              | URL             | Token required | Description     |
| :  |        |                   |                 |                |                 |
| 1  |POST    | `Create claim`  | `/claim/`     | yes            | Create claim  |
| 2  |GET     | `Get list type of services`  | `/claim/get-list-type-of-services`     | yes            | Get list type of services |
| 3  |GET     | `Get list place of services`  | `/claim/get-list-place-of-services`     | yes            | Get list place of services |
| 4  |GET     | `Get list types formats`  | `/claim/get-list-type-formats`     | yes            | Get list type formats |
| 5  |GET     | `Get list types diags`  | `/injury/get-list-type-diags`     | yes            | Get list type diags |
| 6  |GET     | `Get list status claim`  | `/claim/get-list-status`     | yes            | Get list status claim |
| 7  |GET     | `Get all claims` | `/claim/{status?}/{subStatus?}`     | yes            | Get all claims |
| 8  |GET     | `Get one claim` | `/claim/{id}` | yes            | Get one claim |
| 9  |PUT     | `Update claim`  | `/claim/{id}` | yes            | Update claim  |
| 10  |POST    | `Save as draft claim`  | `/claim/draft/`     | yes            | Save as draft claim  |
| 11 |PUT     | `Update as draft claim`  | `/claim/draft/{id}` | yes            | Update as draft claim  |
| 12 |POST    | `Save as draft and check eligibility claim`  | `/claim/draft-check-eligibility`     | yes            | Save as draft and check eligibility claim |
| 13 |GET     | `Validation claim`  | `/claim/validation/{claim_id}`     | yes            | Validation claim |
| 14 |PUT     | `Verify and register claim`  | `/claim/verify-register/{id}` | yes            | Verify and register claim  |
| 15 |POST    | `Show claim report preview`  | `/claim/show-claim-preview` | yes            | Show claim report  |


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
    "diagnoses": [
        {
            "item": "A",
            "diagnosis_id": 1

        },
        {
            "item": "B",
            "diagnosis_id": 3

        }
    ],
    "insurance_policies": [8,10],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "modifier_id": 1,
            "rev": 2,
            "place_of_service_id": 3,
            "type_of_service_id": 2,
            "diagnostic_pointers": ["A", "B"],
            "epstd": 1, //1,2,3
            "price": 200
        }
    ],
    "will_report_any_injury": true,
    "injuries": [
        {
            "diag_date": "2022-07-05",
            "diagnosis_id": 1,
            "type_diag_id": 2,
            "note": "Note of injury"
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
        "name": "0 - Whole Blood"
    },
    {
        "id": 2,
        "name": "1 - Medical Care"
    },
    {
        "id": 3,
        "name": "2 - Surgery"
    },
    {
        "id": 4,
        "name": "3 - Consultation"
    },
    {
        "id": 5,
        "name": "4 - Diagnostic Radiology"
    },
    {
        "id": 6,
        "name": "5 - Diagnostic Laboratory"
    },
    {
        "id": 7,
        "name": "6 - Therapeutic Radiology"
    },
    {
        "id": 8,
        "name": "7 - Anesthesia"
    },
    {
        "id": 9,
        "name": "8 - Assistant at Surgery"
    },
    {
        "id": 10,
        "name": "9 - Other Medical Items or Services"
    },
    {
        "id": 11,
        "name": "A - Used DME"
    },
    {
        "id": 12,
        "name": "B - High Risk Screening Mammography"
    },
    {
        "id": 13,
        "name": "C - Low Risk Screening Mammography"
    },
    {
        "id": 14,
        "name": "D - Ambulance"
    },
    {
        "id": 15,
        "name": "E - Enteral/Parenteral Nutrients/Supplies"
    },
    {
        "id": 16,
        "name": "F - Ambulatory Surgical Center (Facility Usage for Surgical Services)"
    },
    {
        "id": 17,
        "name": "G - Immunosuppressive Drugs"
    },
    {
        "id": 18,
        "name": "H - Hospice"
    },
    {
        "id": 19,
        "name": "J - Diabetic Shoes"
    },
    {
        "id": 20,
        "name": "K - Hearing Items and Services"
    },
    {
        "id": 21,
        "name": "L - ESRD Supplies"
    },
    {
        "id": 22,
        "name": "M - Monthly Capitation Payment for Dialysis"
    },
    {
        "id": 23,
        "name": "N - Kidney Donor"
    },
    {
        "id": 24,
        "name": "P - Lump Sum Purchase of DME, Prosthetics, Orthotics"
    },
    {
        "id": 25,
        "name": "Q - Vision Items or Services"
    },
    {
        "id": 26,
        "name": "R - Rental of DME"
    },
    {
        "id": 27,
        "name": "S - Surgical Dressings or Other Medical Supplies"
    },
    {
        "id": 28,
        "name": "T - Outpatient Mental Health Treatment Limitation"
    },
    {
        "id": 29,
        "name": "U - Occupational Therapy"
    },
    {
        "id": 30,
        "name": "V - Pneumococcal/Flu Vaccine"
    },
    {
        "id": 31,
        "name": "W - Physical Therapy"
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

> {success} 200 Place of Service found

#

```json
[
    {
        "id": 1,
        "name": "03 - School"
    },
    {
        "id": 2,
        "name": "04 - Homeless Shelter"
    },
    {
        "id": 3,
        "name": "05 - Indian Health Service Free-Standing Facility"
    },
    {
        "id": 4,
        "name": "06 - Indian Health Service Provider-Based Facility"
    },
    {
        "id": 5,
        "name": "07 - Tribal 638 Free-Standing Facility"
    },
    {
        "id": 6,
        "name": "08 - Tribal 638 Provider Based-Facility"
    },
    {
        "id": 7,
        "name": "11 - Office Visit"
    },
    {
        "id": 8,
        "name": "12 - Home"
    },
    {
        "id": 9,
        "name": "13 - Assisted Living"
    },
    {
        "id": 10,
        "name": "14 - Group Home"
    },
    {
        "id": 11,
        "name": "15 - Mobile Unit"
    },
    {
        "id": 12,
        "name": "20 - Urgent Care Facility"
    },
    {
        "id": 13,
        "name": "21 - Inpatient Hospital"
    },
    {
        "id": 14,
        "name": "22 - Outpatient Hospital"
    },
    {
        "id": 15,
        "name": "23 - Emergency Room"
    },
    {
        "id": 16,
        "name": "24 - Ambulatory Surgical Center"
    },
    {
        "id": 17,
        "name": "25 - Birthing Center"
    },
    {
        "id": 18,
        "name": "26 - Military Treatment Facility"
    },
    {
        "id": 19,
        "name": "31 - Skilled Nursing Facility"
    },
    {
        "id": 20,
        "name": "32 - Nursing Facility"
    },
    {
        "id": 21,
        "name": "33 - Custodial Care Facility"
    },
    {
        "id": 22,
        "name": "34 - Hospice"
    },
    {
        "id": 23,
        "name": "41 - Ambulance - Land"
    },
    {
        "id": 24,
        "name": "42 - Ambulance - Air or Water"
    },
    {
        "id": 25,
        "name": "50 - Federally Qualified Health Center"
    },
    {
        "id": 26,
        "name": "51 - Inpatient Psychiatric Facility"
    },
    {
        "id": 27,
        "name": "52 - Psychiatric Facility Partial Hospitalization"
    },
    {
        "id": 28,
        "name": "53 - Community Mental Health Center"
    },
    {
        "id": 29,
        "name": "54 - Intermediate Care Facility"
    },
    {
        "id": 30,
        "name": "55 - Residential Substance Abuse Treatment Facility"
    },
    {
        "id": 31,
        "name": "56 - Psychiatric Residential Treatment Center"
    },
    {
        "id": 32,
        "name": "60 - Mass Immunization Center"
    },
    {
        "id": 33,
        "name": "61 - Comprehensive Inpatient Rehab Facility"
    },
    {
        "id": 34,
        "name": "62 - Comprehensive Outpatient Rehab Facility"
    },
    {
        "id": 35,
        "name": "65 - End Stage Renal Disease Treatment Facility"
    },
    {
        "id": 36,
        "name": "71 - State or Local Public Health Clinic"
    },
    {
        "id": 37,
        "name": "2  - Rural Health Clinic"
    },
    {
        "id": 38,
        "name": "81 - Independent Laboratory"
    },
    {
        "id": 39,
        "name": "99 - Other Unlisted Facility"
    }
]
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
        "name": "CMS-1500 / 837P"
    },
    {
        "id": 2,
        "name": "UB-04 / 837I"
    }
]
```

#

<a name="get-list-type-diags"></a>
## Get list type diags


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Type diags of injury found

#

```json
[
    {
        "id": 1,
        "name": "A - Allergy"
    },
    {
        "id": 2,
        "name": "C - Chronic"
    },
    {
        "id": 3,
        "name": "D - Problem List"
    },
    {
        "id": 4,
        "name": "O - Other"
    },
    {
        "id": 5,
        "name": "P - Pre Existing Condition"
    },
    {
        "id": 6,
        "name": "S - Self Limiting"
    },
    {
        "id": 7,
        "name": "U - Acute"
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

## Param in path

```json
{
    "status": optional <array>       //[1,2]
    "subStatus": optional <array>    //[1,2]
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
        "private_note": "Nota 1",
        "status": "Draft",
        "status_history": [
            {
                "note": "Nota 1",
                "status": "Draft",
                "last_modified": {
                    "user": "Henry Paredes",
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
                                "user_id": 14,
                                "role_id": 2,
                                "created_at": "2022-07-20T21:04:22.000000Z",
                                "updated_at": "2022-07-20T21:04:22.000000Z"
                            }
                        }
                    ]
                }
            }
        ],
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
    "private_note": "Nota 1",
    "status": "Draft",
    "status_history": [
        {
            "note": "Nota 1",
            "status": "Draft",
            "last_modified": {
                "user": "Henry Paredes",
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
                            "user_id": 14,
                            "role_id": 2,
                            "created_at": "2022-07-20T21:04:22.000000Z",
                            "updated_at": "2022-07-20T21:04:22.000000Z"
                        }
                    }
                ]
            }
        }
    ],
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
    "diagnoses": [
        {
            "item": "A",
            "diagnosis_id": 1

        },
        {
            "item": "B",
            "diagnosis_id": 3

        }
    ],
    "insurance_policies": [8,10],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "modifier_id": 1,
            "rev": 2,
            "place_of_service_id": 3,
            "type_of_service_id": 2,
            "diagnostic_pointers": ["A", "B"],
            "epstd": 1, //1,2,3
            "price": 200
        }
    ],
    "will_report_any_injury": true,
    "injuries": [
        {
            "diag_date": "2022-07-05",
            "diagnosis_id": 1,
            "type_diag_id": 2,
            "note": "Note of injury"
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
#

<a name="save-as-draft-claim"></a>
## Save as draft claim

### Body request example

```json
{
    "format": 1,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_id": 1,
    "diagnoses": [
        {
            "item": "A",
            "diagnosis_id": 1

        },
        {
            "item": "B",
            "diagnosis_id": 3

        }
    ],
    "insurance_policies": [8,10],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "modifier_id": 1,
            "rev": 2,
            "place_of_service_id": 3,
            "type_of_service_id": 2,
            "diagnostic_pointers": ["A", "B"],
            "epstd": 1,
            "price": 200
        }
    ],
    "will_report_any_injury": true,
    "injuries": [
        {
            "diag_date": "2022-07-05",
            "diagnosis_id": 1,
            "type_diag_id": 2,
            "note": "Note of injury"
        }
    ],
    "private_note": "Note claim"
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

<a name="update-as-draft-claim"></a>
## Update as draft claim

### Body request example

```json
{
    "format": 1,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_id": 1,
    "diagnoses": [
        {
            "item": "A",
            "diagnosis_id": 1

        },
        {
            "item": "B",
            "diagnosis_id": 3

        }
    ],
    "insurance_policies": [8,10],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "modifier_id": 1,
            "rev": 2,
            "place_of_service_id": 3,
            "type_of_service_id": 2,
            "diagnostic_pointers": ["A", "B"],
            "epstd": 1, //1,2,3
            "price": 200
        }
    ],
    "will_report_any_injury": true,
    "injuries": [
        {
            "diag_date": "2022-07-05",
            "diagnosis_id": 1,
            "type_diag_id": 2,
            "note": "Note of injury"
        }
    ],
    "private_note": "Note claim 1"
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
#

<a name="draft-check-eligibility-claim"></a>
## Save as draft and check eligibility claim

### Param in header

```json
{
    "Authorization": bearer <token>
}
```
### Body request example

```json
{
    "format": 1,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_id": 1,
    "diagnoses": [
        {
            "item": "A",
            "diagnosis_id": 1

        },
        {
            "item": "B",
            "diagnosis_id": 3

        }
    ],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "modifier_id": 1,
            "rev": 2,
            "place_of_service_id": 3,
            "type_of_service_id": 2,
            "diagnostic_pointers": ["A", "B"],
            "epstd": 1, //1,2,3
            "price": 200
        }
    ],
    "will_report_any_injury": true,
    "injuries": [
        {
            "diag_date": "2022-07-05",
            "diagnosis_id": 1,
            "type_diag_id": 2,
            "note": "Note of injury"
        }
    ],
    "private_note": "Note claim 1"
}
```
## Response

> {success} 200 claim found

#


```json

```

#

<a name="validation-claim"></a>
## Validation claim

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
    "status": "SUCCESS",
    "controlNumber": "000000001",
    "tradingPartnerServiceId": "9496",
    "claimReference": {
        "correlationId": "200715R999898~18620063139417176",
        "submitterId": "999898",
        "customerClaimNumber": "000000001",
        "patientControlNumber": "12345",
        "timeOfResponse": "2020-07-15T12:44:17.994-05:00",
        "claimType": "PRO",
        "formatVersion": "5010"
    },
    "meta": {
        "submitterId": "999898",
        "senderId": "MN_MCC_APP",
        "billerId": "009998",
        "traceId": "804d63e8-aca8-0f05-c573-166ba75c3acb",
        "applicationMode": "sandbox"
    },
    "editStatus": "SUCCESS",
    "payer": {
        "payerName": "EXTRA HEALTHY INSURANCE",
        "payerID": "9496"
    }
}
```


<a name="verify-register"></a>
## Verify and register claim

### Body request example

```json
{
    "format": 1,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_id": 1,
    "diagnoses": [
        {
            "item": "A",
            "diagnosis_id": 1

        },
        {
            "item": "B",
            "diagnosis_id": 3

        }
    ],
    "insurance_policies": [8,10],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "modifier_id": 1,
            "rev": 2,
            "place_of_service_id": 3,
            "type_of_service_id": 2,
            "diagnostic_pointers": ["A", "B"],
            "epstd": 1,
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

> {success} 200 claim verify and register

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
#

<a name="preview-claim"></a>
## Show claim report preview

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Body request example

```json
{
    "format": 1,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_id": 1,
    "diagnoses": [
        {
            "item": "A",
            "diagnosis_id": 1

        },
        {
            "item": "B",
            "diagnosis_id": 3

        }
    ],
    "insurance_policies": [8,10],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "modifier_id": 1,
            "rev": 2,
            "place_of_service_id": 3,
            "type_of_service_id": 2,
            "diagnostic_pointers": ["A", "B"],
            "epstd": 1,
            "price": 200
        }
    ],
    "will_report_any_injury": true,
    "injuries": [
        {
            "diag_date": "2022-07-05",
            "diagnosis_id": 1,
            "type_diag_id": 2,
            "note": "Note of injury"
        }
    ]
}
```

## Response

> {success} 200 claim found

#