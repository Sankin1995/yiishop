<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property string $market_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sn'], 'required'],
            [['goods_category_id', 'brand_id', 'stock', 'is_on_sale', 'status', 'sort', 'inputtime'], 'integer'],
            [['market_price', 'shop_price'], 'number'],
            [['name'], 'string', 'max' => 50],
            [['logo'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'sn' => '货号',
            'logo' => '商品LOGO',
            'goods_category_id' => '商品分类',
            'brand_id' => '品牌',
            'market_price' => '市场价格',
            'shop_price' => '本店售价',
            'stock' => '库存',
//            1是0否
            'is_on_sale' => '是否上架',
//            1正常0回收站
            'status' => '状态',
            'sort' => '排序',
            'inputtime' => '录入时间',
        ];
    }

    //与详情表进行一对一关联
    public function getIntro()
    {
        return $this->hasOne(GoodsIntro::className(),['goods_id'=>'id']);
}

    //与图片表进行一对多关联
    public function getGallery()
    {
        return $this->hasMany(GoodsGallery::className(),['goods_id'=>'id']);
    }
    
    //与商品分类表进行1对1关系
    public function getCategory()
    {
        return $this->hasOne(GoodsCategory::className(),['id'=>'goods_category_id']);
    }

    //与品牌分类进行1对1关联
    public function getBrand()
    {
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
}
