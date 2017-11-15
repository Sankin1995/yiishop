<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>
                    <?php
                        if(!isset(\yii::$app->user->identity->username)){
                            echo "";
                        }else{
                            echo \yii::$app->user->identity->username;
                        }
                    ?>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i>
                    <?php
                    if(!isset(\yii::$app->user->identity->username)){
                        echo "无用户在线";
                    }else{
                        echo "在线";
                    }
                    ?>
                </a>
            </div>
        </div>


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => mdm\admin\components\MenuHelper::getAssignedMenu(yii::$app->user->id),

            ]
        ) ?>

    </section>

</aside>
