vcloud-sdk-php-helpers [![Latest Unstable Version](https://poser.pugx.org/purple-dbu/vcloud-sdk-helpers/v/unstable.png)](https://packagist.org/packages/purple-dbu/vcloud-sdk-helpers)
======================

Utility classes for vCloud Director PHP SDK

[![Build Status](https://travis-ci.org/purple-dbu/vcloud-sdk-php-helpers.png?branch=master)](https://travis-ci.org/purple-dbu/vcloud-sdk-php-helpers)
[![Coverage Status](https://coveralls.io/repos/purple-dbu/vcloud-sdk-php-helpers/badge.png?branch=master)](https://coveralls.io/r/purple-dbu/vcloud-sdk-php-helpers?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/527fc4d8632bac824100002d/badge.png)](https://www.versioneye.com/user/projects/527fc4d8632bac824100002d)


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
    "pear-pear/HTTP_Request2": "*",
    "purple-dbu/vcloud-sdk-helpers": "1.0.0"
  }
```

Usage
-----


### Right Helper

The Right Helper gives you the ability to manipulate user rights with ease. It
helps you determining the current logged user rights.

#### Determine whether the current user is administrator of his organization, or
not

```php
use \Purple\Dbu\VCloud\Helpers\Right as RightHelper;
use \VMware_VCloud_SDK_Service as SDKService;
```
```php
...
$service = SDKService::getService();
$service->login(...);

RightHelper::isOrganizationAdmin($service)

// => true|false depending on user rights
```


### Query Helper

The Query Helper gives you the ability to manipulate the vCloud SDK Query
Service with ease. It provides abstraction for pagination.


#### Get all results for query 'adminVApp'
```php
use \Purple\Dbu\VCloud\Helpers\Query as QueryHelper;
use \VMware_VCloud_SDK_Query_Types as SDKQueryTypes;
```
```php
QueryHelper::queryAll(SDKQueryTypes::ADMIN_VAPP);

// => array(
//        QueryResultAdminVAppRecordType,
//        ...
//    )
```

#### Get the query result for 'adminVApp' with id 'c47ddf20-05de-44f5-b79e-c463992ffd3f'
```php
use \Purple\Dbu\VCloud\Helpers\Query as QueryHelper;
use \VMware_VCloud_SDK_Query_Types as SDKQueryTypes;
```
```php
QueryHelper::query(
    SDKQueryTypes::ADMIN_VAPP,
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
6. Run tests: `make test`
