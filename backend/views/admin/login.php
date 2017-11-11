




<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '用户登录';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>管理员登录</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        <?php
        $form = \yii\bootstrap\ActiveForm::begin();
        echo $form->field($model,'username')->textInput();
        echo $form->field($model,'password_hash')->passwordInput();
        echo $form->field($model,'rememberMe')->checkbox();
        echo \yii\bootstrap\Html::submitButton('登录',['class'=>'btn btn-success']);
        echo " ";
        echo \yii\bootstrap\Html::a('注册',['admin/reg'],['class'=>'btn btn-info']);
        \yii\bootstrap\ActiveForm::end();
        ?>

            <!-- /.col -->
        </div>


    <!-- /.login-box-body -->
</div><!-- /.login-box -->

