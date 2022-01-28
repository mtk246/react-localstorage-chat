# Facility Docs

---

- [User](#section-2)

<a name="section-2"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Facility`          | `/facility/`               |yes             |Create facility|         
| 2 |GET | `Get all Facility`| `/facility/`        |yes            |Get all facility|
| 3 |GET | `Get one Facility`          | `/facility/{id}`|yes|Get one facility|



>{primary} when url params have this symbol "?" mean not required, so you must to send null


# 

#-Create Facility

<a name="section-3"></a>
## Body request example

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
        "billing_company_id":1
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

> {success} 201 clearing house created


#

```json
{
    "code": "someCode",
    "name": "someName",
    "updated_at": "2022-01-22T19:47:10.000000Z",
    "created_at": "2022-01-22T19:47:10.000000Z",
    "id": 4
}
```


# 

#-Get All Clearing House


## Param in header

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
        "type": 1,
        "name": "somename",
        "company_name": "sonameCompany",
        "npi": "somenpi",
        "taxonomy": "dsfdsf",
        "billing_company_id": 1,
        "created_at": "2022-01-22T21:30:58.000000Z",
        "updated_at": "2022-01-22T21:30:58.000000Z"
    },
    {
        "id": 2,
        "type": 1,
        "name": "somenamefff",
        "company_name": "sonameCompany",
        "npi": "somenpi",
        "taxonomy": "dsfdsf",
        "billing_company_id": 2,
        "created_at": "2022-01-22T21:41:38.000000Z",
        "updated_at": "2022-01-22T21:41:38.000000Z"
    }
]
```



#




#-Get One Clearing House


## Param in header

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
    "type": 1,
    "name": "somename",
    "company_name": "sonameCompany",
    "npi": "somenpi",
    "taxonomy": "dsfdsf",
    "billing_company_id": 1,
    "updated_at": "2022-01-22T21:30:58.000000Z",
    "created_at": "2022-01-22T21:30:58.000000Z",
    "id": 1
}
```


#

>{warning} 404 clearing found not found
