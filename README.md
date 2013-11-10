vcloud-sdk-php-helpers
======================

Utility classes for vCloud Director PHP SDK


Usage
-----


### Query Helper

The Query Helper gives you tha ability to manipulate the vCloud SDK Query
Service with ease. It provides abstraction for pagination.


#### Get all results for query 'adminVApp'
```
use \Purple\Dbu\VCloud\Helpers\Query as QueryHelper;
use \VMware_VCloud_SDK_Query_Types as QueryTypes;
```
```
QueryHelper::queryAll(QueryTypes::ADMIN_VAPP);

// => array(
//        QueryResultAdminVAppRecordType,
//        ...
//    )
```

#### Get the query result for 'adminVApp' with id 'c47ddf20-05de-44f5-b79e-c463992ffd3f'
```
use \Purple\Dbu\VCloud\Helpers\Query as QueryHelper;
use \VMware_VCloud_SDK_Query_Types as QueryTypes;
```
```
QueryHelper::query(
    QueryTypes::ADMIN_VAPP,
    'id==c47ddf20-05de-44f5-b79e-c463992ffd3f'
);

// => array(QueryResultAdminVAppRecordType)
// OR empty array if no vApp exist with such id
```
