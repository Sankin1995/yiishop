<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 14:25
 */

namespace backend\models;




use yii\base\Model;

class LoginForm extends Model
{
public $username;
public $password_hash;
public $rememberMe;

    public function tableName()
    {
        return 'admin';
}

    public function rules()
    {
        return [
            [['username','password_hash'],'required'],
            [['rememberMe'],'safe'],
        ];
}

    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password_hash'=>'密码',
            'rememberMe'=>'记住我？'
        ];
}
}