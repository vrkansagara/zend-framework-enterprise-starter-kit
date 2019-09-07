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
    'Blog',
    'Blogwithorm',
    'User'
];

$frameworkModule = [
    'Zend\Mvc\Plugin\FilePrg',
    'Zend\Mvc\Plugin\FlashMessenger',
    'Zend\Mvc\Plugin\Identity',
    'Zend\Mvc\Plugin\Prg',
    'Zend\Session',
    'Zend\Navigation',
    'Zend\Cache',
    'Zend\Form',
    'Zend\InputFilter',
    'Zend\Filter',
    'Zend\Paginator',
    'Zend\Hydrator',
    'Zend\Router',
    'Zend\Db',
    'Zend\Mail',
    'Zend\Validator',
    'Zend\I18n',

];
return ArrayUtils::merge($frameworkModule, $applicationModules);



