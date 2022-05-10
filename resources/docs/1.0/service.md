

# Service Docs

---

- [Basic data](#basic-data)
- [Create service](#create-service)
- [Get all service](#get-all-service)
- [Get one service](#get-one-service)
- [Update service](#Update-service)
- [Get all service groups](#get-list-service-groups)
- [Get all service types](#get-list-service-types)
- [Get all service type of services](#get-list-service-type-of-services)
- [Get all service stmt descriptions](#get-list-service-stmt-descriptions)
- [Get all service special instructions](#get-list-service-special-instructions)



<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 |POST    | `Create Service`  | `/service/`     | yes            | Create Service  |         
| 2 |GET     | `Get all Service` | `/service/`     | yes            | Get all Service |
| 3 |GET     | `Get one Service` | `/service/{id}` | yes            | Get one Service |
| 4 |PUT     | `Update Service`  | `/service/{id}` | yes            | Update Service  |
| 5 |GET | `Get all service groups`| `/service/get-list-service-groups`        |yes            |Get all service groups|
| 6 |GET | `Get all service types`| `/service/get-list-service-types`        |yes            |Get all service types|
| 7 |GET | `Get all service type of services`| `/service/get-list-service-type-of-services`        |yes            |Get all service type of services|
| 8 |GET | `Get all service stmt descriptions`| `/service/get-list-service-stmt-descriptions`        |yes            |Get all service stmt descriptions |
| 9 |GET | `Get all service special instructions`| `/service/get-list-service-special-instructions`        |yes            |Get all service special instructions |


<a name="create-service"></a>
## Create Service

### Body request example

```json

```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 Service created


#



```json

```


#

<a name="get-all-service"></a>
## Get All Service

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service found

#


```json

```

#


<a name="get-one-service"></a>
## Get One Service

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

> {success} 200 Service found

#


`````json

`````

#


<a name="Update-service"></a>
## Update Service

### Body request example

```json

```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service updated


#



```json

```

<a name="get-list-service-groups"></a>
## Get All Service Groups


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service Groups found

#

```json
[
    {
        "id": 1,
        "name": "EM - Evaluation & Management"
    },
    {
        "id": 2,
        "name": "LB - LAB"
    },
    {
        "id": 3,
        "name": "MI - Miscellaneous"
    },
    {
        "id": 4,
        "name": "PR - Procedures"
    },
    {
        "id": 5,
        "name": "SU - Surgery"
    },
    {
        "id": 6,
        "name": "XR - X Ray / Radiology"
    }
]
```


<a name="get-list-service-types"></a>
## Get All Service Types


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service Types found

#

```json
[
    {
        "id": 1,
        "name": "C - CPT"
    },
    {
        "id": 2,
        "name": "O - Office"
    },
    {
        "id": 3,
        "name": "V - Vode Codes"
    },
    {
        "id": 4,
        "name": "R - Revenue Codes"
    },
    {
        "id": 5,
        "name": "I - Inventory Virtual"
    },
    {
        "id": 6,
        "name": "D - DRG"
    },
    {
        "id": 7,
        "name": "E - Expl"
    }
]
```

<a name="get-list-service-type-of-services"></a>
## Get All Service Type of Service


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service Type of Service found

#

```json
[
    {
        "id": 1,
        "name": "01 - Medical Care"
    },
    {
        "id": 2,
        "name": "02 - Surgery"
    },
    {
        "id": 3,
        "name": "03 - Consultation"
    },
    {
        "id": 4,
        "name": "04 - Diagnostic X-Ray"
    },
    {
        "id": 5,
        "name": "05 - Diagnostic Lab"
    },
    {
        "id": 6,
        "name": "06 - Radiation Therapy"
    },
    {
        "id": 7,
        "name": "07 - Anesthesia"
    },
    {
        "id": 8,
        "name": "08 - Surgical Assistance"
    },
    {
        "id": 9,
        "name": "09 - Other Medical"
    },
    {
        "id": 10,
        "name": "10 - Blood Charges"
    },
    {
        "id": 11,
        "name": "11 - Used DME"
    },
    {
        "id": 12,
        "name": "12 - DME Purchase"
    },
    {
        "id": 13,
        "name": "13 - ASC Facility"
    },
    {
        "id": 14,
        "name": "14 - Renal Supplies In the Home"
    },
    {
        "id": 15,
        "name": "15 - Alternate Method Dialysis Payment"
    },
    {
        "id": 16,
        "name": "16 - CRD Equipment"
    },
    {
        "id": 17,
        "name": "17 - Pre-Admission Testing"
    },
    {
        "id": 18,
        "name": "18 - DME Renal"
    },
    {
        "id": 19,
        "name": "19 - Pneumonia Vaccine"
    },
    {
        "id": 20,
        "name": "20 - Second Surgical Opinion"
    },
    {
        "id": 21,
        "name": "21 - Third Surgical Opinion"
    },
    {
        "id": 22,
        "name": "22 - Third Surgical Opinion"
    },
    {
        "id": 23,
        "name": "99 - Other Used For prescription drugsMedical Care"
    },
    {
        "id": 24,
        "name": "MA - Mammography"
    }
]
```

<a name="get-list-service-stmt-descriptions"></a>
## Get All Service Stmt Descriptions


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service Stmt Descriptions found

#

```json
[
    {
        "id": 1,
        "name": "HV - Hospital Visit"
    },
    {
        "id": 2,
        "name": "IN - Injection"
    },
    {
        "id": 3,
        "name": "LB - Lab Test"
    },
    {
        "id": 4,
        "name": "ME - Medication"
    },
    {
        "id": 5,
        "name": "OV - Office Visit"
    },
    {
        "id": 6,
        "name": "PR - Procedure"
    },
    {
        "id": 7,
        "name": "SP - Supplies"
    },
    {
        "id": 8,
        "name": "SU - Surgery"
    },
    {
        "id": 9,
        "name": "XR - X Ray / Radiology"
    },
    {
        "id": 10,
        "name": "XX - Do not Show On Patient Statement"
    }
]
```

<a name="get-list-service-special-instructions"></a>
## Get All Service Special Instructions


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Service Special Instructions found

#

```json
[
    {
        "id": 1,
        "name": "BR - Op Report Required"
    },
    {
        "id": 2,
        "name": "PO - Paper Only"
    }
]
```