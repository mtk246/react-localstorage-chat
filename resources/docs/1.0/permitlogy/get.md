# Address Docs

---
- [Get list roles](#get-list-roles)
- [Get single role](#get-single-role)
- [Get list permission](#get-list-permission)
- [Get list permission for role](#get-list-permission)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
|1|GET|`Get list roles`|`/roles`|yes|Get all roles for the currect billing company|
|2|GET|`Get single role`|`/roles/{role_id}`|yes|Get all permission for current role|
|3|GET|`Get list permission`|`/roles/{role_id}/permission`|yes|Get all permission for current role|
|4|GET|`Get list permission`|`/roles/{role_id}/permission`|yes|Get all permission for current role|
|5|GET|`Get list permission`|`/roles/{role_id}/permission`|yes|Get all permission for current role|

>{primary} when url params have this symbol "?" mean not required, so you must to send null


<a name="get-list-roles"></a>
## Get all roles

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