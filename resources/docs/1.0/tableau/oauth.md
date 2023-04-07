# Modifier Docs

---

- [Basic data](#basic-data)
- [get jwt for embed](#get-embed-jwt)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name              | URL             | Token required | Description     |
| : |        |                   |                 |                |                 |  
| 1 | GET    |`get jwt for embed`|`/tableau/auth/embed-token`| yes  | generate new jwt for embed links  |         


<a name="get-embed-jwt"></a>
## get jwt for embed links

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
{
  "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImlzcyI6IjJlZmQ4ZTViLThjNzYtNDhlOS1hNmViLTU5MDU1ZjE5ZTgxMiIsImtpZCI6IjQ0YzBiMzdhLWZlMmEtNDhjNi04N2Q1LTM4ZjJkM2I0MWYxMiJ9.eyJqdGkiOiIxMjA3ZGJjNy1iNmE2LTQxMDktYTgwNS0wY2NiNzFlYTA2NGUiLCJhdWQiOiJ0YWJsZWF1Iiwic3ViIjoiY2NjQGNpcGgzci5jbyIsInNjcCI6WyJ0YWJsZWF1OnZpZXdzOmVtYmVkIl0sImlzcyI6IjJlZmQ4ZTViLThjNzYtNDhlOS1hNmViLTU5MDU1ZjE5ZTgxMiIsImlhdCI6MTY4MDM0ODg3OS41NzI0MzEsImV4cCI6MTY4MDM0OTQ3OS41NzI0NjV9.PzMKRfHmCrfMsvg2J5hyreTq6kKgKzkzP6Tj6fIYS2M",
  "issued_at": 1680348879,
  "expires_at": 1680349479
}
```
