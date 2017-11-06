<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($oneCate,'name');
echo $form->field($oneCate,'parent_id');
echo \liyuze\ztree\ZTree::widget([
    'setting' => '{
            callback: {
                onClick: function(event, treeId, treeNode){
                $("#goodscategory-parent_id").val(treeNode.id);
                }
            },
			data: {
				simpleData: {
						enable: true,
			            idKey: "id",
			            pIdKey: "parent_id",
			            rootPId: 0
				}
			}
		}',
    'nodes' =>$cate,
]);

echo $form->field($oneCate,'intro');
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();