# Modifier Docs

---
- [Basic data](#basic-data)
- [Get sheet](#get-sheet)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 |GET     | `Get sheet`| `/reports/get-sheet/{name?}`        |yes            |Get sheet|


<a name="get-sheet"></a>
## Get sheet


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Sheet found

#

```json
"<script type='module' src='https://prod-useast-a.online.tableau.com/javascripts/api/tableau.embedding.3.latest.min.js'></script><tableau-viz id='tableau-viz' src='https://prod-useast-a.online.tableau.com/t/begento/views/ClaimsReportsPDFGenerator/Sheet12_1' width='1517' height='662' hide-tabs toolbar='bottom' ></tableau-viz>"
```