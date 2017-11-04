<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/4
 * Time: 15:00
 */

$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'article_category_id')->dropDownList($options);
echo $form->field($model,'intro')->textarea();
$model->status= 1;
echo $form->field($model,'status')->inline()->radioList(['1'=>'是','0'=>'否']);
echo $form->field($model,'sort');
echo $form->field($detail,'content')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();