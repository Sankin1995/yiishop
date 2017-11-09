<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8
 * Time: 18:38
 */

namespace backend\models;


use yii\base\Model;

class GoodsSearchForm extends Model
{
    public $min;
    public $max;
    public $keyWords;

    public function tableName()
    {
        return 'goods';
    }
    public function rules()
    {
        return [
            [['min','max'],'integer','message' => ''],
            [['keyWords'],'string']
        ];
    }

    public function attributes()
    {
        return [
            'min'=>'最低价',
            'max'=>'最高价',
            'keyWords'=>'关键字'
        ];
        }
}