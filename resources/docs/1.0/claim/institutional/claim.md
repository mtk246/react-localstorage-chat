# Claim Docs

---

- [Basic data](#basic-data)
- [Create claim](#create-claim)
- [Update claim](#update-claim)
- [verify and register claim](#verify-register)
- [Save as draft claim](#save-as-draft-claim)
- [Check eligibility](#check-eligibility-claim)

- [Get list type formats](#get-list-type-formats)
- [Get list claim field information](#get-list-claim-field-informations)
- [Get list qualifier by field](#get-list-qualifier)

- [Get list condition codes](#get-list-condition-codes)
- [Get list revenue codes](#get-list-revenue-codes)
- [Get list procedures](#get-list-procedures)
- [Get list admission types](#get-list-admission-types)
- [Get list admission sources](#get-list-admission-sources)
- [Get list patient statuses](#get-list-patient-statuses)
- [Get list bill classifications](#get-list-bill-classifications)
- [Get list diagnosis related groups](#get-list-diagnosis-related-groups)

- [Get list billing companies](#get-list-billing-companies)
- [Get list companies](#get-list-companies)
- [Get list facilities](#get-list-facilities)
- [Get list patients](#get-list-patients)
- [Get list health professional](#get-list-health-professionals)

<a name="basic-data"></a>
## Basic data to make request

| # | METHOD | Name | URL | Token required | Description |
| : | : | :- | : | :- | :- |
| 1 | POST | `Create claim` | `/claim/` | yes | Create claim |
| 2  |PUT     | `Update claim`  | `/claim/{id}` | yes            | Update claim  |
| 13  |POST    | `Save as draft claim`  | `/claim/draft/`     | yes            | Save as draft claim  |
| 14 |PUT     | `Update as draft claim`  | `/claim/draft/{id}` | yes            | Update as draft claim  |
| 16 | POST     | `check eligibility claim`  | `/claim/check-eligibility`     | yes            | Check eligibility claim |
| 18 |POST     | `Verify and register claim`  | `/claim/verify-register` | yes            | Verify and register claim  |
| 3 | GET | `Get list types formats` | `/claim/get-list-type-formats` | yes | Get list type formats |
| 4 | GET | `Get list claim field information` | `/claim/get-list-claim-field-informations` | yes | Get list claim field informations |
| 5 | GET | `Get list claim qualifier` | `/claim/get-list-qualifier-by-field/{field_id?}` | yes | Get list claim field informations |
| 6 | GET | `Get list condition codes` | `/claim/get-list-condition-codes` | yes | Get list condition codes |
| 7 | GET | `Get list revenue codes` | `/claim/get-list-revenue-codes` | yes | Get list revenue codes |
| 8 | GET | `Get list admission types` | `/claim/get-list-admission-types` | yes | Get list admission types |
| 9 | GET | `Get list admission sources` | `/claim/get-list-admission-sources` | yes | Get list admission sources |
| 10 | GET | `Get list patient statuses` | `/claim/get-list-patient-statuses` | yes | Get list patient statuses |
| 11 | GET | `Get list bill classifications` | `/claim/get-list-bill-classifications` | yes | Get list bill classifications |
| 12 | GET | `Get list diagnosis related groups` | `/claim/get-list-diagnosis-related-groups` | yes | Get list diagnosis related groups |



<a name="data-another-module"></a>
## Data from another module to make request

| # | METHOD | Name | URL | Token required | Description |
| : | : | :- | : | :- | :- |
| 1 | GET | `Get list billing companies` | `/billing-company/get-list` | yes | Get list billing companies |
| 2 | GET | `Get list company by billing company` | `/company/get-list-by-billing-company/{id?}` | yes | Get all companies by billing company |
| 3 | GET | `Get list facilities` | `/facility/get-list` | yes | Get list facilities |
| 4 | GET | `Get list patients` | `/patient/get-list` | yes | Get list all patients |
| 5 | GET | `Get list health professionals` | `/health-professional/get-list` | yes | Get list health professionals |
| 6 | GET | `Get list diagnoses` | `/procedure/get-list-diagnoses/{code?}` | yes | Get list diagnoses |
| 7 |GET     | `Get list procedure` | `/procedure/get-list/{company_id?}?search={search}&revenue_code_id={revenueCode}` | yes            | Get list procedure|


<a name="create-claim"></a>
## Create claim

### Body request example

```json
{
    "billing_company_id": 1, /** Only by superuser */
    "type": 1,
    "draft": false,

    "demographic_information": {
        "validate": false,
        "automatic_eligibility": false,
        "type_of_medical_assistance": "inpatient", //outpatient
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

        "health_professional_qualifier": [ /** Only required by draft is false. Min(4) Max(4) */
            {
                "field":76,
                "health_professional_id": 1,
                "qualifier_id": 1,
            },
            {
                "field":77,
                "health_professional_id": 1,
                "qualifier_id": 1,
            },
            {
                "field":78,
                "health_professional_id": 1,
                "qualifier_id": 1,
            },
            {
                "field":79,
                "health_professional_id": 1,
                "qualifier_id": 1,
            }
        ],
    },

    "claim_services": {
        "diagnosis_related_group_id": 1,
        "non_covered_charges": 200,
        "diagnoses": [
            {
                "item": "A",
                "diagnosis_id": 1,
                "admission": true,
                "poa": 1,
            }
        ],
        "services": [
            {
                "id": "",
                "from_service": "2022-07-05",
                "to_service": "2022-07-05",
                "procedure_id": 11,
                "revenue_code_id": 11,
                "price": 200,
                "days_or_units": 1.5,
                "total_charge": 200,
                "copay": 200,
            }
        ],
    },

    "additional_information": {
        "from": "2022-07-05",
        "to": "2022-07-05",
        "patient_information": {
            "admission_date": "2022-07-05",
            "admission_time": "07:05",
            "discharge_date":"2022-07-05",
            "discharge_time": "07:05",
            "condition_code_ids": [1,2], /** Max(11) */
            "admission_type_id": 1,
            "admission_source_id": 2,
            "patient_status_id": 2,
            "bill_classification_id": 2,
        },
        "claim_date_informations": [
            {
                "id": "",
                "field_id": 1,
                "qualifier_id": 1,
                "from_date": "2022-07-05",
                "to_date": "2022-07-05",
                "description": "Lorem ipsum",
                "amount": 200,
            }
        ],
        "extra_information": "",
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
    "updated_at": "2022-09-16T13:23:19.000000Z",
    "created_at": "2022-09-16T13:23:19.000000Z",
    "id": 1
}
```

<a name="update-claim"></a>
## Update claim

### Body request example

```json
{
    "billing_company_id": 1, /** Only by superuser */
    "format": 2,
    "type_of_medical_assistance": "inpatient", //outpatient
    "validate": false,
    "automatic_eligibility": false,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_qualifier": [
        {
            "field":76,
            "health_professional_id": 1,
            "qualifier_id": 1,
        },
        {
            "field":77,
            "health_professional_id": 1,
            "qualifier_id": 1,
        },
        {
            "field":78,
            "health_professional_id": 1,
            "qualifier_id": 1,
        },
        {
            "field":79,
            "health_professional_id": 1,
            "qualifier_id": 1,
        }
    ],
    "prior_authorization_number": "1234567890A",
    "employment_related_condition": true,
    "auto_accident_related_condition": true,
    "auto_accident_place_state": "AS",
    "other_accident_related_condition": true,
    "accept_assignment": false,
    "patient_signature": false,
    "insured_signature": false,
    "outside_lab": true,
    
    "diagnoses": [
        {
            "item": "A",
            "diagnosis_id": 1,
            "admission": true,
            "poa": 1,
        }
    ],
    "claim_services": [
        {
            "id": 1,
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "revenue_code_id": 3,
            "price": 200,
            "units_of_service": 1.5,
            "total_charge": 200,
            "copay": 200,
        }
    ],
    "additional_information": {
        "admission_date": "2022-07-05",
        "admission_time": "07:05",
        "discharge_date":"2022-07-05",
        "discharge_time": "07:05",
        "condition_codes": [1,2],
        "admission_type_id": 1,
        "admission_source_id": 2,
        "patient_status_id": 2,
        "bill_classification_id": 2,
        "diagnosis_related_group_id": 1,
        "non_covered_charges": 20.15,
        "claim_date_informations": [
            {
                "id": 1,
                "field_id": 1,
                "code_id": 1,
                "from_date": "2022-07-05",
                "to_date": "2022-07-05",
                "through": "Lorem ipsum",
                "amount": 200,
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

<a name="verify-register"></a>
## Verify and register claim

### Body request example

```json
{
    "billing_company_id": 1, /** Only by superuser */
    "format": 2,
    "type_of_medical_assistance": "inpatient", //outpatient
    "validate": false,
    "automatic_eligibility": false,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_qualifier": [
        {
            "field":76,
            "health_professional_id": 1,
            "qualifier_id": 1,
        },
        {
            "field":77,
            "health_professional_id": 1,
            "qualifier_id": 1,
        },
        {
            "field":78,
            "health_professional_id": 1,
            "qualifier_id": 1,
        },
        {
            "field":79,
            "health_professional_id": 1,
            "qualifier_id": 1,
        }
    ],
    "prior_authorization_number": "1234567890A",
    "employment_related_condition": true,
    "auto_accident_related_condition": true,
    "auto_accident_place_state": "AS",
    "other_accident_related_condition": true,
    "accept_assignment": false,
    "patient_signature": false,
    "insured_signature": false,
    "outside_lab": true,
    
    "diagnoses": [
        {
            "item": "A",
            "diagnosis_id": 1,
            "admission": true,
            "poa": 1,
        }
    ],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "revenue_code_id": 3,
            "price": 200,
            "units_of_service": 1.5,
            "total_charge": 200,
            "copay": 200,
        }
    ],
    "additional_information": {
        "admission_date": "2022-07-05",
        "admission_time": "07:05",
        "discharge_date":"2022-07-05",
        "discharge_time": "07:05",
        "condition_codes": [1,2],
        "admission_type_id": 1,
        "admission_source_id": 2,
        "patient_status_id": 2,
        "bill_classification_id": 2,
        "diagnosis_related_group_id": 1,
        "non_covered_charges": 20.15,
        "claim_date_informations": [
            {
                "field_id": 1,
                "code_id": 1,
                "from_date": "2022-07-05",
                "to_date": "2022-07-05",
                "through": "Lorem ipsum",
                "amount": 200,
            }
        ],
    },
    "insurance_policies": [
        {"insurance_policy_id": 8, "order": 1},
        {"insurance_policy_id": 10, "order": 2},
    ]
}
```

<a name="save-as-draft-claim"></a>
## Save as draft claim

### Body request example

```json
{
    "billing_company_id": 1, /** Only by superuser */
    "format": 2,
    "type_of_medical_assistance": "inpatient", //outpatient
    "validate": false,
    "automatic_eligibility": false,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "health_professional_qualifier": [
        {
            "field":76,
            "health_professional_id": 1,
            "qualifier_id": 1,
        },
        {
            "field":77,
            "health_professional_id": 1,
            "qualifier_id": 1,
        },
        {
            "field":78,
            "health_professional_id": 1,
            "qualifier_id": 1,
        },
        {
            "field":79,
            "health_professional_id": 1,
            "qualifier_id": 1,
        }
    ],
    "prior_authorization_number": "1234567890A",
    "employment_related_condition": true,
    "auto_accident_related_condition": true,
    "auto_accident_place_state": "AS",
    "other_accident_related_condition": true,
    "accept_assignment": false,
    "patient_signature": false,
    "insured_signature": false,
    "outside_lab": true,
    
    "diagnoses": [
        {
            "item": "A",
            "diagnosis_id": 1,
            "admission": true,
            "poa": 1,
        }
    ],
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "revenue_code_id": 3,
            "price": 200,
            "units_of_service": 1.5,
            "total_charge": 200,
            "copay": 200,
        }
    ],
    "additional_information": {
        "admission_date": "2022-07-05",
        "admission_time": "07:05",
        "discharge_date":"2022-07-05",
        "discharge_time": "07:05",
        "condition_codes": [1,2],
        "admission_type_id": 1,
        "admission_source_id": 2,
        "patient_status_id": 2,
        "bill_classification_id": 2,
        "diagnosis_related_group_id": 1,
        "non_covered_charges": 20.15,
        "claim_date_informations": [
            {
                "field_id": 1,
                "code_id": 1,
                "from_date": "2022-07-05",
                "to_date": "2022-07-05",
                "through": "Lorem ipsum",
                "amount": 200,
            }
        ],
    },
    "insurance_policies": [
        {"insurance_policy_id": 8, "order": 1},
        {"insurance_policy_id": 10, "order": 2},
    ],

    "private_note": "Note claim",
    "sub_status_id": 1
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
<a name="check-eligibility-claim"></a>
## Check eligibility claim

### Body request example

```json
{
    "billing_company_id": 1, /** Only by superuser */
    "format": 2,
    "type_of_medical_assistance": "inpatient", //outpatient
    "validate": false,
    "automatic_eligibility": false,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    
    "claim_services": [
        {
            "from_service": "2022-07-05",
            "to_service": "2022-07-05",
            "procedure_id": 11,
            "revenue_code_id": 3,
            "price": 200,
            "units_of_service": 1.5,
            "total_charge": 200,
            "copay": 200,
        }
    ]
}
```

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
<a name="get-list-claim-field-informations"></a>
## Get list claim field informations


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
"type" <string> /** optional */
```

## Example path 1

> {primary} /get-list-claim-field-informations?type=healthcare-professional

## Example path 2

> {primary} /get-list-claim-field-informations?type=information-institutional

## Example path 3

> {primary} /get-list-claim-field-informations?type=information-professional


## Response

> {success} 200 Claim field information found

#

```json
[
    {
        "id": 1,
        "name": "14. Date of current illnes, injury or pregnancy (LMP)"
    },
    {
        "id": 2,
        "name": "15. Other date"
    },
    {
        "id": 3,
        "name": "16. Dates patient unable to work in current occupation"
    },
    {
        "id": 4,
        "name": "18. Hospitalization dates related to current services"
    },
    {
        "id": 5,
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

### Param in path

```json
"id" <integer> /** optional */
"type" <string> /** optional */
```

## Example path 1

> {primary} /get-list-qualifier-by-field?type=health-care-institutional

## Example path 2

> {primary} /get-list-qualifier-by-field?type=information-professional&id=1

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

<a name="get-list-condition-codes"></a>
## Get all condition Codes


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
"search" <string> optional
```
## Example path

> {primary} /get-list-condition-codes?search=1

## Response

> {success} 200 Condition codes found

#

```json
[
    {
        "id": 415,
        "code": "00",
        "name": "Requested"
    },
    {
        "id": 416,
        "code": "000",
        "name": "In Progress"
    },
    {
        "id": 417,
        "code": "0A",
        "name": "Automated Export System - Post Departure Authorized Special Status (AES-PASS) Standard"
    },
    {
        "id": 418,
        "code": "0B",
        "name": "Automated Export System - Post Departure Authorized Special Status (AES-PASS) Expanded"
    },
]
```

<a name="get-list-revenue-codes"></a>
## Get all revenue Codes


### Param in header

```json
{
    "Authorization": bearer <token>
}
```
### Param in path

```json
"search" <string> optional
```

## Example path

> {primary} /get-list-revenue-codes?search=1


## Response

> {success} 200 Revenue codes found

#

```json
[
    {
    "id": 1,
    "name": "99203",
    "description": "Office o/p new low 30-44 min"
  },
  {
    "id": 2,
    "name": "99204",
    "description": "Office o/p new mod 45-59 min"
  },
  {
    "id": 3,
    "name": "99205",
    "description": "Office o/p new hi 60-74 min"
  }
]
```

<a name="get-list-admission-types"></a>
## Get list admission types


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Admission types found

#

```json
[
  {
    "id": 233,
    "name": "Emergency"
  },
  {
    "id": 234,
    "name": "Urgent"
  },
  {
    "id": 235,
    "name": "Elective"
  },
  {
    "id": 236,
    "name": "Newborn"
  },
  {
    "id": 237,
    "name": "Trauma"
  },
  {
    "id": 238,
    "name": "Information not available"
  }
]
```
<a name="get-list-admission-sources"></a>
## Get list admission sources


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Admission sources found

#

```json
[
  {
    "id": 239,
    "name": "Non-Health Facility Point of Origin"
  },
  {
    "id": 240,
    "name": "Clinic"
  },
  {
    "id": 241,
    "name": "Reserved for assignment by the NUBC"
  },
  {
    "id": 242,
    "name": "Transfer From a Hospital (Different Facility)"
  },
  {
    "id": 243,
    "name": "Transfer From a Skilled Nursing Facility (SNF) or Intermediate Care Facility (ICF)"
  },
  {
    "id": 244,
    "name": "Transfer From Another Health Care Facility"
  },
  {
    "id": 245,
    "name": "Emergency Room"
  },
  {
    "id": 246,
    "name": "Court/Law Enforcement"
  },
  {
    "id": 247,
    "name": "Information Not Available"
  },
  {
    "id": 248,
    "name": "Transfer from a Rural Primary Care Hospital (Only valid for discharges prior to 10/1/2007)"
  },
  {
    "id": 249,
    "name": "Transfer from One Distinct Unit of the Hospital to another Distinct Unit of the Same Hospital Resulting in a Separate Claim to the Payer"
  },
  {
    "id": 250,
    "name": "Transfer from Ambulatory Surgery Center (Effective 10/1/2007)"
  },
  {
    "id": 251,
    "name": "Transfer from Hospice and is Under a Hospice Plan of Care or Enrolled in a Hospice Program (Effective 10/1/2007)"
  }
]
```

#
<a name="get-list-patient-statuses"></a>
## Get list patient statuses


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Patient statuses found

#

```json
[
    {
        "id": 252,
        "code": "99",
        "name": "Reserved for national assignment"
    },
    {
        "id": 317,
        "code": "1",
        "name": "Discharged to home or self-care (routine discharge)"
    },
    {
        "id": 318,
        "code": "2",
        "name": "Discharged/transferred to a short-term general hospital for inpatient care"
    }
]
```
#
<a name="get-list-bill-classifications"></a>
## Get list bill clasifications


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Bill clasifications found

#

```json
[
  {
    "id": "1",
    "code": "0",
    "name": "Non-payment/Zero Claim"
  },
  {
    "id": "2",
    "code": "1",
    "name": "Admit Through Discharge"
  },
  {
    "id": "3",
    "code": "2",
    "name": "Interim - First Claim"
  },
  {
    "id": "4",
    "code": "3",
    "name": "Interim-Continuing Claims"
  },
  {
    "id": "5",
    "code": "4",
    "name": "Interim - Last Claim"
  },
  {
    "id": "6",
    "code": "5",
    "name": "Late Charge Only"
  },
  {
    "id": "7",
    "code": "7",
    "name": "Replacement of Prior Claim (See adjustment third digit)"
  },
  {
    "id": "8",
    "code": "8",
    "name": "Void/Cancel of Prior Claim (See adjustment third digit)"
  },
  {
    "id": "9",
    "code": "9",
    "name": "Final claim for a Home Health PPS Period"
  }
]
```
#
<a name="get-list-diagnosis-related-groups"></a>
## Get list diagnosis related groups


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Diagnosis related groups found

#

```json
[
    {
        "id": 1731,
        "code": "008",
        "name": "Simultaneous pancreas and kidney transplant"
    },
    {
        "id": 1732,
        "code": "010",
        "name": "Pancreas transplant"
    },
    {
        "id": 1733,
        "code": "011",
        "name": "Tracheostomy for face, mouth and neck diagnoses or laryngectomy with mcc"
    },
    {
        "id": 1734,
        "code": "012",
        "name": "Tracheostomy for face, mouth and neck diagnoses or laryngectomy with cc"
    },
    {
        "id": 1735,
        "code": "013",
        "name": "Tracheostomy for face, mouth and neck diagnoses or laryngectomy without cc/mcc"
    }
]
```

<a name="get-list-billing-companies"></a>
## Get list billing companies


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Billing Companies found

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
    },
    {
        "id": 4,
        "name": "Halvorson, Deckow and Bode"
    }
]
```

<a name="get-list-companies"></a>
## Get all company by billing company


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
"id" <integer> required by super user
```

## Response

> {success} 200 companies found

#

```json
[
    {
        "id": 2,
        "name": "company first11"
    },
    {
        "id": 3,
        "name": "PANAMERICAN INTERNAL MEDICINE INC"
    }
]
```

<a name="get-list-facilities"></a>
## Get list facilities


### Param in header

```json
{
    "Authorization": bearer <token>
}
```
### Param in path

```json
"billing_company_id" <integer> required by super user
"company_id" <integer> required
```

## Example path

> {primary} /get-list?billing_company_id=1&company_id=1

## Response

> {success} 200 Facilities found

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
    },
    {
        "id": 4,
        "name": "Halvorson, Deckow and Bode"
    }
]
```

<a name="get-list-patients"></a>
## Get list all patients


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path
```json
"billing_company_id" <integer> required by super user
```
## Example path Super user

> {primary} /get-list?billing_company_id=1

## Example path Billing manager

> {primary} /get-list

## Response

> {success} 200 Patients found

#

```json
[
    {
        "id": 17,
        "name": "PA-00001-2022 - Fisrt Name Last Name"
    },
    {
        "id": 49,
        "name": "PA-00010-23 - Johnatan Doe"
    }
]
```

<a name="get-list-health-professionals"></a>
## Get list health professionals


### Param in header

```json
{
    "Authorization": bearer <token>
}
```
### Param in path

```json
"billing_company_id" <integer> /** required by super user */
"company_id" <integer> /** optional */
```

## Example path by super user

> {primary} /get-list?billing_company_id=1&company_id=1

## Example path by biling manager

> {primary} /get-list?company_id=1

## Response

> {success} 200 Health professionals found

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
    },
    {
        "id": 4,
        "name": "Halvorson, Deckow and Bode"
    }
]
```

<a name="get-list-procedures"></a>
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

>{primary} ?search=code & revenue_code_id=code & except_ids[]=1 & except_ids[]=2

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