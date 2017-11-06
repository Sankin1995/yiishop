# 项目介绍
### 项目简介
```angular2html
类似于京东的电商网站。
为了掌握企业开发特点，以及解决问题的能力，项目会涉及非常有代表性的功能。
为了掌握协同开发的模式，我们用git管理代码。
```
### 主要功能模块
```angular2html
系统包括：
        后台：品牌管理，商品分类管理，商品管理，订单管理，系统管理和会员管理六个模块。
        前台：首页、商品展示、商品购买、订单管理、在线支付等
```
### 开发环境和技术
<table>
<tr><td>开发环境</td><td>Window</td></tr>
<tr><td>开发工具</td><td>Phpstorm+php5.6+apache</td></tr>
<tr><td>相关技术</td><td>Yii2.0+CDN+JQuery+sphinx</td></tr>
</table>



### 文章分类和文章管理模块
* 文章分类和文章管理，首先完成基本的增删改查功能。
* 在文章添加的时候涉及到同时向两张表里面添加数据，先添加文章表，再将刚添加进去的数据的id查询出来，再添加文章内容。

###  商品无限极分类设计要点
```
$this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('名称'),
            'parent_id'=>$this->integer()->notNull()->defaultValue(0)->comment('父级ID'),
            'tree' => $this->integer()->notNull()->comment('树'),
            'lft' => $this->integer()->notNull()->comment('左值'),
            'rgt' => $this->integer()->notNull()->comment('右值'),
            'depth' => $this->integer()->notNull()->comment('级别'),
            'intro'=>$this->string()->comment('简介'),
        ]);
```
#### 需求
* 商品分类的增删改查
* 添加商品分类用ztree插件
#### 要点难点
* ztree插件原本就把健壮性做好了，在编辑和删除分类的时候，只需要异常捕获错误信息，再修改一下就可以。