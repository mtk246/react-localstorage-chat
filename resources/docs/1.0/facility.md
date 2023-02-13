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
- [Get list facility types](#get-list-facility-types)
- [Get list place of services](#get-list-place-of-services)
- [Add to company](#add-to-company)
- [Remove to company](#remove-to-company)
- [Get list billing companies](#get-list-billing-companies)
- [Get list facilities](#get-list)


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
| 11 |GET | `Get list facility types`| `/facility/get-list-facility-types`        |yes            |Get list facility types|
| 12 |GET | `Get list facility types`| `/facility/get-list-place-of-services`        |yes            |Get list place of services|
| 13 |PATCH | `Add to company`          | `/facility/{facility_id}/add-to-company/{company_id}`|yes|Add facility to company|
| 14 |PATCH | `Remove to company`          | `/facility/{facility_id}/remove-to-company/{company_id}`|yes|Remove facility to company|
| 15 |GET | `Get list billing companies`| `/facility/get-list-billing-companies?facility_id={facilityID?}&edit={edit?}`        |yes            |Get list billing companies|
| 10 |GET   | `Get list facilities`  | `/facility/get-list?billing_company_id={ID?}&company_id={ID?}`|yes|Get list facilities|



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
    "abbreviation":"ABBFAC",
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
`company_id <integer>`

## Example path

>{primary} ?query=fieldSearch&itemsPerPage=5&sortDesc=1&page=1&sortBy=fieldName&company_id=1

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
    "abbreviation":"ABBFAC",
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

<a name="get-list-facility-types"></a>
## Get list facility types


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Facility types found

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

<a name="get-list-place-of-services"></a>
## Get list place of services


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Place of services found

#

```json
[
    {
        "id": 1,
        "name": "03 - School"
    },
    {
        "id": 2,
        "name": "04 - Homeless Shelter"
    },
    {
        "id": 3,
        "name": "05 - Indian Health Service Free-Standing Facility"
    },
    {
        "id": 4,
        "name": "06 - Indian Health Service Provider-Based Facility"
    },
    {
        "id": 5,
        "name": "07 - Tribal 638 Free-Standing Facility"
    },
    {
        "id": 6,
        "name": "08 - Tribal 638 Provider Based-Facility"
    },
    {
        "id": 7,
        "name": "11 - Office Visit"
    },
    {
        "id": 8,
        "name": "12 - Home"
    },
    {
        "id": 9,
        "name": "13 - Assisted Living"
    },
    {
        "id": 10,
        "name": "14 - Group Home"
    },
    {
        "id": 11,
        "name": "15 - Mobile Unit"
    },
    {
        "id": 12,
        "name": "20 - Urgent Care Facility"
    },
    {
        "id": 13,
        "name": "21 - Inpatient Hospital"
    },
    {
        "id": 14,
        "name": "22 - Outpatient Hospital"
    },
    {
        "id": 15,
        "name": "23 - Emergency Room"
    },
    {
        "id": 16,
        "name": "24 - Ambulatory Surgical Center"
    },
    {
        "id": 17,
        "name": "25 - Birthing Center"
    },
    {
        "id": 18,
        "name": "26 - Military Treatment Facility"
    },
    {
        "id": 19,
        "name": "31 - Skilled Nursing Facility"
    },
    {
        "id": 20,
        "name": "32 - Nursing Facility"
    },
    {
        "id": 21,
        "name": "33 - Custodial Care Facility"
    },
    {
        "id": 22,
        "name": "34 - Hospice"
    },
    {
        "id": 23,
        "name": "41 - Ambulance - Land"
    },
    {
        "id": 24,
        "name": "42 - Ambulance - Air or Water"
    },
    {
        "id": 25,
        "name": "50 - Federally Qualified Health Center"
    },
    {
        "id": 26,
        "name": "51 - Inpatient Psychiatric Facility"
    },
    {
        "id": 27,
        "name": "52 - Psychiatric Facility Partial Hospitalization"
    },
    {
        "id": 28,
        "name": "53 - Community Mental Health Center"
    },
    {
        "id": 29,
        "name": "54 - Intermediate Care Facility"
    },
    {
        "id": 30,
        "name": "55 - Residential Substance Abuse Treatment Facility"
    },
    {
        "id": 31,
        "name": "56 - Psychiatric Residential Treatment Center"
    },
    {
        "id": 32,
        "name": "60 - Mass Immunization Center"
    },
    {
        "id": 33,
        "name": "61 - Comprehensive Inpatient Rehab Facility"
    },
    {
        "id": 34,
        "name": "62 - Comprehensive Outpatient Rehab Facility"
    },
    {
        "id": 35,
        "name": "65 - End Stage Renal Disease Treatment Facility"
    },
    {
        "id": 36,
        "name": "71 - State or Local Public Health Clinic"
    },
    {
        "id": 37,
        "name": "2  - Rural Health Clinic"
    },
    {
        "id": 38,
        "name": "81 - Independent Laboratory"
    },
    {
        "id": 39,
        "name": "99 - Other Unlisted Facility"
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
### Param in path

```json
{
    "facility_id": <integer>
    "edit": <boolean>
}
```

## Example path

>{primary} /get-list-billing-companies?facility_id=2&edit=false

> /get-list-billing-companies?facility_id=2&edit=true

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


<a name="get-list"></a>
## Get list facilities


### Param in header

```json
{
    "Authorization": bearer <token>
}
```
### Param in path

```json
{
    "billing_company_id": <integer> /** optional */
    "company_id": <integer> /** optional */
}
```

## Example path

>{primary} /get-list?billing_company_id=1&company_id=1

## Response

> {success} 200 Facilities found

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