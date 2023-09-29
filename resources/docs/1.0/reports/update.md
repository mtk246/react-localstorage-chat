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
  "billing_company_id": 1, // onmly for admin
  "name": "test name",
  "description": "test description",
  "clasification": 1,
  "type": 1,
  "range": "30", // days 
  "configuration": {
    "columns":[]
  }
}
```


## Response

> {success} 201 Modifier created

#

```json
{
  "id": "01hbaee88wm6a6n90dtcxhggfz",
  "name": "test name",
  "description": "test description",
  "type": 1,
  "url": "https://prod-useast-a.online.tableau.com/t/begento/views/ClaimsReportsPDFGenerator/General2",
  "clasification": 1,
  "color": {
    "background": "#FFFAE6",
    "text": "#B04D12"
  },
  "icon": "ico-live-insights",
  "range": "30",
  "begin_date": "2023-08-28T06:06:33.879049Z",
  "end_date": "2023-09-27T06:06:33.879108Z",
  "tags": null,
  "configuration": {
    "colums": []
  },
  "favorite": false
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
