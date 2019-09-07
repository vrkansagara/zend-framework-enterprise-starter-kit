<?php
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
    ],
];