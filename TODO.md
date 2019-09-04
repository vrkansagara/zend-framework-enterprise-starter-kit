- I started this branch without using zend skeleton application.

- I used composer library installation from same order.

~~~json
{
    "minimum-stability": "stable",
    "prefer-stable": true,
    "require": {
        "zendframework/zend-mvc": "^3.1",
        "doctrine/doctrine-orm-module": "^2.1",
        "zendframework/zend-navigation": "^2.9",
        "zendframework/zend-form": "^2.14",
        "zendframework/zend-i18n": "^2.9",
        "zendframework/zend-mail": "^2.10",
        "zendframework/zend-paginator": "^2.8",
        "zendframework/zend-validator": "^2.12",
        "zendframework/zend-db": "^2.10",
        "doctrine/migrations": "^2.1"
    },
    "autoload": {
        "psr-4": {
            "Application\\": "core/Application/src/"
        }
    },
    "require-dev": {
        "roave/security-advisories": "dev-master"
    }
}
~~~