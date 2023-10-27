# Address Docs

---
- [Store role](#store-role)
- [Update role](#update-role)
- [Add permission to role](#add-permissions-role)
- [Add permission to user](#add-permissions-user)


<a name="basic-data"></a>
## Basic data to make request


| # | METHOD   | Name             | URL                     | Token required|Description|
| : ||   :-                 |  :                      |               |                    |  
|1|POST|`Store role`|`/roles`|yes|Create role for current billing company|
|2|PUT|`Update role`|`/roles/{role_id}`|yes|Update role data|
|3|PUT|`Add permission to role`|`/roles/{role_id}/permissions`|yes|Manage roles permissions|
|4|PUT|`Add permission to user`|`/user/{user_id}/permissions`|yes|Manage user permissions|

>{primary} when url params have this symbol "?" mean not required, so you must to send null

<a name="store-role"></a>
## Create role for current billing company

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in body

```json
{
  "billing_company_id": 1, // only for admin
  "name": "test role",
  "note": "this is a test role",
  "type": 2, // 1: is for system use and only valid for admins
  "permissions": [
    1,
    20,
    5
  ]
}
```

## Response

> {success} 200 data retorned

#
```json
{
  "id": 27,
  "name": "test role",
  "note": "this is a test role",
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
      "name": "Manage permissions for each role",
      "slug": "permission.manage.role",
      "description": "Manage permissions for each role",
      "module": "Permission Management",
      "constraint": ""
    },
    {
      "name": "Edit User",
      "slug": "user.edit",
      "description": "Edit User",
      "module": "User Management",
      "constraint": "user.show"
    },
    {
      "name": "Disable Billing Company",
      "slug": "billingcompany.disable",
      "description": "Disable Billing Company",
      "module": "Billing Company Management",
      "constraint": ""
    }
  ],
  "create_at": "2023-10-27T05:15:11.000000Z",
  "updated_at": "2023-10-27T05:15:11.000000Z"
}
```

<a name="update-role"></a>
## Update role data

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in body

```json
{
  "billing_company_id": 2, // only for admin
  "name": "test",
  "note": "this is a test role",
  "type": 2 // 1: is for system use and only valid for admins
}
```

## Response

> {success} 200 data retorned

#
```json
{
  "id": 27,
  "name": "test",
  "note": "this is a test role",
  "billing_company_id": 2,
  "billing_company": {
    "id": 2,
    "name": "Billing Paradise Revenue Cyde Master",
    "created_at": "2023-10-26T16:26:42.000000Z",
    "updated_at": "2023-10-26T16:26:42.000000Z",
    "code": "BC-00002-2023",
    "status": true,
    "logo": null,
    "abbreviation": "BILLINGP",
    "tax_id": null,
    "last_modified": {
      "user": "Console",
      "roles": []
    },
    "contact": {
      "id": 2,
      "phone": "4702858986",
      "fax": "8003341041",
      "email": "info@billingparadise.com",
      "billing_company_id": 2,
      "created_at": "2023-10-26T16:26:42.000000Z",
      "updated_at": "2023-10-26T16:26:42.000000Z",
      "mobile": "4702858986",
      "contactable_type": "App\\Models\\BillingCompany",
      "contactable_id": 2,
      "contact_name": null
    },
    "address": {
      "id": 2,
      "address": "23441 Golden Springs Drive",
      "city": "Diamond Bar",
      "state": "CA - California",
      "zip": "917652030",
      "billing_company_id": 2,
      "created_at": "2023-10-26T16:26:42.000000Z",
      "updated_at": "2023-10-26T16:26:42.000000Z",
      "addressable_type": "App\\Models\\BillingCompany",
      "addressable_id": 2,
      "address_type_id": null,
      "country": null,
      "country_subdivision_code": null,
      "apt_suite": "",
      "state_code": "CA"
    },
    "contacts": [
      {
        "id": 2,
        "phone": "4702858986",
        "fax": "8003341041",
        "email": "info@billingparadise.com",
        "billing_company_id": 2,
        "created_at": "2023-10-26T16:26:42.000000Z",
        "updated_at": "2023-10-26T16:26:42.000000Z",
        "mobile": "4702858986",
        "contactable_type": "App\\Models\\BillingCompany",
        "contactable_id": 2,
        "contact_name": null
      }
    ],
    "addresses": [
      {
        "id": 2,
        "address": "23441 Golden Springs Drive",
        "city": "Diamond Bar",
        "state": "CA - California",
        "zip": "917652030",
        "billing_company_id": 2,
        "created_at": "2023-10-26T16:26:42.000000Z",
        "updated_at": "2023-10-26T16:26:42.000000Z",
        "addressable_type": "App\\Models\\BillingCompany",
        "addressable_id": 2,
        "address_type_id": null,
        "country": null,
        "country_subdivision_code": null,
        "apt_suite": "",
        "state_code": "CA"
      }
    ]
  },
  "permissions": [
    {
      "name": "Manage permissions for each role",
      "slug": "permission.manage.role",
      "description": "Manage permissions for each role",
      "module": "Permission Management",
      "constraint": ""
    },
    {
      "name": "Edit User",
      "slug": "user.edit",
      "description": "Edit User",
      "module": "User Management",
      "constraint": "user.show"
    },
    {
      "name": "Disable Billing Company",
      "slug": "billingcompany.disable",
      "description": "Disable Billing Company",
      "module": "Billing Company Management",
      "constraint": ""
    }
  ],
  "create_at": "2023-10-27T05:15:11.000000Z",
  "updated_at": "2023-10-27T05:16:04.000000Z"
}
```

<a name="add-permissions-role"></a>
## Manage roles permissions

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in body

```json
{
  "permissions": [
    55,
    1,
    5,
    12
  ]
}
```

## Response

> {success} 200 data retorned

#
```json
{
  "id": 24,
  "name": "Billing Auditor",
  "note": "Allows access to system functions for audit management by billing company",
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
      "name": "Manage permissions for each role",
      "slug": "permission.manage.role",
      "description": "Manage permissions for each role",
      "module": "Permission Management",
      "constraint": ""
    },
    {
      "name": "Show Restriction",
      "slug": "setting.restriction.show",
      "description": "Show Restrictions",
      "module": "User Restriction by IP",
      "constraint": "setting.restriction.view"
    },
    {
      "name": "Disable User",
      "slug": "user.disable",
      "description": "Disable User",
      "module": "User Management",
      "constraint": "user.show"
    },
    {
      "name": "View Health Professionals",
      "slug": "heatlhprofessional.view",
      "description": "View Health Professionals",
      "module": "Health Professional Management",
      "constraint": ""
    }
  ],
  "create_at": "2023-10-26T16:26:43.000000Z",
  "updated_at": "2023-10-26T16:26:43.000000Z"
}
```


<a name="add-permissions-user"></a>
## Manage user permissions

### Param in header

```json
{
    "Authorization": bearer <token>
}
```

## Param in body

```json
{
  "permissions": [
    55,
    1,
    5,
    12
  ]
}
```

## Response

> {success} 200 data retorned

#
```json
[
  {
    "name": "Manage permissions for each role",
    "slug": "permission.manage.role",
    "description": "Manage permissions for each role",
    "module": "Permission Management",
    "constraint": ""
  },
  {
    "name": "Show Restriction",
    "slug": "setting.restriction.show",
    "description": "Show Restrictions",
    "module": "User Restriction by IP",
    "constraint": "setting.restriction.view"
  },
  {
    "name": "Disable User",
    "slug": "user.disable",
    "description": "Disable User",
    "module": "User Management",
    "constraint": "user.show"
  },
  {
    "name": "View Health Professionals",
    "slug": "heatlhprofessional.view",
    "description": "View Health Professionals",
    "module": "Health Professional Management",
    "constraint": ""
  }
]
```