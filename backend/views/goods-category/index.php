

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
        <tr data-lft="<?=$cate->lft?>" data-rgt="<?=$cate->rgt?>" data-tree="<?=$cate->tree?>">
            <td><?=$cate->id?></td>
            <td><span class="glyphicon glyphicon-menu-down cate" style="float:left"><?=$cate->nameText?></span></td>
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

<?php
$js=<<<EOF
  $(".cate").click(function(){
      
       $(this).toggleClass("glyphicon-minus-sign");
       $(this).toggleClass("glyphicon-plus-sign");
  
       var tr= $(this).parent().parent();
       
       var lft=tr.attr('data-lft');
       var rgt=tr.attr('data-rgt');
       
       var tree=tr.attr('data-tree');
       
       
       /*得到所有的tr*/
       
     var trs= $("tr")
       
       $.each(trs,function(k,v){
       
       var treePer=$(v).attr('data-tree');  
       var lftPer=$(v).attr('data-lft');
       var rgtPer=$(v).attr('data-rgt');
        console.log($(v).attr('data-lft'),$(v).attr('data-rgt'));
        
        if(tree==treePer && lftPer-lft>0 && rgtPer - rgt<0){
        
        $(v).toggle();
        }
       
       })
       
        
        
        
        
        
    });



EOF;

$this->registerJs($js);

?>
