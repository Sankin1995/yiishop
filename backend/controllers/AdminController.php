<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 13:32
 */

namespace backend\controllers;


use backend\models\Admin;
use backend\models\LoginForm;
use yii\web\Controller;

class AdminController extends Controller
{
//    public $defaultAction = 'index';
    public function actionHome()
    {
        return $this->render('home');
}
    public function actionIndex()
    {
        //创建表单模型对象
        $model = new LoginForm();
        $request = \yii::$app->request;
        if($request->isPost){
            //接收数据
//            var_dump($request->post());exit;
            //绑定数据
            $model->load($request->post());
            //验证是否存在用户名
            $admin_user = Admin::find()->where(['username'=>$model->username])->one();
            if(!empty($admin_user)){
                //验证密码
                if(\yii::$app->security->validatePassword($model->password_hash,$admin_user->password_hash)){
                    \yii::$app->user->login($admin_user,$model->rememberMe ? 3600*24 : 0);
                    //更改最后登录时间
                    $admin_user->last_login_at = time();
                    $admin_user->save();
                    return $this->redirect(['admin/home']);
                }else{
//                    \yii::$app->session->setFlash('danger','密码错误');
                    $model->addError("password_hash","密码错误");
                }
            }
        }
//        var_dump($model);exit;
        return $this->renderPartial('login',['model'=>$model]);
    }

    public function actionList()
    {
        $admins = Admin::find()->all();
        return $this->render('index', ['admins' => $admins]);
    }
    
    
    public function actionReg()
    {
        //创建模型
        $admin = new Admin();
        //创建request对象
        $request = \yii::$app->request;
       if($request->isPost){
//            echo "<pre>";
//            var_dump($_SERVER);exit;
//            var_dump($request->post());exit;
            //绑定数据
      $admin->load($request->post());
            $admin->password_hash = \yii::$app->security->generatePasswordHash($admin->password_hash);
            //给令牌赋值
            $admin->auth_key = \yii::$app->security->generateRandomString();
            //给创建时间赋值
            $admin->create_at = time();
            //给最后登录时间赋值
            $admin->last_login_at = $admin->create_at;
            //获取访问的ip地址
            $admin->last_login_ip = $_SERVER['REMOTE_ADDR'];
            //保存数据
            $admin->save();

            //创建RBAC组件对象
           $authManager = \yii::$app->authManager;
//           if($admin->username == "admin"){
           //找到默认的普通管理员角色
               $role = $authManager->getRole('user');
               //将当前注册的用户赋予角色
               $authManager->assign($role,$admin->id);
//           }else{
//               //注册用户都为普通管理员 找到普通管理员角色
//               $role = $authManager->getRole('adminuser');
//               //将当前用户追加到普通管理员角色中
//               $authManager->assign($role,$admin->id);
//           }


            \yii::$app->session->setFlash('success','注册成功,您的账户处于待审核状态，请等待总管理员审核···');
            //自动登录
//            \yii::$app->user->login($admin,3600*24);
            return $this->redirect(['admin/index']);
        }
        return $this->render('reg',['model'=>$admin]);
    }

    public function actionDel($id)
    {
        $adminOne = Admin::findOne($id);
        $adminOne->delete();
        \yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['admin/list']);
    }

    public function actionLogout()
    {
        \yii::$app->user->logout();
        return $this->redirect(['admin/index']);
    }

    public function actionEdit($id)
    {
//        $this->enableCsrfValidation = false;
        $adminOne = Admin::findOne($id);
        $OnePassword = $adminOne->password_hash;
        $request = \yii::$app->request;
        if($request->isPost){
            $data = $request->post();
            //绑定数据
            $adminOne->load($data);
            if($data['Admin']['password_hash'] === ""){
                $adminOne->password_hash = $OnePassword;
            }else{
                $adminOne->password_hash = \yii::$app->security->generatePasswordHash($adminOne->password_hash);
            }
                if($adminOne->validate()){
                    $adminOne->auth_key = \yii::$app->security->generateRandomString();
                    $adminOne->save();
                    \yii::$app->session->setFlash('success','编辑成功');
                    return $this->redirect(['admin/list']);
                }

        }

        return $this->render('edit',['model'=>$adminOne]);
    }
    public function actionUpdate($id)
    {
//        $this->enableCsrfValidation = false;
        $adminOne = Admin::findOne($id);
        $OnePassword = $adminOne->password_hash;
        $request = \yii::$app->request;
        if($request->isPost){
            $data = $request->post();
            //绑定数据
            $adminOne->load($data);
            if($data['Admin']['password_hash'] === ""){
                $adminOne->password_hash = $OnePassword;
            }else{
                $adminOne->password_hash = \yii::$app->security->generatePasswordHash($adminOne->password_hash);
            }
            if($adminOne->validate()){
                $adminOne->auth_key = \yii::$app->security->generateRandomString();
                $adminOne->save();
                \yii::$app->session->setFlash('success','编辑成功');
                return $this->redirect(['admin/home']);
            }

        }

        return $this->render('edit',['model'=>$adminOne]);
    }


}