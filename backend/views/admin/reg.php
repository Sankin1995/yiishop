<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username')->textInput();
echo $form->field($model,'password_hash')->passwordInput();
echo $form->field($model,'email');
echo \yii\bootstrap\Html::submitButton('注册',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();