<?php
date_default_timezone_set('UTC');

use Zend\Mvc\Application;
use Zend\Stdlib\ArrayUtils;

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

define('ZF_CLASS_CACHE', 'data/cache/classes.php.cache');
//if (file_exists(ZF_CLASS_CACHE)) {
//    require_once ZF_CLASS_CACHE;
//}

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Composer autoloading
include __DIR__ . '/../vendor/autoload.php';

if (!class_exists(Application::class)) {
    throw new RuntimeException(
        "Unable to load application.\n"
        . "- Type `composer install` if you are developing locally.\n"
        . "- Type `vagrant ssh -c 'composer install'` if you are using Vagrant.\n"
        . "- Type `docker-compose run zf composer install` if you are using Docker.\n"
    );
}

// Retrieve configuration
$appConfig = require __DIR__ . '/../config/application.config.php';
if (file_exists(__DIR__ . '/../config/development.config.php')) {
    // Development mode scope.
    ini_set("error_reporting", E_ALL);
    ini_set("display_errors", 1);
    $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/../config/development.config.php');
    // Define application environment
    defined('IS_PRODUCTION') || define('IS_PRODUCTION', false);
    defined('IS_DEVELOPMENT') || define('IS_DEVELOPMENT', true);
} else {
    ini_set("error_reporting", E_ALL & ~E_DEPRECATED & ~E_STRICT);
    ini_set("display_errors", 0);
    ini_set("display_startup_errors", 0);
    ini_set("log_errors", 1);
    defined('IS_PRODUCTION') || define('IS_PRODUCTION', true);
    defined('IS_DEVELOPMENT') || define('IS_DEVELOPMENT', false);
}

// Run the application!
Application::init($appConfig)->run();
