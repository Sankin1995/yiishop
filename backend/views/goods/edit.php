<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($good,'name');
echo $form->field($good,'goods_category_id')->dropDownList($goods_options);
echo $form->field($good,'brand_id')->dropDownList($brand_options);
echo $form->field($good,'market_price');
echo $form->field($good,'shop_price');
echo $form->field($good,'stock');
echo $form->field($good,'is_on_sale')->inline()->radioList(['1'=>'是','0'=>'否']);
echo $form->field($good,'status')->inline()->radioList(['1'=>'正常','0'=>'回收站']);
echo $form->field($good,'sort');

echo $form->field($good, 'logo')->widget('manks\FileInput', [
]);

echo $form->field($galleryF, 'path')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
    ],
]);
echo $form->field($intro,'content')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);

\yii\bootstrap\ActiveForm::end();