<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username')->textInput();
echo $form->field($model,'password_hash')->passwordInput();
echo $form->field($model,'rememberMe')->checkbox();
echo \yii\bootstrap\Html::submitButton('登录',['class'=>'btn btn-success']);
echo " ";
echo \yii\bootstrap\Html::a('注册',['admin/reg'],['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();

