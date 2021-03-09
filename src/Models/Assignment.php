<?php

namespace kd\kdladmin\Models;

use Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Kd\Kdladmin\Components\Configs;
use Kd\Kdladmin\Models\AuthItem;
use Kd\Kdladmin\Models\AuthItemChild;
use Kd\Kdladmin\Models\User;
use Illuminate\Http\Request;

/**
 * @author KD Services <support@kreativedezine.com>
 * @since 2.5
 */
class Assignment extends Model
{
    public $id, $user;

    public function __construct($id = 0, $user = null, $config = []) {
        $this->id = $id;
        $this->user = $user;
        parent::__construct($config);
        $this->setTable(Configs::$auth_assignmentTable);
    }
    protected $fillable = [
        'item_name', 'user_id', 'created_at'
    ];

    public function search($params) {
        return User::all();
    }

    public function assign($id,$items)
    {
        $success = 0;
        $data=[];
        foreach ($items as $key => $name) {
            $data[]=[
                'item_name' => $name,
                'user_id' => $id,
                'created_at' => strtotime('U'),
            ];
            $success++;
        }
        Assignment::insert($data);
        return $success;
    }

    public function revoke($id,$items)
    {
        $success = 0;
        foreach ($items as $key => $name) {
            Assignment::where(['item_name'=>$name,'user_id'=>$id])->delete();
            $success++;
        }
        return $success;
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
        foreach (AuthItem::get() as $key => $route) {
            $auth_item[$route->name] = 'permission';
            $available[$route->name] = 'permission';
        }
        $perm_lists=Assignment::where(['user_id'=>Request()->id])->get();
        foreach ($perm_lists as $key => $perm_list) {
            $assigned[$perm_list['item_name']] = (array_key_exists($perm_list['item_name'], $auth_item) ? 'permission' : 'route');
            unset($available[$perm_list['item_name']]);
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
