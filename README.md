# Laravel KdlAdmin RBAC-Permission

Allow users to setup laravel RBAC-Permission Module

## Create new project

composer create-project laravel/laravel kdladmin_auth

## Add repo in composer.json file:

```php
"require": {
	...
	"kd/kdladmin": "^1.0.7"
	....
},
"repositories": [
	...
    {
        "type": "vcs",
        "url": "https://github.com/mrehman23/kd_laravel_admin"
    }
	...
],

composer update
```

## Add below provider in config.app

```php
Kd\Kdladmin\KdMatiServiceProvider::class,
```
## Add below code in AuthServiceProvider.app in boot()

```php
use Kd\Kdladmin\Models\Assignment;
$assignment=new Assignment();
foreach ($assignment->getUserPermissions() as $key => $permission) {
    Gate::define($key, function ($user) use ($key) {
        return true;
    });
}
```

## Add kdladmin_except for exception URL in config.app file;

```php
'kdladmin' => [
    '_type' => 'name', //uri, name
    '_except' => [
        'kd.user.index',
        'kd.user.view',
        'kd.user.delete',
        'kd.user.create',
        'kd.user.store',
        'kd.user.edit',
        'kd.user.update',
        'kd.user.activate',
        'kd.permission.index',
        'kd.permission.view',
        'kd.permission.create',
        'kd.permission.store',
        'kd.permission.edit',
        'kd.permission.update',
        'kd.permission.delete',
        'kd.permission.assign',
        'kd.permission.remove',
        'kd.assignment.index',
        'kd.assignment.view',
        'kd.assignment.assign',
        'kd.assignment.revoke',
        'home',
        'login',
    ],
]
```

## To publish package file

php artisan vendor:publish --tag=kdpublic --force

