

<?php echo \yii\bootstrap\Html::a('添加商品分类',['goods-category/add'],['class'=>'btn btn-info']);?>
<table class="table">
    <tr>
        <th>id</th>
        <th>商品分类名称</th>
        <th>所属分类</th>
        <th>简介</th>
        <th>操作</th>
    </tr>
    <?php foreach($goods_cate as $cate):
        ?>
        <tr>
            <td><?=$cate->id?></td>
            <td><?=$cate->name?></td>
            <td><?=$cate->parent_id?></td>
            <td><?=$cate->intro?></td>
            <td>
                <?php echo \yii\bootstrap\Html::a('编辑',['goods-category/edit','id'=>$cate->id],['class'=>'btn btn-success']);?>
                <?php echo \yii\bootstrap\Html::a('删除',['goods-category/del','id'=>$cate->id],['class'=>'btn btn-danger']);?>
            </td>
        </tr>
        <?php
    endforeach;?>
</table>