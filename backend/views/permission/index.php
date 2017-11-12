<?=\yii\bootstrap\Html::a('添加权限',['permission/add'],['class'=>'btn btn-info'])?>
<table class="table">
    <tr>
        <th>权限名称</th>
        <th>权限描述</th>
        <th>操作</th>
    </tr>
<?php foreach($permissions as $permission):?>
    <tr>
        <td>
            <?php
            echo strpos($permission->name,'/') ? "  " :"";
            ?>
            <?=$permission->name?>
        </td>
        <td><?=$permission->description?></td>
        <td>
            <?=\yii\bootstrap\Html::a('编辑',['permission/edit','name'=>$permission->name],['class'=>'btn btn-primary'])?>
            <?=\yii\bootstrap\Html::a('删除',['permission/del','name'=>$permission->name],['class'=>'btn btn-danger'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
