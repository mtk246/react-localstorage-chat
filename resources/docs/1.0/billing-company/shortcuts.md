# Company Billing shortcuts Docs

---
- [Get billing company shortcuts](#read-shortcuts)
- [Store billing company shortcut](#store-shortcuts)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |GET| `Get all shortcuts`| `/billing-company/{billing_company_id}/shortcuts`|yes|Get all billing company shortcuts|
| 2 |POST| `Store shortcuts`| `/billing-company/{billing_company_id}/shortcuts`|yes|Store all billing company shortcuts|


>{primary} when url params have this symbol "?" mean not required, so you must to send null


<a name="read-shortcuts"></a>
## Get all billing company shortcuts

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
    "description": "Show menu",
    "shortcut_type": "General",
    "module": "",
    "key": "CTRL + ALT",
    "default_key": "CTRL + ALT"
  },
  {
    "id": 2,
    "description": "Access to claims management",
    "shortcut_type": "General",
    "module": "",
    "key": "CTRL + ALT + A",
    "default_key": "CTRL + ALT + C"
  }
  [...] rest of shortcuts
]
```
update
update.*.id
update.*.key
delete
delete.*.id
>{warning} possible errors: 404 when user not found 

<a name="store-shortcuts"></a>
## Store billing company shortcut
### Body request example

```json
{
    "update":[
        {
            "id": 1,
            "key": "new shortcut",
        },
        {
            "id": 8,
            "key": "new shortcut",
        }
    ],
    "delete":[
        {
            "id": 2,
        },
        {
            "id": 10,
        }
    ]
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 new hotkeys stored

#
```json
[
  {
    "id": 1,
    "description": "Show menu",
    "shortcut_type": "General",
    "module": "",
    "key": "new shortcut",
    "default_key": "CTRL + ALT"
  },
  {
    "id": 2,
    "description": "Access to claims management",
    "shortcut_type": "General",
    "module": "",
    "key": "CTRL + ALT + C",
    "default_key": "CTRL + ALT + C"
  }
  [...] rest of shortcuts
]
```

>{warning} possible errors: 422 when is missing some data 