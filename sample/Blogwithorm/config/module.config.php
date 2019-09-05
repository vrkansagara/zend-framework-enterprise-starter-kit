<?php

namespace Blogwithorm;

use Blogwithorm\Controller\DeleteController;

use Blogwithorm\Controller\ListController;
use Blogwithorm\Controller\WriteController;
use Blogwithorm\Factory\DeleteControllerFactory;
use Blogwithorm\Factory\ListControllerFactory;
use Blogwithorm\Factory\WriteControllerFactory;
use Blogwithorm\Factory\ZendDbSqlCommandFactory;
use Blogwithorm\Factory\ZendDbSqlRepositoryFactory;
use Blogwithorm\Model\PostCommand;
use Blogwithorm\Model\PostCommandInterface;
use Blogwithorm\Model\PostRepository;
use Blogwithorm\Model\PostRepositoryInterface;
use Blogwithorm\Model\ZendDbSqlCommand;
use Blogwithorm\Model\ZendDbSqlRepository;
use Zend\Mvc\Controller\LazyControllerAbstractFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    // The following section is new and should be added to your file:
    // This lines opens the configuration for the RouteManager
    'router' => [
        // Open configuration for all possible routes
        'routes' => [
            'barcode' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/barcode[/:type/:label]',
                    'constraints' => [
                        'type' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'label' => '[a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\ListController::class,
                        'action' => 'barcode',
                    ],
                ],
            ],
            // Define a new route called "blog"
            'blog' => [
                // Define a "literal" route type:
                'type' => Literal::class,
                // Configure the route itself
                'options' => [
                    // Listen to "/blog" as uri:
                    'route' => '/blog',
                    // Define default controller and action to be called when
                    // this route is matched
                    'defaults' => [
                        'controller' => ListController::class,
                        'action' => 'index',
                    ],
                ],
                // The following allows "/blog" to match on its own if no child routes match:
                'may_terminate' => true,
                'child_routes' => [
                    'detail' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/:id',
                            'defaults' => [
                                'controller' => ListController::class,
                                'action' => 'detail'
                            ],
                            'constraints' => [
                                'id' => '\d+',
                            ]
                        ]
                    ],
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => WriteController::class,
                                'action' => 'add',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/edit/:id',
                            'defaults' => [
                                'controller' => WriteController::class,
                                'action' => 'edit',
                            ],
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/delete/:id',
                            'defaults' => [
                                'controller' => DeleteController::class,
                                'action' => 'delete',
                            ],
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                        ],
                    ],
                    'download' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/download',
                            'defaults' => [
                                'controller' => Controller\DownloadController::class,
                                'action' => 'index'
                            ],
                            'constraints' => [
//                                'name' => '[1-9]\d*',
                            ],
                        ],
                    ]
                ]

            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            ListController::class => ListControllerFactory::class,
//            ListController::class => LazyControllerAbstractFactory::class,
            WriteController::class => WriteControllerFactory::class,
            DeleteController::class => DeleteControllerFactory::class,
            Controller\DownloadController::class => InvokableFactory::class
        ],
    ],
    'service_manager' => [
        'aliases' => [
            PostRepositoryInterface::class => ZendDbSqlRepository::class,
            PostCommandInterface::class => ZendDbSqlCommand::class,


        ],
        'factories' => [
            PostRepository::class => InvokableFactory::class,
            ZendDbSqlRepository::class => ZendDbSqlRepositoryFactory::class,
            PostCommand::class => InvokableFactory::class,
            ZendDbSqlCommand::class => ZendDbSqlCommandFactory::class,
        ],
    ],


    /**
     * It is important to note that the view_manager configuration not only allows you to ship view files for your module, but also to overwrite view files from other modules.
     */
    'view_manager' => [
        //view/{namespace}/{controller}/{action}.phtml
        'template_path_stack' => [
            'blog' => __DIR__ . '/../view',
        ],
    ],
];
