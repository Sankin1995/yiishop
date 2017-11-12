<?=\yii\bootstrap\Html::a('添加角色',['role/add'],['class'=>'btn btn-info'])?>
<table class="table">
    <tr>
        <th>角色名称</th>
        <th>角色描述</th>
        <th>权限</th>
        <th>操作</th>
    </tr>
<?php foreach($roles as $role):?>
    <tr>
        <td>
            <?php
            echo strpos($role->name,'/') ? "  " :"";
            ?>
            <?=$role->name?>
        </td>
        <td><?=$role->description?></td>
        <td>
            <?php
            //实例化RBAC对象
            $authManager = \yii::$app->authManager;
            //根据role名字获取对应权限
            $permissions = $authManager->getPermissionsByRole($role->name);

            foreach($permissions as $permiss){
                echo $permiss->description."|";
            }
            ?>
        </td>
        <td>
            <?=\yii\bootstrap\Html::a('编辑',['role/edit','name'=>$role->name],['class'=>'btn btn-primary'])?>
            <?=\yii\bootstrap\Html::a('删除',['role/del','name'=>$role->name],['class'=>'btn btn-danger'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
