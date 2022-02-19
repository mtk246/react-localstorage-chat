# API Docs
---
- [Basic data](#basic-data)
- [Get NPI](#get-npi)
- [Get zip code](#get-zip-code)

<a name="basic-data"></a>
## Basic data to make request


| # |METHOD| Name           | URL          | Token required | Description|
| : |      |   :-           |  :           |                | |
| 1 |GET   | `get npi`      | `/npi/{npi}` | no             | Get the information associated with the NPI record |
| 2 |POST  | `get zip code` | `/usps`      | no             | Get the zipcode associated with the address registered with the USPS |

<a name="get-npi"></a>
## Get NPI

### Param in path

```json
{
    "id": <integer>
}
```

## Response

> {success} 200 Npi found

#


```json
{
    "number": 1669853537,
    "basic": {
        "first_name": "KAREL",
        "last_name": "DIAZ REYES",
        "credential": "M.D",
        "sole_proprietor": "NO",
        "gender": "M",
        "enumeration_date": "2015-06-16",
        "last_updated": "2020-05-01",
        "status": "A",
        "name": "DIAZ REYES KAREL",
        "certification_date": "2020-05-01"
    },
    "taxonomies": [
        {
            "code": "207R00000X",
            "desc": "Internal Medicine",
            "primary": true,
            "state": "FL",
            "license": "ME136891"
        }
    ],
    "contact": {
        "phone": "786-468-0113",
        "email": "",
        "address": "7901 HISPANOLA AVE",
        "country": "United States",
        "city": "NORTH BAY VILLAGE",
        "state": "FL"
    }
}
```

<a name="get-zip-code"></a>
## Get zip code

### Body request example

```json
{
    "address1":"4300 ALTON RD",
    "city":"MIAMI BEACH",
    "state":"FL",
}
```

## Response

> {success} 200 Zip code found


#


```json
{
    "status": "SUCCESS",
    "zipCode": "331402948"
}
```
