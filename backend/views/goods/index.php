<?php
$model = new \app\models\GoodsSearchForm();
$form = \yii\bootstrap\ActiveForm::begin([
        'options'=>['class'=>'form-inline pull-right',
        'method'=>'get'
        ]]);
echo $form->field($model,'min')->label(false)->textInput(['size'=>5,'placeholder'=>'最低价']);
echo "-";
echo $form->field($model,'max')->label(false)->textInput(['size'=>5,'placeholder'=>'最高价']);
echo " ";
echo $form->field($model,'keyWords')->label(false)->textInput(['placeholder'=>'请输入商品名称']);
echo " ";
echo \yii\bootstrap\Html::submitButton('搜索',['class'=>'btn','style'=>'margin-bottom:8px;']);
\yii\bootstrap\ActiveForm::end();
?>
<?=\yii\bootstrap\Html::a('添加商品',['goods/add'],['class'=>'btn btn-info'])?>
<table class="table">
    <tr>
        <th>id</th>
        <th>商品名称</th>
        <th>商品logo</th>
        <th>货号</th>
        <th>商品分类</th>
        <th>品牌分类</th>
        <th>市场价格</th>
        <th>本店售价</th>
        <th>库存</th>
        <th>上/下架</th>
        <th>状态</th>
        <th>排序</th>
        <th>详情</th>
        <th>操作</th>
    </tr>

    <?php foreach($goods as $good):
        ?>
        <tr>
            <td><?=$good->id?></td>
            <td><?=$good->name?></td>
            <td><?=\yii\bootstrap\Html::img($good->logo,['height'=>50])?></td>
            <td><?=$good->sn?></td>
            <td><?=$good->category->name?></td>
            <td><?=$good->brand->name?></td>
            <td><?=$good->market_price?></td>
            <td><?=$good->shop_price?></td>
            <td><?=$good->stock?></td>
            <td><?php
                if($good->is_on_sale==1){
                    echo "是";
                }else{
                    echo "否";
                }
                ?></td>
            <td><?php
                if($good->status==1){
                    echo "正常";
                }else{
                    echo "回收站";
                }
                ?></td>
            <td><?=$good->sort?></td>
            <td><?=!empty($good->intro->content)?$good->intro->content:"";?></td>
            <td>
                <?php echo \yii\bootstrap\Html::a('编辑',['goods/edit','id'=>$good->id],['class'=>'btn btn-success']);?>
                <?php echo \yii\bootstrap\Html::a('删除',['goods/del','id'=>$good->id],['class'=>'btn btn-danger']);?>
            </td>
        </tr>
        <?php
    endforeach;?>
</table>