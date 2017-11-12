<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($roles,'name')->label('角色名');
echo $form->field($roles,'description')->label('角色描述');
echo $form->field($roles,'permissions')->inline()->checkboxList($permissions);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();