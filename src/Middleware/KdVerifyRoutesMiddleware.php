<?php

namespace Kd\Kdladmin\Middleware;

use Closure;
use Kd\Kdladmin\Models\Assignment;
// use Illuminate\Http\Request;

/**
 * KdVerifyRoutesMiddleware implements Permissions to routes.
 *
 * @author KD Services <support@kreativedezine.com>
 * @since 1.0
 */
class KdVerifyRoutesMiddleware
{
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
    {
        // $is_allow=true;

        $get_per=Assignment::get();
        dd($get_per);
        $chk=Assignment::where(['id'=>$request->input('user_id'),'api_token'=>$request->input('auth_key')])->first();

        $is_allow=(!empty($chk) ? true : false);

        // $roles[];
        // foreach ($roles as $role) {
        //   if ($this->roles->contains('slug', $role)) {
        //     return true;
        //     $is_allow=false;
        //   }
        // }
        if(!$is_allow) {
            return response()->json('Not Authorized to access', 401);
        }

        // return false;

        // $chk=Assignment::where(['id'=>$request->input('user_id'),'api_token'=>$request->input('auth_key')])->first();
        // $is_allow=(!empty($chk) ? true : false);
        // if(!$is_allow) {
        //     $response['status']=false;
        //     $response['msg']='Invalid Access.';
        //     $response['data']=[];
        //     return response()->json($response, 401);
        // }

        return $next($request);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle11($request, Closure $next)
    {
        $is_allow=false;
        $registered_users=[
            [
                'url'=>'www.host-20.com',
                'ip'=>'::1',
                'company'=>'ZIA PHARMACY',
                'org_id'=>'1',
                'contact_person'=>'MATI',
                'access_key'=>'T2YBBU5T5p2YLkZE47q1i6B5qsQsrLRXSJoQ6KlkwxgfkzJM4G14XwaMCu6YCnN5DcBQPEYziyb2npdl86ATIy824Qet6qsBSFOvgorz5TkbGjKp3TG5xb7Wjraq0p0TnHFNkTLRH0KdVZyzEPpC7bz10FqIDOiSyolUB3dkoI31LSCrBj6cTLlrV8aasHXCFUHXVsPDtocATmOs05IxXPT6gKG258j6JlKZLJKedhQYSQOo3gbz76FflBHekrqq',
            ],
            [
                'url'=>'www.hope-20.com',
                'ip'=>'192.13.12.22',
                'company'=>'HOPE 20',
                'org_id'=>'1',
                'contact_person'=>'YAWER',
                'access_key'=>'GAfTZXp2uqWybGubB4H6ppHl1YofcfamUejwZjran054XHfO1PaxfKaHBHy0ina2cq44NTG84G8C1WDJD4fBHqZjvQGEgUs8ByAUfnLcVrujotUs1MuLqAtJasS07TTBqFgAeoOKmwkaXhBcGWCZR4yHU84LuCXHgUz6MJTn88em3IAeUCDFe2BZ7YS4wcAhxWXfIqd8NPsyljFyVCKrsjPJ0pShSMhqgF5aFxA5acCQ7rQzfPvepWjvjZmyQqgi',
            ],
        ];
        foreach ($registered_users as $key => $value) {
            if ($request->input('access_key')==$value["access_key"] && $request->ip()==$value['ip']) {
                $is_allow=true;
            }
        }
        if(!$is_allow) {
            return response()->json('Not Registered to access', 401);
        }
        return $next($request);
    }
}
