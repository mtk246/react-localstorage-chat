# Claim sub-status Docs

---

- [Basic data](#basic-data)
- [Create claim sub-status](#create-claim-sub-status)
- [Get all claim sub-status from server](#get-all-claim-sub-status-server)
- [Get one claim sub-status](#get-one-claim-sub-status)
- [Get one claim sub-status by name](#get-one-claim-sub-status-by-name)
- [Get list claim status](#get-list-status)
- [Get list claim sub-status by billing company](#get-list)
- [Update claim sub-status](#update-claim-sub-status)
- [Change status claim sub-status](#change-status-claim-sub-status)

<a name="basic-data"></a>
## Basic data to make request


| # | METHOD | Name                                           | URL                     | Token required |Description|
| : |        |   :-                                           |  :                      |                |            |
| 1 |POST    | `Create claim sub-status`                      | `/claim-sub-status/`                                  | yes | Create claim sub-status|
| 2 |GET     | `Get all claim sub-status from server`         | `/claim-sub-status/get-all-server`                    | yes | Get all claim sub-status from server|
| 3 |GET     | `Get one claim sub-status`                     | `/claim-sub-status/{id}`                              | yes | Get one claim sub-status|
| 4 |GET     | `Get one claim sub-status by name`             | `/claim-sub-status/get-by-name/{name}`                | yes | Get claim sub-status by name|
| 5 |GET     | `Get list claim status`                        | `/claim-sub-status/get-list-status`                   | yes | Get all claim status|
| 6 |GET     | `Get list claim sub-status by billing company` | `/claim-sub-status/get-list-by-billing-company/{status_id}/{billing_company_id?}` | yes | Get all claim sub-status by billing company|
| 7 |PUT     | `Update claim sub-status`                      | `/claim-sub-status/{id}`                              | yes | update claim sub-status|
| 8 |PATCH   | `Change status claim sub-status`               | `/claim-sub-status/change-status/{id}`                | yes | Change status claim sub-status|


>{primary} when url params have this symbol "?" mean not required, so you must to send null

# 

<a name="create-claim-sub-status"></a>
## Create claim sub-status

### Body request example


#

```json
{
    "code":"Code claim sub-status",
    "name":"Claim sub-status first",
    "description":"description sub-status",
    "specific_billing_company": true,
    "billing_companies": [1,2,3],
    "claim_statuses": [14,15],
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 201 Claim sub-status created

#

```json
{
    "code": "Code1",
    "name": "Claim Sub-status first",
    "description": "description sub-status",
    "updated_at": "2022-12-28T13:43:28.000000Z",
    "created_at": "2022-12-28T13:43:28.000000Z",
    "id": 9,
    "status": false,
    "last_modified": {
        "user": "Henry Paredes",
        "roles": [
            {
                "id": 1,
                "name": "Super User",
                "slug": "superuser",
                "description": "Allows you to administer and manage all the functions of the application",
                "level": 1,
                "created_at": "2022-04-20T21:52:51.000000Z",
                "updated_at": "2022-04-20T21:52:51.000000Z",
                "pivot": {
                    "user_id": 14,
                    "role_id": 1,
                    "created_at": "2022-07-20T21:04:22.000000Z",
                    "updated_at": "2022-07-20T21:04:22.000000Z"
                }
            }
        ]
    },
    "specific_billing_company": true,
    "billing_companies": [
        {
            "id": 2,
            "name": "Reinger, Beahan And Rempel",
            "created_at": "2022-04-20T21:52:55.000000Z",
            "updated_at": "2022-04-20T21:52:55.000000Z",
            "code": "BC-00002-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Console",
                "roles": []
            }
        },
        {
            "id": 3,
            "name": "Hahn Plc",
            "created_at": "2022-04-20T21:52:56.000000Z",
            "updated_at": "2022-08-28T19:48:37.000000Z",
            "code": "BC-00003-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Henry Paredes",
                "roles": [
                    {
                        "id": 1,
                        "name": "Super User",
                        "slug": "superuser",
                        "description": "Allows you to administer and manage all the functions of the application",
                        "level": 1,
                        "created_at": "2022-04-20T21:52:51.000000Z",
                        "updated_at": "2022-04-20T21:52:51.000000Z",
                        "pivot": {
                            "user_id": 14,
                            "role_id": 1,
                            "created_at": "2022-07-20T21:04:22.000000Z",
                            "updated_at": "2022-07-20T21:04:22.000000Z"
                        }
                    }
                ]
            }
        },
        {
            "id": 1,
            "name": "Zulauf Group",
            "created_at": "2022-04-20T21:52:55.000000Z",
            "updated_at": "2022-12-08T18:43:42.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Henry Paredes",
                "roles": [
                    {
                        "id": 1,
                        "name": "Super User",
                        "slug": "superuser",
                        "description": "Allows you to administer and manage all the functions of the application",
                        "level": 1,
                        "created_at": "2022-04-20T21:52:51.000000Z",
                        "updated_at": "2022-04-20T21:52:51.000000Z",
                        "pivot": {
                            "user_id": 14,
                            "role_id": 1,
                            "created_at": "2022-07-20T21:04:22.000000Z",
                            "updated_at": "2022-07-20T21:04:22.000000Z"
                        }
                    }
                ]
            }
        }
    ]
}
```

#

<a name="get-all-claim-sub-status-server"></a>
## Get all claim sub-status from server

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in path

`query <string>`
`itemsPerPage <string>`
`page <integer>`
`sortBy <string>`
`sortDesc <boolean>`

## Example path

>{primary} ?query=fieldSearch&itemsPerPage=5&sortDesc=1&page=1&sortBy=fieldName

## Response

> {success} 200 data returned

#
```json
{
    "data": [
        {
            "id": 9,
            "code": "Code1",
            "name": "Claim Edit",
            "description": "description sub-status",
            "created_at": "2022-12-28T13:43:28.000000Z",
            "updated_at": "2022-12-28T13:51:52.000000Z",
            "status": false,
            "last_modified": {
                "user": "Henry Paredes",
                "roles": [
                    {
                        "id": 1,
                        "name": "Super User",
                        "slug": "superuser",
                        "description": "Allows you to administer and manage all the functions of the application",
                        "level": 1,
                        "created_at": "2022-04-20T21:52:51.000000Z",
                        "updated_at": "2022-04-20T21:52:51.000000Z",
                        "pivot": {
                            "user_id": 14,
                            "role_id": 1,
                            "created_at": "2022-07-20T21:04:22.000000Z",
                            "updated_at": "2022-07-20T21:04:22.000000Z"
                        }
                    }
                ]
            },
            "specific_billing_company": true,
            "billing_companies": [
                {
                    "id": 1,
                    "name": "Zulauf Group",
                    "created_at": "2022-04-20T21:52:55.000000Z",
                    "updated_at": "2022-12-08T18:43:42.000000Z",
                    "code": "BC-00001-2022",
                    "status": false,
                    "logo": null,
                    "abbreviation": null,
                    "last_modified": {
                        "user": "Henry Paredes",
                        "roles": [
                            {
                                "id": 1,
                                "name": "Super User",
                                "slug": "superuser",
                                "description": "Allows you to administer and manage all the functions of the application",
                                "level": 1,
                                "created_at": "2022-04-20T21:52:51.000000Z",
                                "updated_at": "2022-04-20T21:52:51.000000Z",
                                "pivot": {
                                    "user_id": 14,
                                    "role_id": 1,
                                    "created_at": "2022-07-20T21:04:22.000000Z",
                                    "updated_at": "2022-07-20T21:04:22.000000Z"
                                }
                            }
                        ]
                    }
                },
                {
                    "id": 2,
                    "name": "Reinger, Beahan And Rempel",
                    "created_at": "2022-04-20T21:52:55.000000Z",
                    "updated_at": "2022-04-20T21:52:55.000000Z",
                    "code": "BC-00002-2022",
                    "status": false,
                    "logo": null,
                    "abbreviation": null,
                    "last_modified": {
                        "user": "Console",
                        "roles": []
                    }
                },
                {
                    "id": 3,
                    "name": "Hahn Plc",
                    "created_at": "2022-04-20T21:52:56.000000Z",
                    "updated_at": "2022-08-28T19:48:37.000000Z",
                    "code": "BC-00003-2022",
                    "status": false,
                    "logo": null,
                    "abbreviation": null,
                    "last_modified": {
                        "user": "Henry Paredes",
                        "roles": [
                            {
                                "id": 1,
                                "name": "Super User",
                                "slug": "superuser",
                                "description": "Allows you to administer and manage all the functions of the application",
                                "level": 1,
                                "created_at": "2022-04-20T21:52:51.000000Z",
                                "updated_at": "2022-04-20T21:52:51.000000Z",
                                "pivot": {
                                    "user_id": 14,
                                    "role_id": 1,
                                    "created_at": "2022-07-20T21:04:22.000000Z",
                                    "updated_at": "2022-07-20T21:04:22.000000Z"
                                }
                            }
                        ]
                    }
                }
            ],
            "claim_statuses": [
                {
                    "id": 15,
                    "status": "Verified - Not submitted",
                    "created_at": "2022-10-25T11:45:13.000000Z",
                    "updated_at": "2022-12-28T09:00:16.000000Z",
                    "background_color": "#FBECDD",
                    "font_color": "#B04D12",
                    "pivot": {
                        "claim_sub_status_id": 9,
                        "claim_status_id": 15,
                        "created_at": "2022-12-28T13:43:28.000000Z",
                        "updated_at": "2022-12-28T13:43:28.000000Z"
                    }
                }
            ]
        },
    ],
    "numberOfPages": 1,
    "count": 3
}
```

#



<a name="get-one-claim-sub-status"></a>
## Get one claim sub-status


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Claim sub-status found

#

```json
{
    "id": 9,
    "code": "Code1",
    "name": "Claim Edit",
    "description": "description sub-status",
    "created_at": "2022-12-28T13:43:28.000000Z",
    "updated_at": "2022-12-28T13:51:52.000000Z",
    "status": false,
    "last_modified": {
        "user": "Henry Paredes",
        "roles": [
            {
                "id": 1,
                "name": "Super User",
                "slug": "superuser",
                "description": "Allows you to administer and manage all the functions of the application",
                "level": 1,
                "created_at": "2022-04-20T21:52:51.000000Z",
                "updated_at": "2022-04-20T21:52:51.000000Z",
                "pivot": {
                    "user_id": 14,
                    "role_id": 1,
                    "created_at": "2022-07-20T21:04:22.000000Z",
                    "updated_at": "2022-07-20T21:04:22.000000Z"
                }
            }
        ]
    },
    "specific_billing_company": true,
    "billing_companies": [
        {
            "id": 2,
            "name": "Reinger, Beahan And Rempel",
            "created_at": "2022-04-20T21:52:55.000000Z",
            "updated_at": "2022-04-20T21:52:55.000000Z",
            "code": "BC-00002-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Console",
                "roles": []
            }
        },
        {
            "id": 3,
            "name": "Hahn Plc",
            "created_at": "2022-04-20T21:52:56.000000Z",
            "updated_at": "2022-08-28T19:48:37.000000Z",
            "code": "BC-00003-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Henry Paredes",
                "roles": [
                    {
                        "id": 1,
                        "name": "Super User",
                        "slug": "superuser",
                        "description": "Allows you to administer and manage all the functions of the application",
                        "level": 1,
                        "created_at": "2022-04-20T21:52:51.000000Z",
                        "updated_at": "2022-04-20T21:52:51.000000Z",
                        "pivot": {
                            "user_id": 14,
                            "role_id": 1,
                            "created_at": "2022-07-20T21:04:22.000000Z",
                            "updated_at": "2022-07-20T21:04:22.000000Z"
                        }
                    }
                ]
            }
        },
        {
            "id": 1,
            "name": "Zulauf Group",
            "created_at": "2022-04-20T21:52:55.000000Z",
            "updated_at": "2022-12-08T18:43:42.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Henry Paredes",
                "roles": [
                    {
                        "id": 1,
                        "name": "Super User",
                        "slug": "superuser",
                        "description": "Allows you to administer and manage all the functions of the application",
                        "level": 1,
                        "created_at": "2022-04-20T21:52:51.000000Z",
                        "updated_at": "2022-04-20T21:52:51.000000Z",
                        "pivot": {
                            "user_id": 14,
                            "role_id": 1,
                            "created_at": "2022-07-20T21:04:22.000000Z",
                            "updated_at": "2022-07-20T21:04:22.000000Z"
                        }
                    }
                ]
            }
        }
    ],
    "claim_statuses": [
        {
            "id": 15,
            "status": "Verified - Not submitted",
            "created_at": "2022-10-25T11:45:13.000000Z",
            "updated_at": "2022-12-28T09:00:16.000000Z",
            "background_color": "#FBECDD",
            "font_color": "#B04D12",
            "pivot": {
                "claim_sub_status_id": 9,
                "claim_status_id": 15,
                "created_at": "2022-12-28T13:43:28.000000Z",
                "updated_at": "2022-12-28T13:43:28.000000Z"
            }
        }
    ]
}
```
#

>{warning} 404 Claim sub-status found not found

<a name="get-one-claim-sub-status-by-name"></a>
## Get one claim sub-status by name


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "name": <string>
}
```

## Response

> {success} 200 Claim sub-status found

#

```json
{
    "id": 9,
    "code": "CODE1",
    "name": "Claim Sub-status Third",
    "description": "Description sub-status",
    "created_at": "2022-12-28T13:43:28.000000Z",
    "updated_at": "2022-12-28T13:51:52.000000Z",
    "status": false,
    "last_modified": {
        "user": "Henry Paredes",
        "roles": [
            {
                "id": 1,
                "name": "Super User",
                "slug": "superuser",
                "description": "Allows you to administer and manage all the functions of the application",
                "level": 1,
                "created_at": "2022-04-20T21:52:51.000000Z",
                "updated_at": "2022-04-20T21:52:51.000000Z",
                "pivot": {
                    "user_id": 14,
                    "role_id": 1,
                    "created_at": "2022-07-20T21:04:22.000000Z",
                    "updated_at": "2022-07-20T21:04:22.000000Z"
                }
            }
        ]
    },
    "specific_billing_company": true,
    "billing_companies": [
        {
            "id": 2,
            "name": "Reinger, Beahan And Rempel",
            "created_at": "2022-04-20T21:52:55.000000Z",
            "updated_at": "2022-04-20T21:52:55.000000Z",
            "code": "BC-00002-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Console",
                "roles": []
            }
        },
        {
            "id": 3,
            "name": "Hahn Plc",
            "created_at": "2022-04-20T21:52:56.000000Z",
            "updated_at": "2022-08-28T19:48:37.000000Z",
            "code": "BC-00003-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Henry Paredes",
                "roles": [
                    {
                        "id": 1,
                        "name": "Super User",
                        "slug": "superuser",
                        "description": "Allows you to administer and manage all the functions of the application",
                        "level": 1,
                        "created_at": "2022-04-20T21:52:51.000000Z",
                        "updated_at": "2022-04-20T21:52:51.000000Z",
                        "pivot": {
                            "user_id": 14,
                            "role_id": 1,
                            "created_at": "2022-07-20T21:04:22.000000Z",
                            "updated_at": "2022-07-20T21:04:22.000000Z"
                        }
                    }
                ]
            },
            "contact": {
                "id": 3,
                "phone": "1-239-942-5570",
                "fax": "636-772-4710",
                "email": "weissnat.oma@hane.com",
                "billing_company_id": 3,
                "created_at": "2022-04-20T21:52:56.000000Z",
                "updated_at": "2022-04-20T21:52:56.000000Z",
                "mobile": "+1.872.786.3316",
                "contactable_type": "App\\Models\\BillingCompany",
                "contactable_id": 3
            }
        },
        {
            "id": 1,
            "name": "Zulauf Group",
            "created_at": "2022-04-20T21:52:55.000000Z",
            "updated_at": "2022-12-08T18:43:42.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Henry Paredes",
                "roles": [
                    {
                        "id": 1,
                        "name": "Super User",
                        "slug": "superuser",
                        "description": "Allows you to administer and manage all the functions of the application",
                        "level": 1,
                        "created_at": "2022-04-20T21:52:51.000000Z",
                        "updated_at": "2022-04-20T21:52:51.000000Z",
                        "pivot": {
                            "user_id": 14,
                            "role_id": 1,
                            "created_at": "2022-07-20T21:04:22.000000Z",
                            "updated_at": "2022-07-20T21:04:22.000000Z"
                        }
                    }
                ]
            }
        }
    ],
    "claim_statuses": [
        {
            "id": 15,
            "status": "Verified - Not submitted",
            "created_at": "2022-10-25T11:45:13.000000Z",
            "updated_at": "2022-12-28T09:00:16.000000Z",
            "background_color": "#FBECDD",
            "font_color": "#B04D12",
            "pivot": {
                "claim_sub_status_id": 9,
                "claim_status_id": 15,
                "created_at": "2022-12-28T13:43:28.000000Z",
                "updated_at": "2022-12-28T13:43:28.000000Z"
            }
        }
    ]
}
```
#

<a name="get-list-status"></a>
## Get list all claim status


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 claim status found

#

```json
[
    {
        "id": 17,
        "name": "Accepted"
    },
    {
        "id": 14,
        "name": "Draft"
    },
    {
        "id": 15,
        "name": "Verified - Not submitted"
    },
    {
        "id": 16,
        "name": "Submitted"
    },
    {
        "id": 22,
        "name": "Approved"
    },
    {
        "id": 18,
        "name": "Rejected"
    },
    {
        "id": 19,
        "name": "Denied"
    },
    {
        "id": 20,
        "name": "Complete"
    },
    {
        "id": 21,
        "name": "Appel"
    }
]
```
#

<a name="get-list"></a>
## Get list claim sub-status by billing company


### Param in header

```json
{
    "Authorization": bearer <token>
}
```

### Param in path

```json
{
    "status_id": required <integer>
    "billing_company_id": optional <integer>
}
```

## Response

> {success} 200 claim sub-status found

#

```json
[
    {
        "id": 5,
        "name": "Claim Sub-status first"
    },
    {
        "id": 8,
        "name": "Claim Sub-status second"
    },
    {
        "id": 9,
        "name": "Claim Sub-status third"
    }
]
```

#
<a name="update-claim-sub-status"></a>
## Update claim sub-status

### Param in path

```json
{
    "id": <integer>
}
```

### Body request example


#

```json
{
    "code":"Code1",
    "name":"Claim Edit",
    "description":"description sub-status",
    "specific_billing_company": true,
    "billing_companies": [1,2,3],
    "claim_statuses": [15]
}
```

## Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Response

> {success} 200 Claim sub-status created


#

```json
{
    "id": 9,
    "code": "Code1",
    "name": "Claim Edit",
    "description": "description sub-status",
    "created_at": "2022-12-28T13:43:28.000000Z",
    "updated_at": "2022-12-28T13:51:52.000000Z",
    "status": false,
    "last_modified": {
        "user": "Henry Paredes",
        "roles": [
            {
                "id": 1,
                "name": "Super User",
                "slug": "superuser",
                "description": "Allows you to administer and manage all the functions of the application",
                "level": 1,
                "created_at": "2022-04-20T21:52:51.000000Z",
                "updated_at": "2022-04-20T21:52:51.000000Z",
                "pivot": {
                    "user_id": 14,
                    "role_id": 1,
                    "created_at": "2022-07-20T21:04:22.000000Z",
                    "updated_at": "2022-07-20T21:04:22.000000Z"
                }
            }
        ]
    },
    "specific_billing_company": true,
    "billing_companies": [
        {
            "id": 2,
            "name": "Reinger, Beahan And Rempel",
            "created_at": "2022-04-20T21:52:55.000000Z",
            "updated_at": "2022-04-20T21:52:55.000000Z",
            "code": "BC-00002-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Console",
                "roles": []
            }
        },
        {
            "id": 3,
            "name": "Hahn Plc",
            "created_at": "2022-04-20T21:52:56.000000Z",
            "updated_at": "2022-08-28T19:48:37.000000Z",
            "code": "BC-00003-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Henry Paredes",
                "roles": [
                    {
                        "id": 1,
                        "name": "Super User",
                        "slug": "superuser",
                        "description": "Allows you to administer and manage all the functions of the application",
                        "level": 1,
                        "created_at": "2022-04-20T21:52:51.000000Z",
                        "updated_at": "2022-04-20T21:52:51.000000Z",
                        "pivot": {
                            "user_id": 14,
                            "role_id": 1,
                            "created_at": "2022-07-20T21:04:22.000000Z",
                            "updated_at": "2022-07-20T21:04:22.000000Z"
                        }
                    }
                ]
            }
        },
        {
            "id": 1,
            "name": "Zulauf Group",
            "created_at": "2022-04-20T21:52:55.000000Z",
            "updated_at": "2022-12-08T18:43:42.000000Z",
            "code": "BC-00001-2022",
            "status": false,
            "logo": null,
            "abbreviation": null,
            "last_modified": {
                "user": "Henry Paredes",
                "roles": [
                    {
                        "id": 1,
                        "name": "Super User",
                        "slug": "superuser",
                        "description": "Allows you to administer and manage all the functions of the application",
                        "level": 1,
                        "created_at": "2022-04-20T21:52:51.000000Z",
                        "updated_at": "2022-04-20T21:52:51.000000Z",
                        "pivot": {
                            "user_id": 14,
                            "role_id": 1,
                            "created_at": "2022-07-20T21:04:22.000000Z",
                            "updated_at": "2022-07-20T21:04:22.000000Z"
                        }
                    }
                ]
            }
        }
    ],
    "claim_statuses": [
        {
            "id": 15,
            "status": "Verified - Not submitted",
            "created_at": "2022-10-25T11:45:13.000000Z",
            "updated_at": "2022-12-28T09:00:16.000000Z",
            "background_color": "#FBECDD",
            "font_color": "#B04D12",
            "pivot": {
                "claim_sub_status_id": 9,
                "claim_status_id": 15,
                "created_at": "2022-12-28T13:43:28.000000Z",
                "updated_at": "2022-12-28T13:43:28.000000Z"
            }
        }
    ]
}
```

#

<a name="change-status-Claim sub-status"></a>
## Change status Claim sub-status


### Body request example

```json
{
    "status":"boolean"
}
```


## Response

> {success} 204 Good response
