<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro');
echo $form->field($model,'sort');
$model->status=1;
echo $form->field($model,'status')->inline()->radioList(['-1'=>'删除','0'=>'隐藏','1'=>'显示']);
//echo $form->field($model,'imgFile')->fileInput();
echo $form->field($model, 'logo')->widget('manks\FileInput', [
]);

echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();