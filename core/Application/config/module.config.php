<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Factory\ContactusControllerFactory;
use Application\Factory\ImageControllerFactory;
use Application\Factory\RegistrationControllerFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'navigation' => [
        'default' => [
//            [
//                'label' => 'Registration',
//                'route' => 'registration',
//            ],
//            [
//                'label' => 'Images',
//                'route' => 'images',
//            ],
            [
                'label' => 'Home',
                'route' => 'home',
            ],
            [
                'label' => 'Contact us',
                'route' => 'contact',
            ],
            [
                'label' => 'Album',
                'route' => 'album',
                'pages' => [
                    [
                        'label' => 'Add',
                        'route' => 'album',
                        'action' => 'add',
                    ],
                    [
                        'label' => 'Edit',
                        'route' => 'album',
                        'action' => 'edit',
                    ],
                    [
                        'label' => 'Delete',
                        'route' => 'album',
                        'action' => 'delete',
                    ],
                ],
            ],
            [
                'label' => 'Blog',
                'route' => 'blog',
                'pages' => [
                    [
                        'label' => 'Detail',
                        'route' => 'blog',
                        'action' => 'detail',
                    ],
                    [
                        'label' => 'Add',
                        'route' => 'blog',
                        'action' => 'add',
                    ],
                    [
                        'label' => 'Edit',
                        'route' => 'blog',
                        'action' => 'edit',
                    ],
                    [
                        'label' => 'Delete',
                        'route' => 'blog',
                        'action' => 'delete',
                    ],
                ],
            ],
//            [
//                'label' => 'Login',
//                'route' => 'backend',
//            ],
        ],
    ],
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'ping' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/ping',
                    'defaults' => [
                        'controller' => Controller\PingController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'application' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'contact' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/contact[/:action]',
                    'defaults' => [
                        'controller' => Controller\ContactusController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'images' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/images[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\ImageController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'registration' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/registration[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\RegistrationController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'session_containers' => [
        'UserRegistration'
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\PingController::class => InvokableFactory::class,
            Controller\ContactusController::class => ContactusControllerFactory::class,
            Controller\ImageController::class => ImageControllerFactory::class,
            Controller\RegistrationController::class => RegistrationControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Service\MailSender::class => InvokableFactory::class,
            Service\ImageManager::class => InvokableFactory::class
        ],
    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\Menu::class => InvokableFactory::class,
        ],
        'aliases' => [
            'mainMenu' => View\Helper\Menu::class
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
