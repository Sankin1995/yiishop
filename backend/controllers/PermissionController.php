<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/11
 * Time: 12:54
 */

namespace backend\controllers;


use backend\models\AuthItem;
use yii\web\Controller;

class PermissionController extends Controller
{
    public function actionIndex()
    {
//        $permissions = AuthItem::find()->all();
        //实例化RBAC组件
        $authManager = \yii::$app->authManager;
        //获得所有权限
        $permissions = $authManager->getPermissions();
        return $this->render('index',compact('permissions'));
    }

    /**
     * 添加权限
     */
    public function actionAdd()
    {

        //创建模型
        $permission = new AuthItem();
        //创建request对象
        $request = \yii::$app->request;
        if($request->isPost){
//            echo 11;exit;
            //绑定并验证数据
            if($permission->load($request->post()) && $permission->validate()){
                //实例化RBAC组件
                $authManager = \yii::$app->authManager;
                //创建权限
                $permiss = $authManager->createPermission($permission->name);
                //添加描述
                $permiss->description = $permission->description;
                //添加权限，将权限保存在数据库
                $authManager->add($permiss);
                \yii::$app->session->setFlash('success','添加'.$permission->description.'权限成功');
                return $this->redirect(['permission/index']);
            }else{
                \yii::$app->session->setFlash('success','添加'.$permission->description.'权限失败');
            }

        }
        return $this->render('add',compact('permission'));
    }

    public function actionEdit($name)
    {
//创建模型
//        $permission = new AuthItem();
        $permission = AuthItem::findOne($name);
        //创建request对象
        $request = \yii::$app->request;
        if($request->isPost){
//            echo 11;exit;
            //绑定并验证数据
            if($permission->load($request->post()) && $permission->validate()){
                //实例化RBAC组件
                $authManager = \yii::$app->authManager;
                //找出当前权限对象
                $permiss = $authManager->getPermission($permission->name);
               // $permiss = $authManager->createPermission($permission->name);
                //修改描述
                $permiss->description = $permission->description;
                //修改权限，将权限保存在数据库
                $authManager->update($permission->name,$permiss);
                \yii::$app->session->setFlash('success','修改'.$permission->description.'权限成功');
                return $this->redirect(['permission/index']);
            }else{
                \yii::$app->session->setFlash('success','修改'.$permission->description.'权限失败');
            }

        }
        return $this->render('add',compact('permission'));
    }

    public function actionDel($name)
    {
        //实例化RBAC对象
        $authManager = \yii::$app->authManager;
        //找出当前权限
        $permission = $authManager->getPermission($name);
       if($authManager->remove($permission)){
           \yii::$app->session->setFlash('success','删除权限成功');
           return $this->redirect(['permission/index']);
       }
    }
}