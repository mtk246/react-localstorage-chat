

# Taxonomy Docs

---

- [Taxonomy](#section-2)

<a name="section-2"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
| 1 |POST| `Create taxonomy`                    | `/taxonomy/`               |yes             |Create taxonomy|         
| 2 |GET | `Get all taxonomy`                   | `/taxonomy/{type}/{id}`        |yes            |Get all taxonomy|
| 3 |GET | `Get one taxonomy`                   | `/taxonomy/{id}`|yes|Get one taxonomy|
| 4 |PUT | `Update taxonomy`                | `/taxonomy/{id}`|yes|Update taxonomy|
| 5 |PATCH | `change primary taxonomy`                | `/taxonomy/{id}/change-primary`|yes|change primary taxonomy|
| 6 |DELETE | `delete taxonomy`                | `/taxonomy/{id}`|yes|change primary taxonomy|

#

>{primary} when url params have this symbol "?" mean not required, so you must to send null.... Clearing house Status is a boolean

#


>{warning} You cant send at the same time user_id and company_id

#-Create Taxonomy

<a name="section-3"></a>
## Body request example

```json
{
    "name":"sgdsfg",
    "isPrimary":false,
    "user_id":3
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 Taxonomy created


#



```json
{
    "name": "sgdsfg",
    "isPrimary": false,
    "user_id": 3,
    "updated_at": "2022-02-09T22:17:55.000000Z",
    "created_at": "2022-02-09T22:17:55.000000Z",
    "id": 12
}
```



#



#-Update Taxonomy

<a name="section-3"></a>
## Body request example

```json
{
    "name":"holaMundo"
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in Path

```json
{
    "id": <integer>
}
```

## Response

> {success} 204 Patient updated


#



```json
{
    "id": 7,
    "isPrimary": true,
    "name": "holaMundo",
    "user_id": 3,
    "company_id": null,
    "created_at": "2022-02-09T22:15:22.000000Z",
    "updated_at": "2022-02-09T23:33:56.000000Z"
}
```


#



#-Change primary Taxonomy

<a name="section-3"></a>
## Body request example

#
>{warning} You cant send at the same time user_id and company_id
#

```json
{
    "primary":true,
    "user_id":3
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in Path

```json
{
    "id": <integer>
}
```

## Response

> {success} 204 Taxonomy updated


#



#-Delete Taxonomy

<a name="section-3"></a>

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in Path

```json
{
    "id": <integer>
}
```

## Response

> {success} 204 Taxonomy Deleted


#


#-Get All Taxonomy

<a name="section-3"></a>

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in Path

```json
{
    "type": "2 to company, 1 to user",
    "id": <integer>
}
```

## Response

> {success} 200 list Taxonomies

#

```json
[
    {
        "id": 8,
        "isPrimary": true,
        "name": "someNamejj",
        "user_id": null,
        "company_id": 3,
        "created_at": "2022-02-09T22:17:12.000000Z",
        "updated_at": "2022-02-09T22:17:12.000000Z"
    },
    {
        "id": 9,
        "isPrimary": false,
        "name": "fsdfsdf",
        "user_id": null,
        "company_id": 3,
        "created_at": "2022-02-09T22:17:36.000000Z",
        "updated_at": "2022-02-09T22:17:36.000000Z"
    },
    {
        "id": 10,
        "isPrimary": false,
        "name": "sdfsdf",
        "user_id": null,
        "company_id": 3,
        "created_at": "2022-02-09T22:17:38.000000Z",
        "updated_at": "2022-02-09T22:17:38.000000Z"
    }
]
```


#-Get One Taxonomy

<a name="section-3"></a>

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in Path

```json
{
    "id": <integer>
}
```

## Response

> {success} 200 Taxonomy

#

```json
{
        "id": 8,
        "isPrimary": true,
        "name": "someNamejj",
        "user_id": null,
        "company_id": 3,
        "created_at": "2022-02-09T22:17:12.000000Z",
        "updated_at": "2022-02-09T22:17:12.000000Z"
    }
```
