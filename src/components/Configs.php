<?php

namespace kd\kdladmin\components;

// use Yii;
// use yii\caching\Cache;
// use yii\db\Connection;
// use yii\di\Instance;
// use yii\helpers\ArrayHelper;
// use yii\rbac\ManagerInterface;

/**
 * Configs
 * Used to configure some values. To set config you can use [[\yii\base\Application::$params]]
 *
 * ```
 * return [
 *
 *     'mdm.admin.configs' => [
 *         'db' => 'customDb',
 *         'menuTable' => '{{%admin_menu}}',
 *         'cache' => [
 *             'class' => 'yii\caching\DbCache',
 *             'db' => ['dsn' => 'sqlite:@runtime/admin-cache.db'],
 *         ],
 *     ]
 * ];
 * ```
 *
 * or use [[\Yii::$container]]
 *
 * ```
 * Yii::$container->set('mdm\admin\components\Configs',[
 *     'db' => 'customDb',
 *     'menuTable' => 'admin_menu',
 * ]);
 * ```
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */

class Configs
{
    public static $userTable = 'users';
    public static $auth_assignmentTable = 'auth_assignment';
    public static $auth_itemTable = 'auth_item';
    public static $auth_item_childTable = 'auth_item_child';
    public static $auth_ruleTable = 'auth_rule';
    public static $menuTable = 'menu';

    const CACHE_TAG = 'kd.admin';

    /**
     * @var ManagerInterface .
     */
    public $authManager = 'authManager';

    /**
     * @var Connection Database connection.
     */
    public $db = 'db';

    /**
     * @var Connection Database connection.
     */
    public $userDb = 'db';

    /**
     * @var Cache Cache component.
     */
    public $cache = 'cache';

    /**
     * @var integer Cache duration. Default to a hour.
     */
    public $cacheDuration = 3600;

    /**
     * @var integer Default status user signup. 10 mean active.
     */
    public $defaultUserStatus = 1;

    /**
     * @var integer Number of user role.
     */
    public $userRolePageSize = 100;

    /**
     * @var boolean If true then AccessControl only check if route are registered.
     */
    public $onlyRegisteredRoute = false;

    /**
     * @var boolean If false then AccessControl will check without Rule.
     */
    public $strict = true;

    /**
     * @var array
     */
    public $options;

    private static $_classes = [
        'db' => 'yii\db\Connection',
        'userDb' => 'yii\db\Connection',
        'cache' => 'yii\caching\Cache',
        'authManager' => 'yii\rbac\ManagerInterface',
    ];

    /**
     * @return int
     */
    public static function userRolePageSize()
    {
        return static::instance()->userRolePageSize;
    }
}
