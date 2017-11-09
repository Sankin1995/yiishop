<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($goods,'name');
echo $form->field($goods,'goods_category_id')->dropDownList([$goods_options]);
echo $form->field($goods,'brand_id')->dropDownList([$brand_options]);
echo $form->field($goods,'market_price');
echo $form->field($goods,'shop_price');
echo $form->field($goods,'stock');
$goods->is_on_sale = 1;
echo $form->field($goods,'is_on_sale')->inline()->radioList(['1'=>'是','0'=>'否']);
$goods->status = 1;
echo $form->field($goods,'status')->inline()->radioList(['1'=>'正常','0'=>'回收站']);
echo $form->field($goods,'sort');

echo $form->field($goods, 'logo')->widget('manks\FileInput', [
]);

echo $form->field($gallery, 'path')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
    ],
]);
//echo $form->field($intro,'content')->textarea();
echo $form->field($intro,'content')->widget('kucha\ueditor\UEditor',[]);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);

\yii\bootstrap\ActiveForm::end();