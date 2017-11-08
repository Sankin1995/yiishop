<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
//    public $imgFile;
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','intro','sort','status'],'required'],
            [['intro'], 'string'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 20],
            //[['imgFile'],'file','extensions' => ['gif','png','jpg'],'skipOnEmpty' => true]
            [['logo'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => '品牌名称',
            'intro' => '品牌简介',
            'logo' => '图片上传',
            'sort' => '排序',
            'status' => '状态',
            //'imgFile' => '上传图片'
        ];
    }

    public function getImage()
    {
        if(substr($this->logo,0,7)=='http://'){
            return $this->logo;
        }else{
            return "@web/".$this->logo;
        }

    }

}
