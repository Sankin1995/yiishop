<?php echo \yii\bootstrap\Html::a('添加文章分类',['article-category/add'],['class'=>'btn btn-info']);?>
<table class="table">
    <tr>
        <th>id</th>
        <th>分类名称</th>
        <th>分类介绍</th>
        <th>状态</th>
        <th>排序</th>
        <th>操作</th>
    </tr>
    <?php foreach($cates as $cate):
        ?>
        <tr>
            <td><?=$cate->id?></td>
            <td><?=$cate->name?></td>
            <td><?=$cate->intro?></td>
            <td><?=$cate->sort?></td>
            <td><?=$cate->status?></td>
            <td>
                <?php echo \yii\bootstrap\Html::a('编辑',['article-category/edit','id'=>$cate->id],['class'=>'btn btn-success']);?>
                <?php echo \yii\bootstrap\Html::a('删除',['article-category/del','id'=>$cate->id],['class'=>'btn btn-danger']);?>
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