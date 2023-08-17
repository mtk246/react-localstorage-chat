# Company Billing Docs

---

- [Basic data](#basic-data)
- [Create billing company](#create-billing-company)
- [Update billing company](#update-billing-company)
- [Change status billing company](#change-status-billing-company)
- [Get list billing companies](#get-list-billing-companies)
- [Upload image billing company](#upload-image)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create billing company`          | `/billing-company/create`               |yes             |Create Billing Company  |         
| 2 |PUT| `Update billing company`          | `/billing-company/{billing_company_id}`               |yes             |Update Billing Company  |         
| 8 |PATCH | `Change status billing company`           | `/billing-company/change-status/{id}`|yes|Change status billing company|
| 9 |GET | `Get list billing companies`| `/billing-company/get-list`        |yes            |Get list billing companies|
| 10 |POST | `upload image billing company`   | `/billing-company/upload-image` |yes|upload image billing company|


>{primary} when url params have this symbol "?" mean not required, so you must to send null


<a name="create-billing-company"></a>
## Create billing company

### Body request example

```json
{
    "name": "Medhurst-Schmidt",
    "abbreviation": "MedSc",
    "address":{
        "address": "Singleton Rd",
        "city": "Calimesa",
        "state": "California",
        "zip": "923202207",
    },
    "contact":{
        "phone": "+1-830-587-6085",
        "fax": "737-883-3672",
        "email": "corine07@dooley.info",
        "mobile": "930.984.6441",
    },
    "logo": "file"
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 billing company created

#
```json
{
    "id": 1,
    "name": "Medhurst-Schmidt",
    "abbreviation": "MedSc",
    "logo": "File",
    "created_at": "2022-03-15T11:15:43.000000Z",
    "updated_at": "2022-03-15T11:15:43.000000Z",
    "code": "BC-00001-2022",
    "status": false,
    "address": {
        "id": 1,
        "address": "Singleton Rd",
        "city": "Calimesa",
        "state": "California",
        "zip": "923202207",
        "billing_company_id": 1,
        "created_at": "2022-03-15T11:15:44.000000Z",
        "updated_at": "2022-03-15T11:15:44.000000Z",
        "addressable_type": "App\\Models\\BillingCompany",
        "addressable_id": 1
    },
    "contact": {
        "id": 1,
        "phone": "+1-830-587-6085",
        "fax": "737-883-3672",
        "email": "corine07@dooley.info",
        "billing_company_id": 1,
        "created_at": "2022-03-15T11:15:44.000000Z",
        "updated_at": "2022-03-15T11:15:44.000000Z",
        "mobile": "930.984.6441",
        "contactable_type": "App\\Models\\BillingCompany",
        "contactable_id": 1
    }
}
```


>{warning} possible errors: 422 when is missing some data 

<a name="update-billing-company"></a>
## Update Billing Company


### Body request example


#

```json
{
    "name": "Medhurst-Schmidt",
    "abbreviation": "MedSc",
    "address":{
        "address": "Singleton Rd",
        "city": "Calimesa",
        "state": "California",
        "zip": "923202207",
    },
    "contact":{
        "phone": "+1-830-587-6085",
        "fax": "737-883-3672",
        "email": "corine07@dooley.info",
        "mobile": "930.984.6441",
    },
    "logo": "somepath"
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 clearing house created


#

```json
{
    "id": 1,
    "name": "Medhurst-Schmidt",
    "abbreviation": "MedSc",
    "created_at": "2022-03-15T11:15:43.000000Z",
    "updated_at": "2022-03-15T11:15:43.000000Z",
    "code": "BC-00001-2022",
    "status": false,
    "address": {
        "id": 1,
        "address": "Singleton Rd",
        "city": "Calimesa",
        "state": "California",
        "zip": "923202207",
        "billing_company_id": 1,
        "created_at": "2022-03-15T11:15:44.000000Z",
        "updated_at": "2022-03-15T11:15:44.000000Z",
        "addressable_type": "App\\Models\\BillingCompany",
        "addressable_id": 1
    },
    "contact": {
        "id": 1,
        "phone": "+1-830-587-6085",
        "fax": "737-883-3672",
        "email": "corine07@dooley.info",
        "billing_company_id": 1,
        "created_at": "2022-03-15T11:15:44.000000Z",
        "updated_at": "2022-03-15T11:15:44.000000Z",
        "mobile": "930.984.6441",
        "contactable_type": "App\\Models\\BillingCompany",
        "contactable_id": 1
    }
}
```

<a name="change-status-billing-company"></a>
## Change status billing company


### Body request example

```json
{
    "status":"boolean"
}
```


## Response

> {success} 204 Good response


#

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

#

<a name="upload-image"></a>
## Upload image billing company

### Body request example

```json
{
    "logo": "file",
    "billing_company_id": 1
}
```

>{success} 200 Response 

```json
{
    "path":"somepath"
}
```