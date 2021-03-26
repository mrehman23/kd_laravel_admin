<?php

namespace Kd\Kdladmin\Middleware;

use Closure;
use Config;
use Illuminate\Support\Facades\Auth;
use Kd\Kdladmin\Models\Assignment;
use Kd\Kdladmin\Models\AuthItem;
use Kd\Kdladmin\Models\AuthItemChild;
use Illuminate\Support\Facades\Route;

/**
 * KdVerifyRoutesMiddleware implements Permissions to routes.
 *
 * @author KD Services <support@kreativedezine.com>
 * @since 1.0
 */
class KdVerifyRoutesMiddleware
{
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
        $p=[];
        $r=[];
        $conf_params=Config::get('app.kdladmin');
        if(!empty($conf_params['_type']) && $conf_params['_type']=='uri') {
            $croute=$request->route()->uri();
        } else {
            $croute=$request->route()->getName();
        }
        $assignment=new Assignment();
        $kd_routes=$assignment->getUserRoutes($id);
        $check_except=(!empty($conf_params['_except']) ? $conf_params['_except'] : []);
        $is_allow=(!empty($croute) ? (!in_array($croute, $check_except) ? (!array_key_exists($croute, $kd_routes) ? false : true) : true) : true);
        if(!$is_allow) {
            if(!empty($id)) {
                return abort(401);
            } else {
                if (Route::has('login')) {
                    return redirect(route('login'));
                } else {
                    return response()->json('Not Authorized to access', 401);
                }
            }
        }
        return $next($request);
    }
}
