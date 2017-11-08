<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m171107_032054_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('商品名称'),
            'sn'=>$this->string(15)->notNull()->comment('货号'),
            'logo'=>$this->string(150)->notNull()->comment('商品LOGO'),
            'goods_category_id'=> $this->integer(3)->notNull()->defaultValue(0)->comment('商品分类'),
            'brand_id'=>$this->smallInteger(5)->notNull()->defaultValue(0)->comment('品牌'),
            'market_price'=>$this->decimal(10,2)->notNull()->defaultValue(0.00)->comment('市场价格'),
            'shop_price'=>$this->decimal(10,2)->notnull()->defaultValue(0.00)->comment('本店售价'),
            'stock'=>$this->integer(11)->notNull()->defaultValue(0)->comment('库存'),
            'is_on_sale'=>$this->integer(4)->notNull()->defaultValue(1)->comment('是否上架1是0否'),
            'status'=>$this->integer(4)->notNull()->defaultValue(1)->comment('1正常0回收站'),
            'sort'=>$this->integer(4)->notNull()->defaultValue(20)->comment('排序'),
            'inputtime'=>$this->integer(11)->notNull()->defaultValue(0)->comment('录入时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
