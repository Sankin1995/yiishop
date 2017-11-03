<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($brand,'name');
echo $form->field($brand,'intro');
echo $form->field($brand,'sort');
echo $form->field($brand,'status')->inline()->radioList(['-1'=>'删除','0'=>'隐藏','1'=>'显示']);
echo $form->field($brand,'imgFile')->fileInput();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();