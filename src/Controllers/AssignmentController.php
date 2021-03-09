<?php

namespace Kd\Kdladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kd\Kdladmin\Models\Assignment;
use Kd\Kdladmin\Models\User;

/**
 * AssignmentController implements the CRUD actions for Assignment model.
 *
 * @author KD Services <support@kreativedezine.com>
 * @since 1.0
 */
class AssignmentController extends Controller
{

    public function index(Request $request)
    {
        $assignment = new Assignment();
        $data['list'] = $assignment->search($request->queryParams);
        return view('kd::assignment.index',['data'=>$data]);
    }

    public function view($id)
    {
        $model = $this->findModel($id);
        return view('kd::assignment.view',['model'=>$model]);
    }

    public function assign(Request $request,$id)
    {
        $aic=new Assignment();
        $items=$request->items;
        $success = $aic->assign($id,$items);
        $model = $this->findModel($id);
        return array_merge($model->getItems(), ['success' => $success]);
    }

    public function revoke(Request $request,$id)
    {
        $aic=new Assignment();
        $items=$request->items;
        $success = $aic->revoke($id,$items);
        $model = $this->findModel($id);
        return array_merge($model->getItems(), ['success' => $success]);
    }

    protected function findModel($id)
    {
        $user=User::find($id);
        return new Assignment($id, $user);
    }
}
