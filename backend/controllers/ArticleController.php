<?php

namespace backend\controllers;

use app\models\Article;
use app\models\ArticleCategory;
use app\models\ArticleDetail;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //总条数
        $count = Article::find()->count();
        //每页显示的条数
        $pageSize = 3;
        //创建分页对象

        $pages = new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count
        ]);
        //查询所有数据
        $articles = Article::find()
            ->limit($pages->limit)
            ->offset($pages->offset)
            ->all();

        return $this->render('index',['articles'=>$articles,'pages'=>$pages]);
    }

    public function actionAdd()
    {
        //创建模型对象
        $model = new Article();
        //创建detail对象
        $detail = new ArticleDetail();
        //创建request对象
        $request = \yii::$app->request;
        //判断是否是post提交
        if($request->isPost){
            //接收数据
            $data = $request->post();
            $model->load($data);
            if($model->validate()){
                $model->inputtime = time();
//                $model->detail->content = ;
                $model->save();
                $lastId = $model->attributes['id'];
                $detail->load($data);
                if($detail->validate()){
                    $detail->article_id = $lastId;
                    $detail->save();
                }
                \yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['article/index']);
            }else{
                \yii::$app->session->setFlash('danger','添加失败');
                return $this->redirect(['article/index']);
            }

        }
        //查询出分类数据
        $cates = ArticleCategory::find()->all();
        $options = ArrayHelper::map($cates,'id','name');
        //创建category模型
        $detail = new ArticleDetail();
        //传图视图
        return $this->render('add',['model'=>$model,'options'=>$options,'detail'=>$detail]);
    }

    public function actionEdit($id)
    {
        //创建模型对象
        $model = Article::findOne($id);
        //创建detail对象
        $detail =ArticleDetail::findOne($id);
        //创建request对象
        $request = \yii::$app->request;
        //判断是否是post提交
        if($request->isPost){
            //接收数据
            $data = $request->post();
            $model->load($data);
            if($model->validate()){
                $model->inputtime = time();
//                $model->detail->content = ;
                $model->save();
                $lastId = $model->attributes['id'];
                $detail->load($data);
                if($detail->validate()){
                    $detail->article_id = $lastId;
                    $detail->save();
                }
                \yii::$app->session->setFlash('success','编辑成功');
                return $this->redirect(['article/index']);
            }else{
                \yii::$app->session->setFlash('danger','编辑失败');
                return $this->redirect(['article/index']);
            }

        }
        //查询出分类数据
        $cates = ArticleCategory::find()->all();
        $options = ArrayHelper::map($cates,'id','name');
        //创建category模型
        $detail = ArticleDetail::findOne($id);
        //传图视图
        return $this->render('add',['model'=>$model,'options'=>$options,'detail'=>$detail]);
    }

    public function actionDel($id)
    {
        $article = Article::findOne($id);
        $detail = ArticleDetail::findOne($id);
        $article->delete();
        $detail->delete();
        \yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['article/index']);
    }
}
