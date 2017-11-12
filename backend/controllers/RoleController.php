<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/11
 * Time: 14:14
 */

namespace backend\controllers;


use backend\models\AuthItem;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class RoleController extends Controller
{
    public function actionIndex(){
        //实例化RBAC对象
        $authManager = \yii::$app->authManager;
        //获得所有角色
        $roles = $authManager->getRoles();
        return $this->render('index',compact('roles'));
    }

    public function actionAdd()
    {
        $roles = new AuthItem();
        $request = \yii::$app->request;
        //实例化RBAC对象
        $authManager = \yii::$app->authManager;
        if($request->post()){
//            echo "<pre>";
//            var_dump($request->post());exit;
            if($roles->load($request->post()) && $roles->validate()){

                //创建角色
                $role = $authManager->createRole($roles->name);
                //添加描述
                $role->description = $roles->description;
                //添加角色，添加到数据库
                if($authManager->add($role)){
                    //根据权限名获取所有权限对象
//                    $authManager->getPermission($permiss);
                    //如果添加角色成功 给角色添加权限
                    if($roles->permissions){
                        foreach($roles->permissions as $permiss){
//                            var_dump($permiss);
                        $authManager->addChild($role,$authManager->getPermission($permiss));
                        }
//                        exit;
                    }

                }
                \yii::$app->session->setFlash('success','添加'.$roles->description.'权限成功');
                return $this->redirect(['role/index']);
            }
        }
        //得到所有权限
        $permission = $authManager->getPermissions();
        $permissions = ArrayHelper::map($permission,'name','description');
        return $this->render('add',compact('roles','permissions'));
    }

    public function actionEdit($name)
    {
        $roles = AuthItem::findOne($name);
        $request = \yii::$app->request;
        //实例化RBAC对象
        $authManager = \yii::$app->authManager;
        //得到当前角色的权限
        $rolePermiss = $authManager->getPermissionsByRole($roles->name);
        $roles->permissions = array_keys($rolePermiss);
        if($request->post()){
            if($roles->load($request->post()) && $roles->validate()){

                //获取当前角色
                $role = $authManager->getRole($roles->name);
                if($role){
                    //修改描述
                    $role->description = $roles->description;
                    //修改角色，添加到数据库
                   if($authManager->update($roles->name,$role)){
                       //编辑权限
                       //编辑权限之前删除当前角色以前的所有权限
                       $authManager->removeChildren($role);

                       if($roles->permissions){
                           foreach($roles->permissions as $permission){
                                $authManager->addChild($role,$authManager->getPermission($permission));
                           }
                       }
                   }

                    \yii::$app->session->setFlash('success','修改'.$roles->description.'成功');
                    return $this->redirect(['role/index']);
                }

            }
        }
        //得到所有权限
        $permission = $authManager->getPermissions();
        $permissions = ArrayHelper::map($permission,'name','description');

//        $rolePermission = ArrayHelper::map($rolePermiss,'name','description');
        return $this->render('edit',compact('roles','permissions'));
    }

    public function actionDel($name)
    {
        //实例化RBAC对象
        $authManager = \yii::$app->authManager;
        //找出当前角色对象
        $role = $authManager->getRole($name);
        //删除当前角色的所有权限
        $authManager->removeChildren($role);

        if( $authManager->remove($role)){
            \yii::$app->session->setFlash('success','删除'.$role->description.'成功');
            return $this->redirect(['role/index']);
        }


    }
}