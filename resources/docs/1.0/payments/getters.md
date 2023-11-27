# Address Docs

---
- [Get list of batch states](#get-list-batch-states)
- [Get list of payments source](#get-list-payment-source)
- [Get list of payments methods](#get-list-payment-methods)
- [Get eob file view](#get-eob-file)
- [Get all batches](#get-all-batch)
- [Get single batch](#get-single-batch)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
|1|GET|`Get list of batch states`|`/payments/batch/states`|yes|Get all baches states list|
|2|GET|`Get list payments source`|`/payments/sources`|yes|Get all payments sources list|
|3|GET|`Get list of payments methods`|`/payments/methods`|yes|Get all payments metods list|
|4|GET|`Get eob file view`|`/payments/eob/{eob_file}`|yes|this is the view for the eob file|
|5|GET|`Get all batches`|`/payments/batch`|yes|Get list of all payments batches|
|6|GET|`Get single batch`|`/payments/batch/{batch_id}`|yes|Get all of batch information|

>{primary} when url params have this symbol "?" mean not required, so you must to send null

<a name="get-list-batch-states"></a>
## Get all baches states list

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data retorned

#
```json
[
  {
    "id": 1,
    "colors": {
      "background": "#FFFAE6",
      "text": "#B04D12"
    },
    "name": "In Progress"
  },
  {
    "id": 2,
    "colors": {
      "background": "#E9FDF2",
      "text": "#1B6D49"
    },
    "name": "Completed"
  },
  {
    "id": 3,
    "colors": {
      "background": "#E3F8FF",
      "text": "#018ECC"
    },
    "name": "In Review"
  }
]
```

<a name="get-list-payment-source"></a>
## Get list of payments source

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data retorned

#
```json
[
  {
    "id": 1,
    "name": "Patient"
  },
  {
    "id": 2,
    "name": "Insurance"
  },
  {
    "id": 3,
    "name": "Others"
  },
  {
    "id": 4,
    "name": "Indivisible"
  }
]
```

<a name="get-list-payment-methods"></a>
## Get all payments metods list

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data retorned

#
```json
[
  {
    "id": 1,
    "name": "Credit Card"
  },
  {
    "id": 2,
    "name": "CASH"
  },
  {
    "id": 3,
    "name": "Check"
  },
  {
    "id": 4,
    "name": "Other"
  }
]
```


<a name="get-eob-file"></a>
## this is the view for the eob file

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 eob file view

<a name="get-all-batch"></a>
## Get list of all payments batches

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data retorned

#
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "name": "test",
      "posting_date": "2015-10-05T00:00:00.000000Z",
      "currency": "USD",
      "amount": "25000",
      "status": 1,
      "payments": [
        ... payments information
      ],
      "created_at": "2023-11-22T13:09:50.000000Z",
      "updated_at": "2023-11-22T13:09:50.000000Z",
      "company": {
        "id": 1,
        "code": "CO-00001-2023",
        "name": "Nexus Medical Centers, Llc",
        "npi": "1750811915",
        "ein": null,
        "clia": "",
        "other_name": "",
        "created_at": "2023-11-21T13:37:33.000000Z",
        "updated_at": "2023-11-21T13:37:33.000000Z",
        "public_note": "",
        "last_modified": {
          "user": "Console",
          "roles": []
        },
        "taxonomies": [...],
        "facilities": {...},
        "services": {...},
        "copays": {...},
        "contract_fees": {...},
        "exception_insurance_companies": {...},
        "patients": {...},
        "statements": {...},
        "abbreviations": [...],
        "billing_companies": [...],
      },
      "billing_company": {...}
    },
    ... rest of data
  ],
  "first_page_url": "http://localhost/api/v1/payments/batch?query=&page=1",
  "from": 1,
  "last_page": 2,
  "last_page_url": "http://localhost/api/v1/payments/batch?query=&page=2",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "active": false
    },
    {
      "url": "http://localhost/api/v1/payments/batch?query=&page=1",
      "label": "1",
      "active": true
    },
    {
      "url": "http://localhost/api/v1/payments/batch?query=&page=2",
      "label": "2",
      "active": false
    },
    {
      "url": "http://localhost/api/v1/payments/batch?query=&page=2",
      "label": "Next &raquo;",
      "active": false
    }
  ],
  "next_page_url": "http://localhost/api/v1/payments/batch?query=&page=2",
  "path": "http://localhost/api/v1/payments/batch",
  "per_page": 10,
  "prev_page_url": null,
  "to": 6,
  "total": 17
}
```

<a name="get-single-batch"></a>
## Get all of batch information

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data retorned

#
```json{
  "id": 16,
  "name": "test",
  "posting_date": "2015-10-05T00:00:00.000000Z",
  "currency": "USD",
  "amount": "25000",
  "status": 1,
  "payments": [
    {
      "id": 16,
      "source": 1,
      "payment_date": "2015-10-05T00:00:00.000000Z",
      "total_amount": "25000",
      "payment_method": "1",
      "reference": "1541586",
      "card_number": null,
      "expiration_date": null,
      "statement": true,
      "note": "asdawdsadawsdw",
      "eobs": {
        "name": "test",
        "date": "2015-10-05T00:00:00.000000Z",
        "file_name": "",
        "file_url": null
      },
      "insurance_company": {
        "id": 1,
        "code": "IC-00001-2023",
        "name": "Providence Administrative Services",
        "naic": "1101",
        "created_at": "2023-11-21T13:37:34.000000Z",
        "updated_at": "2023-11-21T13:37:34.000000Z",
        "payer_id": "PAS01",
        "file_method_id": 1,
        "status": false,
        "last_modified": {
          "user": "Console",
          "roles": []
        }
      },
      "claims": [
        {
          "id": 3,
          "code": "01HG6E9JAYFFR6B56XJFY25NHW",
          "patient": "Fonseca Leonela",
          "insurance_plan": "Connect 1500 Gold",
          "billed_amount": "600.00",
          "paid_amount": null,
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
              "created_at": "2023-11-26T18:29:29.000000Z",
              "updated_at": "2023-11-26T18:29:29.000000Z",
              "payment": null,
              "modifiers": []
            },
            {
              "id": 2,
              "claim_service_id": 1,
              "procedure_id": 15,
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
              "created_at": "2023-11-26T18:29:29.000000Z",
              "updated_at": "2023-11-26T18:29:29.000000Z",
              "payment": {
                "payment_id": 1,
                "service_id": 2,
                "id": 1,
                "claim_id": 3,
                "currency": "USD",
                "payment": "0",
                "exp_adj": "0",
                "remain": "0",
                "ins_amount": "0",
                "resp_insurance": "1",
                "pt_resp": "0",
                "reason": "1",
                "denial_reason": "1",
                "note": "as dasw wwa sw asd was awds aw sa aw",
                "created_at": "2023-11-27T13:39:29.000000Z",
                "updated_at": "2023-11-27T13:39:29.000000Z",
                "adjustments": [
                  {
                    "id": 1,
                    "payment_service_id": 1,
                    "currency": "USD",
                    "amount": "0",
                    "adj_reason": "11",
                    "created_at": "2023-11-27T13:39:29.000000Z",
                    "updated_at": "2023-11-27T13:39:29.000000Z"
                  }
                ]
              },
              "modifiers": []
            }
          ]
        }
      ]
    }
  ],
  "created_at": "2023-11-26T18:09:03.000000Z",
  "updated_at": "2023-11-26T18:09:03.000000Z",
  "company": {
    "id": 1,
    "code": "CO-00001-2023",
    "name": "Nexus Medical Centers, Llc",
    "npi": "1750811915",
    "ein": null,
    "clia": "",
    "other_name": "",
    "created_at": "2023-11-21T13:37:33.000000Z",
    "updated_at": "2023-11-21T13:37:33.000000Z",
    "public_note": "",
    "last_modified": {
      "user": "Console",
      "roles": []
    },
    "taxonomies": [
      {
        "tax_id": "207RC0000X",
        "name": "Internal Medicine, Cardiovascular Disease",
        "primary": false,
        "created_at": "2023-11-21T13:37:33.000000Z",
        "updated_at": "2023-11-21T13:37:33.000000Z"
      },
      {
        "tax_id": "207Q00000X",
        "name": "Family Medicine",
        "primary": false,
        "created_at": "2023-11-21T13:37:33.000000Z",
        "updated_at": "2023-11-21T13:37:33.000000Z"
      }
    ],
    "facilities": {
      "current_page": 1,
      "data": [
        {
          "billing_company_id": null,
          "facility_id": 1,
          "billing_company": "",
          "facility": "Caring Family Corp",
          "facility_types": []
        },
        {
          "billing_company_id": null,
          "facility_id": 1,
          "billing_company": "",
          "facility": "Caring Family Corp",
          "facility_types": []
        },
        {
          "billing_company_id": null,
          "facility_id": 1,
          "billing_company": "",
          "facility": "Caring Family Corp",
          "facility_types": []
        },
        {
          "billing_company_id": null,
          "facility_id": 1,
          "billing_company": "",
          "facility": "Caring Family Corp",
          "facility_types": []
        }
      ],
      "first_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "links": [
        {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
        },
        {
          "url": "http://localhost/api/v1/payments/batch/16?page=1",
          "label": "1",
          "active": true
        },
        {
          "url": null,
          "label": "Next &raquo;",
          "active": false
        }
      ],
      "next_page_url": null,
      "path": "http://localhost/api/v1/payments/batch/16",
      "per_page": 10,
      "prev_page_url": null,
      "to": 4,
      "total": 4
    },
    "services": {
      "current_page": 1,
      "data": [],
      "first_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "from": null,
      "last_page": 1,
      "last_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "links": [
        {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
        },
        {
          "url": "http://localhost/api/v1/payments/batch/16?page=1",
          "label": "1",
          "active": true
        },
        {
          "url": null,
          "label": "Next &raquo;",
          "active": false
        }
      ],
      "next_page_url": null,
      "path": "http://localhost/api/v1/payments/batch/16",
      "per_page": 10,
      "prev_page_url": null,
      "to": null,
      "total": 0
    },
    "copays": {
      "current_page": 1,
      "data": [],
      "first_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "from": null,
      "last_page": 1,
      "last_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "links": [
        {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
        },
        {
          "url": "http://localhost/api/v1/payments/batch/16?page=1",
          "label": "1",
          "active": true
        },
        {
          "url": null,
          "label": "Next &raquo;",
          "active": false
        }
      ],
      "next_page_url": null,
      "path": "http://localhost/api/v1/payments/batch/16",
      "per_page": 10,
      "prev_page_url": null,
      "to": null,
      "total": 0
    },
    "contract_fees": {
      "current_page": 1,
      "data": [],
      "first_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "from": null,
      "last_page": 1,
      "last_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "links": [
        {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
        },
        {
          "url": "http://localhost/api/v1/payments/batch/16?page=1",
          "label": "1",
          "active": true
        },
        {
          "url": null,
          "label": "Next &raquo;",
          "active": false
        }
      ],
      "next_page_url": null,
      "path": "http://localhost/api/v1/payments/batch/16",
      "per_page": 10,
      "prev_page_url": null,
      "to": null,
      "total": 0
    },
    "exception_insurance_companies": {
      "current_page": 1,
      "data": [],
      "first_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "from": null,
      "last_page": 1,
      "last_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "links": [
        {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
        },
        {
          "url": "http://localhost/api/v1/payments/batch/16?page=1",
          "label": "1",
          "active": true
        },
        {
          "url": null,
          "label": "Next &raquo;",
          "active": false
        }
      ],
      "next_page_url": null,
      "path": "http://localhost/api/v1/payments/batch/16",
      "per_page": 10,
      "prev_page_url": null,
      "to": null,
      "total": 0
    },
    "patients": {
      "current_page": 1,
      "data": [],
      "first_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "from": null,
      "last_page": 1,
      "last_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "links": [
        {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
        },
        {
          "url": "http://localhost/api/v1/payments/batch/16?page=1",
          "label": "1",
          "active": true
        },
        {
          "url": null,
          "label": "Next &raquo;",
          "active": false
        }
      ],
      "next_page_url": null,
      "path": "http://localhost/api/v1/payments/batch/16",
      "per_page": 10,
      "prev_page_url": null,
      "to": null,
      "total": 0
    },
    "statements": {
      "current_page": 1,
      "data": [],
      "first_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "from": null,
      "last_page": 1,
      "last_page_url": "http://localhost/api/v1/payments/batch/16?page=1",
      "links": [
        {
          "url": null,
          "label": "&laquo; Previous",
          "active": false
        },
        {
          "url": "http://localhost/api/v1/payments/batch/16?page=1",
          "label": "1",
          "active": true
        },
        {
          "url": null,
          "label": "Next &raquo;",
          "active": false
        }
      ],
      "next_page_url": null,
      "path": "http://localhost/api/v1/payments/batch/16",
      "per_page": 10,
      "prev_page_url": null,
      "to": null,
      "total": 0
    },
    "abbreviations": [
      "NEXUS"
    ],
    "billing_companies": [
      {
        "id": 1,
        "name": "Medical Claims Consultants",
        "code": "BC-00001-2023",
        "abbreviation": "MCC",
        "private_company": {
          "status": true,
          "miscellaneous": "",
          "split_company_claim": false,
          "claim_format_ids": [],
          "claim_formats": [
            {
              "id": 1,
              "name": "CMS-1500 / 837P"
            },
            {
              "id": 2,
              "name": "UB-04 / 837I"
            }
          ],
          "edit_name": false,
          "nickname": "",
          "abbreviation": "NEXUS",
          "private_note": "",
          "taxonomy": [],
          "address": {
            "address": "1914 Northwest 84th Avenue",
            "city": "Doral",
            "state": "FL - Florida",
            "zip": "331261030",
            "country": null,
            "apt_suite": "",
            "created_at": "2023-11-21T13:37:33.000000Z",
            "updated_at": "2023-11-21T13:37:33.000000Z"
          },
          "payment_address": null,
          "contact": {
            "phone": "3052548900",
            "fax": "3052548902",
            "email": "info@nexus.com",
            "mobile": "3052548900",
            "contact_name": "",
            "created_at": "2023-11-21T13:37:33.000000Z",
            "updated_at": "2023-11-21T13:37:33.000000Z"
          }
        }
      }
    ]
  },
  "billing_company": {
    "id": 1,
    "name": "Medical Claims Consultants",
    "created_at": "2023-11-21T13:36:18.000000Z",
    "updated_at": "2023-11-21T13:36:18.000000Z",
    "code": "BC-00001-2023",
    "status": true,
    "logo": "http://31.220.55.211:81/img-billing-company/1675262605.png",
    "abbreviation": "MCC",
    "tax_id": null,
    "last_modified": {
      "user": "Console",
      "roles": []
    },
    "contact": {
      "id": 1,
      "phone": "7862089235",
      "fax": "8003341041",
      "email": "sales@mccondemand.net",
      "billing_company_id": 1,
      "created_at": "2023-11-21T13:36:18.000000Z",
      "updated_at": "2023-11-21T13:36:18.000000Z",
      "mobile": "7862089235",
      "contactable_type": "App\\Models\\BillingCompany",
      "contactable_id": 1,
      "contact_name": null
    },
    "address": {
      "id": 1,
      "address": "780 Northwest Le Jeune Road",
      "city": "Miami",
      "state": "FL - Florida",
      "zip": "331265540",
      "billing_company_id": 1,
      "created_at": "2023-11-21T13:36:18.000000Z",
      "updated_at": "2023-11-21T13:36:18.000000Z",
      "addressable_type": "App\\Models\\BillingCompany",
      "addressable_id": 1,
      "address_type_id": null,
      "country": null,
      "country_subdivision_code": null,
      "apt_suite": "",
      "state_code": "FL"
    },
    "contacts": [
      {
        "id": 1,
        "phone": "7862089235",
        "fax": "8003341041",
        "email": "sales@mccondemand.net",
        "billing_company_id": 1,
        "created_at": "2023-11-21T13:36:18.000000Z",
        "updated_at": "2023-11-21T13:36:18.000000Z",
        "mobile": "7862089235",
        "contactable_type": "App\\Models\\BillingCompany",
        "contactable_id": 1,
        "contact_name": null
      }
    ],
    "addresses": [
      {
        "id": 1,
        "address": "780 Northwest Le Jeune Road",
        "city": "Miami",
        "state": "FL - Florida",
        "zip": "331265540",
        "billing_company_id": 1,
        "created_at": "2023-11-21T13:36:18.000000Z",
        "updated_at": "2023-11-21T13:36:18.000000Z",
        "addressable_type": "App\\Models\\BillingCompany",
        "addressable_id": 1,
        "address_type_id": null,
        "country": null,
        "country_subdivision_code": null,
        "apt_suite": "",
        "state_code": "FL"
      }
    ]
  }
}
```