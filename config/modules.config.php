<?php
/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */

use Zend\Stdlib\ArrayUtils;

$applicationModules = [
    'DoctrineModule',
    'DoctrineORMModule',
    'Application',
    'Album',
    'Blog'
];

$frameworkModule = [
    'Zend\Router',
    'Zend\Navigation',
    'Zend\Form',
    'Zend\Mail',
    'Zend\Paginator',
    'Zend\Db',
    'Zend\Validator',
];

return ArrayUtils::merge($frameworkModule, $applicationModules);