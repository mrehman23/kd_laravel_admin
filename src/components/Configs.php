<?php

namespace kd\kdladmin\components;
use Config;

class Configs
{
    public static function userTable() {
    	$conf_params=Config::get('app.kdladmin');
    	return (!empty($conf_params['_tables']['users']) ? $conf_params['_tables']['users'] : 'users');
    }

    public static function auth_assignmentTable() {
    	$conf_params=Config::get('app.kdladmin');
    	return (!empty($conf_params['_tables']['auth_assignment']) ? $conf_params['_tables']['auth_assignment'] : 'auth_assignment');
    }

    public static function auth_itemTable() {
    	$conf_params=Config::get('app.kdladmin');
    	return (!empty($conf_params['_tables']['auth_item']) ? $conf_params['_tables']['auth_item'] : 'auth_item');
    }

    public static function auth_item_childTable() {
    	$conf_params=Config::get('app.kdladmin');
    	return (!empty($conf_params['_tables']['auth_item_child']) ? $conf_params['_tables']['auth_item_child'] : 'auth_item_child');
    }

    public static function menuTable() {
    	$conf_params=Config::get('app.kdladmin');
    	return (!empty($conf_params['_tables']['menu']) ? $conf_params['_tables']['menu'] : 'menu');
    }
}
