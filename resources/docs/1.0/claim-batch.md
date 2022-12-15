# claim batch Docs

---

- [Basic data](#basic-data)
- [Create batch](#create-batch)
- [Get all batch from server](#get-all-batch-server)
- [Get all claim from server](#get-all-claim-server)
- [Get one claim batch](#get-one-batch)
- [Update batch](#update-batch)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name                        | URL                                  | Token required | Description     |
| : |        |                             |                                      |                |                 |  
| 1 |POST    | `Create batch`              | `claim/batch/`                       | yes            | Create claim batch  |         
| 2 |GET     | `Get all batch from server` | `/claim/batch/get-all-server`        |yes             | Get all claim batch from server|
| 3 |GET     | `Get all claim from server` | `/claim/batch/get-all-server-claims` |yes             | Get all claim from server|
| 4 |GET     | `Get one batch`             | `/claim/batch/{id}`                  | yes            | Get one claim batch |
| 5 |PUT     | `Update batch`              | `/claim/batch/{id}`                  | yes            | Update claim batch  |
| 8 |DELETE  | `Delete batch`              | `/claim/batch/{id}`                  | yes            | Delete claim batch  |


<a name="create-batch"></a>
## Create claim batch

### Body request example

```json
{
    "name": "Name batch",
    "fake_transmission": null,
    "claims_reconciled": false,
    "company_id": 1,
    "billing_company_id": 1,
    "claim_ids": [1,2,3],
    "send": null
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 claim batch created


#

```json
{
    "code": "CB-00002-2022",
    "name": "Name batch",
    "status": "Not submitted",
    "shipping_date": null,
    "fake_transmission": false,
    "claims_reconciled": false,
    "company_id": 1,
    "billing_company_id": 1,
    "updated_at": "2022-12-06T11:32:00.000000Z",
    "created_at": "2022-12-06T11:32:00.000000Z",
    "id": 2,
    "total_processed": "0",
    "claim_ids": [
        1,
        2,
        3
    ]
}
```


#

<a name="get-all-batch-server"></a>
## Get all claim batch from server

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`query <string>`
`itemsPerPage <string>`
`page <integer>`
`sortBy <string>`
`sortDesc <boolean>`

## Example path

>{primary} ?query=fieldSearch&itemsPerPage=5&sortDesc=1&page=1&sortBy=fieldName

## Response

> {success} 200 cdata returned

#


```json
{
    "data": [
        {
            "id": 2,
            "code": "CB-00002-2022",
            "name": "Name batch",
            "status": "Not submitted",
            "shipping_date": null,
            "fake_transmission": false,
            "claims_reconciled": false,
            "company_id": 1,
            "billing_company_id": 1,
            "created_at": "2022-12-06T11:32:00.000000Z",
            "updated_at": "2022-12-06T11:32:00.000000Z",
            "total_processed": "0",
            "claim_ids": [
                1,
                2,
                3
            ],
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
            }
        },
        {
            "id": 1,
            "code": "CB-00001-2022",
            "name": "Batch 1",
            "status": "Not submitted",
            "shipping_date": null,
            "fake_transmission": false,
            "claims_reconciled": false,
            "company_id": 1,
            "billing_company_id": 1,
            "created_at": "2022-12-05T13:32:20.000000Z",
            "updated_at": "2022-12-05T13:32:20.000000Z",
            "total_processed": "0",
            "claim_ids": [
                1,
                2,
                3
            ],
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
            }
        }
    ],
    "numberOfPages": 1,
    "count": 2
}
```

#

<a name="get-all-claim-server"></a>
## Get all claim from server

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`query <string>`
`itemsPerPage <string>`
`page <integer>`
`sortBy <string>`
`sortDesc <boolean>`
`filterBy <string>`
`billing_company_id <integer>`
`company_id <integer>`

## Example path

>{primary} ?query=fieldSearch&itemsPerPage=5&sortDesc=1&page=1&sortBy=fieldName&filterBy=billingcompany&billing_company_id=1

## Response

> {success} 200 data returned

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

#

<a name="get-one-batch"></a>
## Get one claim batch

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

> {success} 200 claim batch found

#


```json
{
    "id": 3,
    "code": "NABA-00001-22",
    "name": "Name batch2",
    "status": "Not submitted",
    "shipping_date": null,
    "fake_transmission": false,
    "company_id": 1,
    "billing_company_id": 21,
    "created_at": "2022-12-13T23:48:12.000000Z",
    "updated_at": "2022-12-13T23:48:12.000000Z",
    "claims_reconciled": false,
    "claim_ids": [
        1,
        2,
        3
    ],
    "total_processed": 0,
    "total_claims": 3,
    "total_accepted": 0,
    "total_denied": 0,
    "total_accepted_by_clearing_house": 0,
    "total_denied_by_clearing_house": 0,
    "total_accepted_by_payer": 0,
    "total_denied_by_payer": 0,
}
```

<a name="update-batch"></a>
## Update claim batch

### Body request example

```json
{
    "name": "Name batch edited",
    "fake_transmission": true,
    "company_id": 1,
    "billing_company_id": 1,
    "claim_ids": [1,2,3],
    "send": true
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

> {success} 200 claim batch updated

#

```json
{
    "id": 1,
    "code": "CB-00001-2022",
    "name": "Name batch edited",
    "status": "Submitted",
    "shipping_date": "2022-12-06T11:45:12.173014Z",
    "fake_transmission": true,
    "company_id": 1,
    "billing_company_id": 1,
    "created_at": "2022-12-05T13:32:20.000000Z",
    "updated_at": "2022-12-06T11:45:12.000000Z",
    "total_processed": "0",
    "claim_ids": [
        1,
        2,
        3
    ]
}
```

<a name="delete-batch"></a>
## Delete claim batch


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

> {success} 204 claim batch deleted