<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/11
 * Time: 21:35
 */

namespace backend\components;


use yii\base\Component;

class RbacMenu extends Component
{
    public static function menu1(){
        $auth=\Yii::$app->authManager;
        $arr=[];
        $pers=$auth->getPermissions();
        foreach ($pers as $k=>$per){
            if ($per->description===null){
                continue;
            }
            if (strpos($k,'/')===false){
                $arr[$k]=[
                    'label' => $per->description,
                    'icon' => 'file-code-o',
                    'url' => "#",
                    'visible' =>  \Yii::$app->user->identity->username==="admin"?true:\Yii::$app->user->can($per->name),
                ];
            }else {
                $arr[explode('/',$k)[0]]['items'][]=[
                    'label' => $per->description,
                    'icon' => 'file-code-o',
                    'url' => [$per->name],
                    'visible' =>  \Yii::$app->user->identity->username==="admin"?true:\Yii::$app->user->can($per->name),
                ];
            }
        }
        // var_dump($per->data);exit;
        return $arr;
    }
}