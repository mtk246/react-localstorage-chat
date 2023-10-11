# Modifier Docs

---

- [Basic data](#basic-data)
- [create new report](#store)
- [save as](#save-as)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 | POST |`create new report`|`/reports`| yes | Store new report |
| 2 | POST |`create based report`|`/reports`| yes | save as |

<a name="store"></a>
## create new report

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

<a name="save-as"></a>
## create report based on another one

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
  "name": "test name",
  "description": "test description",
  "base_report_id": "01hbaee88wm6a6n90dtcxhggfz", // id of the report to copy
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
  "id": "1hbaee88wm6a6n90dtcxhggfz",
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