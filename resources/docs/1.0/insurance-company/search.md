# Insurance Company search Docs

---

- [Resume](#resume)
- [Find all](#find-all)
- [Search by name](#search-name)
- [Exclude results](#exclude-results)

<a name="resume"></a>
## Insurance Company search methods resumen

| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
|[1](#find-all)|POST|`find all`|`/insurance-company/search`|yes|find all insurance companies| 
|[2](#search-name)|POST|`search by name`|`/insurance-company/search`|yes|search by name| 
|[3](#exclude-results)|POST|`exclude results`|`/insurance-company/search`|yes|exclude results from search|

>{primary} all search metods whit the same url and method can be used together in the same request body

<a name="find-all"></a>
## find all

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
    "name": "Providence Administrative Services"
  },
  {
    "id": 2,
    "name": "Kg Administrative Services"
  },

  ... // rest of results
]
```

<a name="search-name"></a>
## Search by name

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Body request example

```json
{
    ... // other queries if exist
    "name": "example name"
}
```

## Response

> {success} 200 data retorned

#
```json
[
  {
    "id": 2,
    "name": "example name",
  },
  {
    "id": 5,
    "name": "example name 2",
  }
]
```

>{warning} return empty array wen not found a valid result

<a name="exclude-results"></a>
## exclude results

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Body request example

```json
{
    ... // other queries if exist
    "exclude": [2]
}
```

## Response

> {success} 200 data retorned

#
```json
[
  {
    "id": 5,
    "name": "example name 2",
  }
]
```

>{warning} return empty array wen not found a valid result