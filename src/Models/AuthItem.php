<?php

namespace kd\kdladmin\Models;

use Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Kd\Kdladmin\Components\Configs;
use Kd\Kdladmin\Models\AuthItemChild;
use Illuminate\Http\Request;

/**
 * @author KD Services <support@kreativedezine.com>
 * @since 1.0
 */
class AuthItem extends Model
{
    private $prefix;
    public $timestamps = false;
    protected $primaryKey = 'name';
    protected $keyType = 'string';

    public function __construct($config = []) {
        parent::__construct($config);
        $this->setTable(Configs::$auth_itemTable);
    }

    protected $fillable = [
        'name','type','description','ruleName','data','updated_at','created_at'
    ];

    public function getDateFormat() {
        return 'U';
    }

    public function search($params) {
        return AuthItem::all();
    }

    public function getItems()
    {
        $assigned = [];
        $available = [];
        $conf_params=Config::get('app.kdladmin');
        foreach (Route::getRoutes() as $key => $route) {
            if(!empty($conf_params['_type']) && $conf_params['_type']=='uri') {
                if($route->uri()) {
                    $available[$route->uri()] = 'route';
                }
            } else {
                if($route->getName()) {
                    $available[$route->getName()] = 'route';
                }
            }
        }
        $auth_item=[];
        foreach (AuthItem::where('name','<>',Request()->id)->get() as $key => $route) {
            $auth_item[$route->name] = 'permission';
            $available[$route->name] = 'permission';
        }
        $perm_lists=AuthItemChild::where(['parent'=>Request()->id])->get();
        foreach ($perm_lists as $key => $perm_list) {
            $assigned[$perm_list['child']] = (array_key_exists($perm_list['child'], $auth_item) ? 'permission' : 'route');
            unset($available[$perm_list['child']]);
        }
        unset($available[$this->name]);
        ksort($available);
        ksort($assigned);
        return [
            'available' => $available,
            'assigned' => $assigned,
        ];
    }
}
