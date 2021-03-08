<form method="POST" action="{{ route('kd.user.store') }}">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password') }}" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row">
        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

        <div class="col-md-6">
            <select name="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </div>
</form>


<?php
/*
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\Url;



/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var old( \)common\modules\kdadmin\models\form\Signup */
/*
$this->title = Yii::t('rbac-admin', 'Setup User');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::errorSummary($model)?>

<?php 
if(Yii::$app->user->id==1) {
    $style="";
    $label=true;
} else {
    $style="display:block;";
    $label=false;
}
?>
<?php $form = ActiveForm::begin([
                'id' => 'form-signup', 
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-4',
                        'wrapper' => 'col-sm-8',
                    ],
                ],
              ]); 
?>
      <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              
            </div>
          </div>
          <div class="box-body">

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'org_id')->dropdownlist($org_list,['style'=>$style])->label($label) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'br_id')->dropdownlist($br_list)->label($label) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'username') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'emp_code') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=
                    $form->field($model, 'country')->widget(
                        Select2::classname(), [
                            'data' => $countriesLov,
                            'options' => ['placeholder' => 'Select Country ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            'pluginEvents' => [
                                "change" => "function() { 
                                    var t = $(this).find(':selected').text();
                                    var v = $(this).find(':selected').val();
                                    $.ajax({
                                        url: '".Url::toRoute(['user/countries'])."',
                                        data:{'value': v, 'text': t, 'level' : 2},
                                        method:'POST',
                                        beforeSend: function(){
                                            console.log('req begin');
                                        },
                                        success: function(res){
                                            res = JSON.parse(res);
                                            $('#signup-state').html(res['options']);
                                        }, 
                                        error : function (jqXHR, textStatus, errorThrown) {
                                            console.log('Country error');
                                            console.log(jqXHR); 
                                            console.log(textStatus);
                                            console.log(errorThrown);
                                        }
                                    });
                                }"
                            ],
                        ]
                    );
                ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'addr_o') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'addr_t') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'addr_th') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=
                    $form->field($model, 'state')->widget(
                        Select2::classname(), [
                            'data' => $statesLov,
                            'options' => ['placeholder' => 'Select State ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            'pluginEvents' => [
                                "change" => "function() { 
                                    var t = $(this).find(':selected').text();
                                    var v = $(this).find(':selected').val();
                                    $.ajax({
                                        url: '".Url::toRoute(['user/countries'])."',
                                        data:{'value': v, 'text': t, 'level' : 3},
                                        method:'POST',
                                        beforeSend: function(){
                                            console.log('req begin');
                                        },
                                        success: function(res){
                                            res = JSON.parse(res);
                                            $('#signup-city').html(res['options']);
                                        }, 
                                        error : function (jqXHR, textStatus, errorThrown) {
                                            console.log('State error');
                                            console.log(jqXHR); 
                                            console.log(textStatus);
                                            console.log(errorThrown);
                                        }
                                    });
                                }"
                            ],
                        ]
                    );
                ?>
            </div>
            <div class="col-md-6">
                <?=
                    $form->field($model, 'city')->widget(
                        Select2::classname(), [
                            'data' => $citiesLov,
                            'options' => ['placeholder' => 'Select City ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]
                    );
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=
                    $form->field($model, 'home_country')->widget(
                        Select2::classname(), [
                            'data' => $homecountryLov,
                            'options' => ['placeholder' => 'Select Home Country ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]
                    );
                ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'email') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'phone') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'cell') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'status')->dropdownlist([
                    '10'=>'ACTIVE',
                    'DEACTIVE'=>'DEACTIVE',
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php if (!$model->start_date) $model->start_date = date('d-M-Y'); ?>
                <?= $form->field($model, 'start_date')->widget(DatePicker::class, [
                    'value' => date('d-M-Y'),
                    'options' => ['placeholder' => 'Select End date ...'],
                    'pluginOptions' => [
                        'format' => 'dd-M-yyyy',
                        'todayHighlight' => true
                    ]
                ]); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'end_date')->widget(DatePicker::class, [
                    'value' => date('d-M-Y'),
                    'options' => ['placeholder' => 'Select End date ...'],
                    'pluginOptions' => [
                        'format' => 'dd-M-yyyy',
                        'todayHighlight' => true
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=
                    $form->field($model, 'nationality')->widget(
                        Select2::classname(), [
                            'data' => $nationalityLov,
                            'options' => ['placeholder' => 'Select Nationality ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]
                    );
                ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'usr_type')->dropdownlist([
                ''=>'Select Type',
                'GEN_USER'=>'GEN USER',
                'NURSE'=>'NURSE',
                'DOCTOR'=>'DOCTOR',
                ],['onchange'=>'
                    $("select#signup-ref_id").html("");
                    if($(this).val()=="GEN_USER") { } else {
                        $.post( "index.php?r=kdadmin/user/usrlist&utype="+$(this).val()+"", function( data ) {
                          $( "select#signup-ref_id" ).html( data );
                        });
                    }
                '])->label("User Type") ?>
            </div>
            <div class="col-md-6">
            <?=
                $form->field($model, 'ref_id')->widget(
                    Select2::classname(), [
                        'data' => [],
                        'options' => ['placeholder' => 'Select Doctor ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]
                );
            ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'attribute1'); ?>
            </div>
        </div>
    </div>
</div>

  </div>
  <div class="box-footer">
    <?= Html::submitButton(Yii::t('rbac-admin', 'Create User'), ['class' => 'btn btn-success pull-right btn-lg', 'name' => 'signup-button']) ?>
    <?= Html::resetButton(Yii::t('rbac-admin', 'Reset'), ['class' => 'btn btn-danger pull-right btn-lg']) ?>

  </div>
</div>            


            <?php ActiveForm::end(); ?>
</div>
