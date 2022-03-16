# Facility Docs

---

- [Basic data](#basic-data)
- [Create facility](#create-facility)
- [Get all facility](#get-all-facility)
- [Get one Facility](#get-one-facility)
- [Update facility](#update-facility)
- [Change status facility](#change-status-facility)
- [Get facility by name](#get-facility-by-name)
- [Add to billing company](#add-to-billing-company)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Facility`          | `/facility/`               |yes             |Create facility|         
| 2 |GET | `Get all Facility`| `/facility/`        |yes            |Get all facility|
| 3 |GET | `Get one Facility`          | `/facility/{id}`|yes|Get one facility|
| 4 |PUT | `Update Facility`          | `/facility/{id}`|yes|Update facility|
| 5 |PATCH | `change status Facility`          | `/facility/{id}/change-status`|yes|change status facility|
| 6 |GET | `Get Facility by name`          | `/facility/{id}/get-by-name`|yes|get by facility|
| 7 |PATCH | `Add to billing company`          | `/facility/add-to-billing-company/{id}`|yes|Add facility to billing company|



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
    "type": 1,
    "company_id": 1,
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
    "type": 1,
    "company_id": 1,
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
        "type": 1,
        "name": "facilityName",
        "npi": "123fac321",
        "created_at": "2022-03-16T10:03:40.000000Z",
        "updated_at": "2022-03-16T10:03:40.000000Z",
        "company_id": 1,
        "code": "FA-00001-2022",
        "status": false,
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
        "billing_companies": []
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
    "type": 1,
    "name": "facilityName",
    "npi": "123fac321",
    "created_at": "2022-03-16T10:03:40.000000Z",
    "updated_at": "2022-03-16T10:03:40.000000Z",
    "company_id": 1,
    "code": "FA-00001-2022",
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
    "company": {
        "id": 1,
        "code": "CO-00001-2022",
        "name": "company first",
        "npi": "222CF123",
        "created_at": "2022-03-16T10:06:31.000000Z",
        "updated_at": "2022-03-16T10:06:31.000000Z",
        "status": false,
        "billing_companies": []
    },
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
    "type": 1,
    "company_id": 1,
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
    "type": 1,
    "company_id": 1,
    "updated_at": "2022-03-16T10:03:40.000000Z",
    "created_at": "2022-03-16T10:03:40.000000Z",
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
    "type": 1,
    "company_id": 1,
    "updated_at": "2022-03-16T10:03:40.000000Z",
    "created_at": "2022-03-16T10:03:40.000000Z",
    "id": 1,
    "status": true
}
```

#

>{warning} 404 error add facility to billing company