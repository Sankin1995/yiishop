<?php

namespace backend\controllers;

use app\models\ArticleCategory;
use yii\data\Pagination;

class ArticleCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //总条数
        $count = ArticleCategory::find()->count();
        //每页显示的条数
        $pageSize = 3;
        //创建分页对象
        $pages = new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count
        ]);
        //查询所有数据
        $cates = ArticleCategory::find()
            ->limit($pages->limit)
            ->offset($pages->offset)
            ->all();
        return $this->render('index',['pages'=>$pages,'cates'=>$cates]);
    }

    public function actionAdd()
    {
        //创建模型对象
        $model = new ArticleCategory();
        //创建request对象
        $request = \yii::$app->request;
        //判断是否是post提交
        if($request->isPost){
            //接收数据
            $data = $request->post();
            //绑定数据
            $model->load($data);
            //验证数据
            if($model->validate()){
                //验证成功 保存数据 跳转
                $model->save();
                \yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['article-category/index']);
            }else{
                \yii::$app->session->setFlash('danger','您输入的数据有误');
                return $this->redirect(['article-category/add']);
            }
        }
        //传入视图
        return $this->render('add',['model'=>$model]);
    }


    public function actionEdit($id)
    {
        //创建模型对象
        $model =ArticleCategory::findOne($id);
        //创建request对象
        $request = \yii::$app->request;
        //判断是否是post提交
        if($request->isPost){
            //接收数据
            $data = $request->post();
            //绑定数据
            $model->load($data);
            //验证数据
            if($model->validate()){
                //验证成功 保存数据 跳转
                $model->save();
                \yii::$app->session->setFlash('success','编辑成功');
                return $this->redirect(['article-category/index']);
            }else{
                \yii::$app->session->setFlash('danger','您输入的数据有误');
                return $this->redirect(['article-category/add']);
            }
        }
        //传入视图
        return $this->render('edit',['model'=>$model]);
    }

    public function actionDel($id)
    {
        $model = ArticleCategory::findOne($id);
        $model->delete();
        \yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['article-category/index']);
    }

}
