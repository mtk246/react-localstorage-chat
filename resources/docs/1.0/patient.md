

# Patient Docs

---

- [Patient](#section-2)

<a name="section-2"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Patient`                    | `/patient/`               |yes             |Create Patient|         
| 2 |GET | `Get all Patient`                   | `/patient/`        |yes            |Get all Patient|
| 3 |GET | `Get one Patient`                   | `/patient/{id}`|yes|Get one Patient|
| 4 |PUT | `Update Patient`                | `/patient/{id}`|yes|Update Patient|


>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean


#-Create Patient

<a name="section-3"></a>
## Body request example

```json
{
    "user":{
        "username":"dff",
        "email":"dffg@gmail.com",
        "sex":"m",
        "firstName":"test",
        "lastName":"test",
        "middleName":"testing",
        "ssn":"345345",
        "dateOfBirth":"1990-11-11"
    },
    "patient":{
        "marital_status":"dsf",
        "driver_licence":"sdfsdf",
        "dependent":true,
        "guardian_name":"dsfsdf",
        "guardian_phone":"Dsfsdf",
        "spuse_name":"dfgfd",
        "employer":"DFgddf",
        "employer_address":"dfg",
        "position":"Dsgsdf",
        "phone_employer":"Dsfgds",
        "spuse_employer":"Sdfgdsfg",
        "spuse_work_phone":"DSfgds"
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

> {success} 201 Patient created


#



```json
{
    "username": "dff",
    "email": "dffg@gmail.com",
    "sex": "m",
    "firstName": "test",
    "lastName": "test",
    "middleName": "testing",
    "ssn": "345345",
    "dateOfBirth": "1990-11-11",
    "updated_at": "2022-02-09T09:18:10.000000Z",
    "created_at": "2022-02-09T09:18:10.000000Z",
    "id": 66,
    "roles": [
        {
            "id": 13,
            "name": "PATIENT",
            "guard_name": "api",
            "created_at": "2022-02-07T13:26:23.000000Z",
            "updated_at": "2022-02-07T13:26:23.000000Z",
            "pivot": {
                "model_id": 66,
                "role_id": 13,
                "model_type": "App\\Models\\User"
            }
        }
    ],
    "patient": {
        "id": 18,
        "marital_status": "dsf",
        "driver_licence": "sdfsdf",
        "dependent": true,
        "guardian_name": "dsfsdf",
        "guardian_phone": "Dsfsdf",
        "spuse_name": "dfgfd",
        "employer": "DFgddf",
        "employer_address": "dfg",
        "position": "Dsgsdf",
        "phone_employer": "Dsfgds",
        "spuse_employer": "Sdfgdsfg",
        "spuse_work_phone": "DSfgds",
        "user_id": 66,
        "created_at": "2022-02-09T09:18:10.000000Z",
        "updated_at": "2022-02-09T09:18:10.000000Z"
    }
}
```



#


#-Update Patient

<a name="section-3"></a>
## Body request example

```json
{
    "user":{
        "username":"jjjjjj",
        "email":"jjjjjjj@gmail.com",
        "sex":"m",
        "firstName":"jjjj",
        "lastName":"jjjj",
        "middleName":"jjjj",
        "ssn":"66666",
        "dateOfBirth":"1990-11-11"
    },
    "patient":{
        "marital_status":"jjjj",
        "driver_licence":"jjj",
        "dependent":false,
        "guardian_name":"jjj",
        "guardian_phone":"jjj",
        "spuse_name":"jjj",
        "employer":"jjj",
        "employer_address":"jjjj",
        "position":"jjj",
        "phone_employer":"jjjj",
        "spuse_employer":"jjjjj",
        "spuse_work_phone":"jjjj"
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

> {success} 200 Patient updated


#



```json
{
    "id": 1,
    "marital_status": "jjjj",
    "driver_licence": "jjj",
    "dependent": false,
    "guardian_name": "jjj",
    "guardian_phone": "jjj",
    "spuse_name": "jjj",
    "employer": "jjj",
    "employer_address": "jjjj",
    "position": "jjj",
    "phone_employer": "jjjj",
    "spuse_employer": "jjjjj",
    "spuse_work_phone": "jjjj",
    "user_id": 48,
    "created_at": "2022-02-09T08:54:13.000000Z",
    "updated_at": "2022-02-09T09:30:23.000000Z",
    "user": {
        "id": 48,
        "username": "jjjjjj",
        "email": "jjjjjjj@gmail.com",
        "email_verified_at": null,
        "created_at": "2022-02-09T08:54:13.000000Z",
        "updated_at": "2022-02-09T09:30:23.000000Z",
        "sex": "m",
        "lastName": "jjjj",
        "firstName": "jjjj",
        "middleName": "jjjj",
        "token": null,
        "available": false,
        "isLogged": false,
        "ssn": "66666",
        "dateOfBirth": "1990-11-11",
        "img_profile": null,
        "isBlocked": false
    }
}
```



#


#-Get One Patient

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

> {success} 200 Patient found

#


```json
{
    "id": 1,
    "marital_status": "dsf",
    "driver_licence": "sdfsdf",
    "dependent": true,
    "guardian_name": "dsfsdf",
    "guardian_phone": "Dsfsdf",
    "spuse_name": "dfgfd",
    "employer": "DFgddf",
    "employer_address": "dfg",
    "position": "Dsgsdf",
    "phone_employer": "Dsfgds",
    "spuse_employer": "Sdfgdsfg",
    "spuse_work_phone": "DSfgds",
    "user_id": 48,
    "created_at": "2022-02-09T08:54:13.000000Z",
    "updated_at": "2022-02-09T08:54:13.000000Z",
    "user": {
        "id": 48,
        "username": "ccffcfgdfcvv",
        "email": "ccffffffdfdfcvvc@gmail.com",
        "email_verified_at": null,
        "created_at": "2022-02-09T08:54:13.000000Z",
        "updated_at": "2022-02-09T08:54:13.000000Z",
        "sex": "m",
        "lastName": "test",
        "firstName": "test",
        "middleName": "testing",
        "token": null,
        "available": false,
        "isLogged": false,
        "ssn": "345345",
        "dateOfBirth": "1990-11-11",
        "img_profile": null,
        "isBlocked": false
    }
}
```



#


#-Get All Patient

## Param in header

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
        "marital_status": "dsf",
        "driver_licence": "sdfsdf",
        "dependent": true,
        "guardian_name": "dsfsdf",
        "guardian_phone": "Dsfsdf",
        "spuse_name": "dfgfd",
        "employer": "DFgddf",
        "employer_address": "dfg",
        "position": "Dsgsdf",
        "phone_employer": "Dsfgds",
        "spuse_employer": "Sdfgdsfg",
        "spuse_work_phone": "DSfgds",
        "user_id": 48,
        "created_at": "2022-02-09T08:54:13.000000Z",
        "updated_at": "2022-02-09T08:54:13.000000Z",
        "user": {
            "id": 48,
            "username": "ccffcfgdfcvv",
            "email": "ccffffffdfdfcvvc@gmail.com",
            "email_verified_at": null,
            "created_at": "2022-02-09T08:54:13.000000Z",
            "updated_at": "2022-02-09T08:54:13.000000Z",
            "sex": "m",
            "lastName": "test",
            "firstName": "test",
            "middleName": "testing",
            "token": null,
            "available": false,
            "isLogged": false,
            "ssn": "345345",
            "dateOfBirth": "1990-11-11",
            "img_profile": null,
            "isBlocked": false
        }
    },
    {
        "id": 2,
        "marital_status": "dsf",
        "driver_licence": "sdfsdf",
        "dependent": true,
        "guardian_name": "dsfsdf",
        "guardian_phone": "Dsfsdf",
        "spuse_name": "dfgfd",
        "employer": "DFgddf",
        "employer_address": "dfg",
        "position": "Dsgsdf",
        "phone_employer": "Dsfgds",
        "spuse_employer": "Sdfgdsfg",
        "spuse_work_phone": "DSfgds",
        "user_id": 50,
        "created_at": "2022-02-09T09:00:43.000000Z",
        "updated_at": "2022-02-09T09:00:43.000000Z",
        "user": {
            "id": 50,
            "username": "ccffcfgdfcvv",
            "email": "ccfffffdddfdfdfcvvc@gmail.com",
            "email_verified_at": null,
            "created_at": "2022-02-09T09:00:43.000000Z",
            "updated_at": "2022-02-09T09:00:43.000000Z",
            "sex": "m",
            "lastName": "test",
            "firstName": "test",
            "middleName": "testing",
            "token": null,
            "available": false,
            "isLogged": false,
            "ssn": "345345",
            "dateOfBirth": "1990-11-11",
            "img_profile": null,
            "isBlocked": false
        }
    }
]
```



#
