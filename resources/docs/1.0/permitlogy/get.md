# Address Docs

---
- [Get list roles](#get-list-roles)
- [Get single role](#get-single-role)
- [Get list permission](#get-all-permissions)
- [Get user permission](#get-user-permissions)
- [Get roles types](#get-roles-types)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
|1|GET|`Get list roles`|`/roles`|yes|Get all roles for the currect billing company|
|2|GET|`Get single role`|`/roles/{role_id}`|yes|Get all permission for current role|
|3|GET|`Get list permission`|`/permissions`|yes|Get all permission for current role|
|4|GET|`Get user permission`|`/user/{user_id}/permissions`|yes|Get all permission for user|
|5|GET|`Get roles types`|`/roles/types`|yes|Get roles types|

>{primary} when url params have this symbol "?" mean not required, so you must to send null

<a name="get-list-roles"></a>
## Get all roles

### Param in header

```json
{
    "Authorization": bearer <token>
}
```
## Param in path

`billing_company_id <int> ` // only for admin

## Example path

>{primary} ?billing_company_id=1

## Response

> {success} 200 data retorned

#
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 6,
      "name": "Billing Manager",
      "slug": "billingmanager",
      "description": "Allows you to administer and manage all the functions of the application associated with a billing company",
      "level": 1,
      "set_at": null
    },
    ...
  ],
  "first_page_url": "http://localhost/api/v1/roles?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://localhost/api/v1/roles?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "active": false
    },
    {
      "url": "http://localhost/api/v1/roles?page=1",
      "label": "1",
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://localhost/api/v1/roles",
  "per_page": 10,
  "prev_page_url": null,
  "to": 7,
  "total": 7
}
```

<a name="get-single-role"></a>
## Get single role data

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
  "id": 9,
  "name": "Biller",
  "note": "worker of a billing company",
  "billing_company_id": 1,
  "billing_company": {
    "id": 1,
    "name": "Medical Claims Consultants",
    "created_at": "2023-10-26T16:26:42.000000Z",
    "updated_at": "2023-10-26T16:26:42.000000Z",
    "code": "BC-00001-2023",
    "status": true,
    "logo": "http://31.220.55.211:81/img-billing-company/1675262605.png",
    "abbreviation": "MCC",
    "tax_id": null,
    "last_modified": {
      "user": "Console",
      "roles": []
    },
    "contact": {
      "id": 1,
      "phone": "7862089235",
      "fax": "8003341041",
      "email": "sales@mccondemand.net",
      "billing_company_id": 1,
      "created_at": "2023-10-26T16:26:42.000000Z",
      "updated_at": "2023-10-26T16:26:42.000000Z",
      "mobile": "7862089235",
      "contactable_type": "App\\Models\\BillingCompany",
      "contactable_id": 1,
      "contact_name": null
    },
    "address": {
      "id": 1,
      "address": "780 Northwest Le Jeune Road",
      "city": "Miami",
      "state": "FL - Florida",
      "zip": "331265540",
      "billing_company_id": 1,
      "created_at": "2023-10-26T16:26:42.000000Z",
      "updated_at": "2023-10-26T16:26:42.000000Z",
      "addressable_type": "App\\Models\\BillingCompany",
      "addressable_id": 1,
      "address_type_id": null,
      "country": null,
      "country_subdivision_code": null,
      "apt_suite": "",
      "state_code": "FL"
    },
    "contacts": [
      {
        "id": 1,
        "phone": "7862089235",
        "fax": "8003341041",
        "email": "sales@mccondemand.net",
        "billing_company_id": 1,
        "created_at": "2023-10-26T16:26:42.000000Z",
        "updated_at": "2023-10-26T16:26:42.000000Z",
        "mobile": "7862089235",
        "contactable_type": "App\\Models\\BillingCompany",
        "contactable_id": 1,
        "contact_name": null
      }
    ],
    "addresses": [
      {
        "id": 1,
        "address": "780 Northwest Le Jeune Road",
        "city": "Miami",
        "state": "FL - Florida",
        "zip": "331265540",
        "billing_company_id": 1,
        "created_at": "2023-10-26T16:26:42.000000Z",
        "updated_at": "2023-10-26T16:26:42.000000Z",
        "addressable_type": "App\\Models\\BillingCompany",
        "addressable_id": 1,
        "address_type_id": null,
        "country": null,
        "country_subdivision_code": null,
        "apt_suite": "",
        "state_code": "FL"
      }
    ]
  },
  "permissions": [
    {
      "name": "Show Profile",
      "slug": "setting.profile.show",
      "description": "Show Profile",
      "module": "Profile",
      "constraint": ""
    },
    {
      "name": "Edit Profile",
      "slug": "setting.profile.edit",
      "description": "Edit Profile",
      "module": "Profile",
      "constraint": "setting.profile.show"
    },
    ... rest of permissions
  ],
  "create_at": "2023-10-26T16:26:43.000000Z",
  "updated_at": "2023-10-26T16:26:43.000000Z"
}
```

<a name="get-all-permissions"></a>
## Get all permissions

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
  "Permission Management": [
    {
      "id": 1,
      "name": "Manage permissions for each role",
      "slug": "permission.manage.role",
      "description": "Manage permissions for each role",
      "module": "Permission Management",
      "created_at": "2023-10-26T16:26:43.000000Z",
      "updated_at": "2023-10-26T16:26:43.000000Z",
      "constraint": ""
    },
    {
      "id": 2,
      "name": "Manage permissions for each user",
      "slug": "permission.manage.user",
      "description": "Manage permissions for each role",
      "module": "Permission Management",
      "created_at": "2023-10-26T16:26:43.000000Z",
      "updated_at": "2023-10-26T16:26:43.000000Z",
      "constraint": "user.view"
    }
  ],
  "User Restriction by IP": [
    ...
  ],
  ...
}
```


<a name="get-user-permissions"></a>
## Get all permission for user

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
    "name": "Show Profile",
    "slug": "setting.profile.show",
    "description": "Show Profile",
    "module": "Profile",
    "constraint": ""
  },
  {
    "name": "Edit Profile",
    "slug": "setting.profile.edit",
    "description": "Edit Profile",
    "module": "Profile",
    "constraint": "setting.profile.show"
  },
  ... rest of permissions
]
```


<a name="get-roles-types"></a>
## Get roles types

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
    "id": 1,  // value only returned for admin
    "name": "SYSTEM" // value only returned for admin
  },
  {
    "id": 2,
    "name": "BILLING COMPANY"
  },
  {
    "id": 3,
    "name": "Patient"
  },
  {
    "id": 4,
    "name": "Health Professional"
  }
]
```