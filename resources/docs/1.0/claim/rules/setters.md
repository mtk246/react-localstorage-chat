# getters claims rule Docs

---

- [Basic data](#basic-data)
- [Store rule](#store)
- [Update rule](#update)
- [Destroy rule](#destroy)

<a name="basic-data"></a>
## Basic data to make request

| #  | METHOD | Name                        | URL                                   | Token required | Description                          |
| :  |        |                             |                                       |                |                                      |  
| 1  | POST   | `Store rule`                | `claim/rules`                         | yes            | create rule for document type        |         
| 2  | PUT    | `Update rule`               | `claim/rules/{rule}`                  | yes            | updata rule                          |
| 3  | DELETE | `Destroy rule`              | `claim/rules/rule`                    | yes            | destroy currect rule                 |

<a name="store"></a>
## Create rule for document type

### Body request example

```json
{
  "name": "test test test",
  "format": "institutional",
  "billing_company_id": 1,
  "insurance_plan_id": 1,
  "rules": {
    "file": {
      "1a":["demographicInformation.company.name"]
    }
  }
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response
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
  }
}
```

<a name="update"></a>
## Updata rule

### Body request example

```json
{
  "name": "test test test",
  "format": "institutional",
  "billing_company_id": 1,
  "insurance_plan_id": 1,
  "rules": {
    "file": {
      "1a":["demographicInformation.company.name"]
    }
  },
  "active": false
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
    "rule": <string>
}
```

## Example path

>{primary} claim/rules/01hc7qg3jacxzs1beq478kfdf9

## Response
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
  },,
  "active": false,
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
}
```

<a name="destroy"></a>
## Destroy currect rule

## Param in header

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

> {success} 200 rule deleted


#
> true
