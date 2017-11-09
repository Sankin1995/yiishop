
<?php echo \yii\helpers\Html::a('添加用户',['admin/reg'],['class'=>'btn btn-primary'])?>
<table class="table">
    <tr>
        <th>id</th>
        <th>用户名</th>
        <th>邮箱</th>
        <th>创建时间</th>
        <th>最后登录时间</th>
        <th>最后登录ip</th>
        <th>操作</th>
    </tr>
<?php foreach ($admins as $admin):?>
    <tr>
        <td><?=$admin->id?></td>
        <td><?=$admin->username?></td>
        <td><?=$admin->email?></td>
        <td><?=date('Y-m-d H:i:s',$admin->create_at)?></td>
        <td><?=date('Y-m-d H:i:s',$admin->last_login_at)?></td>
        <td><?=$admin->last_login_ip?></td>
        <td>
            <?php echo \yii\bootstrap\Html::a('编辑',['admin/edit','id'=>$admin->id],['class'=>'btn btn-info']);?>
            <?php echo \yii\bootstrap\Html::a('删除',['admin/del','id'=>$admin->id],['class'=>'btn btn-danger']);?>
        </td>

    </tr>
    <?php endforeach;?>
</table>