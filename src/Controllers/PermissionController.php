<?php

namespace Kd\Kdladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Kd\Kdladmin\Models\AuthItem;
use Kd\Kdladmin\Models\AuthItemChild;

class PermissionController extends Controller
{

    public function index(Request $request)
    {
        $searchModel = new AuthItem();
        $data['list'] = $searchModel->search($request->queryParams);
        return view('kd::item.index',['data'=>$data]);
    }

    public function view($id)
    {
        $model = new AuthItem();
        return view('kd::item.view',['model'=>$model,'data'=>$this->findModel($id)]);
    }

    public function create()
    {
        $model = new AuthItem();
        return view('kd::item.create',['model'=>$model]);
    }

    public function store(Request $request)
    {
        $user=AuthItem::create([
            'name' => $request->name,
            'type' => (!empty($request->type) ? $request->type : 2),
            'description' => $request->description,
        ]);
        if($user) {
            return redirect(route('kd.permission.index'));
        }
    }

    public function edit($id)
    {
        $model = $this->findModel($id);
        return view('kd::item.update',['model'=>$model]);
    }

    public function update(Request $request)
    {
        $auth_item = $this->findModel($request->name);
        $auth_item->description = $request->description;
        if ($auth_item->update()) {
            return redirect(route('kd.permission.index'));
        }
        return redirect(route('kd.permission.index'));
    }

    public function assign(Request $request,$id)
    {
        $aic=new AuthItemChild();
        $items=$request->items;
        $success = $aic->addChildren($id,$items);
        $model = $this->findModel($id);
        return array_merge($model->getItems(), ['success' => $success]);
    }

    public function remove(Request $request,$id)
    {
        $aic=new AuthItemChild();
        $items=$request->items;
        $success = $aic->removeChildren($id,$items);
        $model = $this->findModel($id);
        return array_merge($model->getItems(), ['success' => $success]);
    }


    public function delete($id)
    {
        $this->findModel($id)->delete();
        AuthItemChild::where(['parent'=>$id])->delete();
        return redirect(route('kd.permission.index'));
    }

    protected function findModel($id)
    {
        return AuthItem::where(['name'=>$id])->first();
    }
}
