# Modifier Docs

---

- [Basic data](#basic-data)
- [update Report](#update)
- [delete report](#delete)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 | PUT |`update Report`|`reports/{report}`| yes | update report |
| 1 | DELETE |`delete report`|`/reports/{report}`| yes | delete report |      


<a name="update"></a>
## update Report

## Param in header

```json
{
    "Authorization": bearer <token>
}
```


### Body request example
```json
{
  "billing_company_id": 1, // only for admin
  "name": "test",
  "use": "test",
  "description": "test",
  "tags": [1],
  "type": 1,
  "range": "30", // days
  "configuration": {
    "columns":[]
  },
  "favorite": true
}
```


## Response

> {success} 201 Modifier created

#

```json
{
  "id": "01gxwzg9r8qnwh6df7s3at4x09",
  "name": "test",
  "use": "test",
  "description": "sdaw",
  "type": 1,
  "url": "ClaimsReportsPDFGenerator/General2",
  "range": "30",
  "begin_date": "2023-03-14T10:04:50.715311Z",
  "end_date": "2023-04-13T10:04:50.715383Z",
  "tags": [
    1
  ],
  "configuration": {
    "colums": []
  },
  "default": [],
  "favorite": true
}
```

<a name="delete"></a>
## delete report

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

```json
{
    "report": <integer> // report id
}
```

## Response

> {success} 204 report deleted
