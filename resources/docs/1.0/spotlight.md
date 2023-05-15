# Spotlight Docs

---

- [Basic data](#basic-data)
- [Search](#search)
- [Filters](#filters)

<a name="basic-data"></a>
## Basic data to make request

| # | METHOD | Name              | URL              | Token required | Description        |
| : |        |                   |                  |                |                    |  
| 1 |GET     | `Search`          |`/search/{query}` | yes            | Search for aniting |         
| 2 |GET     | `Get Filters list`|`/search-filters/`| yes            | Get list of filters|

<a name="search"></a>
## Search

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`filters <array<string>>`

## Example path

>{primary} ?filters[]=billing_company&filters[]=facility

## Response

> {success} 200 data returned

#
```json
{
  "billing_company": [
    {
      "id": 3,
      "name": "Advanced Pacific Medical, Llc",
      "created_at": "2023-04-28T11:22:52.000000Z",
      "updated_at": "2023-04-28T11:22:52.000000Z",
      "code": "BC-00003-2023",
      "status": true,
      "logo": null,
      "abbreviation": "ADVANCEDMD",
      "last_modified": {
        "user": "Console",
        "roles": []
      },
      "contact": {
        "id": 3,
        "phone": "8542842771",
        "fax": "8123341041",
        "email": "info@advancedpacific.com",
        "billing_company_id": 3,
        "created_at": "2023-04-28T11:22:52.000000Z",
        "updated_at": "2023-04-28T11:22:52.000000Z",
        "mobile": "8452842771",
        "contactable_type": "App\\Models\\BillingCompany",
        "contactable_id": 3,
        "contact_name": null
      },
      "address": {
        "id": 3,
        "address": "San Diego Street",
        "city": "Oceanside",
        "state": "920582744",
        "zip": "917652030",
        "billing_company_id": 3,
        "created_at": "2023-04-28T11:22:52.000000Z",
        "updated_at": "2023-04-28T11:22:52.000000Z",
        "addressable_type": "App\\Models\\BillingCompany",
        "addressable_id": 3,
        "address_type_id": null,
        "country": null,
        "country_subdivision_code": null
      },
      "contacts": [
        {
          "id": 3,
          "phone": "8542842771",
          "fax": "8123341041",
          "email": "info@advancedpacific.com",
          "billing_company_id": 3,
          "created_at": "2023-04-28T11:22:52.000000Z",
          "updated_at": "2023-04-28T11:22:52.000000Z",
          "mobile": "8452842771",
          "contactable_type": "App\\Models\\BillingCompany",
          "contactable_id": 3,
          "contact_name": null
        }
      ],
      "addresses": [
        {
          "id": 3,
          "address": "San Diego Street",
          "city": "Oceanside",
          "state": "920582744",
          "zip": "917652030",
          "billing_company_id": 3,
          "created_at": "2023-04-28T11:22:52.000000Z",
          "updated_at": "2023-04-28T11:22:52.000000Z",
          "addressable_type": "App\\Models\\BillingCompany",
          "addressable_id": 3,
          "address_type_id": null,
          "country": null,
          "country_subdivision_code": null
        }
      ]
    }
  ],
  "facility": [
    {
      "id": 3,
      "facility_type_id": 6,
      "name": "Macarena Assisted Living Facility, Inc.",
      "npi": "1851778658",
      "created_at": "2023-04-28T11:22:53.000000Z",
      "updated_at": "2023-04-28T11:22:53.000000Z",
      "code": "FA-00003-2023",
      "nppes_verified_at": "2023-04-28",
      "status": false,
      "last_modified": {
        "user": "Console",
        "roles": []
      },
      "verified_on_nppes": true
    },
    {
      "id": 4,
      "facility_type_id": 6,
      "name": "My New Home Alf I, Inc.",
      "npi": "1699160762",
      "created_at": "2023-04-28T11:22:53.000000Z",
      "updated_at": "2023-04-28T11:22:53.000000Z",
      "code": "FA-00004-2023",
      "nppes_verified_at": "2023-04-28",
      "status": false,
      "last_modified": {
        "user": "Console",
        "roles": []
      },
      "verified_on_nppes": true
    }
  ],
  "health_professional": [
    {
      "id": 3,
      "npi": "1770883027",
      "user_id": 24,
      "created_at": "2023-04-28T11:22:54.000000Z",
      "updated_at": "2023-04-28T11:22:54.000000Z",
      "code": "HP-00003-2023",
      "is_provider": false,
      "npi_company": "",
      "health_professional_type_id": 1,
      "company_id": 2,
      "nppes_verified_at": null,
      "ein": null,
      "upin": null,
      "status": false,
      "last_modified": {
        "user": "Console",
        "roles": []
      },
      "companies_providers": [
        {
          "health_professional_id": 3,
          "company_id": 2,
          "authorization": [
            1,
            2,
            3
          ],
          "billing_company_id": 1,
          "created_at": "2023-04-28T11:22:54.000000Z",
          "updated_at": "2023-04-28T11:22:54.000000Z"
        }
      ],
      "verified_on_nppes": false,
      "companies": [
        {
          "id": 2,
          "code": "CO-00002-2023",
          "name": "Isle Of Palms Recovery Center, Llc",
          "npi": "1538603873",
          "created_at": "2023-04-28T11:22:52.000000Z",
          "updated_at": "2023-04-28T11:22:52.000000Z",
          "ein": null,
          "upin": null,
          "clia": null,
          "status": null,
          "edit_name": false,
          "last_modified": {
            "user": "Console",
            "roles": []
          },
          "pivot": {
            "health_professional_id": 3,
            "company_id": 2,
            "authorization": [
              1,
              2,
              3
            ],
            "billing_company_id": 1,
            "created_at": "2023-04-28T11:22:54.000000Z",
            "updated_at": "2023-04-28T11:22:54.000000Z"
          },
          "nicknames": []
        }
      ]
    }
  ]
}
```

<a name="filters"></a>
## Filters

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data returned

#
```json
[
  "billing_company",
  "claim",
  "company",
  "facility",
  "health_professional"
]
```
