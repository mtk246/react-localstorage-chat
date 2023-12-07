# getters claims rule Docs

---

- [Basic data](#basic-data)
- [Get list of rules](#rules-list)
- [Get list of rules types](#rules-types)
- [Get all rules](#get-all-rules)
- [Get single rule](#get-one-rules)

<a name="basic-data"></a>
## Basic data to make request

| #  | METHOD | Name                        | URL                                   | Token required | Description                          |
| :  |        |                             |                                       |                |                                      |  
| 1  | GET    | `Get list of rules`         | `claim/rules/list`                    | yes            | Get list of rules and default config |         
| 2  | GET    | `Get list of rules types`   | `claim/rules/types`                   | yes            | Get list of document types           |
| 3  | GET    | `Get all rules`             | `claim/rules`                         | yes            |Get all claim rules in billing company|
| 4  | GET    | `Get single rule`           | `claim/rules/{rule}`                  | yes            | Get single rule                      |

<a name="rules-list"></a>
## Get list of rules and default config


## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response
```json
{
  "institutional": {
    "file": {...},
    "json": {...}
  },
  "professional": {
    "file": {
      "1": {
        "type": "single",
        "value": "insType:code"
      },
      "2": {
        "type": "multiple",
        "length": 30,
        "value": [
          "patientProfile:last_name",
          "patientProfile:name_suffix",
          "patientProfile:first_name",
          "patientProfile:middle_name"
        ]
      },
      ...
    },
    "json": {...}
  }
}
```

<a name="rules-types"></a>
## Get list of rule document types


## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response
```json
[
    {
        "id": 1,
        "name": "institutional"
    },
    {
        "id": 2,
        "name": "professional"
    }
]
```

<a name="get-all-rules"></a>
## Get all claim rules in billing company

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

> {success} 200 rules data returned

#
```json
{
  "current_page": 1,
  "data": [
    {
      "id": "01hc7qg3jacxzs1beq478kfdf9",
      "name": "test test test",
      "description": "",
      "insurance_plan": {
        "id": 1,
        "code": "IP-00001-2023",
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
        "created_at": "2023-09-20T04:45:45.000000Z",
        "updated_at": "2023-09-20T04:45:45.000000Z",
        "ins_type_id": 3,
        "plan_type_id": null,
        "payer_id": null,
        "last_modified": {
          "user": "Console",
          "roles": []
        }
      },
      "format": "institutional",
      "rules": {
        "file": {
          "4": {
            "type": "multiple",
            "length": 30,
            "value": [
              "|0",
              "demographicInformation.bill_classification",
              "patientInformation.billClassification.code"
            ],
            "values": {
              "common": [
                "|0",
                "patientInformation.billClassification.code",
                "demographicInformation.bill_classification"
              ]
            }
          },
          ...
        "json": {...}
      }
    },
    "active": false
  ],
  "first_page_url": "http://localhost/api/v1/claim/rules?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://localhost/api/v1/claim/rules?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "active": false
    },
    {
      "url": "http://localhost/api/v1/claim/rules?page=1",
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
  "path": "http://localhost/api/v1/claim/rules",
  "per_page": 10,
  "prev_page_url": null,
  "to": 1,
  "total": 1
}
```

<a name="get-one-rules"></a>
## Get single rule

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "rule": <string>
}
```

## Example path

>{primary} claim/rules/01hc7qg3jacxzs1beq478kfdf9

## Response

> {success} 200 rule data returned

#

```json
{
  "id": "01hc7qg3jacxzs1beq478kfdf9",
  "name": "test test test",
  "description": "",
  "insurance_plan": {
    "id": 1,
    "code": "IP-00001-2023",
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
    "created_at": "2023-09-20T04:45:45.000000Z",
    "updated_at": "2023-09-20T04:45:45.000000Z",
    "ins_type_id": 3,
    "plan_type_id": null,
    "payer_id": null,
    "last_modified": {
      "user": "Console",
      "roles": []
    }
  },
  "format": "institutional",
  "rules": {
    "file": {
      "4": {
        "type": "multiple",
        "length": 30,
        "value": [
          "|0",
          "demographicInformation.bill_classification",
          "patientInformation.billClassification.code"
        ],
        "values": {
          "common": [
            "|0",
            "patientInformation.billClassification.code",
            "demographicInformation.bill_classification"
          ]
        }
      },
      ...
    "json": {...}
  },
  "active": true
}
```
