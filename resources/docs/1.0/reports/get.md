# Modifier Docs

---

- [Basic data](#basic-data)
- [get classifications](#get-classifications)
- [get types](#get-types)
- [get all reports](#get-reports)
- [get report](#get-report)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 | GET |`get all classifications`|`/reports/classifications`| yes | get all classifications |
| 2 | GET |`get all types`|`/reports/types`| yes | get all reports types |
| 3 | GET |`get all reports`|`reports`| yes | get all reports |
| 4 | GET |`get single report`|`reports/{report}`| yes | get reports |

<a name="get-classifications"></a>
## get all classifications

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 

#

```json
[
[
  {
    "id": 1,
    "url": "https://prod-useast-a.online.tableau.com/t/begento/views/ClaimsReportsPDFGenerator/General2",
    "name": "Live insights",
    "color": {
      "background": "#FFFAE6",
      "text": "#B04D12"
    },
    "icon": "ico-live-insights"
  },
  ...
],
```

<a name="get-types"></a>
## get all types

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 Modifier created

#

```json
[
  {
    "id": 1,
    "name": "General"
  },
  {
    "id": 2,
    "name": "Custom"
  }
]
```

<a name="get-reports"></a>
## get all reports

## Param in header

```json
{
    "Authorization": bearer <token>
}
```
## Param in path

`billing_company_id <int> ` // only for admin
`clasifications[] <int[]>`
`favorite <boolean>`

## Example path

>{primary} ?billing_company_id=1&favorite=1&tags[]=1

## Response

> {success} 201 Modifier created

#

```json
[
  {
    "id": "01gxwzg9r8qnwh6df7s3at4x09", // if null the report is a system report and dont have id
    "name": "General Report",
    "description": "Nullam tortor velit, varius laoreet molestie sed, feugiat vel massa. Phasellus varius accumsan enim. Cras congue ut lacus eget malesuada. Suspendisse lobortis mauris in dui pretium fringilla. Mauris a gravida nulla. Quisque imperdiet libero sem",
    "type": 1,
    "url": "https://prod-useast-a.online.tableau.com/t/begento/views/ClaimsReportsPDFGenerator/General2",
    "clasification": 1,
    "color": {
      "background": "#FFFAE6",
      "text": "#B04D12"
    },
    "icon": "ico-live-insights",
    "range": "30",
    "begin_date": "2023-08-28T09:18:40.705934Z",
    "end_date": "2023-09-27T09:18:40.705993Z",
    "configuration": {
      "colums": []
    },
    "favorite": false
  },
  ...
]
```

<a name="get-report"></a>
## get report

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201

#

```json
{
  "id": "01gxwzg9r8qnwh6df7s3at4x09", // if null the report is a system report and dont have id
  "name": "General Report",
  "description": "Nullam tortor velit, varius laoreet molestie sed, feugiat vel massa. Phasellus varius accumsan enim. Cras congue ut lacus eget malesuada. Suspendisse lobortis mauris in dui pretium fringilla. Mauris a gravida nulla. Quisque imperdiet libero sem",
  "type": 1,
  "url": "https://prod-useast-a.online.tableau.com/t/begento/views/ClaimsReportsPDFGenerator/General2",
  "clasification": 1,
  "color": {
    "background": "#FFFAE6",
    "text": "#B04D12"
  },
  "icon": "ico-live-insights",
  "range": "30",
  "begin_date": "2023-08-28T09:18:40.705934Z",
  "end_date": "2023-09-27T09:18:40.705993Z",
  "configuration": {
    "colums": []
  },
  "favorite": false
}
```
