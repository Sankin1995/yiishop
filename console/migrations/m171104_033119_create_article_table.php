<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m171104_033119_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(50)->notNull()->comment('文章名称'),
            'article_category_id'=>$this->smallInteger(3)->notNull()->defaultValue(0)->comment('文章分类'),
            'intro'=>$this->text()->null()->comment('文章简介'),
            'status'=>$this->smallInteger(4)->notNull()->defaultValue(1)->comment('状态'),
            'sort'=>$this->smallInteger(4)->notNull()->defaultValue(20)->comment('排序'),
            'inputtime'=>$this->integer(10)->notNull()->comment('录入时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
