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
    "facility":{
        "type":1,
        "name":"somename",
        "company_name":"sonameCompany",
        "npi":"somenpi",
        "taxonomy":"dsfdsf",
        "company_id":1
    },
    "address":{
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

> {success} 201 Facility created


#

```json
{
    "type": 1,
    "name": "somenamessfff",
    "company_name": "sonameCssompany",
    "npi": "somenpi",
    "taxonomy": "dsfdsf",
    "company_id": 2,
    "updated_at": "2022-02-02T19:46:39.000000Z",
    "created_at": "2022-02-02T19:46:39.000000Z",
    "id": 3
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
        "name": "somename",
        "company_name": "sonameCompany",
        "npi": "somenpi",
        "taxonomy": "dsfdsf",
        "company_id": 1,
        "created_at": "2022-01-22T21:30:58.000000Z",
        "updated_at": "2022-01-22T21:30:58.000000Z",
        "address": {
            "id": 5,
            "address": "dfsdf",
            "city": "sdfsdf",
            "state": "dsfsdf",
            "zip": "234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-01-22T21:30:59.000000Z",
            "updated_at": "2022-01-22T21:30:59.000000Z",
            "clearing_house_id": null,
            "facility_id": 1,
            "company_id": null
        },
        "contact": null
    },
    {
        "id": 2,
        "type": 1,
        "name": "somenamefff",
        "company_name": "sonameCompany",
        "npi": "somenpi",
        "taxonomy": "dsfdsf",
        "company_id": 2,
        "created_at": "2022-01-22T21:41:38.000000Z",
        "updated_at": "2022-01-22T21:41:38.000000Z",
        "address": {
            "id": 6,
            "address": "dfsdf",
            "city": "sdfsdf",
            "state": "dsfsdf",
            "zip": "234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-01-22T21:41:38.000000Z",
            "updated_at": "2022-01-22T21:41:38.000000Z",
            "clearing_house_id": null,
            "facility_id": 2,
            "company_id": null
        },
        "contact": null
    },
    {
        "id": 3,
        "type": 1,
        "name": "somenamessfff",
        "company_name": "sonameCssompany",
        "npi": "somenpi",
        "taxonomy": "dsfdsf",
        "company_id": 2,
        "created_at": "2022-02-02T19:46:39.000000Z",
        "updated_at": "2022-02-02T19:46:39.000000Z",
        "address": {
            "id": 18,
            "address": "dfsdf",
            "city": "sdfsdf",
            "state": "dsfsdf",
            "zip": "234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-02T19:46:39.000000Z",
            "updated_at": "2022-02-02T19:46:39.000000Z",
            "clearing_house_id": null,
            "facility_id": 3,
            "company_id": null
        },
        "contact": null
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
    "name": "somename",
    "company_name": "sonameCompany",
    "npi": "somenpi",
    "taxonomy": "dsfdsf",
    "company_id": 1,
    "created_at": "2022-01-22T21:30:58.000000Z",
    "updated_at": "2022-01-22T21:30:58.000000Z",
    "address": {
        "id": 5,
        "address": "dfsdf",
        "city": "sdfsdf",
        "state": "dsfsdf",
        "zip": "234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-01-22T21:30:59.000000Z",
        "updated_at": "2022-01-22T21:30:59.000000Z",
        "clearing_house_id": null,
        "facility_id": 1,
        "company_id": null
    },
    "contact": null
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
    "facility":{
        "type":1,
        "name":"somename",
        "company_name":"sonameCompany",
        "npi":"somenpi",
        "taxonomy":"dsfdsf",
        "company_id":1
    },
    "address":{
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

> {success} 200 Facility Updated


#


```json
{
    "id": 1,
    "type": 1,
    "name": "somename",
    "company_name": "sonameCompany",
    "npi": "somenpi",
    "taxonomy": "dsfdsf",
    "company_id": 1,
    "created_at": "2022-01-22T21:30:58.000000Z",
    "updated_at": "2022-01-22T21:30:58.000000Z",
    "address": {
        "id": 5,
        "address": "dfsdf",
        "city": "sdfsdf",
        "state": "dsfsdf",
        "zip": "234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-01-22T21:30:59.000000Z",
        "updated_at": "2022-01-22T21:30:59.000000Z",
        "clearing_house_id": null,
        "facility_id": 1,
        "company_id": null
    },
    "contact": null
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


### Body request example

```json
{
    "id": 1,
    "type": 1,
    "name": "facility_name",
    "company_name": "company_name",
    "npi": "123456",
    "taxonomy": "taxonomy",
    "company_id": 1,
    "created_at": null,
    "updated_at": null
}
```


## Response

> {success} 200 Good response


#

>{warning} 404 error add facility to billing company