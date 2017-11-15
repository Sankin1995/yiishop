<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '用户注册';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
    <link href="/assets/18df53f1/css/bootstrap.css" rel="stylesheet">
    <link href="/css/site.css" rel="stylesheet">
    <link href="/assets/9420dd43/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/d46c44b0/css/AdminLTE.min.css" rel="stylesheet">
    <link href="/assets/d46c44b0/css/skins/_all-skins.min.css" rel="stylesheet">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>管理员注册</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">


<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username')->textInput();
echo $form->field($model,'password_hash')->passwordInput();
echo $form->field($model,'email');
echo \yii\bootstrap\Html::submitButton('注册',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();

?>
<!-- /.col -->
        </div>


    <!-- /.login-box-body -->
</div><!-- /.login-box -->
