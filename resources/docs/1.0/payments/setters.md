# Address Docs

---
- [Store batch](#store-batch)
- [Update batch](#update-batch)
- [Store/Update batch claims](#sync-claims)
- [Store/Update batch services](#sync-services)
- [Close batch](#close-batch)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
|1|POST|`Store batch` |`/payments/batch`|yes|Store batch|
|2|PUT |`Update batch`|`/payments/batch/{batch_id}`|yes|Get all payments sources list|
|3|POST|`Store/Update batch claims`  |`/payments/batch/{batch}/claims`|yes|Get all payments metods list|
|4|POST|`Store/Update batch services`|`/payments/batch/{batch}/services`|yes|this is the view for the eob file|
|5|GET |`Close batch` |`/payments/batch`|yes|Get list of all payments batches|

>{primary} when url params have this symbol "?" mean not required, so you must to send null

<a name="store-batch"></a>
## Store batch

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in body

``` json
{
  "billing_company_id": 1, // only for admin
  "company_id": 1,
  "name": "test",
  "posting_date": "2015-10-5",
  "currency": "USD",
  "amount": "25000",
  "payments": [
    {
      "order": 1,
      "source_id":1,
      "insurance_company_id": 1,
      "payment_date": "2015-10-5",
      "currency": "USD",
      "amount": "25000",
      "method": "1",
      "reference": 1541586,
      "statement": true,
      "note": "test note",
      "eobs": [{
        "name": "test",
        "date": "2015-10-5",
        "file_name": "test"
      }]
    }
  ],
  "files": [ // files for eobs
    eob_files 
    ...
  ]
}
```

## Response

> {success} 200 data retorned

#
```json
{
  "id": 20,
  "name": "test",
  "posting_date": "2015-10-05T00:00:00.000000Z",
  "currency": "USD",
  "amount": "25000",
  "status": 1,
  "payments": [
    {
      "id": 20,
      "order": 1,
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
      "claims": []
    }
  ],
  "created_at": "2023-11-27T18:17:46.000000Z",
  "updated_at": "2023-11-27T18:17:46.000000Z",
  "company": {...},
  "billing_company": {...}
}
```

<a name="update-batch"></a>
## Update batch

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in body

```json
{
  "billing_company_id": 1, //only admin
  "company_id": 1,
  "name": "test",
  "posting_date": "2015-10-5",
  "currency": "USD",
  "amount": "25000",
  "payments": [
    {
      "order": 1,
      "source_id":1,
      "insurance_company_id": 1,
      "payment_date": "2015-10-5",
      "currency": "USD",
      "amount": "25000",
      "method": "1",
      "reference": 1541586,
      "statement": true,
      "note": "asdawdsadawsdw",
      "eobs": [{
        "name": "test",
        "date": "2015-10-5",
        "file_name": "test"
      }]
    }
  ]
  "files": [ // files for eobs
    eob_files 
    ...
  ]
}
```

## Response

> {success} 200 data retorned

#
```json
{
  "id": 20,
  "name": "test",
  "posting_date": "2015-10-05T00:00:00.000000Z",
  "currency": "USD",
  "amount": "25000",
  "status": 1,
  "payments": [
    {
      "id": 20,
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
      "claims": []
    }
  ],
  "created_at": "2023-11-27T18:17:46.000000Z",
  "updated_at": "2023-11-27T18:17:46.000000Z",
  "company": {...},
  "billing_company": {...}
}
```

<a name="sync-claims"></a>
## update store batch claims

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in body

```json
{
  "payments": [
    {
      "id":16, //payment id
      "claims": [
        3
      ]
    }
  ]
}
```

## Response

> {success} 200 data retorned

#
```json
{
  "id": 20,
  "name": "test",
  "posting_date": "2015-10-05T00:00:00.000000Z",
  "currency": "USD",
  "amount": "25000",
  "status": 1,
  "payments": [
    {
      "id": 20,
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
      "claims": []
    }
  ],
  "created_at": "2023-11-27T18:17:46.000000Z",
  "updated_at": "2023-11-27T18:17:46.000000Z",
  "company": {...},
  "billing_company": {...}
}
```


<a name="sync-services"></a>
## update / store batch claims services

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in body

```json
{
  "payments": [
    {
      "id":1,
      "services": [
        {
          "claim_id": 4,
          "service_id": 7,
          "payment": "$100.00",
          "exp_adj": "$0.00",
          "adjust": [{
            "amount": "$15.00",
            "adj_reason": "11"
          }],
          "remain": "$20.00",
          "ins_amount": "$10.00",
          "resp_insurance": "1",
          "pt_resp": "$22.00",
          "reason": "1",
          "denial_reason": "1",
          "note": "as dasw wwa sw asd was awds aw sa aw",
          "refile": null
        }
      ]
    }
  ]
}
```

## Response

> {success} 200 data retorned

#
```json
{
  "id": 20,
  "name": "test",
  "posting_date": "2015-10-05T00:00:00.000000Z",
  "currency": "USD",
  "amount": "25000",
  "status": 1,
  "payments": [
    {
      "id": 20,
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
      "claims": []
    }
  ],
  "created_at": "2023-11-27T18:17:46.000000Z",
  "updated_at": "2023-11-27T18:17:46.000000Z",
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
    "facilities": {...,
    "services": {...},
    "copays": {...},
    "contract_fees": {...},
    "exception_insurance_companies": {...},
    "patients": {...},
    "statements": {...},
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
          "claim_formats": [...],
          "edit_name": false,
          "nickname": "",
          "abbreviation": "NEXUS",
          "private_note": "",
          "taxonomy": [],
          "address": {...},
          "payment_address": null,
          "contact": {...}
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
    "contact": {...},
    "address": {...},
    "contacts": [...],
    "addresses": [...]
  }
}
```

<a name="close-batch"></a>
## close batch

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data retorned
