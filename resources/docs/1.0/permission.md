# Permissions Docs

---

- [Basic data](#basic-data)
- [Get all roles](#get-all-roles)
- [Get all permissions](#get-all-permissions)
- [Get one role](#get-one-role)
- [Get one permission](#get-one-permission)
- [Create role](#create-role)
- [Create permission](#create-permission)
- [Assign permission role](#assign-permission-role)
- [Assign permission user](#assign-permission-user)
- [Assign role user](#assign-role-user)
- [Revoke permission user](#revoke-permission-user)
- [Revoke permission role](#revoke-permission-role)
- [Revoke role user](#revoke-role-user)


<a name="basic-data"></a>
## Basic data to make request

| # | METHOD | Name                       | URL                     | Token required|Description|
| : |        |   :-                       |  :                      |               |                    |  
| 1 |GET     | `Get all roles`            | `/permission/roles`               |yes             |Get all roles  |         
| 2 |GET     | `Get all permissions`      | `/permission/permissions`        |yes            |Get all permissions|
| 3 |GET     | `Get one role`             | `/permission/role/{role_id}`|yes|Get one role|
| 4 |GET     | `Get one permission`       | `/permission/permission/{permission_id}` |yes            |Get one permission|
| 5 |POST    | `Create Role`              | `/permission/create-role` |yes|Create role|
| 6 |POST    | `Create Permission`        | `/permission/create-permission` |yes|Create Permission|
| 7 |PATCH   | `assign permission role`   | `/permission/assign-permissions-role/{role_id}/{permission_id}` |yes|assign permission role|
| 8 |PATCH   | `assign permission user`   | `/permission/assign-permissions-user/{permission_id}/{user_id}` |yes|assign permission user|
| 9 |PATCH   | `assign role user`         | `/permission/assign-role-user/{user_id}/{role_id}`|yes|assign role user|
| 10|PATCH   | `revoke permission user`   | `/permission/remove-permission-user/{user_id}/{permission_id}`|yes|revoke permission user|
| 11|PATCH   | `revoke permission role`   | `/permission/remove-permission-role/{role_id}/{permission_id}`|yes|revoke permission role|
| 12|PATCH   | `revoke role user`         | `/permission/remove-role-user/{user_id}/{role_id}`|yes|revoke role user|

<a name="get-all-roles"></a>
## Get all roles

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

>{success} 200 ok

## Response
```json
[
    {
        "id": 1,
        "name": "SUPER_USER",
        "guard_name": "api",
        "created_at": "2021-12-23T18:08:35.000000Z",
        "updated_at": "2021-12-23T18:08:35.000000Z"
    },
    {
        "id": 2,
        "name": "BILLING_MANAGER",
        "guard_name": "api",
        "created_at": "2021-12-23T18:08:35.000000Z",
        "updated_at": "2021-12-23T18:08:35.000000Z"
    },
    {
        "id": 3,
        "name": "BILLER",
        "guard_name": "api",
        "created_at": "2021-12-23T18:08:35.000000Z",
        "updated_at": "2021-12-23T18:08:35.000000Z"
    },
    {
        "id": 4,
        "name": "COLLECTOR",
        "guard_name": "api",
        "created_at": "2021-12-23T18:08:35.000000Z",
        "updated_at": "2021-12-23T18:08:35.000000Z"
    },
    {
        "id": 5,
        "name": "PAYMENT_PROCESSOR",
        "guard_name": "api",
        "created_at": "2021-12-23T18:08:35.000000Z",
        "updated_at": "2021-12-23T18:08:35.000000Z"
    },
    {
        "id": 6,
        "name": "ACCOUNT_MANAGER",
        "guard_name": "api",
        "created_at": "2021-12-23T18:08:35.000000Z",
        "updated_at": "2021-12-23T18:08:35.000000Z"
    },
    {
        "id": 7,
        "name": "DEVELOPMENT_SUPPORT",
        "guard_name": "api",
        "created_at": "2021-12-23T18:08:35.000000Z",
        "updated_at": "2021-12-23T18:08:35.000000Z"
    },
    {
        "id": 8,
        "name": "ADMIN",
        "guard_name": "api",
        "created_at": "2022-01-04T01:27:50.000000Z",
        "updated_at": "2022-01-04T01:27:50.000000Z"
    },
    {
        "id": 9,
        "name": "edit post",
        "guard_name": "api",
        "created_at": "2022-01-04T01:29:11.000000Z",
        "updated_at": "2022-01-04T01:29:11.000000Z"
    },
    {
        "id": 10,
        "name": "edit users",
        "guard_name": "api",
        "created_at": "2022-01-04T01:31:05.000000Z",
        "updated_at": "2022-01-04T01:31:05.000000Z"
    }
]
```



<a name="get-all-permissions"></a>
## Get all permissions

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

>{success} 200 ok


## Response
```json
[
    {
        "id": 1,
        "name": "edit articles",
        "guard_name": "api",
        "created_at": "2022-01-04T01:45:08.000000Z",
        "updated_at": "2022-01-04T01:45:08.000000Z"
    },
    {
        "id": 2,
        "name": "edit users",
        "guard_name": "api",
        "created_at": "2022-01-04T01:48:19.000000Z",
        "updated_at": "2022-01-04T01:48:19.000000Z"
    },
    {
        "id": 3,
        "name": "edit permissions",
        "guard_name": "api",
        "created_at": "2022-01-04T01:48:33.000000Z",
        "updated_at": "2022-01-04T01:48:33.000000Z"
    }
]
```

<a name="get-one-role"></a>
## Get one Role

### Param in path

`role_id integer`

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

>{success} 200 ok

## Response
```json
{
    "id": 5,
    "name": "PAYMENT_PROCESSOR",
    "guard_name": "api",
    "created_at": "2021-12-23T18:08:35.000000Z",
    "updated_at": "2021-12-23T18:08:35.000000Z"
}
```

<a name="get-one-permission"></a>
## Get one Permission

### Param in path

`role_id integer`

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

>{success} 200 ok

## Response
```json
{
    "id": 2,
    "name": "edit users",
    "guard_name": "api",
    "roles": []
}
```




<a name="create-role"></a>
## Create one Role

### Param in header

```json
{
    "Authorization": bearer <token>
}
```


## Body request Example

```json
{
    "name":"ADMIN"
}
```

>{success} 201 Role Create



##Response
```json
{
    "name": "ADMIN-SUPER",
    "guard_name": "api",
    "updated_at": "2022-01-05T20:43:56.000000Z",
    "created_at": "2022-01-05T20:43:56.000000Z",
    "id": 11
}
```

>{warning} 400 bad request, 422 some field is missing in body, 500 some exception







<a name="create-permission"></a>
## Create Permission

### Param in header

```json
{
    "Authorization": bearer <token>
}
```


## Body request Example

```json
{
    "name":"edit-page"
}
```

>{success} 201 Role Create



##Response
```json
{
    "name": "edit-page",
    "guard_name": "api",
    "updated_at": "2022-01-05T20:47:04.000000Z",
    "created_at": "2022-01-05T20:47:04.000000Z",
    "id": 4
}
```

>{warning} 400 bad request, 422 some field is missing in body, 500 some exception



<a name="assign-permission-role"></a>
## Assign Permission Role

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`role_id integer & permission_id integer`

## Response

```json
{
    "id": 1,
    "name": "SUPER_USER",
    "guard_name": "api",
    "created_at": "2021-12-23T18:08:35.000000Z",
    "updated_at": "2021-12-23T18:08:35.000000Z",
    "permissions": [
        {
            "id": 3,
            "name": "edit permissions",
            "guard_name": "api",
            "created_at": "2022-01-04T01:48:33.000000Z",
            "updated_at": "2022-01-04T01:48:33.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 3
            }
        }
    ]
}
```

>{success} 200 assign successfully




<a name="assign-permission-user"></a>
## Assign Permission User

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`permission_id integer & user_id integer`

## Response

```json
{
    "id": 1,
    "name": "hola",
    "email": "admin@billing.com",
    "email_verified_at": null,
    "created_at": "2021-12-23T18:08:35.000000Z",
    "updated_at": "2022-01-05T18:02:27.000000Z",
    "DOB": "2021-12-26",
    "sex": "m",
    "lastName": "test",
    "firstName": "test",
    "middleName": "testing",
    "token": null,
    "available": true,
    "permissions": [
        {
            "id": 1,
            "name": "edit articles",
            "guard_name": "api",
            "created_at": "2022-01-04T01:45:08.000000Z",
            "updated_at": "2022-01-04T01:45:08.000000Z",
            "pivot": {
                "model_id": 1,
                "permission_id": 1,
                "model_type": "App\\Models\\User"
            }
        }
    ]
}
```

>{success} 200 assign successfully



<a name="assign-role-user"></a>
## Assign Role User

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`user_id integer & role_id integer`

## Response

```json
{
    "id": 1,
    "name": "hola",
    "email": "admin@billing.com",
    "email_verified_at": null,
    "created_at": "2021-12-23T18:08:35.000000Z",
    "updated_at": "2022-01-05T18:02:27.000000Z",
    "DOB": "2021-12-26",
    "sex": "m",
    "lastName": "test",
    "firstName": "test",
    "middleName": "testing",
    "token": null,
    "available": true,
    "roles": [
        {
            "id": 1,
            "name": "SUPER_USER",
            "guard_name": "api",
            "created_at": "2021-12-23T18:08:35.000000Z",
            "updated_at": "2021-12-23T18:08:35.000000Z",
            "pivot": {
                "model_id": 1,
                "role_id": 1,
                "model_type": "App\\Models\\User"
            }
        },
        {
            "id": 3,
            "name": "BILLER",
            "guard_name": "api",
            "created_at": "2021-12-23T18:08:35.000000Z",
            "updated_at": "2021-12-23T18:08:35.000000Z",
            "pivot": {
                "model_id": 1,
                "role_id": 3,
                "model_type": "App\\Models\\User"
            }
        }
    ]
}
```

>{success} 200 assign successfully



<a name="revoke-permission-user"></a>
## Revoke Permission User

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`permission_id integer & user_id integer`

## Response

```json
{
    "id": 1,
    "name": "hola",
    "email": "admin@billing.com",
    "email_verified_at": null,
    "created_at": "2021-12-23T18:08:35.000000Z",
    "updated_at": "2022-01-05T18:02:27.000000Z",
    "DOB": "2021-12-26",
    "sex": "m",
    "lastName": "test",
    "firstName": "test",
    "middleName": "testing",
    "token": null,
    "available": true,
    "permissions": [
        {
            "id": 1,
            "name": "edit articles",
            "guard_name": "api",
            "created_at": "2022-01-04T01:45:08.000000Z",
            "updated_at": "2022-01-04T01:45:08.000000Z",
            "pivot": {
                "model_id": 1,
                "permission_id": 1,
                "model_type": "App\\Models\\User"
            }
        }
    ]
}
```

>{success} 200 assign successfully


<a name="revoke-permission-role"></a>
## Revoke Permission Role

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`role_id integer & permission_id integer`

## Response

```json
{
    "id": 1,
    "name": "SUPER_USER",
    "guard_name": "api",
    "created_at": "2021-12-23T18:08:35.000000Z",
    "updated_at": "2021-12-23T18:08:35.000000Z",
    "permissions": [
        {
            "id": 3,
            "name": "edit permissions",
            "guard_name": "api",
            "created_at": "2022-01-04T01:48:33.000000Z",
            "updated_at": "2022-01-04T01:48:33.000000Z",
            "pivot": {
                "role_id": 1,
                "permission_id": 3
            }
        }
    ]
}
```

>{success} 200 assign successfully


<a name="revoke-role-user"></a>
## Revoke Role User

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`user_id integer & role_id integer`

## Response

```json
{
    "id": 1,
    "name": "hola",
    "email": "admin@billing.com",
    "email_verified_at": null,
    "created_at": "2021-12-23T18:08:35.000000Z",
    "updated_at": "2022-01-05T18:02:27.000000Z",
    "DOB": "2021-12-26",
    "sex": "m",
    "lastName": "test",
    "firstName": "test",
    "middleName": "testing",
    "token": null,
    "available": true,
    "roles": [
        {
            "id": 1,
            "name": "SUPER_USER",
            "guard_name": "api",
            "created_at": "2021-12-23T18:08:35.000000Z",
            "updated_at": "2021-12-23T18:08:35.000000Z",
            "pivot": {
                "model_id": 1,
                "role_id": 1,
                "model_type": "App\\Models\\User"
            }
        },
        {
            "id": 3,
            "name": "BILLER",
            "guard_name": "api",
            "created_at": "2021-12-23T18:08:35.000000Z",
            "updated_at": "2021-12-23T18:08:35.000000Z",
            "pivot": {
                "model_id": 1,
                "role_id": 3,
                "model_type": "App\\Models\\User"
            }
        }
    ]
}
```

>{success} 200 assign successfully

