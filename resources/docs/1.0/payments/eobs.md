# Address Docs

---
- [Get payment eobs](#get-eobs)
- [Get payment single eob](#get-single-eob)
- [Store payment eob](#store-eob)
- [Update payment eob](#update-eob)
- [Delete payment eob](#delete-eob)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
|1|GET|`Get payment eobs`|`/payments/batch/{batch}/payments/{payment}/eobs`|yes|Get eobs related to payment|
|2|GET|`Get payment single eob`|`/payments/batch/{batch}/payments/{payment}/eobs/{eob}`|yes|Get especific eob|
|3|POST|`Store payment eob`  |`/payments/batch/{batch}/payments/{payment}/eobs`|yes|Add eob to payment|
|4|PUT|`Update payment eob`|`/payments/batch/{batch}/payments/{payment}/eobs/{eob}`|yes|Update payment eob|
|5|DELETE|`Delete payment eob` |`/payments/batch/{batch}/payments/{payment}/eobs/{eob}`|yes|Delete payment eob|

>{primary} when url params have this symbol "?" mean not required, so you must to send null

<a name="get-eobs"></a>
## Get eobs related to payment

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "sortBy":       <string>
    "sortDesc":     <boolean>
}
```

## Response

> {success} 200 data retorned

#
```json
[
  {
    "id": 2,
    "name": "test",
    "date": "2015-10-05T00:00:00.000000Z",
    "file_name": "",
    "file_url": null
  },
  {
    "id": 13,
    "name": "test store eob",
    "date": "1992-10-22T00:00:00.000000Z",
    "file_name": "",
    "file_url": null
  },
  {
    "id": 14,
    "name": "test store eob",
    "date": "1992-10-22T00:00:00.000000Z",
    "file_name": "",
    "file_url": null
  },
  {
    "id": 16,
    "name": "test store eob edited",
    "date": "1992-10-22T00:00:00.000000Z",
    "file_name": "",
    "file_url": null
  }
]
```

<a name="get-list-payment-source"></a>
## Get list of payments source

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
{
  "id": 2,
  "name": "test",
  "date": "2015-10-05T00:00:00.000000Z",
  "file_name": "",
  "file_url": null
}
```

<a name="store-eob"></a>
## Add eob to payment

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in body

``` json
{
  "name": "eob name",
  "date": "22-10-1992",
  "file_name": "file name",
  "file": "file"
}
```

## Response

> {success} 200 data retorned

#
```json
[
  {
    "id": 2,
    "name": "test",
    "date": "2015-10-05T00:00:00.000000Z",
    "file_name": "",
    "file_url": null
  },
  {
    "id": 13,
    "name": "eob name",
    "date": "1992-10-22T00:00:00.000000Z",
    "file_name": "file name",
    "file_url": {file url}
  },
]
```

<a name="update-eob"></a>
## Update payment eob

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in body

``` json
{
  "name": "edited eob name",
  "date": "22-10-1992",
  "file_name": "asd",
  "payment_id": 2 // new payment id
}
```

## Response

> {success} 200 data retorned

#
```json
[
  {
    "id": 2,
    "name": "test",
    "date": "2015-10-05T00:00:00.000000Z",
    "file_name": "",
    "file_url": null
  },
  {
    "id": 13,
    "name": "edited eob name",
    "date": "1992-10-22T00:00:00.000000Z",
    "file_name": "file name",
    "file_url": {file url}
  },
]
```

<a name="delete-eob"></a>
## Delete payment eob

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
    "id": 2,
    "name": "test",
    "date": "2015-10-05T00:00:00.000000Z",
    "file_name": "",
    "file_url": null
  },
]
```
