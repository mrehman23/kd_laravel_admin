<?php

namespace Kd\Kdladmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kd\Kdladmin\Models\Assignment;
use Kd\Kdladmin\Models\User;
// use Yii;
// use common\modules\kdadmin\models\Assignment;
// use common\modules\kdadmin\models\searchs\Assignment as AssignmentSearch;
// use yii\web\Controller;
// use yii\web\NotFoundHttpException;
// use yii\filters\VerbFilter;

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
        // kd::public;
        $model = $this->findModel($id);
        // $model = new Assignment();
        return view('kd::assignment.view',['model'=>$model]);//,'data'=>$this->findModel($id)]);

        return view('kd::assignment.index',['data'=>$data]);

        return $this->render('view', [
                'model' => $model,
                // 'idField' => $this->idField,
                // 'usernameField' => $this->usernameField,
                // 'fullnameField' => $this->fullnameField,
        ]);
    }


    public function assign(Request $request,$id)
    {
        $aic=new Assignment('');
        $items=$request->items;
        $success = $aic->assign($id,$items);
        $model = $this->findModel($id);
        return array_merge($model->getItems(), ['success' => $success]);
    }

    public function revoke(Request $request,$id)
    {
        $aic=new Assignment('');
        $items=$request->items;
        $success = $aic->revoke($id,$items);
        $model = $this->findModel($id);
        return array_merge($model->getItems(), ['success' => $success]);
    }

    /**
     * Assign items
     * @param string $id
     * @return array
     */
    public function actionAssign($id)
    {
        $items = Yii::$app->getRequest()->post('items', []);
        $model = new Assignment($id);
        $success = $model->assign($items);
        Yii::$app->getResponse()->format = 'json';
        return array_merge($model->getItems(), ['success' => $success]);
    }

    /**
     * Assign items
     * @param string $id
     * @return array
     */
    public function actionRevoke($id)
    {
        $items = Yii::$app->getRequest()->post('items', []);
        $model = new Assignment($id);
        $success = $model->revoke($items);
        Yii::$app->getResponse()->format = 'json';
        return array_merge($model->getItems(), ['success' => $success]);
    }

    /**
     * Finds the Assignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer $id
     * @return Assignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel111($id)
    {
        $class = $this->userClassName;
        if (($user = $class::findIdentity($id)) !== null) {
            return new Assignment($id, $user);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModel($id)
    {
        $user=User::find($id);
        return new Assignment($id, $user);
        // $data= new Assignment($id, $user);
        // return $data->where(['user_id'=>$id])->first();
        // return Assignment::where(['user_id'=>$id])->first();
    }

}
