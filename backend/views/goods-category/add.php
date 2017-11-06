<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($cates,'name');
echo $form->field($cates,'parent_id')->hiddenInput();
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

echo $form->field($cates,'intro');
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();