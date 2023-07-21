# Company Docs

---

- [Basic data](#basic-data)
- [Data from another module](#data-another-module)
- [Change status company](#change-status-company)
- [Add to billing company](#add-to-billing-company)
- [Add facilities to company](#add-facilities)
- [Add service to company](#add-services)
- [Add service to company](#add-copay)
- [Add service to contract fee](#add-contracts-fee)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 17 |PATCH | `Change status company`          | `/company/change-status/{id}`|yes|Change status company|
| 18 |PATCH | `Add to billing company`          | `/company/add-to-billing-company/{id}`|yes|Add company to billing company|
| 19 |PATCH | `Add facilities to company`       | `/company/add-facilities-to-company/{id}`|yes|Add facilities to company|
| 20 |PATCH | `Add services to company`       | `/company/{id}/services`|yes|Add services to company|
| 21 |PATCH | `Add copays to company`       | `/company/add-copays-to-company/{id}`|yes|Add copays to company|
| 22 |PATCH | `Add contract fee to company`       | `/company/add-contract-fee-to-company/{id}`|yes|Add contract fee to company|

<a name="change-status-company"></a>
## Change status Company


### Body request example

```json
{
    "status":"boolean"
}
```


## Response

> {success} 204 Good response


#


<a name="add-to-billing-company"></a>
## Add to billing company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required integer`


## Response

> {success} 200 Good response

```json
{
    "code": "CO-00001-2022",
    "name": "company first",
    "npi": "222CF123",
    "updated_at": "2022-03-16T09:44:57.000000Z",
    "created_at": "2022-03-16T09:44:57.000000Z",
    "id": 1,
    "status": true
}
```

#

>{warning} 404 error add company to billing company


<a name="add-facilities"></a>
## Add facilities to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required integer`

## Param in body

```json
{
    "facilities": [
        {
            "billing_company_id": 1, /** Only required by superuser */
            "facility_id": 1,
        },
        {
            "billing_company_id": 1,
            "facility_id": 2,
        }
    ]
}
```


## Response

> {success} 200 Good response

```json
[
    {
        "billing_company_id": 1,
        "facility_id": 2,
        "facility_type_ids": [1,2,3],
        "billing_company": "Medical Claims Consultants",
        "facility": "Isa Home Corp.",
        "facility_types": [
          {
            "id": 1,
            "name": "AL - Assisted Living Facility"
          },
          {
            "id": 2,
            "name": "AL - Assisted Living Facility"
          },
          {
            "id": 3,
            "name": "AL - Assisted Living Facility"
          }
        ]
    }
]
```

#

>{warning} 404 error add facilities to company


<a name="add-services"></a>
## Add services to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required integer`

## Param in body

```json
{
    "services": [
        {
            "id":87,
            "billing_company_id": 1,  /** Only required by superuser */
            "procedure_ids": [1,3],
            "modifier_ids": [1,2],
            "price": 20.2,
            "mac": "02102",
            "locality_number":"01",
            "state": "ALASKA",
            "fsa": "STATEWIDE",
            "counties": "ALL COUNTIES",
            "insurance_label_fee_id": 1,
            "rate": "",
            "price_percentage": "70",
            "clia": "00001A",
            "medications": [
                {
                    "id": 2,
                    "drug_code": "1472583691",
                    "measurement_unit_id": 1,
                    "units": 30.5,
                    "units_limit": 30,
                    "link_sequence_number": "124585154",
                    "pharmacy_prescription_number": "123456",
                    "repackaged_NDC": false,
                    "Code_NDC": "1010524871",
                    "claim_note_required": true,
                    "note": "Note Medication",
                },
                {
                    "id": 0, /** zero for new entries */
                    "drug_code": "001010101",
                    "measurement_unit_id": 1,
                    "units": 30,
                    "units_limit": 30,
                    "link_sequence_number": "7891561231",
                    "pharmacy_prescription_number": "12345652145",
                    "repackaged_NDC": false,
                    "Code_NDC": "101000082",
                    "claim_note_required": true,
                    "note": "Note Medication",
                }
            ]
        },
        {
            "billing_company_id": 1,  /** Only required by superuser */
            "id": 88, /** zero for new entries */
            "procedure_ids": [1,2],
            "price": 300
        }
    ]
}
```


## Response

> {success} 200 Good response

```json
[
  {
    "id": 87,
    "billing_company_id": 1,
    "procedure_ids": [1,2],
    "procedures": [
      {
        "id": 1,
        "name": "Procedure",
      },
      {
        "id": 2,
        "name": "Procedure2",
      }
    ],
    "modifier_ids": [1,3],
    "modifiers": [
      {
        "id": 1,
        "name": "Modifier",
      },
      {
        "id": 3,
        "name": "Modifier3",
      }
    ],
    "mac": "02102",
    "locality_number": "01",
    "state": "ALASKA",
    "fsa": "STATEWIDE",
    "counties": "ALL COUNTIES",
    "insurance_label_fee_id": 1,
    "price": "20.2",
    "price_percentage": "70",
    "clia": "00001A",
    "rate": "",
    "medication_application": false,
    "medications": [
      {
        "id": 2,
        "code": "87001A23X0101AS54",
        "drug_code": "001A23X",
        "batch": "0101AS",
        "quantity": 2,
        "frequency": 3,
        "date": "2022-03-16"
      },
      {
        "id": 3,
        "code": "87002A23X0201AS55",
        "drug_code": "002A23X",
        "batch": "0201AS",
        "quantity": 2,
        "frequency": 3,
        "date": "2022-03-16"
      }
    ]
  },
  {
    "id": 88,
    "billing_company_id": 1,
    "procedure_ids": [2],
    "procedures": [
      {
        "id": 2,
        "name": "Procedure2"
      }
    ],
    "modifier_ids": [],
    "modifiers": [],
    "mac": "10112",
    "locality_number": "00",
    "state": "ALABAMA",
    "fsa": "STATEWIDE",
    "counties": "ALL COUNTIES",
    "insurance_label_fee_id": null,
    "price": "300",
    "price_percentage": null,
    "clia": null,
    "rate": "",
    "medication_application": false,
    "medications": []
  }
]
```

#

>{warning} 404 error add services to company


<a name="add-copay"></a>
## Add copays to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required integer`

## Param in body

```json
{
    "copays": [
        {
            "billing_company_id": 1, /** Only required by superuser */
            "procedure_ids": [1,2,3],
            "insurance_plan_ids": [1,2],
            "insurance_company_ids": [1,2],
            "copay": 150.2,
            "private_note": "Note private by billing_company"
        }
    ]
}
```


## Response

> {success} 200 Good response

```json
[
  {
    "billing_company_id": 1,
    "insurance_plan_id": 1,
    "company_id": 1,
    "copay": "150.00",
    "procedures": [
      {
        "id": 1,
        "code": "CO-00001-2022",
        "description": "test description",
        "start_date": "2023-04-01",
        "end_date": "2023-04-08",
      }
    ]
  }
]
```

#

>{warning} 404 error add copays to company


<a name="add-contracts-fee"></a>
## Add contracts fee to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`company_id required integer`

## Param in body

```json
[
    {
        "billing_company_id": 1, /** Only required by superuser */
        "contract_fee_id": 1, /** Only wen contract update */
        "insurance_company_ids": [1,2],
        "insurance_plan_ids": [1,2],
        "type_id": 1,
        "start_date": "2022-03-16",
        "end_date": "2022-03-16",
        "procedure_ids": [1,2],
        "modifier_ids": [1,2],
        "price": 120.5,
        "mac": "02102",
        "locality_number":"01",
        "state": "ALASKA",
        "fsa": "STATEWIDE",
        "counties": "ALL COUNTIES",
        "insurance_label_fee_id": 1,
        "rate": "02102",
        "price_percentage": 70,
        "private_note": "Note private by billing_company"
    }
]
```


## Response

> {success} 200 Good response

```json
[
  {
    "id": 6,
    "company_id": 2,
    "modifier_id": 1,
    "mac_locality_id": 2,
    "insurance_plan_id": 1,
    "billing_company_id": 1,
    "insurance_label_fee_id": 1,
    "contract_fee_type_id": 1,
    "start_date": "2022-03-16",
    "end_date": "2022-03-16",
    "price": "120.00",
    "price_percentage": "70.00",
    "procedures": [
      {
        "id": 1,
        "code": "dfs51",
        "description": "Dsfdsf dsf",
        "active": true,
        "created_at": "2023-03-29T00:00:00.000000Z",
        "updated_at": "2023-03-01T06:41:22.000000Z",
        "start_date": "2023-04-01",
        "end_date": "2023-04-08",
        "last_modified": {
          "user": "Console",
          "roles": []
        },
        "pivot": {
          "contract_fee_id": 6,
          "procedure_id": 1,
          "created_at": "2023-03-02T11:35:18.000000Z",
          "updated_at": "2023-03-02T11:35:18.000000Z"
        }
      }
    ]
  }
]
```

#

>{warning} 404 error add contracts fee to company