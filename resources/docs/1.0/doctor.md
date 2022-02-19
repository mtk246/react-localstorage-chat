# Doctor Docs

---

- [Basic data](#basic-data)
- [Create doctor](#create-doctor)
- [Get all doctor](#get-all-doctor)
- [Get one doctor](#get-one-doctor)
- [Update doctor](#update-doctor)
- [Get one doctor by npi](#get-one-doctor-by-npi)
- [Change status Doctor](#change-status-doctor)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Doctor`                    | `/doctor/`               |yes             |Create Doctor|         
| 2 |GET | `Get all Doctor`                   | `/doctor/`        |yes            |Get all Doctor|
| 3 |GET | `Get one Doctor`                   | `/doctor/{id}`|yes|Get one Doctor|
| 4 |PUT | `Update Doctor`                | `/doctor/{id}`|yes|Update Doctor|
| 5 |GET | `Get one Doctor by npi`           | `/doctor/{npi}/get-by-npi`|yes|Get one Doctor by npi|
| 6 |PATCH | `change status Doctor`           | `/doctor/{id}/change-status`|yes|change status doctor Doctor|



>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean




#



<a name="create-doctor"></a>
## Create Doctor

### Body request example

```json
{
    "user":{
        "username":"ccfrrfcceeeefdfrrvv",
        "email":"ccfffrrdfdeeeecvvrrrc@gmail.com",
        "sex":"m",
        "firstName":"test",
        "lastName":"test",
        "middleName":"testing",
        "ssn":"345345",
        "dateOfBirth":"1990-11-11"
    },
    "contact":{
        "phone":"34324234",
        "fax":"567674576457",
        "email":"fg@gh.com"
    },
    "address":{
        "address":"dfsdf",
        "city":"sdfsdf",
        "state":"dsfsdf",
        "zip":"234"
    },
    "doctor":{
        "npi":"4345leeorrlo3ee45533",
        "speciality":"soeeerremeSpeciality3",
        "taxonomy":"someeeerreToxonomia3rr"
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

> {success} 201 Doctor created


#



```json
{
    "username": "ccfrrfcceeeefdfrrvv",
    "email": "ccfffrrdfdeeeecvvrrrc@gmail.com",
    "sex": "m",
    "firstName": "test",
    "lastName": "test",
    "middleName": "testing",
    "ssn": "345345",
    "dateOfBirth": "1990-11-11",
    "updated_at": "2022-02-07T13:46:19.000000Z",
    "created_at": "2022-02-07T13:46:19.000000Z",
    "id": 45,
    "token": "eyJpdiI6Ik5lQnJVZlBPT3c5d0hBT1Z0MVRxNmc9PSIsInZhbHVlIjoiQm1GWTlOc05WMnBXWXdhMnRxN2RSeHkvbWdvRVNRT1Rtd1FCcE16SW1iNGV5cjZQakxHa0lWbzVMaEpXclg0ciIsIm1hYyI6ImZhYjQ4MmM5NzI5NmJhMDk3MDZhMjI5N2FhMDk0NTc4ZGUzOWQzMGFkZjgxMjM4ZTY3ZGYzZDNmZWJmY2NmMmQiLCJ0YWciOiIifQ==",
    "roles": [
        {
            "id": 12,
            "name": "DOCTOR",
            "guard_name": "api",
            "created_at": "2022-02-07T13:26:16.000000Z",
            "updated_at": "2022-02-07T13:26:16.000000Z",
            "pivot": {
                "model_id": 45,
                "role_id": 12,
                "model_type": "App\\Models\\User"
            }
        }
    ],
    "doctor": {
        "id": 19,
        "npi": "4345leeorrlo3ee45533",
        "taxonomy": "someeeerreToxonomia3rr",
        "speciality": "soeeerremeSpeciality3",
        "created_at": "2022-02-07T13:46:19.000000Z",
        "updated_at": "2022-02-07T13:46:19.000000Z",
        "user_id": 45
    }
}
```


#

<a name="get-all-doctor"></a>
## Get All Doctors


### Param in header

```json
{
    "Authorization": bearer <token>
}
```


## Response

> {success} 200 Doctor found

#


```json
[
    {
        "id": 1,
        "npi": "434534",
        "taxonomy": "someToxonomia",
        "speciality": "someSpeciality",
        "created_at": "2022-02-04T12:28:07.000000Z",
        "updated_at": "2022-02-04T12:28:07.000000Z"
    },
    {
        "id": 2,
        "npi": "4345343",
        "taxonomy": "someToxonomia2",
        "speciality": "someSpeciality1",
        "created_at": "2022-02-04T12:28:22.000000Z",
        "updated_at": "2022-02-04T12:28:22.000000Z"
    },
    {
        "id": 3,
        "npi": "43453433",
        "taxonomy": "someToxonomia3",
        "speciality": "someSpeciality3",
        "created_at": "2022-02-04T12:28:34.000000Z",
        "updated_at": "2022-02-04T12:28:34.000000Z"
    }
]
```

#

<a name="get-one-doctor"></a>
## Get One Doctor

### Param in header

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

> {success} 200 Doctor found

#


```json
{
    "npi": "43453433",
    "speciality": "someSpeciality3",
    "taxonomy": "someToxonomia3",
    "updated_at": "2022-02-04T12:28:34.000000Z",
    "created_at": "2022-02-04T12:28:34.000000Z",
    "id": 3
}
```

#

<a name="update-doctor"></a>
## Update Doctor

### Body request example

```json
{
    "user":{
        "username":"ccfrrfcceeeefdfrrvv",
        "email":"ccfffrrdfdeeeecvvrrrc@gmail.com",
        "sex":"m",
        "firstName":"test",
        "lastName":"test",
        "middleName":"testing",
        "ssn":"345345",
        "dateOfBirth":"1990-11-11"
    },
    "contact":{
        "phone":"34324234",
        "fax":"567674576457",
        "email":"fg@gh.com"
    },
    "address":{
        "address":"dfsdf",
        "city":"sdfsdf",
        "state":"dsfsdf",
        "zip":"234"
    },
    "doctor":{
        "npi":"4345leeorrlo3ee45533",
        "speciality":"soeeerremeSpeciality3",
        "taxonomy":"someeeerreToxonomia3rr"
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

> {success} 200 Doctor updated


#



```json
{
    "username": "ccfrrfcceeeefdfrrvv",
    "email": "ccfffrrdfdeeeecvvrrrc@gmail.com",
    "sex": "m",
    "firstName": "test",
    "lastName": "test",
    "middleName": "testing",
    "ssn": "345345",
    "dateOfBirth": "1990-11-11",
    "updated_at": "2022-02-07T13:46:19.000000Z",
    "created_at": "2022-02-07T13:46:19.000000Z",
    "id": 45,
    "token": "eyJpdiI6Ik5lQnJVZlBPT3c5d0hBT1Z0MVRxNmc9PSIsInZhbHVlIjoiQm1GWTlOc05WMnBXWXdhMnRxN2RSeHkvbWdvRVNRT1Rtd1FCcE16SW1iNGV5cjZQakxHa0lWbzVMaEpXclg0ciIsIm1hYyI6ImZhYjQ4MmM5NzI5NmJhMDk3MDZhMjI5N2FhMDk0NTc4ZGUzOWQzMGFkZjgxMjM4ZTY3ZGYzZDNmZWJmY2NmMmQiLCJ0YWciOiIifQ==",
    "roles": [
        {
            "id": 12,
            "name": "DOCTOR",
            "guard_name": "api",
            "created_at": "2022-02-07T13:26:16.000000Z",
            "updated_at": "2022-02-07T13:26:16.000000Z",
            "pivot": {
                "model_id": 45,
                "role_id": 12,
                "model_type": "App\\Models\\User"
            }
        }
    ],
    "doctor": {
        "id": 19,
        "npi": "4345leeorrlo3ee45533",
        "taxonomy": "someeeerreToxonomia3rr",
        "speciality": "soeeerremeSpeciality3",
        "created_at": "2022-02-07T13:46:19.000000Z",
        "updated_at": "2022-02-07T13:46:19.000000Z",
        "user_id": 45
    }
}
```

#

<a name="get-one-doctor-by-npi"></a>
##Get One Doctor by NPI


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "npi": <string>
}
```

## Response

> {success} 200 Doctor found

#


```json
{
    "npi": "43453433",
    "speciality": "someSpeciality3",
    "taxonomy": "someToxonomia3",
    "updated_at": "2022-02-04T12:28:34.000000Z",
    "created_at": "2022-02-04T12:28:34.000000Z",
    "id": 3
}
```



#

<a name="change-status-doctor"></a>
## Change status Doctor


### Param in header

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

> {success} 204 Status changed


#
