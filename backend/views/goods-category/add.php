<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($cates,'name');
echo $form->field($cates,'parent_id')->hiddenInput(['value'=>0]);
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


$js=<<<EOF
var treeObj = $.fn.zTree.getZTreeObj("w1");
treeObj.expandAll(true);
/*选中当前节点*/
var node = treeObj.getNodeByParam("id", "{$cates->parent_id}", null);
treeObj.selectNode(node);
EOF;
//注册JS代码
$this->registerJs($js);