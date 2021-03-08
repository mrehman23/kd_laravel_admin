<?php
$users=(!empty($data['users']) ? $data['users'] : []);
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
            <h3 class="box-title">User List</h3>
            <div class="box-tools pull-right"></div>
        </div>

        <div class="box-body" style="display: block;">
            <table class="table">
                <thead>
                    <tr>
                        <td>S#</td>
                        <td>User Id</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Created</td>
                        <td>Last Updated</td>
                        <td>Action</td>
                    </tr>
                </thead>
                </tbody>
                        <?php $i=1; ?>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $i }}</td>
                                <td><a target="_blank" href="{{ route('kd.user.view',$user->id) }}">{{ $user->id }}</a></td>
                                <td><a target="_blank" href="{{ route('kd.user.view',$user->id) }}">{{ $user->name }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td></td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<?php
/*
use yii\helpers\Html;
use yii\grid\GridView;
use common\modules\kdadmin\components\Helper;


$this->title = Yii::t('rbac-admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
            'created_at:date',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status == 0 ? 'Inactive' : 'Active';
                },
                'filter' => [
                    0 => 'Inactive',
                    10 => 'Active'
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn(['view', 'activate']),
                'buttons' => [
                    'activate' => function($url, $model) {
                        if ($model->status == 10) {
                            return '';
                        }
                        $options = [
                            'title' => Yii::t('rbac-admin', 'Activate'),
                            'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, $options);
                    }
                    ]
                ],
            ],
        ]);
        ?>
</div>
*/