# Company Create Docs

---

- [Basic data](#basic-data)
- [Create company](#create-company)
- [Update company contacts](#update-company-contacts)
- [Update company data](#update-company-data)
- [Update company exections](#update-company-exections)
- [Update company notes](#update-company-notes)
- [Update company statements](#update-company-statements)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create company`          | `/company/`               |yes             |Create company|         
| 2 |PUT | `Update company`          | `/company/{id}`|yes|update company|
| 2 |PUT | `Update company contacts` | `/company/{company}/contacts`|yes|update company contacts|
| 2 |PUT | `Update company data`     | `/company/{company}/data`|yes|update company data|
| 2 |PUT | `Update company exections`| `/company/{company}/exections`|yes|update company|
| 2 |PUT | `Update company notes`    | `/company/{company}/notes`|yes|update company notes|
| 2 |PUT | `Update company statements`| `/company/{company}/statements`|yes|update company|


<a name="create-company"></a>
## Create Company

### Body request example


#

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "npi":"222123", /** required */
    "ein":"1234321", /** required only number max 9 */
    "upin":"222CF123", /** optional alfanumeric max 50 */
    "clia":"222CF123", /** optional alfanumeric max 50 */
    "name":"company first", /** required */
    "nickname":"alias company first", /** optional */
    "name_suffix_id": 1, /** optional */
    "abbreviation": "ABB", /** optional */
    "taxonomies": [
        {
            "tax_id": "TAX01213", /** required if exist*/
            "name": "NameTaxonomy Company", /** required if exist */
            "primary": true /** required if exist */
        },
        {
            "tax_id": "TAX01222", /** required if exist */
            "name": "NameTaxonomy 2 Company", /** required if exist */
            "primary": false /** required if exist */
        }
    ],
    "contact": {
        "contact_name": "Name Contact", /** optional */
        "phone":"34324234", /** optional */
        "mobile":"34324234", /** optional */
        "fax":"567674576457", /** optional */
        "email":"company@company.com" /** required */
    },
    "address": {
        "address":"address Company", /** required */
        "city":"city Company", /** required */
        "state":"state Company", /** required */
        "zip": "123234", /** required */
        "country": "Name country", /** optional */
        "country_subdivision_code": "code" /** optional */
    },
    "payment_address": { /** optional */
        "address":"address Company", /** required if exist */
        "city":"city Company", /** required if exist */
        "state":"state Company", /** required if exist */
        "zip": "123234", /** required if exist */
        "country": "Name country", /** optional */
        "country_subdivision_code": "code" /** optional */
    },
    "statements": [
        {
            "rule_id": 1, /** optional */
            "when_id": 1, /** optional */
            "apply_to_ids": [1,2,3], /** optional */
            "start_date": "2022-02-03", /** required if when content 'period' */
            "end_date": "2022-02-03", /** required if when content 'period', example 'In a defined period' */
        }
    ],
    "exception_insurance_companies": [1,2,3], /** optional */
    "public_note": "Public Note", /** optional */
    "private_note": "Private Note" /** optional */
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 company created


#

```json
{
    "code": "CO-00001-2022",
    "name": "company first",
    "npi": "222CF123",
    "updated_at": "2022-03-16T09:44:57.000000Z",
    "created_at": "2022-03-16T09:44:57.000000Z",
    "id": 1,
    "status": false
}
```

<a name="update-company"></a>
## Update Company


### Body request example


#

```json
{
    "billing_company_id": 1, /** Only required by superuser */
    "npi":"222123", /** required */
    "ein":"1234321", /** required only number max 9 */
    "upin":"222CF123", /** optional alfanumeric max 50 */
    "clia":"222CF123", /** optional alfanumeric max 50 */
    "name":"company first", /** required */
    "nickname":"alias company first", /** optional */
    "name_suffix_id": 1, /** optional */
    "abbreviation": "ABB", /** optional */
    "taxonomies": [
        {
            "tax_id": "TAX01213", /** required if exist*/
            "name": "NameTaxonomy Company", /** required if exist */
            "primary": true /** required if exist */
        },
        {
            "tax_id": "TAX01222", /** required if exist */
            "name": "NameTaxonomy 2 Company", /** required if exist */
            "primary": false /** required if exist */
        }
    ],
    "contact": {
        "contact_name": "Name Contact", /** optional */
        "phone":"34324234", /** optional */
        "mobile":"34324234", /** optional */
        "fax":"567674576457", /** optional */
        "email":"company@company.com" /** required */
    },
    "address": {
        "address":"address Company", /** required */
        "city":"city Company", /** required */
        "state":"state Company", /** required */
        "zip": "123234", /** required */
        "country": "Name country", /** optional */
        "country_subdivision_code": "code" /** optional */
    },
    "payment_address": { /** optional */
        "address":"address Company", /** required if exist */
        "city":"city Company", /** required if exist */
        "state":"state Company", /** required if exist */
        "zip": "123234", /** required if exist */
        "country": "Name country", /** optional */
        "country_subdivision_code": "code" /** optional */
    },
    "statements": [
        {
            "rule_id": 1, /** optional */
            "when_id": 1, /** optional */
            "apply_to_ids": [1,2,3], /** optional */
            "start_date": "2022-02-03", /** required if when content 'period' */
            "end_date": "2022-02-03", /** required if when content 'period', example 'In a defined period' */
        }
    ],
    "exception_insurance_companies": [1,2,3], /** optional */
    "public_note": "Public Note", /** optional */
    "private_note": "Private Note" /** optional */
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company created


#

```json
{
}
```


<a name="update-company-contacts"></a>
## Update Company Contacts


### Body request example


#

```json
{
    "billing_company_id": 1, // only for admin
    "contact": {
        "contact_name": "Name Contact",
        "phone":"34324234",
        "mobile":"34324234",
        "fax":"567674576457",
        "email":"company@company.com"
    },
    "address": {
        "address":"address Company",
        "city":"city Company",
        "state":"state Company",
        "zip": "123234",
        "country": "Name country",
        "country_subdivision_code": "code"
    },
    "payment_address": {
        "address":"address Company",
        "city":"city Company",
        "state":"state Company",
        "zip": "123234",
        "country": "Name country",
        "country_subdivision_code": "code"
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

> {success} 200 company created


#

```json
{
  "contact": {
    "phone": "34324234",
    "fax": "567674576457",
    "email": "company@company.com",
    "mobile": "34324234",
    "contact_name": "Name Contact",
    "created_at": "2023-03-15T20:26:09.000000Z",
    "updated_at": "2023-03-21T00:02:03.000000Z"
  },
  "address": {
    "address": "Address Company",
    "city": "City Company",
    "state": "state Company",
    "zip": "123234",
    "country": "Name country",
    "country_subdivision_code": "code",
    "created_at": "2023-03-15T20:26:09.000000Z",
    "updated_at": "2023-03-21T00:02:03.000000Z"
  },
  "payment_address": null
}
```
```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company created


#

```json
{
}
```


<a name="update-company-data"></a>
## Update Company data


### Body request example


#

```json
{
    "billing_company_id": 1,
    "npi":"222123",
    "ein":"1234321",
    "upin":"222CF123",
    "clia":"222CF123",
    "name":"company first",
    "nickname":"alias company first",
    "taxonomies": [
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy Company",
            "primary": true
        },
        {
            "tax_id": "TAX01222",
            "name": "NameTaxonomy 2 Company",
            "primary": false
        }
    ]
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company created



```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company created


#

```json
{
  "npi": "1750811915",
  "ein": "1234321",
  "upin": "222CF123",
  "clia": "222CF123",
  "name": "Nexus Medical Centers, Llc",
  "nickname": "Alias Company First",
  "taxonomies": [
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy Company",
            "primary": true
        },
        {
            "tax_id": "TAX01222",
            "name": "NameTaxonomy 2 Company",
            "primary": false
        }
    ]
}
```


<a name="update-company-exections"></a>
## Update Company Exections insurance companies


### Body request example


#

```json
{
    "billing_company_id": 1, // admin only
    "store": [
      {
        "id": 6,
        "insurance_company_id": 1
      }
    ],
    "delete": [14,15,16]
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company created

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company created


#

```json
[
  {
    "id": 6,
    "insurance_company_id": 1,
    "created_at": "2023-03-23T05:25:18.000000Z",
    "updated_at": "2023-03-23T07:26:23.000000Z"
  }
]
```


<a name="update-company-notes"></a>
## Update Company Notes


### Body request example


#

```json
{
    "billing_company_id": 1, // only for admin
    "public_note": "test test test test test test",
    "private_note": "test test test test test test test test test test"
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company created


#

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company created


#

```json
{
  "public_note": "Test test test test test test",
  "private_note": "Test test test test test test test test test test"
}
```


<a name="update-company-statements"></a>
## Update Company Statements


### Body request example


#

```json
 {
    "billing_company_id": 1, // for admin only
    "store": [
      {
        "id": 8,
        "rule_id": 1,
        "when_id": 1,
        "apply_to_ids": [1,2,3],
        "start_date": "2022-02-03",
        "end_date": "2022-02-03"
      },
      {
        "rule_id": 1,
        "when_id": 1,
        "apply_to_ids": [1,2,3],
        "start_date": "2022-02-03",
        "end_date": "2022-02-03"
      }
    ],
    "delete": []
 }
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company created


#
```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company created


#

```json
[
  {
    "id": 8,
    "rule_id": 1,
    "when_id": 1,
    "start_date": "2022-02-03",
    "end_date": "2022-02-03",
    "apply_to_ids": [
      1,
      2,
      3
    ],
    "created_at": "2023-03-23T07:56:31.000000Z",
    "updated_at": "2023-03-23T07:56:31.000000Z"
  },
  {
    "id": 10,
    "rule_id": 1,
    "when_id": 1,
    "start_date": "2022-02-03",
    "end_date": "2022-02-03",
    "apply_to_ids": [
      1,
      2,
      3
    ],
    "created_at": "2023-03-23T08:05:24.000000Z",
    "updated_at": "2023-03-23T08:05:24.000000Z"
  }
]
```