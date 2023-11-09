# Claim Docs

---

- [Basic data](#basic-data)
- [Create claim](#create-claim)
- [Get list type of services](#get-list-type-of-services)
- [Get list place of services](#get-list-place-of-services)
- [Get list type formats](#get-list-type-formats)
- [Get list type diags](#get-list-type-diags)
- [Get list status claim](#get-list-status-claim)
- [Get list claim field information](#get-list-claim-field-informations)
- [Get list qualifier by field](#get-list-qualifier)
- [Get list clam services](#get-list-claim-services)
- [Get list clam department responsibility](#get-list-claim-department-responsibility)
- [Get list clam insurance policies](#get-list-claim-insurance-policy)
- [Get all claim](#get-all-claim)
- [Get one claim](#get-one-claim)
- [Update claim](#update-claim)
- [Check eligibility](#check-eligibility-claim)
- [Validation claim](#validation-claim)
- [Show claim report preview or print ](#preview-claim)
- [Change status Claim](#change-status-claim)
- [Add note current status Claim](#add-note-current)
- [Update note current status Claim](#update-note-current)
- [Get list diagnoses](#get-list-diagnoses)
- [Add tracking Claim](#add-tracking-claim)
- [Get check status Claim](#get-check-status)



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
| 7  |GET     | `Get list claim field information`  | `/claim/get-list-claim-field-informations`     | yes            | Get list claim field informations |
| 8  |GET     | `Get list claim qualifier`  | `/claim/get-list-qualifier-by-field/{field_id}`     | yes            | Get list claim field informations |
| 9  |GET     | `Get list claim services`  | `/claim/get-list-claim-services`     | yes            | Get list claim services |
| 10  |GET     | `Get list claim department responsibility`  | `/claim/get-list-department-responsibilities`     | yes            | Get list claim department responsibility |
| 10  |GET     | `Get list claim insurance policy`  | `/claim/get-list-insurance-policies/{claimID}`     | yes            | Get list claim insurance policy |
| 10  |GET     | `Get all claims server` | `/claim/get-all-server`     | yes            | Get all claims from server |
| 11  |GET     | `Get one claim` | `/claim/{id}` | yes            | Get one claim |
| 12  |PUT     | `Update claim`  | `/claim/{id}` | yes            | Update claim  |
| 13  |POST    | `Save as draft claim`  | `/claim/draft/`     | yes            | Save as draft claim  |
| 14 |PUT     | `Update as draft claim`  | `/claim/draft/{id}` | yes            | Update as draft claim  |
| 15 |POST    | `Save as draft and check eligibility claim`  | `/claim/draft-check-eligibility`     | yes            | Save as draft and check eligibility claim |
| 16 |GET     | `check eligibility claim`  | `/claim/check-eligibility/{claim_id}`     | yes            | Check eligibility claim |
| 17 |GET     | `Validation claim`  | `/claim/validation/{claimId}`     | yes            | Validation claim |
| 18 |PUT     | `Verify and register claim`  | `/claim/verify-register/{id}` | yes            | Verify and register claim  |
| 19 |POST    | `Show claim report preview`  | `/claim/show-claim-preview` | yes            | Show claim report  |
| 20 |PATCH | `Change status Claim`           | `/claim/change-status/{id}`|yes|Change status claim|
| 21 |PATCH | `Add note current status Claim` | `/claim/add-note-current-status/{id}`|yes|Add note current status claim|
| 22 |PATCH | `Update note current status Claim` | `/claim/update-note-current-status/{id}`|yes|Update note current status claim|
| 23 |PATCH | `Add tracking Claim` | `/claim/add-tracking-claim/{claimID}`|yes|Add tracking claim|
| 24 |GET | `Get check status Claim` | `/claim/get-check-status/{claimID}`|yes|Get check status claim|

<a name="data-another-module"></a>
## Data from another module to make request

| #  | METHOD | Name                         | URL                                    | Token required | Description                |
| :  |        | :-                           | :                                      | :-             | :-                         |
| 11 |GET     | `Get list diagnoses` | `/procedure/get-list-diagnoses/{code?}` | yes            | Get list diagnoses|


<a name="create-claim"></a>
## Create claim

### Body request example

```json
{
    "billing_company_id": 1, /** Only by superuser */
    "type": 1,
    "draft": true,
    "private_note": "Note claim", /** Only if draft is true */
    "sub_status_id": 1, /** Only if draft is true */

    "demographic_information": {
        "validate": false,
        "automatic_eligibility": false,
        "company_id": 1,
        "facility_id": 1,
        "patient_id": 2,
        "prior_authorization_number": "1234567890A",
        "accept_assignment": false,
        "patient_signature": false,
        "insured_signature": false,
        "outside_lab": true,
        "charges": 200,
        "employment_related_condition": true,
        "auto_accident_related_condition": true,
        "auto_accident_place_state": "AS",
        "other_accident_related_condition": true,

        "health_professional_qualifier": [ /** Only required by draft is false. Min(1) Max(3) */
            { /** Billing Provider */
                "field_id": 5,
                "health_professional_id": 1,
                "qualifier_id": '',
            },
            { /** Referred Provider */
                "field_id": 6,
                "health_professional_id": 1,
                "qualifier_id": 2,
            },
            { /** Service Provider */
                "field_id": 7,
                "health_professional_id": 1,
                "qualifier_id": '',
            }
        ],
    },

    "additional_information": {
        "claim_date_informations": [
            {
                "id": "",
                "field_id": 1,
                "qualifier_id": 1,
                "from_date": "2022-07-05",
                "to_date": "2022-07-05",
                "description": "Lorem ipsum",
            }
        ],
        "extra_information": "",
    },

    "claim_services": {
        "diagnoses": [
            {
                "item": "A",
                "diagnosis_id": 1,
            }
        ],
        "services": [
            {
                "id": "",
                "from_service": "2022-07-05",
                "to_service": "2022-07-05",
                "procedure_id": 11,
                "modifier_ids": [1,2,3,4], /** Max 4 */
                "place_of_service_id": 3,
                "type_of_service_id": 2,
                "diagnostic_pointers": ["A", "B"],
                "days_or_units": 1.5,
                "price": 200,
                "copay": 200,
                "emg": true,
                "epsdt_id": 1,
                "family_planning_id": 1
            }
        ],
    },

    "insurance_policies": [
        {"insurance_policy_id": 8, "order": 1},
        {"insurance_policy_id": 10, "order": 2},
    ],
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

<a name="get-list-claim-field-informations"></a>
## Get list claim field informations


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
        "id": 192,
        "name": "14. Date of current illnes, injury or pregnancy (LMP)"
    },
    {
        "id": 193,
        "name": "15. Other date"
    },
    {
        "id": 194,
        "name": "16. Dates patient unable to work in current occupation"
    },
    {
        "id": 195,
        "name": "18. Hospitalization dates related to current services"
    },
    {
        "id": 196,
        "name": "19. Additional claim information (Designated by NUCC)"
    }
]
```

<a name="get-list-qualifier"></a>
## Get list qualifier by field


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Qualifier found

#

```json
[
    {
        "id": 197,
        "name": "1 - 14. Date 1",
        "code": "1"
    },
    {
        "id": 198,
        "name": "2 - 14. Date 2",
        "code": "2"
    }
]
```

<a name="get-list-claim-services"></a>
## Get list claim services


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Qualifier found

#

```json
{
    "type_of_services": [
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
        }
    ],
    "place_of_services": [
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
        }
    ],
    "epsdts": [
        {
            "id": 223,
            "name": "S2"
        },
        {
            "id": 224,
            "name": "ST"
        },
        {
            "id": 225,
            "name": "NU"
        }
    ],
    "family_plannings": [
        {
            "id": 226,
            "name": "Yes"
        },
        {
            "id": 227,
            "name": "No"
        }
    ]
}
```

#
<a name="get-list-claim-department-responsibility"></a>
## Get list claim department responsibilities


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Department responsibility found

#

```json
[
  {
    "id": "Billing",
    "name": "Billing"
  },
  {
    "id": "Payment Posting",
    "name": "Payment Posting"
  },
  {
    "id": "Collector",
    "name": "Collector"
  }
]
```
#

<a name="get-list-claim-insurance-policy"></a>
## Get list claim insurance policy


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

> {success} 200 insurance policy found

#

```json
[
  {
    "id": "P - UL0038342",
    "name": "P - UL0038342",
    "default": true,
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
## Get all claim from server

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
query <string>`
itemsPerPage <string>`
page <integer>`
sortBy <string>`
sortDesc <boolean>`
filterBy <string>`
status optional <array>       //[1,2]
subStatus optional <array>    //[1,2]
```

## Example path

>{primary} ?status[1]&substatus[1,2]

## Example path 2

>{primary} ?status[]=1&substatus[]=1&substatus[]=2

## Example path 2 Paginate

>{primary} ?query=fieldSearch&itemsPerPage=5&sortDesc=1&page=1&sortBy=fieldName&status[]=1&substatus[]=1&substatus[]=2

## Response

> {success} 200 claims found

#

```json
{
    "data": [
        {
            "id": 4,
            "qr_claim": null,
            "control_number": "000000004",
            "submitter_name": null,
            "submitter_contact": null,
            "submitter_phone": null,
            "company_id": 1,
            "facility_id": 1,
            "patient_id": 30,
            "health_professional_id": 1,
            "insurance_company_id": null,
            "claim_formattable_type": "App\\Models\\ClaimFormI",
            "claim_formattable_id": 1,
            "created_at": "2022-11-01T23:44:23.000000Z",
            "updated_at": "2022-11-01T23:44:23.000000Z",
            "validate": false,
            "format": 6,
            "last_modified": {
                "user": "Henry Paredes",
                "roles": [
                    {
                        "id": 1,
                        "name": "Super User",
                        "slug": "superuser",
                        "description": "Allows you to administer and manage all the functions of the application",
                        "level": 1,
                        "created_at": "2022-04-20T21:52:51.000000Z",
                        "updated_at": "2022-04-20T21:52:51.000000Z",
                        "pivot": {
                            "user_id": 14,
                            "role_id": 1,
                            "created_at": "2022-07-20T21:04:22.000000Z",
                            "updated_at": "2022-07-20T21:04:22.000000Z"
                        }
                    }
                ]
            },
            "private_note": "Nota 2 de guardado en draft",
            "status": "Verified - Not submitted",
            "status_history": [
                {
                    "note": "Nota 2 de guardado en draft",
                    "status": "Verified - Not submitted",
                    "status_date": "2022-11-01T23:44:23.000000Z",
                    "last_modified": {
                        "user": "Henry Paredes",
                        "roles": [
                            {
                                "id": 1,
                                "name": "Super User",
                                "slug": "superuser",
                                "description": "Allows you to administer and manage all the functions of the application",
                                "level": 1,
                                "created_at": "2022-04-20T21:52:51.000000Z",
                                "updated_at": "2022-04-20T21:52:51.000000Z",
                                "pivot": {
                                    "user_id": 14,
                                    "role_id": 1,
                                    "created_at": "2022-07-20T21:04:22.000000Z",
                                    "updated_at": "2022-07-20T21:04:22.000000Z"
                                }
                            }
                        ]
                    }
                }
            ],
            "billed_amount": "0.00",
            "amount_paid": "0.00",
            "past_due_date": "",
            "date_of_service": "",
            "status_date": "2022-11-01T23:44:23.000000Z",
            "claim_formattable": {
                "id": 1,
                "type_of_bill": "122",
                "federal_tax_number": "federal_tax_number",
                "start_date_service": null,
                "end_date_service": null,
                "admission_date": null,
                "admission_hour": null,
                "type_of_admission": "1",
                "source_admission": "2",
                "discharge_hour": null,
                "patient_discharge_stat": null,
                "admit_dx": null,
                "type_form_id": 6,
                "created_at": "2022-11-01T23:44:23.000000Z",
                "updated_at": "2022-11-01T23:44:23.000000Z"
            },
            "company": {
                "id": 1,
                "code": "CO-00001-2022",
                "name": "Company First",
                "npi": "2222222222",
                "created_at": "2022-05-02T14:45:27.000000Z",
                "updated_at": "2022-08-28T23:16:16.000000Z",
                "status": false,
                "nicknames": [
                    {
                        "id": 9,
                        "nickname": "Name New",
                        "nicknamable_type": "App\\Models\\Company",
                        "nicknamable_id": 1,
                        "billing_company_id": 10,
                        "created_at": "2022-10-25T11:32:37.000000Z",
                        "updated_at": "2022-10-25T11:32:37.000000Z"
                    }
                ]
            },
        }
    ],
    "numberOfPages": 1,
    "count": 2
}
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
            "notes_history": [
                {
                    "note": "Note",
                    "created_at": "2022-11-01T17:42:13.000000Z"
                }
            ],
            "status": "Draft",
            "status_background_color": "#F2F2F2",
            "status_font_color": "#707070",
            "status_date": "2022-11-01T17:42:13.000000Z",
            "sub_status_history": [
                {
                    "notes_history": [
                        {
                            "note": "Note 2",
                            "created_at": "2023-01-10T06:51:20.000000Z"
                        },
                        {
                            "note": "Note 3",
                            "created_at": "2023-01-12T00:12:36.000000Z"
                        }
                    ],
                    "code": "CODE1",
                    "name": "Claim Sub-status First",
                    "sub_status_date": "2023-01-10T06:51:20.000000Z",
                }
            ],
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
    "billing_company_id": 1, /** Only by superuser */
    "type": 1,
    "draft": false,
    "private_note": "Note claim", /** Only if draft is true */
    "sub_status_id": 1, /** Only if draft is true */

    "demographic_information": {
        "validate": false,
        "automatic_eligibility": false,
        "company_id": 1,
        "facility_id": 1,
        "patient_id": 2,
        "prior_authorization_number": "1234567890A",
        "accept_assignment": false,
        "patient_signature": false,
        "insured_signature": false,
        "outside_lab": true,
        "charges": 200,
        "employment_related_condition": true,
        "auto_accident_related_condition": true,
        "auto_accident_place_state": "AS",
        "other_accident_related_condition": true,

        "health_professional_qualifier": [ /** Only required by draft is false. Min(1) Max(3) */
            { /** Billing Provider */
                "field_id": 5,
                "health_professional_id": 1,
                "qualifier_id": '',
            },
            { /** Referred Provider */
                "field_id": 6,
                "health_professional_id": 1,
                "qualifier_id": 2,
            },
            { /** Service Provider */
                "field_id": 7,
                "health_professional_id": 1,
                "qualifier_id": '',
            }
        ],
    },

    "additional_information": {
        "claim_date_informations": [
            {
                "id": "",
                "field_id": 1,
                "qualifier_id": 1,
                "from_date": "2022-07-05",
                "to_date": "2022-07-05",
                "description": "Lorem ipsum",
            }
        ],
        "extra_information": "",
    },

    "claim_services": {
        "diagnoses": [
            {
                "item": "A",
                "diagnosis_id": 1,
            }
        ],
        "services": [
            {
                "id": "",
                "from_service": "2022-07-05",
                "to_service": "2022-07-05",
                "procedure_id": 11,
                "modifier_ids": [1,2,3,4], /** Max 4 */
                "place_of_service_id": 3,
                "type_of_service_id": 2,
                "diagnostic_pointers": ["A", "B"],
                "days_or_units": 1.5,
                "price": 200,
                "copay": 200,
                "emg": true,
                "epsdt_id": 1,
                "family_planning_id": 1
            }
        ],
    },

    "insurance_policies": [
        {"insurance_policy_id": 8, "order": 1},
        {"insurance_policy_id": 10, "order": 2},
    ],
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

<a name="check-eligibility-claim"></a>
## Check eligibility claim

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Body request example

```json
{
    "billing_company_id": 1, /** Only by superuser */
    "type": 1,

    "demographic_information": {
        "automatic_eligibility": false,
        "company_id": 1,
        "facility_id": 1,
        "patient_id": 2,
    },

    "claim_services": {
        "services": [
            {
                "id": "",
                "from_service": "2022-07-05",
                "to_service": "2022-07-05",
                "procedure_id": 11,
                "modifier_ids": [1,2,3,4], /** Max 4 */
                "place_of_service_id": 3,
                "type_of_service_id": 2,
                "diagnostic_pointers": ["A", "B"],
                "days_or_units": 1.5,
                "price": 200,
                "copay": 200,
                "emg": true,
                "epsdt_id": 1,
                "family_planning_id": 1
            }
        ],
    },
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
#

<a name="preview-claim"></a>
## Show claim report preview or print

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Body request example

```json
{
    "id": "",
    "billing_company_id": 1, /** Only by superuser */
    "format": 1,
    "print": false,
    "validate": false,
    "automatic_eligibility": false,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "billing_provider_id": 1,
    "referred_id": 1,
    "service_provider_id": 1,
    "patient_or_insured_information": {
        "employment_related_condition": true,
        "auto_accident_related_condition": true,
        "auto_accident_place_state": "AS",
        "other_accident_related_condition": true,
        "patient_signature": false,
        "insured_signature": false,
    },
    "physician_or_supplier_information": {
        "prior_authorization_number": "1234567890A",
        "outside_lab": true,
        "charges": "123",
        "patient_account_num": "12341234",
        "accept_assignment": false,
        "claim_date_informations": [
            {
                "field_id": 1,
                "qualifier_id": 1,
                "from_date_or_current": "2022-07-05",
                "to_date": "2022-07-05",
                "description": "Lorem ipsum"
            }
        ],
    },
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
    "insurance_policies": [
        {"insurance_policy_id": 8, "order": 1},
        {"insurance_policy_id": 10, "order": 2},
    ],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "modifier_ids": [1,2,3,4], /** Max 4 */
            "place_of_service_id": 3,
            "type_of_service_id": 2,
            "diagnostic_pointers": ["A", "B"],
            "days_or_units": 1.5,
            "price": 200,
            "copay": 200,
            "emg": true,
            "epsdt_id": 1,
            "family_planning_id": 1
        }
    ],
    "will_report_any_injury": true,
    "injuries": [
        {
            "diag_date": "2022-07-05",
            "diagnosis_id": 1,
            "type_diag_id": 2,
            "public_note": "Note of injury"
        }
    ]
}
```

## Response

> {success} 200 claim found

# 

<a name="change-status-claim"></a>
## Change status Claim

## Param in path

```json
{
    "id": <integer> /** Claim ID */
}
```
## Body request example

```json
{
    "status_id": 1, /** required */
    "sub_status_id": 1, /** optional */
    "private_note": "Note Status" /** optional */
}
```

## Response

> {success} 204 Good response

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

<a name="add-note-current"></a>
## Add note current status Claim

## Param in path

```json
{
    "id": <integer> /** Claim ID */
}
```
## Body request example

```json
{
    "private_note": "Note Status New" /** required */
}
```

## Response

> {success} 204 Good response

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

<a name="update-note-current"></a>
## Update note current status Claim

## Param in path

```json
{
    "id": <integer> /** Claim ID */
}
```
## Body request example

```json
{
    "private_note": "Note Status Edit" /** required */
}
```

## Response

> {success} 204 Good response

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

<a name="get-list-diagnoses"></a>
## Get list diagnoses


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

## Param in path

```json
code optional <string>
except_ids optional <array>    //[1,2] Array with ids diagnoses selected
```

## Example path 1

>{primary} get-list-diagnoses/M4?except_ids[]=1&except_ids[]=2

## Example path 2

>{primary} get-list-diagnoses?except_ids[]=1&except_ids[]=2

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

<a name="add-tracking-claim"></a>
## Add traking of the claim

## Param in path

```json
{
    "id": <integer> /** ID Claim */
}
```
## Body request example

```json
{
    "interface_type": 0, /** Required Options:['call' => '0', 'email' => '1', 'website' => '2', 'other' => '3'] */
    "is_reprocess_claim": true, /** Optional default false*/
    "is_contact_to_patient": true, /** Optional default false*/
    "contact_through": "+1432323212", /** Optional */
    "claim_number": "123543ASD", /** Optional */
    "rep_name": "123543ASD", /** Optional */
    "ref_number": "123543ASD", /** Optional */
    "claim_status": 1, /** Required */
    "claim_sub_status": 2, /** Optional */
    "tracking_date": "2022-09-16", /** Required */
    "resolution_time": "2022-09-16", /** Optional */
    "past_due_date": "2022-09-16", /** Optional */
    "follow_up": "2022-09-16", /** Required */
    "department_responsible": "Department 1", /** Optional */
    "policy_responsible": "P - Policy 1", /** Required */
    "response_details": "{claimData: response..}", /** Optional, If the API status verification is requested */
    "tracking_note": "Note private of tracking claim", /** Required */
}
```

## Response

> {success} 204 Good response

```json
{
  "id": 69,
  "code": "01HDM4TW76431JJ1818S0XMHBZ",
  "submitter_name": "Billing Company name",
  "submitter_contact": "Contact name",
  "submitter_phone": "3054878140",
  "created_at": "2023-10-25T19:26:27.000000Z",
  "updated_at": "2023-10-25T19:26:27.000000Z",
  "billing_company_id": 2,
  "type": 2,
  "aditional_information": "[]",
  "private_note": {...},
  "demographic_information": {...},
  "service": {...},
  "insurance_policies": []
}
```

<a name="get-check-status"></a>
## Get check status of the claim

## Param in path

```json
{
    "id": <integer> /** ID Claim */
}
```

## Response

> {success} 204 Good response

```json
{
}
```