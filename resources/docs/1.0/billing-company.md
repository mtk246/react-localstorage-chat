# Company Billing Docs

---

- [Basic data](#basic-data)
- [Create billing company](#create-billing-company)
- [Update billing company](#update-billing-company)
- [Get billing company](#get-billing-company)
- [Get all billing companies](#get-all-billing-companies)
- [Get billing company by code](#get-billing-company-by-code)
- [Get billing company by name](#get-billing-company-by-name)
- [Change status billing company](#change-status-billing-company)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create billing company`          | `/billing-company/create`               |yes             |Create Billing Company  |         
| 2 |PUT| `Update billing company`          | `/billing-company/{billing_company_id}`               |yes             |Update Billing Company  |         
| 3 |GET | `Get billing company`| `/billing-company/{billing_company_id}`        |yes            |Get one billing company|
| 4 |GET | `Get all billing ompanies`          | `/billing-company`|yes|Get All Companies|
| 5 |GET | `Get biling company by code`          | `/billing-company/get-by-code/{code}`|yes|Get one billing company by code|
| 6 |GET | `Get biling company by name`          | `/billing-company/get-by-name/{name}`|yes|Get one billing company by name|
| 7 |PATCH | `Change status billing company`           | `/billing-company/{id}`|yes|Change status billing company|


>{primary} when url params have this symbol "?" mean not required, so you must to send null


<a name="create-billing-company"></a>
## Create billing company

### Body request example

```json
{
    "name":"NameBillingCompany",
    "code":"CodeBillingCompany",
    "address":{
        "address":"AddressBillingCompany",
        "city":"CityBillingCompany",
        "state":"StateBillingCompany",
        "zip":"12345678"
    },
    "contact":{
        "phone":"5335427",
        "fax":"5335427",
        "email":"billing-company@email.com"
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

> {success} 200 billing company created

#
```json
{
    "id": 1,
    "name":"NameBillingCompany",
    "code":"CodeBillingCompany",
    "status": false,
    "address": {
        "id": 17,
        "address":"AddressBillingCompany",
        "city":"CityBillingCompany",
        "state":"StateBillingCompany",
        "zip":"12345678",
        "user_id": null,
        "billing_company_id": 1,
        "created_at": "2022-02-02T18:15:53.000000Z",
        "updated_at": "2022-02-02T18:15:53.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null
    },
    "contact": {
        "id": 15,
        "phone":"5335427",
        "fax":"5335427",
        "email":"billing-company@email.com",
        "user_id": null,
        "billing_company_id": 1,
        "created_at": "2022-02-02T18:15:53.000000Z",
        "updated_at": "2022-02-02T18:15:53.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null
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
    "name":"NameBillingCompany",
    "code":"CodeBillingCompany",
    "address":{
        "address":"AddressBillingCompany",
        "city":"CityBillingCompany",
        "state":"StateBillingCompany",
        "zip":"12345678"
    },
    "contact":{
        "phone":"5335427",
        "fax":"5335427",
        "email":"billing-company@email.com"
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

> {success} 200 clearing house created


#

```json
{
    "id": 1,
    "name":"NameBillingCompany",
    "code":"CodeBillingCompany",
    "status": false,
    "address": {
        "id": 17,
        "address":"AddressBillingCompany",
        "city":"CityBillingCompany",
        "state":"StateBillingCompany",
        "zip":"12345678",
        "user_id": null,
        "billing_company_id": 1,
        "created_at": "2022-02-02T18:15:53.000000Z",
        "updated_at": "2022-02-02T18:15:53.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null
    },
    "contact": {
        "id": 15,
        "phone":"5335427",
        "fax":"5335427",
        "email":"billing-company@email.com",
        "user_id": null,
        "billing_company_id": 1,
        "created_at": "2022-02-02T18:15:53.000000Z",
        "updated_at": "2022-02-02T18:15:53.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null
    }
}
```



<a name="get-billing-company"></a>
## Get companies by User

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 data retorned

#
```json
{
    "name": "GreatotherCompany",
    "updated_at": "2022-01-13T18:59:46.000000Z",
    "created_at": "2022-01-13T18:59:46.000000Z",
    "id": 3
}
```


>{warning} possible errors: 404 when user not found 


#

<a name="get-all-billing-companies"></a>
## Get all billing companies

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
    {
        "id": 1,
        "name": "someBillingCompany",
        "created_at": "2022-01-13T18:59:15.000000Z",
        "updated_at": "2022-01-13T18:59:15.000000Z"
    },
    {
        "id": 2,
        "name": "otherBillingCompany",
        "created_at": "2022-01-13T18:59:32.000000Z",
        "updated_at": "2022-01-13T18:59:32.000000Z"
    },
    {
        "id": 3,
        "name": "GreatotherBillingCompany",
        "created_at": "2022-01-13T18:59:46.000000Z",
        "updated_at": "2022-01-13T18:59:46.000000Z"
    }
]
```


>{warning} possible errors: 404 when billing companies not found 



#

<a name="get-billing-company-by-code"></a>
## Get billing company by code

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "code": string
}
```

## Response

> {success} 200 data returned

#
```json

    {
        "id": 1,
        "name": "someBillingCompany",
        "created_at": "2022-01-13T18:59:15.000000Z",
        "updated_at": "2022-01-13T18:59:15.000000Z"
    }

```


>{warning} possible errors: 404 when billing company not found 




#

<a name="get-billing-company-by-name"></a>
## Get billing company by name

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "name": string
}
```

## Response

> {success} 200 data returned

#
```json

    {
        "id": 1,
        "name": "someBillingCompany",
        "created_at": "2022-01-13T18:59:15.000000Z",
        "updated_at": "2022-01-13T18:59:15.000000Z"
    }

```


>{warning} possible errors: 404 when billing company not found 

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