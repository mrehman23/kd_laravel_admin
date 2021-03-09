<?php

namespace Kd\Kdladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Kd\Kdladmin\Models\User;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $searchModel = new User();
        $data['users'] = $searchModel->search($request->queryParams);
        return view('kd::user.index',['data'=>$data]);
    }

    public function view($id)
    {
        return view('kd::user.view',['model'=>$this->findModel($id)]);
    }

    public function create()
    {
        $model = new User();
        return view('kd::user.signup',['model'=>$model]);
    }

    public function store(Request $request)
    {
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);
        if($user) {
            return redirect(route('kd.user.index'));
        }
    }

    public function edit($id)
    {
        $model = $this->findModel($id);
        return view('kd::user.updProfile',['model'=>$model]);
    }

    public function update(Request $request)
    {
        $user = $this->findModel($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);
        if ($user->update()) {
            return redirect(route('kd.user.index'));
        }
        return redirect(route('kd.user.index'));
    }

    public function activate($id)
    {
        $user = $this->findModel($id);
        $user->status = ($user->status == 1 ? 0 : 1);
        if ($user->update()) {
            return redirect(route('kd.user.index'));
        }
        return redirect(route('kd.user.index'));
    }

    public function delete($id)
    {
        $this->findModel($id)->delete();
        return redirect(route('kd.user.index'));
    }

    protected function findModel($id)
    {
        return User::findorfail($id);
    }
}
