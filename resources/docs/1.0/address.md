# Address Docs

---
- [Get list countries](#get-list-countries)
- [Get list states by country](#get-list-states)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |GET| `Get list countries`| `/address/get-list-countries`|yes|Get all countries|
| 1 |GET| `Get list states`| `/address/get-list-states`|yes|Get all states with subdivision code by country|


>{primary} when url params have this symbol "?" mean not required, so you must to send null


<a name="get-list-countries"></a>
## Get all countries

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
[
  {
    "id": 1,
    "name": "US - United States of America"
  }
]
```

<a name="get-list-states"></a>
## Get all states with subdivision code by country

### Param in header

```json
{
    "Authorization": bearer <token>
}
```
### Param in path

```json
"country_id": optional <integer>
```

## Example path

>{primary} /get-list-states ?country_id=ID


## Response

> {success} 200 data retorned

#
```json
[
  {
    "id": 1,
    "code": "AK",
    "name": "AK - Alaska"
  },
  {
    "id": 2,
    "code": "AL",
    "name": "AL - Alabama"
  },
  {
    "id": 3,
    "code": "AR",
    "name": "AR - Arkansas"
  },
  [...] rest of states
]
```