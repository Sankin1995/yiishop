<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_detail`.
 */
class m171104_082859_create_article_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_detail', [
            'article_id' => $this->integer(),
            'content'=>$this->text()->null()->comment('文章内容'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_detail');
    }
}
