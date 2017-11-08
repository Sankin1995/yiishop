<?php

namespace backend\controllers;

use app\models\Brand;
use app\models\Goods;
use app\models\GoodsCategory;
use app\models\GoodsDayCount;
use app\models\GoodsGallery;
use app\models\GoodsIntro;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $goods = Goods::find()->all();
        $request = \yii::$app->request;

            $min = $request->get('min');
            $max = $request->get('max');
            $keyWords = $request->get('keyWords');
            //创建一个查询对象
            $query = Goods::find();
            if($min>0){
                $query->andWhere("shop_price >= {$min}");
            }
            if($max>0){
                $query->andWhere("shop_price <= {$max}");
            }
            if(isset($keyWords)){
                $query->andWhere("name like '%{$keyWords}%'");
            }


        return $this->render('index',['goods'=>$goods]);

    }


    public function actionAdd()
    {
        //创建模型对象
        $goods = new Goods();
        //创建商品详情表对象
        $intro = new GoodsIntro();
        $gallery = new GoodsGallery();
        //创建request对象
        $request =\yii::$app->request;
        //判断是否是post提交
        if($request->isPost){
//            $data = $request->post();
//            echo "<pre>";
//            var_dump($data);exit;
            //绑定数据
            $goods->load($request->post());
            $intro->load($request->post());
            $gallery->load($request->post());

            $goods->inputtime = time();
            $goods_sn = date('Ymd');
            $goodOne = Goods::find()
            ->where(['like','sn',$goods_sn])
            ->one();
//            echo "<pre>";
//            var_dump($goodOne);exit;
            if(empty($goodOne)){
                $goods->sn = date('Ymd',$goods->inputtime)."00001";
            }else{
                $goods->sn = $goodOne->sn + 1;
            }
            if($goods->validate()){
                //保存
                $goods->save();
                //查询dayCount表今天添加的数据 如果有就count+1 如果没有就创建一条数据在给count赋值1
//                2017110700001
//                echo $int_sn*100000+1;
                $counts = GoodsDayCount::findOne(['day'=>$goods_sn]);
//                    echo "<pre>";
//                    var_dump($counts);exit;
                if(empty($counts)){
//                    echo 11;exit;
                    //创建dayCount对象
                    $dayCount = new GoodsDayCount();
                    $dayCount->day = date('Ymd');
                    $dayCount->count = 1;
                    $dayCount->save();
//                    var_dump($dayCount->day,$dayCount->count);exit;
                }
//                else{
//                    $counts->count += 1;
//                    $dayCount->save();
//                }
            }
            $goods_id = $goods->attributes['id'];
            $pathArr=$gallery->path;
            if(!empty($pathArr)){
                foreach ($pathArr as $path){
                    //创建图片列表对象
                    $gallery = new GoodsGallery();
                    $gallery->path=$path;
                    $gallery->goods_id=$goods_id;
                    $gallery->save();
                }
            }
            $intro->goods_id = $goods_id;
            $gallery->goods_id = $goods_id;
            if($intro->validate() && $gallery->validate()){

                    $intro->save();
                    $gallery->save();
//
                \yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['goods/index']);
            }
            }
        //创建商品品牌对象查询数据
        $brand = Brand::find()->all();
        $brand_options = ArrayHelper::map($brand,'id','name');
        //创建尚品分类对象查询数据
        $goods_category = GoodsCategory::find()->orderBy('tree,lft')->all();
        $goods_options = ArrayHelper::map($goods_category,'id','nameText');

        return $this->render('add',['gallery'=>$gallery,'goods'=>$goods,'brand_options'=>$brand_options,'goods_options'=>$goods_options,'intro'=>$intro]);
    }


    //编辑
    public function actionEdit($id)
    {
        //查询出对应id的四个表所有数据
        $good = Goods::findOne($id);
        $intro = GoodsIntro::findOne($id);
        $gallery = GoodsGallery::find()->where(['goods_id'=>$id])->all();
//        echo "<pre>";
//        var_dump($gallery);exit;
        $paths = [];
        foreach ($gallery as $obj){
//            var_dump($obj->path);
            $paths[] = $obj->path;
        }
//        var_dump($paths);
//        exit;
        $gallerys = implode(',',$paths);
//        var_dump($gallerys);exit;
        $galleryF = new GoodsGallery();
        $galleryF->path=$gallerys;
        //创建request对象
        $request = \yii::$app->request;
        if($request->isPost){
            //接收数据
            $data = $request->post();
//            echo "<pre>";
//            var_dump($data);exit;
            $good->load($data);
            $intro->load($data);
            if($good->validate() && $intro->validate()){
                //保存数据
                $good->save();
                $intro->save();
                \yii::$app->session->setFlash('success','编辑成功');
                return $this->redirect(['goods/index']);
            }
        }
        //创建商品品牌对象查询数据
        $brand = Brand::find()->all();
        $brand_options = ArrayHelper::map($brand,'id','name');
        //创建尚品分类对象查询数据
        $goods_category = GoodsCategory::find()->orderBy('tree,lft')->all();
        $goods_options = ArrayHelper::map($goods_category,'id','name');

        //传入视图
        return $this->render('edit',['galleryF'=>$galleryF,'good'=>$good,'intro'=>$intro,'brand_options'=>$brand_options,'goods_options'=>$goods_options]);

    }

    public function actionDel($id)
    {
        //查询出所有对应数据 逐一删除
        $good = Goods::findOne($id);

        $gallery = GoodsGallery::findOne(['goods_id'=>$id]);
//        echo "<pre>";
//        var_dump($gallery);exit;
        $intro = GoodsIntro::findOne($id);
        $good->delete();
        $intro->delete();
        $gallery->delete();

        \yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['goods/index']);
    }

}
