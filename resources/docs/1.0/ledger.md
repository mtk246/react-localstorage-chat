# Ledger Docs

---
- [Get search patients](#get-search-patients)
- [Get claims of patient](#get-claims-patient)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
|1|GET|`Get search patients`|`/ledger/search`|yes|Get patients|
|1|GET|`Get claims of patient`|`/ledger/{patient}/claims`|yes|Get claims ofpatients|

>{primary} when url params have this symbol "?" mean not required, so you must to send null

<a name="get-search-patients"></a>
## Get search patients

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Body request example

```json
{
    "claim_number": "nullable|string",
    "company_ids" : "nullable|array",
    "company_ids.*" : "nullable|integer",
    "dob" : "nullable|string",
    "end_date" : "nullable|date|after_or_equal:start_date",
    "first_name" : "nullable|string",
    "health_professional_ids" : "nullable|array",
    "health_professional_ids.*" : "nullable|integer",
    "insurance_plans_ids" : "nullable|array",
    "insurance_plans_ids.*" : "nullable|integer",
    "last_name" : "nullable|string",
    "medical_number" : "nullable|string",
    "patient_number" : "nullable|string",
    "ssn" : "nullable|string",
    "start_date" : "nullable|date|before_or_equal:end_date"
}
```

## Response

> {success} 200 data retorned

#
```json
[
    {
        "id": 3,
        "profile": {
            "first_name": "Wendy",
            "last_name": "Barrueto",
            "dob": "1979-09-02",
            "ssn": "777121246"
        },
        "medical_number": null,
        "patient_number": null,
        "companies": [
            {
                "id": 1,
                "name": "Nexus Medical Centers, Llc"
            },
            {
                "id": 1,
                "name": "Nexus Medical Centers, Llc"
            }
        ]
    }
]
```


<a name="get-claims-patient"></a>
## Get claims patient

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "patient_id":       <integer>
}
```

## Response

> {success} 200 data retorned

#
```json
{
    "id": 3,
    "medical_number": null,
    "patient_number": null,
    "profile": {
        "first_name": "Wendy",
        "last_name": "Barrueto",
        "dob": "1979-09-02",
        "ssn": "777121246"
    },
    "claims": [
        {
            "id": 2,
            "code": "NEXUS-07052022-WB000002",
            "submiter_name": null,
            "created_at": "2024-01-08T20:57:10.000000Z",
            "status": {
                "id": 2,
                "status": "Not submitted",
                "created_at": "2024-01-02T00:22:48.000000Z",
                "updated_at": "2024-01-02T00:22:48.000000Z",
                "background_color": "#FBECDD",
                "font_color": "#B04D12"
            },
            "privateNote": {
                "id": 22,
                "note": "Claim created successfully, system verification",
                "billing_company_id": 1,
                "created_at": "2024-01-08T20:57:11.000000Z",
                "updated_at": "2024-01-08T20:57:11.000000Z",
            },
            "billed_amount": "600.00",
            "amount_paid": "400.00",
            "past_due_date": "2022-07-05",
            "date_of_service": "2022-07-05",
            "user_created": "Ivan Sam",
            "charge": "600.00",
            "services": [
                {
                    "id": 1,
                    "claim_service_id": 1,
                    "procedure_id": 11,
                    "modifier_ids": [],
                    "diagnostic_pointers": [],
                    "from_service": "2022-07-05",
                    "to_service": "2022-07-05",
                    "price": "200",
                    "total_charge": "200",
                    "copay": "200",
                    "revenue_code_id": "11",
                    "place_of_service_id": null,
                    "type_of_service_id": null,
                    "days_or_units": "1.5",
                    "emg": null,
                    "epsdt_id": null,
                    "family_planning_id": null,
                    "created_at": "2024-01-08T20:57:10.000000Z",
                    "updated_at": "2024-01-08T20:57:10.000000Z",
                    "modifiers": []
                }
            ],
            "health_professional": {
                "id": 1,
                "npi": "1588659353",
                "created_at": "2024-01-02T00:23:12.000000Z",
                "updated_at": "2024-01-02T00:23:12.000000Z",
                "code": "HP-00001-2024",
                "is_provider": false,
                "npi_company": "",
                "company_id": 2,
                "nppes_verified_at": null,
                "ein": null,
                "upin": null,
                "profile_id": 28,
                "status": false,
                "companies_providers": [
                    {
                        "health_professional_id": 1,
                        "company_id": 2,
                        "authorization": [
                            1,
                            2
                        ],
                        "billing_company_id": 1,
                        "created_at": "2024-01-02T00:23:12.000000Z",
                        "updated_at": "2024-01-02T00:23:12.000000Z"
                    }
                ],
                "verified_on_nppes": false,
                "companies": [
                    {
                        "id": 2,
                        "code": "CO-00002-2024",
                        "name": "Isle Of Palms Recovery Center, Llc",
                        "npi": "1538603873",
                        "created_at": "2024-01-02T00:23:10.000000Z",
                        "updated_at": "2024-01-02T00:23:10.000000Z",
                        "ein": null,
                        "clia": null,
                        "other_name": null,
                        "status": null,
                        "edit_name": false,
                        "last_modified": {
                            "user": "Console",
                            "roles": []
                        },
                        "pivot": {
                            "health_professional_id": 1,
                            "company_id": 2,
                            "authorization": [
                                1,
                                2
                            ],
                            "billing_company_id": 1,
                            "created_at": "2024-01-02T00:23:12.000000Z",
                            "updated_at": "2024-01-02T00:23:12.000000Z"
                        },
                        "nicknames": []
                    }
                ]
            },
            "insurance_policies": {
                "id": 1,
                "code": "IP-00001-2024",
                "name": "Connect 1500 Gold",
                "accept_assign": true,
                "pre_authorization": true,
                "file_zero_changes": true,
                "referral_required": false,
                "accrue_patient_resp": false,
                "require_abn": true,
                "pqrs_eligible": true,
                "allow_attached_files": false,
                "eff_date": "2020-10-09",
                "insurance_company_id": 1,
                "created_at": "2024-01-02T00:23:11.000000Z",
                "updated_at": "2024-01-02T00:23:11.000000Z",
                "ins_type_id": 3,
                "plan_type_id": null,
                "payer_id": null
            }
        }
    ],
    "policy_information": {
        "policy_holder": null,
        "policy_number": "122587",
        "effective_date": null,
        "expiration_date": null
    }
}
```



