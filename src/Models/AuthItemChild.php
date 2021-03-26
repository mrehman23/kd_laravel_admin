<?php

namespace kd\kdladmin\Models;

use Illuminate\Database\Eloquent\Model;
use Kd\Kdladmin\Components\Configs;

/**
 * @author KD Services <support@kreativedezine.com>
 * @since 1.0
 */
class AuthItemChild extends Model
{
    public $timestamps = false;
    public function __construct($config = []) {
        parent::__construct($config);
        $this->setTable(Configs::auth_item_childTable());
    }
    protected $fillable = [
        'parent', 'child'
    ];

    public function addChildren($parent,$items)
    {
        $success = 0;
        $data=[];
        foreach ($items as $key => $name) {
            $data[]=[
                'parent' => $parent,
                'child' => $name,
            ];
            $success++;
        }
        AuthItemChild::insert($data);
        return $success;
    }

    public function removeChildren($parent,$items)
    {
        $success = 0;
        foreach ($items as $key => $name) {
	    	AuthItemChild::where(['parent'=>$parent,'child'=>$name])->delete();
            $success++;
        }
        return $success;
    }

    public function search($params) {
        return AuthItemChild::all();
    }
}
