# Laravel KdlAdmin RBAC-Permission

Allow users to setup laravel RBAC-Permission Module in 

# create fresh project

composer create-project laravel/laravel kdladmin_auth

# add repo in composer.json file:

```php
"require": {
	...
	"kd/kdladmin": "^1.0.0"
	....
},
"repositories": [
	...
    {
        "type": "vcs",
        "url": "https://github.com/mrehman23/kdladmin"
    }
	...
],
composer.update
```

# add below provider in config.app

Kd\Kdladmin\KdMatiServiceProvider::class,

# add kdladmin_except for exception URL in config.app file;

```php
'kdladmin' => [
    '_type' => 'uri', //uri, name
    '_except' => [
        'home',
        'login',
    ],
]
```

# to publish package file

php artisan vendor:publish --tag=kdpublic --force

