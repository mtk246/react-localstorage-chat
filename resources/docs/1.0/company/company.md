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
| 20 |PATCH | `Add services to company`       | `/company/add-services-to-company/{id}`|yes|Add services to company|
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
        "facility_type_id": 6,
        "billing_company": "Medical Claims Consultants",
        "facility": "Isa Home Corp.",
        "facility_type": "AL - Assisted Living Facility"
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
            "billing_company_id": 1, /** Only required by superuser */
            "procedure_id": 1,
            "description": "Description procedure",
            "modifier_id": 2,
            "price": 20.2,
            "mac": "02102",
            "locality_number":"01",
            "state": "ALASKA",
            "fsa": "STATEWIDE",
            "counties": "ALL COUNTIES",
            "insurance_label_fee_id": 1,
            "price_percentage": "70",
            "clia": "00001A",
            "medication_application": true,
            "medications": [
                {
                    "date": "2022-03-16",
                    "drug_code": "001A23X",
                    "batch": "0101AS",
                    "quantity": 2,
                    "frequency": 3
                },
                {
                    "date": "2022-03-16",
                    "drug_code": "002A23X",
                    "batch": "0201AS",
                    "quantity": 2,
                    "frequency": 3
                }
            ]

        }
    ]
}
```


## Response

> {success} 200 Good response

```json
[
        {
            "billing_company_id": 1, /** Only required by superuser */
            "procedure_id": 1,
            "description": "Description procedure",
            "modifier_id": 2,
            "price": 20.2,
            "mac": "02102",
            "locality_number":"01",
            "state": "ALASKA",
            "fsa": "STATEWIDE",
            "counties": "ALL COUNTIES",
            "insurance_label_fee_id": 1,
            "price_percentage": "70",
            "clia": "00001A",
            "medication_application": true,
            "medications": [
                {
                    "code": "000001",
                    "date": "2022-03-16",
                    "drug_code": "001A23X",
                    "batch": "0101AS",
                    "quantity": 2,
                    "frequency": 3
                },
                {
                    "code": "000002",
                    "date": "2022-03-16",
                    "drug_code": "002A23X",
                    "batch": "0201AS",
                    "quantity": 2,
                    "frequency": 3
                }
            ]

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
            "insurance_plan_id": 1,
            "insurance_company_id": 1,
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
        "insurance_company_id": 1,
        "insurance_plan_id": 1,
        "type_id": 1,
        "start_date": "2022-03-16",
        "end_date": "2022-03-16",
        "procedure_id": [1,2],
        "modifier_id": 1,
        "price": 120.5,
        "mac": "02102",
        "locality_number":"01",
        "state": "ALASKA",
        "fsa": "STATEWIDE",
        "counties": "ALL COUNTIES",
        "insurance_label_fee_id": 1,
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