<?php

namespace Kd\Kdladmin\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Kd\Kdladmin\Models\Assignment;
use Kd\Kdladmin\Models\AuthItem;
use Kd\Kdladmin\Models\AuthItemChild;
// use Illuminate\Http\Request;
use Config;
/**
 * KdVerifyRoutesMiddleware implements Permissions to routes.
 *
 * @author KD Services <support@kreativedezine.com>
 * @since 1.0
 */
class KdVerifyRoutesMiddleware
{
    private $allowed_routes = [];
    private $auth_item = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id=Auth::id();
        $id=1;
        $p=[];
        $r=[];
        $croute=$request->route()->getName();
        $this->auth_item=array_column(AuthItem::get()->toArray(), 'name');
        foreach (Assignment::where(['user_id'=>$id])->get() as $key => $perm_list) {
            if(in_array($perm_list['item_name'], $this->auth_item)) {
                $auth_type='permission';
                $p[$perm_list['item_name']]='permission';
            } else {
                $auth_type='route';
                $r[$perm_list['item_name']]='route';
            }
            $auth_item_type[$perm_list['item_name']] = $auth_type;
        }
        $this->getRouteList($p);
        $this->allowed_routes=array_merge($this->allowed_routes,$r);
        $check_except=(!empty(Config::get('app.kdladmin_except')) ? Config::get('app.kdladmin_except') : []);
        $is_allow=(!empty($croute) ? (!in_array($croute, $check_except) ? (!array_key_exists($croute, $this->allowed_routes) ? false : true) : true) : true);
        if(!$is_allow) {
            return response()->json('Not Authorized to access', 401);
        }
        return $next($request);
    }

    private function getRouteList($p) {
        foreach ($p as $key => $value) {
            $perm_lists=AuthItemChild::where(['parent'=>$key])->get()->toArray();
            $gen_array=[];
            foreach ($perm_lists as $key => $perm_list) {
                if(in_array($perm_list['child'], $this->auth_item)) {
                    $gen_array[$perm_list['child']]='permission';
                } else {
                    $this->allowed_routes[$perm_list['child']]='routes';
                }
            }
            $this->getRouteList($gen_array);
        }
    }
}
