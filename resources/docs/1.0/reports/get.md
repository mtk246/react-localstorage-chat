# Modifier Docs

---

- [Basic data](#basic-data)
- [get tags](#get-tags)
- [get types](#get-types)
- [get all reports](#get-reports)
- [get report](#get-report)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 | GET |`get all tags`|`/reports/tags`| yes | get all reports tags |
| 2 | GET |`get all types`|`/reports/types`| yes | get all reports types |
| 3 | GET |`get all reports`|`reports`| yes | get all reports |
| 4 | GET |`get single report`|`reports/{report}`| yes | get reports |

<a name="get-tags"></a>
## get all tags

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
  {
    "id": 1,
    "name": "tag one"
  },
  ...
]
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
    "url": "https://prod-useast-a.online.tableau.com/t/begento/views/ClaimsReportsPDFGenerator/General2",
    "name": "General Report"
  },
  ...
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
`tags[] <int[]>`
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
    "use": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et justo in orci malesuada convallis.",
    "description": "Nullam tortor velit, varius laoreet molestie sed, feugiat vel massa. Phasellus varius accumsan enim. Cras congue ut lacus eget malesuada. Suspendisse lobortis mauris in dui pretium fringilla. Mauris a gravida nulla. Quisque imperdiet libero sem",
    "type": 1,
    "url": "https://prod-useast-a.online.tableau.com/t/begento/views/ClaimsReportsPDFGenerator/General2",
    "range": "30",
    "begin_date": "2023-03-14T11:11:30.918209Z",
    "end_date": "2023-04-13T11:11:30.918269Z",
    "tags": [
      1,
      2
    ],
    "configuration": [],
    "default": [],
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
  "id": "01gxwzg9r8qnwh6df7s3at4x09",
  "name": "test",
  "use": "test",
  "description": "test",
  "type": 1,
  "url": "https://prod-useast-a.online.tableau.com/t/begento/views/ClaimsReportsPDFGenerator/General2",
  "range": "30",
  "begin_date": "2023-03-14T11:33:51.786656Z",
  "end_date": "2023-04-13T11:33:51.786714Z",
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
