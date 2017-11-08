<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_day_count`.
 */
class m171107_034844_create_goods_day_count_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_day_count', [
            'day' => $this->date()->notNull()->comment('日期'),
            'count'=>$this->integer(10)->null()->comment('商品数')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_day_count');
    }
}
