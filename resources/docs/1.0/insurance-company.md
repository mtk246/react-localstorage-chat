# Insurance Company Docs

---

- [Insurance Company](#section-2)

<a name="section-2"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Insurance Company`                    | `/insurance-company/`               |yes             |Create Insurance Company|         
| 2 |GET | `Get all Insurance Company`                   | `/insurance-company/`        |yes            |Get all Insurance Company|
| 3 |GET | `Get one Insurance Company`                   | `/insurance-company/{id}`|yes|Get one Insurance Company|
| 4 |PUT | `Update Insurance Company`                | `/insurance-company/{id}`|yes|Update Insurance Company|
| 5 |GET | `Get one Insurance Company by name`           | `/insurance-company/{name}/get-by-name`|yes|Get one Insurance Company by name|
| 6 |GET | `Get one Insurance Company by company`           | `/insurance-company/{companyName}/get-by-company`|yes|Get one Insurance Company by name|
| 7 |PATCH | `Change status Insurance Company`           | `/insurance-company/{id}/change-status`|yes|Change status Insurance Company|



>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean





#


#-Create Insurance Company

<a name="section-3"></a>
## Body request example

```json
{
    "insurance":{
        "name":"dsfsdfsfeddsddfg",
        "naic":"someNaic",
        "file_method":"someFileNaic"
    },
    "address":{
        "address":"dfsdf",
        "city":"cdfsf",
        "state":"sdsfsd",
        "zip":"3234"
    },
    "contact":{
        "phone":"55433",
        "fax":"fsdfs",
        "email":"dsfsd@gdrfg.com"
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

> {success} 201 Insurance Company created


#



```json
{
    "name": "dsfsdfsfffeddsddfg",
    "naic": "someNffaic",
    "file_method": "soffmeFileNaic",
    "code": "389245",
    "updated_at": "2022-02-03T21:30:51.000000Z",
    "created_at": "2022-02-03T21:30:51.000000Z",
    "id": 3,
    "address": {
        "id": 23,
        "address": "dfsdf",
        "city": "cdfsf",
        "state": "sdsfsd",
        "zip": "3234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    },
    "contact": {
        "id": 21,
        "phone": "55433",
        "fax": "fsdfs",
        "email": "dsfsd@gdrfg.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    }
}
```



#




#-Update Insurance Company

<a name="section-3"></a>
## Body request example

```json
{
    "insurance":{
        "name":"dsfsdfsfeddsddfg",
        "naic":"someNaic",
        "file_method":"someFileNaic"
    },
    "address":{
        "address":"dfsdf",
        "city":"cdfsf",
        "state":"sdsfsd",
        "zip":"3234"
    },
    "contact":{
        "phone":"55433",
        "fax":"fsdfs",
        "email":"dsfsd@gdrfg.com"
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

> {success} 200 Insurance company updated


#



```json
{
    "name": "dsfsdfsfffeddsddfg",
    "naic": "someNffaic",
    "file_method": "soffmeFileNaic",
    "code": "389245",
    "updated_at": "2022-02-03T21:30:51.000000Z",
    "created_at": "2022-02-03T21:30:51.000000Z",
    "id": 3,
    "address": {
        "id": 23,
        "address": "dfsdf",
        "city": "cdfsf",
        "state": "sdsfsd",
        "zip": "3234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    },
    "contact": {
        "id": 21,
        "phone": "55433",
        "fax": "fsdfs",
        "email": "dsfsd@gdrfg.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    }
}
```



#


#-Get One Insurance company


## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "id": <integer>
}
```

## Response

> {success} 200 Insurance found

#


```json
{
    "name": "dsfsdfsfffeddsddfg",
    "naic": "someNffaic",
    "file_method": "soffmeFileNaic",
    "code": "389245",
    "updated_at": "2022-02-03T21:30:51.000000Z",
    "created_at": "2022-02-03T21:30:51.000000Z",
    "id": 3,
    "address": {
        "id": 23,
        "address": "dfsdf",
        "city": "cdfsf",
        "state": "sdsfsd",
        "zip": "3234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    },
    "contact": {
        "id": 21,
        "phone": "55433",
        "fax": "fsdfs",
        "email": "dsfsd@gdrfg.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    }
}
```



#


#-Get All Insurance company


## Param in header

```json
{
    "Authorization": bearer <token>
}
```


## Response

> {success} 200 Insurance found

#


```json
[
    {
        "id": 1,
        "code": "042151",
        "name": "dsfsdfsfesddfg",
        "file_method": "someFileNaic",
        "naic": "someNaic",
        "created_at": "2022-02-03T20:13:40.000000Z",
        "updated_at": "2022-02-03T20:13:40.000000Z",
        "status": false,
        "address": null,
        "contact": null
    },
    {
        "id": 2,
        "code": "391961",
        "name": "dsfsdfsfeddsddfg",
        "file_method": "someFileNaic",
        "naic": "someNaic",
        "created_at": "2022-02-03T20:17:32.000000Z",
        "updated_at": "2022-02-03T20:17:32.000000Z",
        "status": false,
        "address": {
            "id": 22,
            "address": "dfsdf",
            "city": "cdfsf",
            "state": "sdsfsd",
            "zip": "3234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-03T20:17:32.000000Z",
            "updated_at": "2022-02-03T20:17:32.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": null,
            "insurance_company_id": 2
        },
        "contact": {
            "id": 20,
            "phone": "55433",
            "fax": "fsdfs",
            "email": "dsfsd@gdrfg.com",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-03T20:17:32.000000Z",
            "updated_at": "2022-02-03T20:17:32.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": null,
            "insurance_company_id": 2
        }
    },
    {
        "id": 3,
        "code": "389245",
        "name": "dsfsdfsfffeddsddfg",
        "file_method": "soffmeFileNaic",
        "naic": "someNffaic",
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "status": false,
        "address": {
            "id": 23,
            "address": "dfsdf",
            "city": "cdfsf",
            "state": "sdsfsd",
            "zip": "3234",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-03T21:30:51.000000Z",
            "updated_at": "2022-02-03T21:30:51.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": null,
            "insurance_company_id": 3
        },
        "contact": {
            "id": 21,
            "phone": "55433",
            "fax": "fsdfs",
            "email": "dsfsd@gdrfg.com",
            "user_id": null,
            "billing_company_id": null,
            "created_at": "2022-02-03T21:30:51.000000Z",
            "updated_at": "2022-02-03T21:30:51.000000Z",
            "clearing_house_id": null,
            "facility_id": null,
            "company_id": null,
            "insurance_company_id": 3
        }
    }
]
```

#


#-Get One Insurance company by name


## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "name": <string>
}
```

## Response

> {success} 200 Insurance found

#


```json
{
    "name": "dsfsdfsfffeddsddfg",
    "naic": "someNffaic",
    "file_method": "soffmeFileNaic",
    "code": "389245",
    "updated_at": "2022-02-03T21:30:51.000000Z",
    "created_at": "2022-02-03T21:30:51.000000Z",
    "id": 3,
    "address": {
        "id": 23,
        "address": "dfsdf",
        "city": "cdfsf",
        "state": "sdsfsd",
        "zip": "3234",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    },
    "contact": {
        "id": 21,
        "phone": "55433",
        "fax": "fsdfs",
        "email": "dsfsd@gdrfg.com",
        "user_id": null,
        "billing_company_id": null,
        "created_at": "2022-02-03T21:30:51.000000Z",
        "updated_at": "2022-02-03T21:30:51.000000Z",
        "clearing_house_id": null,
        "facility_id": null,
        "company_id": null,
        "insurance_company_id": 3
    }
}
```



#




#-Change Status


## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Body Param 

```json
{
    "status": <boolean>
}
```

## Param in path

```json
{
    "id": <integer>
}
```

## Response

> {success} 204 status changed

#


