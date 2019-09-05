<?php

namespace Backend;

use Backend\Controller\IndexController;
use Backend\Controller\LoginController;
use Backend\Factory\LoginControllerFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'backend' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin',
                    'defaults' => [
                        'controller' => LoginController::class,
                        'action' => 'showLogin',
                    ],
                ],
            ],
            'backend-root' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/backend[/:action]',
                    'defaults' => [
                        'controller' => LoginController::class,
                        'action' => 'showLogin',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class => InvokableFactory::class,
            LoginController::class => LoginControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'template_map' => [
            'backend/index/index' => __DIR__ . '/../view/backend/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
