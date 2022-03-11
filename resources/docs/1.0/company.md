# Company Docs

---

- [Basic data](#basic-data)
- [Create company](#create-company)
- [Get all company](#get-all-company)
- [Get one company](#get-one-company)
- [Get one company by name](#get-one-company-by-name)
- [Get one company by email](#get-one-company-by-email)
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
| 6 |PUT | `Update company`          | `/company/{id}`|yes|update company|
| 7 |PATCH | `Change status company`          | `/company/change-status/{id}`|yes|Change status company|
| 8 |PATCH | `Add to billing company`          | `/company/add-to-billing-company/{id}`|yes|Add company to billing company|



>{primary} when url params have this symbol "?" mean not required, so you must to send null


# 

<a name="create-company"></a>
## Create Company

### Body request example


#

```json
{
    "company":{
        "code":"somecode",
        "name":"someName0101",
        "npi":"323efsd",
        "email": "some@email.com",
        "tax_id": 343
    },"address":{
        "address":"dfsdf",
        "city":"sdfsdf",
        "state":"dsfsdf",
        "zip":"234"
    },
    "contact":{
        "phone":"34324234",
        "fax":"567674576457",
        "email":"fg@gh.com"
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

> {success} 201 clearing house created


#

```json
{
    "code": "somecode",
    "name": "someName0101",
    "npi": "323efsd",
    "email": "some@email.com",
    "tax_id": 343,
    "updated_at": "2022-01-23T20:27:53.000000Z",
    "created_at": "2022-01-23T20:27:53.000000Z",
    "id": 2
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

> {success} 200 Clearing houses found

#

```json
[
    {
        "id": 1,
        "code": "somecode",
        "name": "someName",
        "status": false,
        "taxonomy": 45345345,
        "npi": "323efsd",
        "created_at": "2022-01-23T20:27:45.000000Z",
        "updated_at": "2022-01-23T20:27:45.000000Z",
        "email": null,
        "tax_id": 0,
        "address": null,
        "contact": null,
        "facilities": null
    },
    {
        "id": 2,
        "code": "somecode",
        "name": "someName0101",
        "status": false,
        "taxonomy": 45345345,
        "npi": "323efsd",
        "created_at": "2022-01-23T20:27:53.000000Z",
        "updated_at": "2022-01-23T20:27:53.000000Z",
        "email": null,
        "tax_id": 0,
        "address": null,
        "contact": null,
        "facilities": null
    },
    {
        "id": 3,
        "code": "somecode2",
        "name": "someName01012",
        "status": false,
        "taxonomy": 45345345,
        "npi": "323efsd",
        "created_at": "2022-02-02T18:14:23.000000Z",
        "updated_at": "2022-02-02T18:14:23.000000Z",
        "email": null,
        "tax_id": 0,
        "address": null,
        "contact": {
            "id": 14,
            "phone": "34324234",
            "fax": "567674576457",
            "email": "fg@gh.com",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-02T18:14:23.000000Z",
            "updated_at": "2022-02-02T18:14:23.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": 3,
            "facilities": null
        }
    },
    {
        "id": 4,
        "code": "somecode22",
        "name": "someName010122",
        "status": false,
        "taxonomy": 45345345,
        "npi": "323efsd",
        "created_at": "2022-02-02T18:15:53.000000Z",
        "updated_at": "2022-02-02T18:15:53.000000Z",
        "email": null,
        "tax_id": 0,
        "address": {
            "id": 17,
            "address": "dfsdf",
            "city": "sdfsdf",
            "state": "dsfsdf",
            "zip": "234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-02T18:15:53.000000Z",
            "updated_at": "2022-02-02T18:15:53.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": 4
        },
        "contact": {
            "id": 15,
            "phone": "34324234",
            "fax": "567674576457",
            "email": "fg@gh.com",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-02T18:15:53.000000Z",
            "updated_at": "2022-02-02T18:15:53.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": 4
        },
        "facilities": [
            {
                "company_id": 1,
                "company_name": "Roob and Sons",
                "created_at": "2022-03-02T22:58:00.000000Z",
                "id": 1,
                "name": "Mr. Rogers Crooks",
                "npi": "716391434057459",
                "status": false,
                "taxonomy": "Police and Sheriffs Patrol Officer",
                "type": 2,
                "updated_at": "2022-03-02T22:58:00.000000Z",
            },
            {
               "company_id": 1,
                "company_name": "Zulauf, Ziemann and Haley",
                "created_at": "2022-03-02T22:58:00.000000Z",
                "id": 2,
                "name": "Rahul McDermott III",
                "npi": "572402301841835",
                "status": false,
                "taxonomy": "Computer Scientist",
                "type": 2,
                "updated_at": "2022-03-02T22:58:00.000000Z"
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

> {success} 200 Clearing house found

#

```json
    {
    "id": 4,
    "code": "somecode22",
    "name": "someName010122",
    "status": false,
    "taxonomy": 45345345,
    "npi": "323efsd",
    "created_at": "2022-02-02T18:15:53.000000Z",
    "updated_at": "2022-02-02T18:15:53.000000Z",
    "email": null,
    "tax_id": 0,
    "address": {
        "id": 17,
        "address": "dfsdf",
        "city": "sdfsdf",
        "state": "dsfsdf",
        "zip": "234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-02T18:15:53.000000Z",
        "updated_at": "2022-02-02T18:15:53.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": 4
    },
    "contact": {
        "id": 15,
        "phone": "34324234",
        "fax": "567674576457",
        "email": "fg@gh.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-02T18:15:53.000000Z",
        "updated_at": "2022-02-02T18:15:53.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": 4
    },
    "facilities": [
        {
            "company_id": 1,
            "company_name": "Roob and Sons",
            "created_at": "2022-03-02T22:58:00.000000Z",
            "id": 1,
            "name": "Mr. Rogers Crooks",
            "npi": "716391434057459",
            "status": false,
            "taxonomy": "Police and Sheriffs Patrol Officer",
            "type": 2,
            "updated_at": "2022-03-02T22:58:00.000000Z",
        },
        {
           "company_id": 1,
            "company_name": "Zulauf, Ziemann and Haley",
            "created_at": "2022-03-02T22:58:00.000000Z",
            "id": 2,
            "name": "Rahul McDermott III",
            "npi": "572402301841835",
            "status": false,
            "taxonomy": "Computer Scientist",
            "type": 2,
            "updated_at": "2022-03-02T22:58:00.000000Z"
        }
    ]
}
```


#

>{warning} 404 clearing found not found

<a name="update-company"></a>
## Update Company


### Body request example


#

```json
{
    "company":{
        "id":4,
        "code":"somecode",
        "name":"someName0101",
        "npi":"323efsd",
        "email": "some@email.com",
        "tax_id": 343
    },"address":{
        "address":"dfsdf",
        "city":"sdfsdf",
        "state":"dsfsdf",
        "zip":"234"
    },
    "contact":{
        "phone":"34324234",
        "fax":"567674576457",
        "email":"fg@gh.com"
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
    "id": 4,
    "code": "somecode22",
    "name": "someName010122",
    "status": false,
    "npi": "323efsd",
    "created_at": "2022-02-02T18:15:53.000000Z",
    "updated_at": "2022-02-02T18:15:53.000000Z",
    "email": null,
    "tax_id": 0,
    "address": {
        "id": 17,
        "address": "dfsdf",
        "city": "sdfsdf",
        "state": "dsfsdf",
        "zip": "234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-02T18:15:53.000000Z",
        "updated_at": "2022-02-02T18:15:53.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": 4
    },
    "contact": {
        "id": 15,
        "phone": "34324234",
        "fax": "567674576457",
        "email": "fg@gh.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-02T18:15:53.000000Z",
        "updated_at": "2022-02-02T18:15:53.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": 4
    }
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
    "id": 3,
    "code": "company_code",
    "name": "company_name",
    "status": true,
    "taxonomy": 1,
    "npi": "123456",
    "created_at": null,
    "updated_at": null,
    "email": "company@company.com",
    "tax_id": 0
}
```

#

>{warning} 404 error add company to billing company
