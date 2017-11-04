<?php echo \yii\bootstrap\Html::a('添加文章',['article/add'],['class'=>'btn btn-primary']);?>
<table class="table">
    <tr>
        <th>id</th>
        <th>文章标题</th>
        <th>文章分类</th>
        <th>文章简介</th>
        <th>状态</th>
        <th>排序</th>
        <th>录入时间</th>
        <th>文章内容</th>
        <th>操作</th>

    </tr>
<?php foreach ($articles as $article):?>
    <tr>
        <td><?=$article->id?></td>
        <td><?=$article->name?></td>
        <td><?=$article->category->name?></td>
        <td><?=$article->intro?></td>
        <td><?=$article->status?></td>
        <td><?=$article->sort?></td>
        <td><?=date('Y-m-d H:i:s',$article->inputtime)?></td>
        <td><?=$article->detail->content?></td>
        <td>
            <?php echo \yii\bootstrap\Html::a('编辑',['article/edit','id'=>$article->id],['class'=>'btn btn-success']);?>
            <?php echo \yii\bootstrap\Html::a('删除',['article/del','id'=>$article->id],['class'=>'btn btn-danger']);?>
        </td>
    </tr>
<?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages
]
);

?>