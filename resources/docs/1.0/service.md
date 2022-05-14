

# Service Docs

---

- [Basic data](#basic-data)
- [Create service](#create-service)
- [Get all service](#get-all-service)
- [Get one service](#get-one-service)
- [Update service](#Update-service)
- [Get all service groups](#get-list-service-groups)
- [Get all service types](#get-list-service-types)
- [Get all service type of services](#get-list-service-type-of-services)
- [Get all service stmt descriptions](#get-list-service-stmt-descriptions)
- [Get all service special instructions](#get-list-service-special-instructions)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 |POST    | `Create Service`  | `/service/`     | yes            | Create Service  |         
| 2 |GET     | `Get all Service` | `/service/`     | yes            | Get all Service |
| 3 |GET     | `Get one Service` | `/service/{id}` | yes            | Get one Service |
| 4 |PUT     | `Update Service`  | `/service/{id}` | yes            | Update Service  |
| 5 |GET | `Get all service groups`| `/service/get-list-service-groups`        |yes            |Get all service groups|
| 6 |GET | `Get all service types`| `/service/get-list-service-types`        |yes            |Get all service types|
| 7 |GET | `Get all service type of services`| `/service/get-list-service-type-of-services`        |yes            |Get all service type of services|
| 8 |GET | `Get all service stmt descriptions`| `/service/get-list-service-stmt-descriptions`        |yes            |Get all service stmt descriptions |
| 9 |GET | `Get all service special instructions`| `/service/get-list-service-special-instructions`        |yes            |Get all service special instructions |


<a name="create-service"></a>
## Create Service

### Body request example

```json
{
    "name": "Service1",
    "description":"Description service 1",
    "aplicable_to": "Aplicable to service 1",
    "rev_code": "Rev Code service 1",
    "use_time_units": "Use time to service 1",
    "ndc_number": "Number to service 1",
    "units": "Unit to service 1",
    "measure": "Mesure to service 1",
    "units_limit": "limit to service 1",
    "requires_claim_note": true,
    "requires_supervisor": true,
    "requires_authorization": true,
    "service_group_1_id": 1,
    "service_group_2_id": 2,
    "service_type_id": 3,
    "service_type_of_service_id": 1,
    "service_rev_center_id": 2,
    "service_stmt_description_id": 2,
    "service_special_instruction_id": 1,
    "std_price": 50.54,
    "billing_company_id": 1,
    "company_id": 2,
    "insurance_plan_services": [
        {
            "insurance_plan_id": 1,
            "price": 24.23,
            "aliance": true,
            "insurance_plan_service_aliance": {
                "price": 20.23,
                "percentage": true
            }
        },
        {
            "insurance_plan_id": 2,
            "price": 24.23,
            "aliance": false,
            "insurance_plan_service_aliance": null
        }
    ],
    "public_note": "Public note to service 1",
    "private_note": "Private note to service 1"
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 Service created


#

```json
{
    "code": "SE-00001-2022",
    "name": "Service1",
    "description": "Description service 1",
    "service_group_1_id": 1,
    "service_group_2_id": 2,
    "service_type_id": 3,
    "aplicable_to": "Aplicable to service 1",
    "service_type_of_service_id": 1,
    "service_rev_center_id": 2,
    "service_stmt_description_id": 2,
    "service_special_instruction_id": 1,
    "rev_code": "Rev Code service 1",
    "use_time_units": "Use time to service 1",
    "ndc_number": "Number to service 1",
    "units": "Unit to service 1",
    "measure": "Mesure to service 1",
    "units_limit": "limit to service 1",
    "requires_claim_note": true,
    "requires_supervisor": true,
    "requires_authorization": true,
    "std_price": 50.54,
    "billing_company_id": 1,
    "company_id": 2,
    "updated_at": "2022-05-14T01:36:46.000000Z",
    "created_at": "2022-05-14T01:36:46.000000Z",
    "id": 2
}
```


#

<a name="get-all-service"></a>
## Get All Service

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service found

#


```json
[
    {
        "id": 9,
        "code": "SE-00001-2022",
        "name": "Service1",
        "description": "Description service 1",
        "aplicable_to": "Aplicable to service 1",
        "rev_code": "Rev Code service 1",
        "use_time_units": "Use time to service 1",
        "ndc_number": "Number to service 1",
        "units": "Unit to service 1",
        "measure": "Mesure to service 1",
        "units_limit": "limit to service 1",
        "requires_claim_note": true,
        "requires_supervisor": true,
        "requires_authorization": true,
        "created_at": "2022-05-14T04:08:44.000000Z",
        "updated_at": "2022-05-14T04:08:44.000000Z",
        "service_group_1_id": 1,
        "service_group_2_id": 2,
        "service_type_id": 3,
        "service_type_of_service_id": 1,
        "service_rev_center_id": 2,
        "service_stmt_description_id": 2,
        "service_special_instruction_id": 1,
        "company_id": 2,
        "billing_company_id": 1,
        "status": null,
        "std_price": "50.54",
        "insurance_plan_services": [
            {
                "id": 11,
                "price": "24.23",
                "aliance": true,
                "insurance_plan_id": 1,
                "service_id": 9,
                "created_at": "2022-05-14T04:08:44.000000Z",
                "updated_at": "2022-05-14T04:08:44.000000Z",
                "insurance_plan_service_aliance": {
                    "id": 3,
                    "price": "20.23",
                    "percentage": true,
                    "insurance_plan_service_id": 11,
                    "created_at": "2022-05-14T04:08:44.000000Z",
                    "updated_at": "2022-05-14T04:08:44.000000Z"
                }
            },
            {
                "id": 12,
                "price": "24.23",
                "aliance": false,
                "insurance_plan_id": 2,
                "service_id": 9,
                "created_at": "2022-05-14T04:08:45.000000Z",
                "updated_at": "2022-05-14T04:08:45.000000Z",
                "insurance_plan_service_aliance": null
            }
        ],
        "public_note": [
            {
                "id": 8,
                "note": "Public note to service 1",
                "publishable_type": "App\\Models\\Service",
                "publishable_id": 9,
                "created_at": "2022-05-14T04:08:45.000000Z",
                "updated_at": "2022-05-14T04:08:45.000000Z"
            }
        ],
        "private_notes": [
            {
                "id": 8,
                "note": "Private note to service 1",
                "billing_company_id": 1,
                "publishable_type": "App\\Models\\Service",
                "publishable_id": 9,
                "created_at": "2022-05-14T04:08:45.000000Z",
                "updated_at": "2022-05-14T04:08:45.000000Z"
            }
        ],
        "company": {
            "id": 2,
            "code": "CO-00002-2022",
            "name": "company first11",
            "npi": "1184006447",
            "created_at": "2022-05-04T01:27:04.000000Z",
            "updated_at": "2022-05-04T01:27:04.000000Z",
            "status": false
        },
        "billing_company": {
            "id": 1,
            "name": "Zulauf Group",
            "created_at": "2022-04-20T21:52:55.000000Z",
            "updated_at": "2022-04-20T21:52:55.000000Z",
            "code": "BC-00001-2022",
            "status": false
        },
        "service_group1": {
            "id": 1,
            "group": "EM - Evaluation & Management",
            "created_at": "2022-05-09T22:10:21.000000Z",
            "updated_at": "2022-05-09T22:10:21.000000Z"
        },
        "service_group2": {
            "id": 2,
            "group": "LB - LAB",
            "created_at": "2022-05-09T22:10:21.000000Z",
            "updated_at": "2022-05-09T22:10:21.000000Z"
        },
        "service_type": {
            "id": 3,
            "type": "V - Vode Codes",
            "created_at": "2022-05-09T22:10:21.000000Z",
            "updated_at": "2022-05-09T22:10:21.000000Z"
        },
        "service_type_of_service": {
            "id": 1,
            "type_of_service": "01 - Medical Care",
            "created_at": "2022-05-09T22:10:21.000000Z",
            "updated_at": "2022-05-09T22:10:21.000000Z"
        },
        "service_rev_center": {
            "id": 2,
            "rev_center": "CO - Consultations",
            "created_at": "2022-05-09T22:11:14.000000Z",
            "updated_at": "2022-05-09T22:11:14.000000Z"
        },
        "service_stmt_description": {
            "id": 2,
            "stmt_description": "IN - Injection",
            "created_at": "2022-05-09T22:11:14.000000Z",
            "updated_at": "2022-05-09T22:11:14.000000Z"
        },
        "service_special_instruction": {
            "id": 1,
            "special_instruction": "BR - Op Report Required",
            "created_at": "2022-05-09T22:11:28.000000Z",
            "updated_at": "2022-05-09T22:11:28.000000Z"
        }
    }
]
```

#


<a name="get-one-service"></a>
## Get One Service

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

> {success} 200 Service found

#


`````json
{
    "id": 1,
    "code": "SE-00001-2022",
    "name": "Service1",
    "description": "Description service 1",
    "aplicable_to": "Aplicable to service 1",
    "rev_code": "Rev Code service 1",
    "use_time_units": "Use time to service 1",
    "ndc_number": "Number to service 1",
    "units": "Unit to service 1",
    "measure": "Mesure to service 1",
    "units_limit": "limit to service 1",
    "requires_claim_note": true,
    "requires_supervisor": true,
    "requires_authorization": true,
    "created_at": "2022-05-14T04:08:44.000000Z",
    "updated_at": "2022-05-14T04:08:44.000000Z",
    "service_group_1_id": 1,
    "service_group_2_id": 2,
    "service_type_id": 3,
    "service_type_of_service_id": 1,
    "service_rev_center_id": 2,
    "service_stmt_description_id": 2,
    "service_special_instruction_id": 1,
    "company_id": 2,
    "billing_company_id": 1,
    "status": null,
    "std_price": "50.54",
    "insurance_plan_services": [
        {
            "id": 11,
            "price": "24.23",
            "aliance": true,
            "insurance_plan_id": 1,
            "service_id": 9,
            "created_at": "2022-05-14T04:08:44.000000Z",
            "updated_at": "2022-05-14T04:08:44.000000Z",
            "insurance_plan_service_aliance": {
                "id": 3,
                "price": "20.23",
                "percentage": true,
                "insurance_plan_service_id": 11,
                "created_at": "2022-05-14T04:08:44.000000Z",
                "updated_at": "2022-05-14T04:08:44.000000Z"
            }
        },
        {
            "id": 12,
            "price": "24.23",
            "aliance": false,
            "insurance_plan_id": 2,
            "service_id": 9,
            "created_at": "2022-05-14T04:08:45.000000Z",
            "updated_at": "2022-05-14T04:08:45.000000Z",
            "insurance_plan_service_aliance": null
        }
    ],
    "public_note": [
        {
            "id": 8,
            "note": "Public note to service 1",
            "publishable_type": "App\\Models\\Service",
            "publishable_id": 9,
            "created_at": "2022-05-14T04:08:45.000000Z",
            "updated_at": "2022-05-14T04:08:45.000000Z"
        }
    ],
    "private_notes": [
        {
            "id": 8,
            "note": "Private note to service 1",
            "billing_company_id": 1,
            "publishable_type": "App\\Models\\Service",
            "publishable_id": 9,
            "created_at": "2022-05-14T04:08:45.000000Z",
            "updated_at": "2022-05-14T04:08:45.000000Z"
        }
    ],
    "company": {
        "id": 2,
        "code": "CO-00002-2022",
        "name": "company first11",
        "npi": "1184006447",
        "created_at": "2022-05-04T01:27:04.000000Z",
        "updated_at": "2022-05-04T01:27:04.000000Z",
        "status": false
    },
    "billing_company": {
        "id": 1,
        "name": "Zulauf Group",
        "created_at": "2022-04-20T21:52:55.000000Z",
        "updated_at": "2022-04-20T21:52:55.000000Z",
        "code": "BC-00001-2022",
        "status": false
    },
    "service_group1": {
        "id": 1,
        "group": "EM - Evaluation & Management",
        "created_at": "2022-05-09T22:10:21.000000Z",
        "updated_at": "2022-05-09T22:10:21.000000Z"
    },
    "service_group2": {
        "id": 2,
        "group": "LB - LAB",
        "created_at": "2022-05-09T22:10:21.000000Z",
        "updated_at": "2022-05-09T22:10:21.000000Z"
    },
    "service_type": {
        "id": 3,
        "type": "V - Vode Codes",
        "created_at": "2022-05-09T22:10:21.000000Z",
        "updated_at": "2022-05-09T22:10:21.000000Z"
    },
    "service_type_of_service": {
        "id": 1,
        "type_of_service": "01 - Medical Care",
        "created_at": "2022-05-09T22:10:21.000000Z",
        "updated_at": "2022-05-09T22:10:21.000000Z"
    },
    "service_rev_center": {
        "id": 2,
        "rev_center": "CO - Consultations",
        "created_at": "2022-05-09T22:11:14.000000Z",
        "updated_at": "2022-05-09T22:11:14.000000Z"
    },
    "service_stmt_description": {
        "id": 2,
        "stmt_description": "IN - Injection",
        "created_at": "2022-05-09T22:11:14.000000Z",
        "updated_at": "2022-05-09T22:11:14.000000Z"
    },
    "service_special_instruction": {
        "id": 1,
        "special_instruction": "BR - Op Report Required",
        "created_at": "2022-05-09T22:11:28.000000Z",
        "updated_at": "2022-05-09T22:11:28.000000Z"
    }
}
`````

#


<a name="Update-service"></a>
## Update Service

### Body request example

```json
{
    "name": "Service edited",
    "description":"Description service 1",
    "aplicable_to": "Aplicable to service 1",
    "rev_code": "Rev Code service 1",
    "use_time_units": "Use time to service 1",
    "ndc_number": "Number to service 1",
    "units": "Unit to service 1",
    "measure": "Mesure to service 1",
    "units_limit": "limit to service 1",
    "requires_claim_note": true,
    "requires_supervisor": true,
    "requires_authorization": true,
    "service_group_1_id": 1,
    "service_group_2_id": 2,
    "service_type_id": 3,
    "service_type_of_service_id": 1,
    "service_rev_center_id": 2,
    "service_stmt_description_id": 2,
    "service_special_instruction_id": 1,
    "std_price": 50.54,
    "billing_company_id": 1,
    "company_id": 2,
    "insurance_plan_services": [
        {
            "insurance_plan_id": 2,
            "price": 24.23,
            "aliance": false,
            "insurance_plan_service_aliance": null
        }
    ],
    "public_note": "Public note to service 1",
    "private_note": "Private note to service 1"
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service updated


#



```json
{
    "id": 9,
    "code": "SE-00001-2022",
    "name": "Service edited",
    "description": "Description service 1",
    "aplicable_to": "Aplicable to service 1",
    "rev_code": "Rev Code service 1",
    "use_time_units": "Use time to service 1",
    "ndc_number": "Number to service 1",
    "units": "Unit to service 1",
    "measure": "Mesure to service 1",
    "units_limit": "limit to service 1",
    "requires_claim_note": true,
    "requires_supervisor": true,
    "requires_authorization": true,
    "created_at": "2022-05-14T04:08:44.000000Z",
    "updated_at": "2022-05-14T04:21:36.000000Z",
    "service_group_1_id": 1,
    "service_group_2_id": 2,
    "service_type_id": 3,
    "service_type_of_service_id": 1,
    "service_rev_center_id": 2,
    "service_stmt_description_id": 2,
    "service_special_instruction_id": 1,
    "company_id": 2,
    "billing_company_id": 1,
    "status": null,
    "std_price": 50.54,
    "insurance_plan_services": [
        {
            "id": 16,
            "price": "24.23",
            "aliance": false,
            "insurance_plan_id": 2,
            "service_id": 9,
            "created_at": "2022-05-14T04:24:15.000000Z",
            "updated_at": "2022-05-14T04:24:15.000000Z",
            "insurance_plan_service_aliance": null
        }
    ]
}
```

<a name="get-list-service-groups"></a>
## Get All Service Groups


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service Groups found

#

```json
[
    {
        "id": 1,
        "name": "EM - Evaluation & Management"
    },
    {
        "id": 2,
        "name": "LB - LAB"
    },
    {
        "id": 3,
        "name": "MI - Miscellaneous"
    },
    {
        "id": 4,
        "name": "PR - Procedures"
    },
    {
        "id": 5,
        "name": "SU - Surgery"
    },
    {
        "id": 6,
        "name": "XR - X Ray / Radiology"
    }
]
```


<a name="get-list-service-types"></a>
## Get All Service Types


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service Types found

#

```json
[
    {
        "id": 1,
        "name": "C - CPT"
    },
    {
        "id": 2,
        "name": "O - Office"
    },
    {
        "id": 3,
        "name": "V - Vode Codes"
    },
    {
        "id": 4,
        "name": "R - Revenue Codes"
    },
    {
        "id": 5,
        "name": "I - Inventory Virtual"
    },
    {
        "id": 6,
        "name": "D - DRG"
    },
    {
        "id": 7,
        "name": "E - Expl"
    }
]
```

<a name="get-list-service-type-of-services"></a>
## Get All Service Type of Service


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service Type of Service found

#

```json
[
    {
        "id": 1,
        "name": "01 - Medical Care"
    },
    {
        "id": 2,
        "name": "02 - Surgery"
    },
    {
        "id": 3,
        "name": "03 - Consultation"
    },
    {
        "id": 4,
        "name": "04 - Diagnostic X-Ray"
    },
    {
        "id": 5,
        "name": "05 - Diagnostic Lab"
    },
    {
        "id": 6,
        "name": "06 - Radiation Therapy"
    },
    {
        "id": 7,
        "name": "07 - Anesthesia"
    },
    {
        "id": 8,
        "name": "08 - Surgical Assistance"
    },
    {
        "id": 9,
        "name": "09 - Other Medical"
    },
    {
        "id": 10,
        "name": "10 - Blood Charges"
    },
    {
        "id": 11,
        "name": "11 - Used DME"
    },
    {
        "id": 12,
        "name": "12 - DME Purchase"
    },
    {
        "id": 13,
        "name": "13 - ASC Facility"
    },
    {
        "id": 14,
        "name": "14 - Renal Supplies In the Home"
    },
    {
        "id": 15,
        "name": "15 - Alternate Method Dialysis Payment"
    },
    {
        "id": 16,
        "name": "16 - CRD Equipment"
    },
    {
        "id": 17,
        "name": "17 - Pre-Admission Testing"
    },
    {
        "id": 18,
        "name": "18 - DME Renal"
    },
    {
        "id": 19,
        "name": "19 - Pneumonia Vaccine"
    },
    {
        "id": 20,
        "name": "20 - Second Surgical Opinion"
    },
    {
        "id": 21,
        "name": "21 - Third Surgical Opinion"
    },
    {
        "id": 22,
        "name": "22 - Third Surgical Opinion"
    },
    {
        "id": 23,
        "name": "99 - Other Used For prescription drugsMedical Care"
    },
    {
        "id": 24,
        "name": "MA - Mammography"
    }
]
```

<a name="get-list-service-stmt-descriptions"></a>
## Get All Service Stmt Descriptions


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service Stmt Descriptions found

#

```json
[
    {
        "id": 1,
        "name": "HV - Hospital Visit"
    },
    {
        "id": 2,
        "name": "IN - Injection"
    },
    {
        "id": 3,
        "name": "LB - Lab Test"
    },
    {
        "id": 4,
        "name": "ME - Medication"
    },
    {
        "id": 5,
        "name": "OV - Office Visit"
    },
    {
        "id": 6,
        "name": "PR - Procedure"
    },
    {
        "id": 7,
        "name": "SP - Supplies"
    },
    {
        "id": 8,
        "name": "SU - Surgery"
    },
    {
        "id": 9,
        "name": "XR - X Ray / Radiology"
    },
    {
        "id": 10,
        "name": "XX - Do not Show On Patient Statement"
    }
]
```

<a name="get-list-service-special-instructions"></a>
## Get All Service Special Instructions


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service Special Instructions found

#

```json
[
    {
        "id": 1,
        "name": "BR - Op Report Required"
    },
    {
        "id": 2,
        "name": "PO - Paper Only"
    }
]
```