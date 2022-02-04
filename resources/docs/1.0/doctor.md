# Doctor Docs

---

- [Doctor](#section-2)

<a name="section-2"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create Doctor`                    | `/doctor/`               |yes             |Create Doctor|         
| 2 |GET | `Get all Doctor`                   | `/doctor/`        |yes            |Get all Doctor|
| 3 |GET | `Get one Doctor`                   | `/doctor/{id}`|yes|Get one Doctor|
| 4 |PUT | `Update Doctor`                | `/doctor/{id}`|yes|Update Doctor|
| 5 |GET | `Get one Doctor by npi`           | `/doctor/{npi}/get-by-npi`|yes|Get one Doctor by npi|



>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean




#




#-Create Doctor

<a name="section-3"></a>
## Body request example

```json
{
    "npi":"43453433",
    "speciality":"someSpeciality3",
    "taxonomia":"someToxonomia3"
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
    "npi": "43453433",
    "speciality": "someSpeciality3",
    "taxonomia": "someToxonomia3",
    "updated_at": "2022-02-04T12:28:34.000000Z",
    "created_at": "2022-02-04T12:28:34.000000Z",
    "id": 3
}
```



#




#-Update Doctor

<a name="section-3"></a>
## Body request example

```json
{
    "npi":"43453433",
    "speciality":"someSpeciality3",
    "taxonomia":"someToxonomia3"
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
    "npi": "43453433",
    "speciality": "someSpeciality3",
    "taxonomia": "someToxonomia3",
    "updated_at": "2022-02-04T12:28:34.000000Z",
    "created_at": "2022-02-04T12:28:34.000000Z",
    "id": 3
}
```



#


#-Get One Doctor

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

> {success} 200 Doctor found

#


```json
{
    "npi": "43453433",
    "speciality": "someSpeciality3",
    "taxonomia": "someToxonomia3",
    "updated_at": "2022-02-04T12:28:34.000000Z",
    "created_at": "2022-02-04T12:28:34.000000Z",
    "id": 3
}
```



#


#-Get All Doctors


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
        "npi": "434534",
        "taxonomia": "someToxonomia",
        "speciality": "someSpeciality",
        "created_at": "2022-02-04T12:28:07.000000Z",
        "updated_at": "2022-02-04T12:28:07.000000Z"
    },
    {
        "id": 2,
        "npi": "4345343",
        "taxonomia": "someToxonomia2",
        "speciality": "someSpeciality1",
        "created_at": "2022-02-04T12:28:22.000000Z",
        "updated_at": "2022-02-04T12:28:22.000000Z"
    },
    {
        "id": 3,
        "npi": "43453433",
        "taxonomia": "someToxonomia3",
        "speciality": "someSpeciality3",
        "created_at": "2022-02-04T12:28:34.000000Z",
        "updated_at": "2022-02-04T12:28:34.000000Z"
    }
]
```

#


#-Get One Doctor by NPI


## Param in header

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
    "taxonomia": "someToxonomia3",
    "updated_at": "2022-02-04T12:28:34.000000Z",
    "created_at": "2022-02-04T12:28:34.000000Z",
    "id": 3
}
```



#
