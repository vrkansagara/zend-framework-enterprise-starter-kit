<?php

use Zend\Cache\Storage\Adapter\Filesystem;
use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;

return [
    // Configuration for your SMTP server (for sending outgoing mail).
    'smtp' => [
        'name' => 'smtp.mailtrap.io',
        'host' => 'smtp.mailtrap.io',
        'port' => 2525,
        'connection_class' => 'crammd5',
        'connection_config' => [
            'username' => 'cd7c08b1e27093',
            'password' => 'a2619e13e341f8',
        ],
    ],
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'password' => 'root',
                    'dbname' => 'zend-framework-enterprise-starter-kit',
                ],
            ],
        ],
        // migrations configuration
        'migrations_configuration' => [
            'orm_default' => [
                'directory' => 'data/migrations',
                'name' => 'Doctrine Database Migrations',
                'namespace' => 'Migrations',
                'table' => 'migrations',
            ],
        ],
    ],
    // Cache configuration.
    'caches' => [
        'FilesystemCache' => [
            'adapter' => [
                'name'    => Filesystem::class,
                'options' => [
                    // Store cached data in this directory.
                    'cache_dir' => './data/cache',
                    // Store cached data for 1 hour.
                    'ttl' => 60 * 60 * 1
                ],
            ],
            'plugins' => [
                [
                    'name' => 'serializer',
                    'options' => [
                    ],
                ],
            ],
        ],
    ],
    // Session configuration.
    'session_config' => [
        // Session cookie will expire in 1 hour.
        'cookie_lifetime' => 60 * 60 * 1,
        // Session data will be stored on server maximum for 30 days.
        'gc_maxlifetime' => 60 * 60 * 24 * 30,
    ],
    // Session manager configuration.
    'session_manager' => [
        // Session validators (used for security).
        'validators' => [
            RemoteAddr::class,
            HttpUserAgent::class,
        ]
    ],
    // Session storage configuration.
    'session_storage' => [
        'type' => SessionArrayStorage::class
    ],
];
