# Facility Docs

---

- [Basic data](#basic-data)
- [Create facility](#create-facility)
- [Get all facility](#get-all-facility)
- [Get all facility from server](#get-all-facility-server)
- [Get all facility by company](#get-all-facility-by-company)
- [Get one Facility](#get-one-facility)
- [Update facility](#update-facility)
- [Change status facility](#change-status-facility)
- [Get facility by name](#get-facility-by-name)
- [Get one facility by npi](#get-one-facility-by-npi)
- [Add to billing company](#add-to-billing-company)
- [Get all facility types](#get-all-facility-types)
- [Add to company](#add-to-company)
- [Remove to company](#remove-to-company)
- [Get list billing companies](#get-list-billing-companies)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Facility`          | `/facility/`               |yes             |Create facility|         
| 2 |GET | `Get all Facility`| `/facility/`        |yes            |Get all facility|
| 3 |GET | `Get all Facility from server`          | `/facility/get-all-server`|yes|Get all facility from server|
| 4 |GET | `Get all Facility by company`| `/facility/get-all-by-company/{company_id}`        |yes            |Get all facility by company|
| 5 |GET | `Get one Facility`          | `/facility/{id}`|yes|Get one facility|
| 6 |PUT | `Update Facility`          | `/facility/{id}`|yes|Update facility|
| 7 |PATCH | `change status Facility`          | `/facility/{id}/change-status`|yes|change status facility|
| 8 |GET | `Get Facility by name`          | `/facility/{id}/get-by-name`|yes|get by facility|
| 9 |GET | `Get Facility by npi`          | `/facility/get-by-npi/{npi}`|yes|get  facility by npy |
| 10 |PATCH | `Add to billing company`          | `/facility/add-to-billing-company/{id}`|yes|Add facility to billing company|
| 11 |GET | `Get all facility types`| `/facility/get-facility-types`        |yes            |Get all facility types|
| 12 |PATCH | `Add to company`          | `/facility/{facility_id}/add-to-company/{company_id}`|yes|Add facility to company|
| 13 |PATCH | `Remove to company`          | `/facility/{facility_id}/remove-to-company/{company_id}`|yes|Remove facility to company|
| 14 |GET | `Get list billing companies`| `/facility/get-list-billing-companies`        |yes            |Get list billing companies|



>{primary} when url params have this symbol "?" mean not required, so you must to send null


# 

<a name="create-facility"></a>
## Create Facility

### Body request example

>{primary} The key Type allow these values
1 - Clinics
2 - Hospitals
3 - Labs
4 - Comprehensive Outpa...
5 - Specialty Facility Res...
6 - Assisted Living Facility
7 - ASC - Ambulatory Surgery Center
8 - LAB - Free Standing Lab Facility
9 - OT - Special Facility - Other
10 - RRH - Rural Health Clinic
11 - Skilled Nursing Facility




#

```json
{
    "name":"facilityName",
    "facility_type_id": 1,
    "companies": [1,2],
    "nickname":"alias facilityName",
    "billing_company_id": 1, /** Only required by superuser */
    "place_of_services": [1,2],
    "taxonomies": [
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy",
            "primary": true
        },
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy",
            "primary": false
        },
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy",
            "primary": false
        }
    ],
    "npi":"123fac321",
    "address":{
        "address":"address Facility",
        "city":"city Facility",
        "state":"state Facility",
        "zip":234
    },
    "contact":{
        "phone":"34324234",
        "mobile":"34324234",
        "fax":"567674576457",
        "email":"facility@facility.com"
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

> {success} 201 Facility created


#

```json
{
    "code": "FA-00001-2022",
    "name": "facilityName",
    "npi": "123fac321",
    "verified_on_nppes": true,
    "facility_type_id": 1,
    "updated_at": "2022-03-16T10:03:40.000000Z",
    "created_at": "2022-03-16T10:03:40.000000Z",
    "id": 1,
    "status": false
}
```


# 

<a name="get-all-facility"></a>
## Get All Facilities


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Facility found

#

```json
[
    {
        "id": 1,
        "facility_type_id": 1,
        "name": "facilityName",
        "npi": "123fac321",
        "verified_on_nppes": true,
        "created_at": "2022-03-16T10:03:40.000000Z",
        "updated_at": "2022-03-16T10:03:40.000000Z",
        "code": "FA-00001-2022",
        "status": false,
        "facility_type": {
            "id": 1,
            "type": "01 - Clinics",
            "created_at": "2022-04-07T20:50:55.000000Z",
            "updated_at": "2022-04-07T20:50:55.000000Z"
        },
        "addresses": [
            {
                "id": 4,
                "address": "address Facility",
                "city": "city Facility",
                "state": "state Facility",
                "zip": "234",
                "billing_company_id": 1,
                "created_at": "2022-03-16T10:03:41.000000Z",
                "updated_at": "2022-03-16T10:03:41.000000Z",
                "addressable_type": "App\\Models\\Facility",
                "addressable_id": 1
            }
        ],
        "contacts": [
            {
                "id": 5,
                "phone": "34324234",
                "fax": "567674576457",
                "email": "facility@facility.com",
                "billing_company_id": 1,
                "created_at": "2022-03-16T10:03:41.000000Z",
                "updated_at": "2022-03-16T10:03:41.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\Facility",
                "contactable_id": 1
            }
        ],
        "nicknames": [
            {
                "id": 1,
                "nickname": "alias facilityName",
                "nicknamable_type": "App\\Models\\Facility",
                "nicknamable_id": 6,
                "billing_company_id": 1,
                "created_at": "2022-04-04T12:55:15.000000Z",
                "updated_at": "2022-04-04T12:55:15.000000Z"
            }
        ],
        "billing_companies": [],
        "companies": [
            {
                "id": 1,
                "code": "CO-00001-2022",
                "name": "company first",
                "npi": "222CF123",
                "created_at": "2022-03-16T10:06:31.000000Z",
                "updated_at": "2022-03-16T10:06:31.000000Z",
                "status": false,
                "billing_companies": []
            }
        ]
    }
]
```

#
<a name="get-all-facility-server"></a>
## Get all facility from server

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

> {success} 200 data returned

#
```json
{
    "data": [
        {
            "id": 1,
            "facility_type_id": 1,
            "name": "facilityName",
            "npi": "123fac321",
            "created_at": "2022-03-16T10:03:40.000000Z",
            "updated_at": "2022-03-16T10:03:40.000000Z",
            "code": "FA-00001-2022",
            "verified_on_nppes": true,
            "status": false,
            "facility_type": {
                "id": 1,
                "type": "01 - Clinics",
                "created_at": "2022-04-07T20:50:55.000000Z",
                "updated_at": "2022-04-07T20:50:55.000000Z"
            },
            "addresses": [
                {
                    "id": 4,
                    "address": "address Facility",
                    "city": "city Facility",
                    "state": "state Facility",
                    "zip": "234",
                    "billing_company_id": 1,
                    "created_at": "2022-03-16T10:03:41.000000Z",
                    "updated_at": "2022-03-16T10:03:41.000000Z",
                    "addressable_type": "App\\Models\\Facility",
                    "addressable_id": 1
                }
            ],
            "contacts": [
                {
                    "id": 5,
                    "phone": "34324234",
                    "fax": "567674576457",
                    "email": "facility@facility.com",
                    "billing_company_id": 1,
                    "created_at": "2022-03-16T10:03:41.000000Z",
                    "updated_at": "2022-03-16T10:03:41.000000Z",
                    "mobile": null,
                    "contactable_type": "App\\Models\\Facility",
                    "contactable_id": 1
                }
            ],
            "nicknames": [
                {
                    "id": 1,
                    "nickname": "alias facilityName",
                    "nicknamable_type": "App\\Models\\Facility",
                    "nicknamable_id": 6,
                    "billing_company_id": 1,
                    "created_at": "2022-04-04T12:55:15.000000Z",
                    "updated_at": "2022-04-04T12:55:15.000000Z"
                }
            ],
            "billing_companies": [],
            "companies": [
                {
                    "id": 1,
                    "code": "CO-00001-2022",
                    "name": "company first",
                    "npi": "222CF123",
                    "created_at": "2022-03-16T10:06:31.000000Z",
                    "updated_at": "2022-03-16T10:06:31.000000Z",
                    "status": false,
                    "billing_companies": []
                }
            ]
        }
    ],
    "count": 10
}
```

#

<a name="get-all-facility-by-company"></a>
## Get all facilities by company


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "company_id": required <integer>
}
```

## Response

> {success} 200 Facility found

#

```json
[
    {
        "id": 1,
        "facility_type_id": 1,
        "name": "facilityName",
        "npi": "123fac321",
        "created_at": "2022-03-16T10:03:40.000000Z",
        "updated_at": "2022-03-16T10:03:40.000000Z",
        "verified_on_nppes": true,
        "code": "FA-00001-2022",
        "status": false,
        "facility_type": {
            "id": 1,
            "type": "01 - Clinics",
            "created_at": "2022-04-07T20:50:55.000000Z",
            "updated_at": "2022-04-07T20:50:55.000000Z"
        },
        "addresses": [
            {
                "id": 4,
                "address": "address Facility",
                "city": "city Facility",
                "state": "state Facility",
                "zip": "234",
                "billing_company_id": 1,
                "created_at": "2022-03-16T10:03:41.000000Z",
                "updated_at": "2022-03-16T10:03:41.000000Z",
                "addressable_type": "App\\Models\\Facility",
                "addressable_id": 1
            }
        ],
        "contacts": [
            {
                "id": 5,
                "phone": "34324234",
                "fax": "567674576457",
                "email": "facility@facility.com",
                "billing_company_id": 1,
                "created_at": "2022-03-16T10:03:41.000000Z",
                "updated_at": "2022-03-16T10:03:41.000000Z",
                "mobile": null,
                "contactable_type": "App\\Models\\Facility",
                "contactable_id": 1
            }
        ],
        "nicknames": [
            {
                "id": 1,
                "nickname": "alias facilityName",
                "nicknamable_type": "App\\Models\\Facility",
                "nicknamable_id": 6,
                "billing_company_id": 1,
                "created_at": "2022-04-04T12:55:15.000000Z",
                "updated_at": "2022-04-04T12:55:15.000000Z"
            }
        ],
        "billing_companies": [],
        "companies": [
            {
                "id": 1,
                "code": "CO-00001-2022",
                "name": "company first",
                "npi": "222CF123",
                "created_at": "2022-03-16T10:06:31.000000Z",
                "updated_at": "2022-03-16T10:06:31.000000Z",
                "status": false,
                "billing_companies": []
            }
        ]
    }
]
```

#




<a name="get-one-facility"></a>
## Get One Facility


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Facility founded

#

```json
{
    "id": 1,
    "facility_type_id": 1,
    "name": "facilityName",
    "npi": "123fac321",
    "created_at": "2022-03-16T10:03:40.000000Z",
    "updated_at": "2022-03-16T10:03:40.000000Z",
    "verified_on_nppes": true,
    "code": "FA-00001-2022",
    "status": false,
    "facility_type": {
        "id": 1,
        "type": "01 - Clinics",
        "created_at": "2022-04-07T20:50:55.000000Z",
        "updated_at": "2022-04-07T20:50:55.000000Z"
    },
    "taxonomies": [
        {
            "id": 1,
            "name": "NameTaxonomy Company",
            "created_at": "2022-03-16T10:03:40.000000Z",
            "updated_at": "2022-03-16T10:06:31.000000Z",
            "tax_id": "TAX01213",
            "primary": true,
            "pivot": {
                "facility_id": 1,
                "taxonomy_id": 1,
                "created_at": "2022-03-16T10:03:41.000000Z",
                "updated_at": "2022-03-16T10:03:41.000000Z"
            }
        }
    ],
    "addresses": [
        {
            "id": 4,
            "address": "address Facility",
            "city": "city Facility",
            "state": "state Facility",
            "zip": "234",
            "billing_company_id": 1,
            "created_at": "2022-03-16T10:03:41.000000Z",
            "updated_at": "2022-03-16T10:03:41.000000Z",
            "addressable_type": "App\\Models\\Facility",
            "addressable_id": 1
        }
    ],
    "contacts": [
        {
            "id": 5,
            "phone": "34324234",
            "fax": "567674576457",
            "email": "facility@facility.com",
            "billing_company_id": 1,
            "created_at": "2022-03-16T10:03:41.000000Z",
            "updated_at": "2022-03-16T10:03:41.000000Z",
            "mobile": null,
            "contactable_type": "App\\Models\\Facility",
            "contactable_id": 1
        }
    ],
    "nicknames": [
        {
            "id": 1,
            "nickname": "alias facilityName",
            "nicknamable_type": "App\\Models\\Facility",
            "nicknamable_id": 6,
            "billing_company_id": 1,
            "created_at": "2022-04-04T12:55:15.000000Z",
            "updated_at": "2022-04-04T12:55:15.000000Z"
        }
    ],
    "companies": [
        {
            "id": 1,
            "code": "CO-00001-2022",
            "name": "company first",
            "npi": "222CF123",
            "created_at": "2022-03-16T10:06:31.000000Z",
            "updated_at": "2022-03-16T10:06:31.000000Z",
            "status": false,
            "billing_companies": []
        }
    ],
    "billing_companies": []
}
```


#

>{warning} 404 Facility not founded




# 

<a name="update-facility"></a>
## Update Facility

### Body request example

>{primary} The key Type allow these values
1 - Clinics
2 - Hospitals
3 - Labs
4 - Comprehensive Outpa...
5 - Specialty Facility Res...
6 - Assisted Living Facility
7 - ASC - Ambulatory Surgery Center
8 - LAB - Free Standing Lab Facility
9 - OT - Special Facility - Other
10 - RRH - Rural Health Clinic
11 - Skilled Nursing Facility




#

```json
{
    "name":"facilityName",
    "facility_type_id": 1,
    "companies": [1,2],
    "nickname":"alias facilityName",
    "billing_company_id": 1, /** Only required by superuser */
    "place_of_services": [1,2],
    "taxonomies": [
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy",
            "primary": true
        },
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy",
            "primary": false
        },
        {
            "tax_id": "TAX01213",
            "name": "NameTaxonomy",
            "primary": false
        }
    ],
    "npi":"123fac321",
    "address":{
        "address":"address Facility",
        "city":"city Facility",
        "state":"state Facility",
        "zip":234
    },
    "contact":{
        "phone":"34324234",
        "mobile":"34324234",
        "fax":"567674576457",
        "email":"facility@facility.com"
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

> {success} 200 Facility Updated


#


```json
{
    "code": "FA-00001-2022",
    "name": "facilityName",
    "npi": "123fac321",
    "facility_type_id": 1,
    "updated_at": "2022-03-16T10:03:40.000000Z",
    "created_at": "2022-03-16T10:03:40.000000Z",
    "verified_on_nppes": true,
    "id": 1,
    "status": false
}
```

#


<a name="change-status-facility"></a>
## Change status Facility


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in body

```json
{
    "status": <boolean>
}
```
## Response

> {success} 200 Facility founded


#

>{warning} 404 Facility not founded


#

<a name="get-one-facility-by-npi"></a>
## Get One Facility by npi


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

> {success} 200 Facility founded

#

```json
{
    "id": 1,
    "facility_type_id": 2,
    "name": "MIGUEL REBOLLAR P.A.",
    "npi": "1598094005",
    "created_at": "2022-03-17T23:36:20.000000Z",
    "updated_at": "2022-03-17T23:36:20.000000Z",
    "verified_on_nppes": true,
    "code": "FA-00001-2022",
    "status": true,
    "facility_type": {
        "id": 2,
        "type": "02 - Hospitals",
        "created_at": "2022-04-07T20:50:55.000000Z",
        "updated_at": "2022-04-07T20:50:55.000000Z"
    },
    "addresses": [
        {
            "id": 15,
            "address": "780 NW 42nd Ave",
            "city": "Miami",
            "state": "Florida",
            "zip": "331265540",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:36:20.000000Z",
            "updated_at": "2022-03-17T23:36:20.000000Z",
            "addressable_type": "App\\Models\\Facility",
            "addressable_id": 1
        }
    ],
    "contacts": [
        {
            "id": 16,
            "phone": "305-828-4155",
            "fax": "testingfax",
            "email": "nw@gmil.com",
            "billing_company_id": 1,
            "created_at": "2022-03-17T23:36:20.000000Z",
            "updated_at": "2022-03-17T23:36:20.000000Z",
            "mobile": null,
            "contactable_type": "App\\Models\\Facility",
            "contactable_id": 1
        }
    ],
    "billing_companies": [
        {
            "id": 1,
            "name": "Block-Walsh",
            "created_at": "2022-03-16T23:18:59.000000Z",
            "updated_at": "2022-03-16T23:18:59.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "pivot": {
                "facility_id": 1,
                "billing_company_id": 1,
                "status": true,
                "created_at": "2022-03-17T23:36:20.000000Z",
                "updated_at": "2022-03-17T23:36:20.000000Z"
            }
        }
    ],
    "companies": [
        {
            "id": 1,
            "code": "CO-00001-2022",
            "name": "company first",
            "npi": "222CF123",
            "created_at": "2022-03-16T10:06:31.000000Z",
            "updated_at": "2022-03-16T10:06:31.000000Z",
            "status": false,
            "billing_companies": []
        }
    ]
}
```


#

>{warning} 404 Facility not founded

<a name="add-to-billing-company"></a>
## Add to billing company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`facility_id required integer`


## Response

> {success} 200 Good response

```json
{
    "code": "FA-00001-2022",
    "name": "facilityName",
    "npi": "123fac321",
    "facility_type_id": 1,
    "updated_at": "2022-03-16T10:03:40.000000Z",
    "created_at": "2022-03-16T10:03:40.000000Z",
    "verified_on_nppes": true,
    "id": 1,
    "status": true
}
```

#

>{warning} 404 error add facility to billing company

<a name="get-all-facility-types"></a>
## Get All Facility Types


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Facility Types found

#

```json
[
    {
        "id": 1,
        "name": "01 - Clinics"
    },
    {
        "id": 2,
        "name": "02 - Hospitals"
    },
    {
        "id": 3,
        "name": "03 - Labs"
    },
    {
        "id": 4,
        "name": "75X - Comprehensive Outpa..."
    },
    {
        "id": 5,
        "name": "86X - Specialty Facility Res..."
    },
    {
        "id": 6,
        "name": "AL - Assisted Living Facility"
    },
    {
        "id": 7,
        "name": "ASC - Ambulatory Surgery Center"
    },
    {
        "id": 8,
        "name": "LAB - Free Standing Lab Facility"
    },
    {
        "id": 9,
        "name": "OT - Special Facility - Other"
    },
    {
        "id": 10,
        "name": "RRH - Rural Health Clinic"
    },
    {
        "id": 11,
        "name": "SN - Skilled Nursing Facility"
    }
]
```

#

<a name="add-to-company"></a>
## Add to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`facility_id required integer`
`company_id  required integer`


## Response

> {success} 200 Good response

```json
{
    "code": "FA-00001-2022",
    "name": "facilityName",
    "npi": "123fac321",
    "facility_type_id": 1,
    "updated_at": "2022-03-16T10:03:40.000000Z",
    "created_at": "2022-03-16T10:03:40.000000Z",
    "verified_on_nppes": true,
    "id": 1,
    "status": true
}
```

#

>{warning} 404 error add facility to company

#

<a name="remove-to-company"></a>
## Remove to company

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`facility_id required integer`
`company_id  required integer`


## Response

> {success} 200 Good response

```json
{
    "code": "FA-00001-2022",
    "name": "facilityName",
    "npi": "123fac321",
    "facility_type_id": 1,
    "updated_at": "2022-03-16T10:03:40.000000Z",
    "created_at": "2022-03-16T10:03:40.000000Z",
    "verified_on_nppes": true,
    "id": 1,
    "status": true
}
```

#

>{warning} 404 error remove facility to company

<a name="get-list-billing-companies"></a>
## Get list billing companies


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Billing Companies found

#

```json
[
    {
        "id": 1,
        "name": "Fay-Hahn"
    },
    {
        "id": 2,
        "name": "Balistreri-Yost"
    },
    {
        "id": 3,
        "name": "Langosh Ltd"
    },
    {
        "id": 4,
        "name": "Halvorson, Deckow and Bode"
    }
]
```