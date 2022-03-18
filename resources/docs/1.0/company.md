# Company Docs

---

- [Basic data](#basic-data)
- [Create company](#create-company)
- [Get all company](#get-all-company)
- [Get one company](#get-one-company)
- [Get one company by name](#get-one-company-by-name)
- [Get one company by email](#get-one-company-by-email)
- [Get one company by npi](#get-one-company-by-npi)
- [Update company](#update-company)
- [Change status company](#change-status-company)
- [Add to billing company](#add-to-billing-company)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create company`          | `/company/`               |yes             |Create company|         
| 2 |GET | `Get all company`| `/company/`        |yes            |Get all company|
| 3 |GET | `Get one company`          | `/company/{id}`|yes|Get one company|
| 4 |GET | `Get one company by name`          | `/company/get-by-name/{name}`|yes|Get company by name|
| 5 |GET | `Get one company by email`          | `/company/get-by-email/{email}`|yes|Get company by email|
| 6 |GET | `Get one company by npi`          | `/company/get-by-npi/{npi}`|yes|Get company by npi|
| 7 |PUT | `Update company`          | `/company/{id}`|yes|update company|
| 8 |PATCH | `Change status company`          | `/company/change-status/{id}`|yes|Change status company|
| 9 |PATCH | `Add to billing company`          | `/company/add-to-billing-company/{id}`|yes|Add company to billing company|



>{primary} when url params have this symbol "?" mean not required, so you must to send null


# 

<a name="create-company"></a>
## Create Company

### Body request example


#

```json
{
    "name":"company first",
    "npi":"222CF123",
    "taxonomies": [
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy Company",
            "primary": true
        },{
            "tax_id": "TAX01222",
            "name": "NameTaxonomy 2 Company",
            "primary": false
        }
    ],"address": {
        "address":"address Company",
        "city":"city Company",
        "state":"state Company",
        "zip":234
    },
    "contact":{
        "phone":"34324234",
        "fax":"567674576457",
        "email":"company@company.com"
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


# 

<a name="get-all-company"></a>
## Get All Company


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company found

#

```json
[
    {
        "id": 2,
        "code": "CO-00002-2022",
        "name": "company second",
        "npi": "222CF1222",
        "created_at": "2022-03-16T09:49:06.000000Z",
        "updated_at": "2022-03-16T09:49:06.000000Z",
        "status": false,
        "addresses": [
            {
                "id": 5,
                "address": "address Company2",
                "city": "city Company2",
                "state": "state Company2",
                "zip": "234",
                "billing_company_id": null,
                "created_at": "2022-03-16T09:49:06.000000Z",
                "updated_at": "2022-03-16T09:49:06.000000Z",
                "addressable_type": "App\\Models\\Company",
                "addressable_id": 2
            }
        ],
        "contacts": [
            {
                "id": 6,
                "phone": "34324234",
                "fax": "567674576457",
                "email": "company2@company.com",
                "billing_company_id": null,
                "created_at": "2022-03-16T09:49:06.000000Z",
                "updated_at": "2022-03-16T09:49:06.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\Company",
                "contactable_id": 2
            }
        ]
    },
    {
        "id": 1,
        "code": "CO-00001-2022",
        "name": "company first",
        "npi": "222CF123",
        "created_at": "2022-03-16T09:44:57.000000Z",
        "updated_at": "2022-03-16T09:44:57.000000Z",
        "status": false,
        "addresses": [
            {
                "id": 4,
                "address": "address Company",
                "city": "city Company",
                "state": "state Company",
                "zip": "234",
                "billing_company_id": null,
                "created_at": "2022-03-16T09:44:57.000000Z",
                "updated_at": "2022-03-16T09:44:57.000000Z",
                "addressable_type": "App\\Models\\Company",
                "addressable_id": 1
            }
        ],
        "contacts": [
            {
                "id": 5,
                "phone": "34324234",
                "fax": "567674576457",
                "email": "company@company.com",
                "billing_company_id": null,
                "created_at": "2022-03-16T09:44:57.000000Z",
                "updated_at": "2022-03-16T09:44:57.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\Company",
                "contactable_id": 1
            }
        ]
    }
]
```



#



<a name="get-one-company"></a>
## Get One Company


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 company house found

#

```json
{
    "id": 1,
    "code": "CO-00001-2022",
    "name": "company first",
    "npi": "222CF123",
    "created_at": "2022-03-16T10:06:31.000000Z",
    "updated_at": "2022-03-16T10:06:31.000000Z",
    "status": false,
    "taxonomies": [
        {
            "id": 1,
            "name": "NameTaxonomy Company",
            "created_at": "2022-03-16T10:03:40.000000Z",
            "updated_at": "2022-03-16T10:06:31.000000Z",
            "tax_id": "TAX01213",
            "primary": true,
            "pivot": {
                "company_id": 1,
                "taxonomy_id": 1,
                "created_at": "2022-03-16T10:06:31.000000Z",
                "updated_at": "2022-03-16T10:06:31.000000Z"
            }
        },
        {
            "id": 2,
            "name": "NameTaxonomy 2 Company",
            "created_at": "2022-03-16T10:06:31.000000Z",
            "updated_at": "2022-03-16T10:06:31.000000Z",
            "tax_id": "TAX01222",
            "primary": false,
            "pivot": {
                "company_id": 1,
                "taxonomy_id": 2,
                "created_at": "2022-03-16T10:06:31.000000Z",
                "updated_at": "2022-03-16T10:06:31.000000Z"
            }
        }
    ],
    "addresses": [
        {
            "id": 5,
            "address": "address Company",
            "city": "city Company",
            "state": "state Company",
            "zip": "234",
            "billing_company_id": 1,
            "created_at": "2022-03-16T10:06:31.000000Z",
            "updated_at": "2022-03-16T10:06:31.000000Z",
            "addressable_type": "App\\Models\\Company",
            "addressable_id": 1
        }
    ],
    "contacts": [
        {
            "id": 6,
            "phone": "34324234",
            "fax": "567674576457",
            "email": "company@company.com",
            "billing_company_id": 1,
            "created_at": "2022-03-16T10:06:31.000000Z",
            "updated_at": "2022-03-16T10:06:31.000000Z",
            "mobile": null,
            "contactable_type": "App\\Models\\Company",
            "contactable_id": 1
        }
    ],
    "facilities": [
        {
            "id": 1,
            "type": 1,
            "name": "facilityName",
            "npi": "123fac321",
            "created_at": "2022-03-16T10:03:40.000000Z",
            "updated_at": "2022-03-16T10:03:40.000000Z",
            "company_id": 1,
            "code": "FA-00001-2022",
            "status": false,
            "billing_companies": []
        }
    ],
    "billing_companies": []
}
```
#

>{warning} 404 company found not found

<a name="get-one-company-by-name"></a>
## Get One Company by name


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "name": <string>
}
```

## Response

> {success} 200 company house found

#

```json
{
    "id": 2,
    "code": "CO-00002-2022",
    "name": "PANAMERICAN INTERNAL MEDICINE INC",
    "npi": "1396903308",
    "created_at": "2022-03-17T23:00:59.000000Z",
    "updated_at": "2022-03-17T23:00:59.000000Z",
    "status": true,
    "taxonomies": [
        {
            "id": 4,
            "name": "Health Maintenance Organization",
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "tax_id": "302R00000X",
            "primary": true,
            "pivot": {
                "company_id": 2,
                "taxonomy_id": 4,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ],
    "addresses": [
        {
            "id": 14,
            "address": "Avenue of the Giants",
            "city": "Merida",
            "state": "California",
            "zip": "123456789",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "addressable_type": "App\\Models\\Company",
            "addressable_id": 2
        }
    ],
    "contacts": [
        {
            "id": 15,
            "phone": "239-410-2887",
            "fax": "+9999999",
            "email": "titu@gmai.com",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "mobile": null,
            "contactable_type": "App\\Models\\Company",
            "contactable_id": 2
        }
    ],
    "facilities": [],
    "billing_companies": [
        {
            "id": 1,
            "name": "Block-Walsh",
            "created_at": "2022-03-16T23:18:59.000000Z",
            "updated_at": "2022-03-16T23:18:59.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "pivot": {
                "company_id": 2,
                "billing_company_id": 1,
                "status": true,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ]
}
```

#

>{warning} 404 company found not found

<a name="get-one-company-by-email"></a>
## Get One Company by email


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "email": <string>
}
```

## Response

> {success} 200 company house found

#

```json
{
    "id": 2,
    "code": "CO-00002-2022",
    "name": "PANAMERICAN INTERNAL MEDICINE INC",
    "npi": "1396903308",
    "created_at": "2022-03-17T23:00:59.000000Z",
    "updated_at": "2022-03-17T23:00:59.000000Z",
    "status": true,
    "taxonomies": [
        {
            "id": 4,
            "name": "Health Maintenance Organization",
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "tax_id": "302R00000X",
            "primary": true,
            "pivot": {
                "company_id": 2,
                "taxonomy_id": 4,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ],
    "addresses": [
        {
            "id": 14,
            "address": "Avenue of the Giants",
            "city": "Merida",
            "state": "California",
            "zip": "123456789",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "addressable_type": "App\\Models\\Company",
            "addressable_id": 2
        }
    ],
    "contacts": [
        {
            "id": 15,
            "phone": "239-410-2887",
            "fax": "+9999999",
            "email": "titu@gmai.com",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "mobile": null,
            "contactable_type": "App\\Models\\Company",
            "contactable_id": 2
        }
    ],
    "facilities": [],
    "billing_companies": [
        {
            "id": 1,
            "name": "Block-Walsh",
            "created_at": "2022-03-16T23:18:59.000000Z",
            "updated_at": "2022-03-16T23:18:59.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "pivot": {
                "company_id": 2,
                "billing_company_id": 1,
                "status": true,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ]
}
```
#

>{warning} 404 company found not found

<a name="get-one-company-by-npi"></a>
## Get One Company by npi


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "npi": <string>
}
```

## Response

> {success} 200 company house found

#

```json
{
    "id": 2,
    "code": "CO-00002-2022",
    "name": "PANAMERICAN INTERNAL MEDICINE INC",
    "npi": "1396903308",
    "created_at": "2022-03-17T23:00:59.000000Z",
    "updated_at": "2022-03-17T23:00:59.000000Z",
    "status": true,
    "taxonomies": [
        {
            "id": 4,
            "name": "Health Maintenance Organization",
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "tax_id": "302R00000X",
            "primary": true,
            "pivot": {
                "company_id": 2,
                "taxonomy_id": 4,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ],
    "addresses": [
        {
            "id": 14,
            "address": "Avenue of the Giants",
            "city": "Merida",
            "state": "California",
            "zip": "123456789",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "addressable_type": "App\\Models\\Company",
            "addressable_id": 2
        }
    ],
    "contacts": [
        {
            "id": 15,
            "phone": "239-410-2887",
            "fax": "+9999999",
            "email": "titu@gmai.com",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:00:59.000000Z",
            "updated_at": "2022-03-17T23:00:59.000000Z",
            "mobile": null,
            "contactable_type": "App\\Models\\Company",
            "contactable_id": 2
        }
    ],
    "facilities": [],
    "billing_companies": [
        {
            "id": 1,
            "name": "Block-Walsh",
            "created_at": "2022-03-16T23:18:59.000000Z",
            "updated_at": "2022-03-16T23:18:59.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "pivot": {
                "company_id": 2,
                "billing_company_id": 1,
                "status": true,
                "created_at": "2022-03-17T23:00:59.000000Z",
                "updated_at": "2022-03-17T23:00:59.000000Z"
            }
        }
    ]
}
```
#

>{warning} 404 company found not found

<a name="update-company"></a>
## Update Company


### Body request example


#

```json
{
    "name":"company first",
    "npi":"222CF123",
    "taxonomies": [
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy Company",
            "primary": true
        },{
            "tax_id": "TAX01222",
            "name": "NameTaxonomy 2 Company",
            "primary": false
        }
    ],"address": {
        "address":"address Company",
        "city":"city Company",
        "state":"state Company",
        "zip":234
    },
    "contact":{
        "phone":"34324234",
        "fax":"567674576457",
        "email":"company@company.com"
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
    "code": "CO-00001-2022",
    "name": "company first",
    "npi": "222CF123",
    "updated_at": "2022-03-16T09:44:57.000000Z",
    "created_at": "2022-03-16T09:44:57.000000Z",
    "id": 1,
    "status": false
}
```



#


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
