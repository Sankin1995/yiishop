<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8
 * Time: 18:38
 */

namespace app\models;


use yii\base\Model;

class GoodsSearchForm extends Model
{
    public $min;
    public $max;
    public $keyWords;
}