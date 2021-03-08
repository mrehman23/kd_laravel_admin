<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\modules\kdadmin\components\Helper;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?= Yii::$app->params['resources_path']; ?>img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= Yii::$app->params['resources_path']; ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->params['resources_path']; ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->params['resources_path']; ?>dist/css/custom.css">
    <link rel="stylesheet" href="<?= Yii::$app->params['resources_path']; ?>dist/css/tsf-step-form-wizard.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->params['resources_path']; ?>dist/css/gsi-step-indicator.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->params['resources_path']; ?>dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->params['resources_path']; ?>dist/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->params['resources_path']; ?>dist/css/skins/skin-blue.min.css"></head>
    <script src="<?= Yii::$app->params['resources_path']; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<style type="text/css">
  .login_form {
        <?php /*background: url('<?= Yii::$app->params['resources_path']; ?>dist/img/login-bg.jpg');*/ ?>
        background: url('<?= Yii::$app->params['resources_path']; ?>dist/img/login-bg.gif');
        background-size: cover;
  }
  .control-label {
    color: #fff;
  }
  label {
    color: #fff;
  }

</style>    
</head>
<body class="hold-transition login_form" >
  <?php $this->beginBody() ?>
  <div class="inner-bg login_form">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 form-box">
              <img class="img-responsive" src="<?= Yii::$app->params['resources_path']; ?>dist/img/logo.png" style="margin-bottom: 10px;">
                <?= $content ?>
            </div>
        </div>
    </div>
  </div>  
<?php /*
  <footer class="main-footer" style="margin-left: 0px;position: fixed;bottom: 0px;width: 100%;">
    <div class="pull-right hidden-xs">
      <a href="javascroipt:void(0);"><?= Html::encode(Yii::$app->params['devby']); ?></a>
    </div>
    <strong>Copyright &copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?>.</strong> All rights reserved.
  </footer>
*/ ?>
  <script src="<?= Yii::$app->params['resources_path']; ?>bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= Yii::$app->params['resources_path']; ?>dist/js/tsf-wizard-plugin.js"></script>
  <script src="<?= Yii::$app->params['resources_path']; ?>dist/js/app.min.js"></script>
  <script>
//    $.widget.bridge('uibutton', $.ui.button);
  </script>
 
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
