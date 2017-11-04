<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m171104_034921_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('分类名称'),
            'intro'=>$this->text()->null()->comment('简介'),
            'status'=>$this->smallInteger(4)->notNull()->defaultValue(1)->comment('状态'),
            'sort'=>$this->smallInteger(4)->notnull()->defaultValue(20)->comment('排序'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
