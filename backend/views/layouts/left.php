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
                'items' => [
                    [
                        'label' => '文章管理',
                        'icon' => 'fa fa-file-text',
                        'url' => '#',
                        'items' => [
                            ['label' => '文章列表', 'icon' => 'file-code-o', 'url' => ['article/index'],],
                            ['label' => '文章分类列表', 'icon' => 'dashboard', 'url' => ['article-category/index'],],

                        ],
                    ],
                    [
                        'label' => '品牌管理',
                        'icon' => 'fa fa-barcode',
                        'url' => '#',
                        'items' => [
                            ['label' => '品牌列表', 'icon' => 'file-code-o', 'url' => ['brand/index'],],
                        ],
                    ],
                    [
                        'label' => '商品管理',
                        'icon' => 'fa fa-jpy',
//                        'aria-hidden'=>true,
                        'url' => '#',
                        'items' => [
                            ['label' => '商品列表', 'icon' => 'file-code-o', 'url' => ['goods/index'],],
                            ['label' => '商品分类列表', 'icon' => 'dashboard', 'url' => ['goods-category/index'],],

                        ],
                    ],
                    [
                        'label' => '用户管理',
                        'icon' => 'fa fa-users',
                        'url' => '#',
                        'items' => [
                            ['label' => '用户列表', 'icon' => 'file-code-o', 'url' => ['admin/list'],],

                        ],
                    ],
                    [
                        'label' => '权限管理',
                        'icon' => 'fa fa-users',
                        'url' => '#',
                        'items' => [
                            ['label' => '权限', 'icon' => 'file-code-o', 'url' => ['permission/index'],],
                            ['label' => '角色', 'icon' => 'file-code-o', 'url' => ['role/index'],],
                        ],
                    ],
//                    \backend\components\RbacMenu::menu1(),
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['admin/index'], 'visible' => Yii::$app->user->isGuest],

                ],
            ]
        ) ?>

    </section>

</aside>
