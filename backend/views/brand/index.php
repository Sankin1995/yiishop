<?php echo \yii\bootstrap\Html::a('添加品牌',['brand/add'],['class'=>'btn btn-info']);?>
<table class="table">
    <tr>
        <th>id</th>
        <th>品牌名称</th>
        <th>品牌简介</th>
        <th>logo</th>
        <th>排序</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
<?php foreach($brands as $brand):
    ?>
    <tr>
        <td><?=$brand->id?></td>
        <td><?=$brand->name?></td>
        <td><?=$brand->intro?></td>
        <td><?=\yii\bootstrap\Html::img($brand->logo,['height'=>50])?></td>
        <td><?=$brand->sort?></td>
        <td><?=$brand->status?></td>
        <td>
            <?php echo \yii\bootstrap\Html::a('编辑',['brand/edit','id'=>$brand->id],['class'=>'btn btn-success']);?>
            <?php echo \yii\bootstrap\Html::a('删除',['brand/del','id'=>$brand->id],['class'=>'btn btn-danger']);?>
        </td>
    </tr>
<?php
    endforeach;?>
</table>
<?php

echo \yii\widgets\LinkPager::widget([

    'pagination' => $pages
]);
?>