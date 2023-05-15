# Claim Docs

---

- [Basic data](#basic-data)
- [Create claim](#create-claim)

- [Get list type formats](#get-list-type-formats)
- [Get list claim field information](#get-list-claim-field-informations)
- [Get list qualifier by field](#get-list-qualifier)

- [Get list revenue codes](#get-list-revenue-codes)
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


| 4 | GET | `Get list types formats` | `/claim/get-list-type-formats` | yes | Get list type formats |
| 7 | GET | `Get list claim field information` | `/claim/get-list-claim-field-informations` | yes | Get list claim field informations |
| 8 | GET | `Get list claim qualifier` | `/claim/get-list-qualifier-by-field/{field_id?}` | yes | Get list claim field informations |


| 2 | GET | `Get list revenue codes` | `/claim/get-list-revenue-codes` | yes | Get list revenue-codes |
| 3 | GET | `Get list admission types` | `/claim/get-list-admission-types` | yes | Get list admission types |
| 4 | GET | `Get list admission sources` | `/claim/get-list-admission-sources` | yes | Get list admission sources |
| 5 | GET | `Get list patient statuses` | `/claim/get-list-patient-statuses` | yes | Get list patient statuses |
| 6 | GET | `Get list bill classifications` | `/claim/get-list-bill-classifications` | yes | Get list bill classifications |
| 7 | GET | `Get list diagnosis related groups` | `/claim/get-list-diagnosis-related-groups` | yes | Get list diagnosis related groups |



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


<a name="create-claim"></a>
## Create claim

### Body request example

```json
{
    "billing_company_id": 1, /** Only by superuser */
    "format": 2,
    "type of medical assistance": "inpatient", //outpatient
    "validate": false,
    "automatic_eligibility": false,
    "company_id": 1,
    "facility_id": 1,
    "patient_id": 2,
    "attending_health_professional_id"
    "attending_qualifier_id"
    "open_attending_health_professional_id"
    "open_attending_qualifier_id"
    "other_health_professional_id"
    "other_qualifier_id"
    "health_professional_id"
    "qualifier_id"
    
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
        "admisison_date": "2022-07-05",
        "admisison_time": "07:05",
        "discharge_date":"2022-07-05",
        "discharge_time": "07:05",
        "condition_codes": [1,2],
        "admisison_type_id": 1,
        "admisison_source_id": 2,
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
    }
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

> {primary} /get-list-claim-field-informations?type=health-care-institutional

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
<a name="get-list-service-revenue-codes"></a>
## Get all revenue Codes


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Revenue codes found

#

```json
[
    {
        "id":1,
        "name":"Revenue code 1"
    },
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