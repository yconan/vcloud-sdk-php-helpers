<?php

require_once dirname(__FILE__) . '/../../vendor/autoload.php';

/**
 * Setup autoloading
 */
include __DIR__ . '/../_autoload.php';

/**
 * Read config
 */
$config = new \Zend\Config\Config(include dirname(__FILE__) . '/../config.php');

/**
 * Log in against vCloud Director
 */
$service = VMware_VCloud_SDK_Service::getService();
$service->login(
    $config->host,
    array(
      'username' => $config->users->administrator->username . '@' . $config->users->administrator->organization,
      'password' => $config->users->administrator->password,
    ),
    array(
      'proxy_host' => null,
      'proxy_port' => null,
      'proxy_user' => null,
      'proxy_password' => null,
      'ssl_verify_peer' => false,
      'ssl_verify_host' => false,
      'ssl_cafile' => null,
    ),
    $config->apiVersion
);
