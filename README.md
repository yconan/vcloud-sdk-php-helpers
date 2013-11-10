vcloud-sdk-php-helpers
======================

Utility classes for vCloud Director PHP SDK


Installation
------------

Installation can be done via [Composer](http://getcomposer.org/). All you need
is to add this to your `composer.json`:

```
  "repositories": [
    {
      "type": "pear",
      "url": "http://pear.php.net"
    }
  ],
  "require": {
    "php": ">=5.3.2",
    "vmware/vcloud-sdk-patched": "*",
    "pear-pear/HTTP_Request2": "*"
  }
```

Usage
-----


### Query Helper

The Query Helper gives you the ability to manipulate the vCloud SDK Query
Service with ease. It provides abstraction for pagination.


#### Get all results for query 'adminVApp'
```php
use \Purple\Dbu\VCloud\Helpers\Query as QueryHelper;
use \VMware_VCloud_SDK_Query_Types as QueryTypes;
```
```php
QueryHelper::queryAll(QueryTypes::ADMIN_VAPP);

// => array(
//        QueryResultAdminVAppRecordType,
//        ...
//    )
```

#### Get the query result for 'adminVApp' with id 'c47ddf20-05de-44f5-b79e-c463992ffd3f'
```php
use \Purple\Dbu\VCloud\Helpers\Query as QueryHelper;
use \VMware_VCloud_SDK_Query_Types as QueryTypes;
```
```php
QueryHelper::query(
    QueryTypes::ADMIN_VAPP,
    'id==c47ddf20-05de-44f5-b79e-c463992ffd3f'
);

// => array(QueryResultAdminVAppRecordType)
// OR empty array if no vApp exist with such id
```


### Exception Helper

The Exception Helper gives you the ability to manipulate vCloud SDK exceptions
(VMware_VCloud_SDK_Exception) with ease. It allows extracting the error codes
and messages from the original exception message, with is just raw XML of the
form:
```xml
<Error
    xmlns="http://www.vmware.com/vcloud/v1.5"
    message="xs:string"
    majorErrorCode="xs:int"
    minorErrorCode="xs:string"
    vendorSpecificErrorCode="xs:string"
    stackTrace="xs:string"
/>
```

#### Get the error message

```php
use \Purple\Dbu\VCloud\Helpers\Exception as ExceptionHelper;
use \VMware_VCloud_SDK_Exception as SDKException;
```
```php
...
catch(SDKException $e) {
  ExceptionHelper::getMessage($e);
  // => (string) The message contained in the error XML
}
```

#### Get the error code

```php
use \Purple\Dbu\VCloud\Helpers\Exception as ExceptionHelper;
use \VMware_VCloud_SDK_Exception as SDKException;
```
```php
...
catch(SDKException $e) {
  ExceptionHelper::getMajorErrorCode($e);
  // => (int) The major error code contained in the error XML
}
```


Licensing
---------

This project is released under [MIT License](LICENSE) license. If this license
does not fit your requirement for whatever reason, but you would be interested
in using the work (as defined below) under another license, please contact
Purple DBU at [dbu.purple@gmail.com](mailto:dbu.purple@gmail.com).


Contributing
------------

Contributions (issues ♥, pull requests ♥♥♥) are more than welcome! Feel free to
clone, fork, modify, extend, etc, as long as you respect the
[license terms](LICENSE).


### Requirements

You need to have the following software installed:
- git
- make
- curl
- php >= 5.3.2


### Getting started

To start contributing, the best is to follow these steps:

1. Create a GitHub account
2. Create your own fork of this project
3. Clone it to your machine: `git clone https://github.com/<you>/vcloud-sdk-php-helpers.git`
4. Go to the project's root directory: `cd vcloud-sdk-php-helpers`
5. Install dependencies: `make`
6. Run unit tests: `make unit`
