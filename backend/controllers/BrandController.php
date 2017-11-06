<?php

namespace backend\controllers;

use app\models\Brand;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\UploadedFile;
use flyok666\qiniu\Qiniu;
class BrandController extends Controller
{
    public function actionIndex()
    {
        //总条数
        $count = Brand::find()->count();
        //每页显示的条数
        $pageSize = 3;
        //创建分页对象
        $pages = new Pagination([
            'pageSize' => $pageSize,
            'totalCount' =>$count
        ]);
        //查询所有品牌信息
        $brands = Brand::find()
            ->limit($pages->limit)
            ->offset($pages->offset)
            ->all();
//        var_dump($brands);exit;
        return $this->render('index',['brands'=>$brands,'pages'=>$pages]);
    }

    public function actionAdd()
    {
        //创建模型对象
        $model = new Brand();

        //创建request对象
        $request = \yii::$app->request;
        //判断是否是post提交
        if($request->isPost){
            //接收数据
            $data = $request->post();
            //绑定数据
            $model->load($data);
            //创建文件上传对象
           // $model->imgFile  = UploadedFile::getInstance($model,'imgFile');
            //验证
            if($model->validate()){
               // if($model->imgFile){
                    //拼接文件上传路径
                   // $filePath = "images/brand/".time().".".$model->imgFile->extension;
                    //保存文件
                   // $model->imgFile->saveAs($filePath,false);
                    //给数据库logo字段添加数据
                   // $model->logo = $filePath;
                //}else{
                   // $model->logo = "images/brand/timg.jpg";
              //  }

                //保存数据
                $model->save();
                //提示 跳转
                \yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['brand/index']);
            }

        }

        //将对象传到视图
        return $this->render('add',['model'=>$model]);
    }

    public function actionEdit($id)
    {
        //查询出对应id的数据 并获得对应对象
        $brand = Brand::findOne($id);
        //创建request对象
        $request = \yii::$app->request;
        //判断是否是post提交
        if($request->isPost){
            //接收数据
            $data = $request->post();
            //绑定数据
            $brand->load($data);
            //创建文件上传对象
            $brand->imgFile  = UploadedFile::getInstance($brand,'imgFile');
            //验证
            if($brand->validate()){

                if($brand->imgFile){
                    //拼接文件上传路径
                    $filePath = "images/brand/".time().".".$brand->imgFile->extension;
                    //保存文件
                    $brand->imgFile->saveAs($filePath,false);
                    //给数据库logo字段添加数据
                    $brand->logo = $filePath;
                }

                //保存数据
                $brand->save();
                //提示 跳转
                \yii::$app->session->setFlash('success','编辑成功');
                return $this->redirect(['brand/index']);
            }

        }

        //传视图
        return $this->render('edit',['brand'=>$brand]);
    }

    public function actionDel($id)
    {
        //查询出一条
        $brand = Brand::findOne($id);
        //删除
        $brand->delete();
        //提示 跳转
        \yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['brand/index']);
    }


    public function actionUpload()
    {
//var_dump($_FILES);exit;
        $config = [
            'accessKey'=>'Osj-uMhn6tcT59aCVr6sdcwBQmNId7llWon-CG5M',
            'secretKey'=>'-7zWHssJdkal65FsoG5rP1e16dPodsZ0sR-g4xMI',
            'domain'=>'http://oz03xrxoj.bkt.clouddn.com/',
            'bucket'=>'php0712',
            'area'=>Qiniu::AREA_HUANAN
        ];



        $qiniu = new Qiniu($config);
        $key = time();
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);

        $info = [
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url,


        ];
        exit(json_encode($info));
    }

}
