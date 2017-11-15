<?php

namespace backend\controllers;

use app\models\GoodsCategory;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\db\Query;

class GoodsCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //得到模型对象
        $goods_cate = GoodsCategory::find()->orderBy('tree,lft')->all();
        return $this->render('index',['goods_cate'=>$goods_cate]);
    }

    public function actionAdd()
    {
        //得到模型对象
        $cates = new GoodsCategory();

        //判断是否是post提交
        $request = \yii::$app->request;
        if($request->isPost){
            //接受数据
            $data = $request->post();
            //绑定数据
            $cates->load($data);
            if($cates->validate()){
                //判断父级id=0时添加根目录
                if($cates->parent_id==0){
                    $cates->makeRoot();
                    \yii::$app->session->setFlash('success','添加分类成功');
                    return $this->redirect(['goods-category/index']);
                }else{
                    //添加子类目录
                    //找到父级id
                    $parent_id = $cates->parent_id;
                    $parent = GoodsCategory::findOne(['id'=>$parent_id]);
                    $cates->prependTo($parent);
                    \yii::$app->session->setFlash('success','添加分类成功');
                    return $this->redirect(['goods-category/index']);
                }
            }
        }

        //获取所有数据
        $goods_cates = GoodsCategory::find()->asArray()->all();
//        var_dump($goods_cates);exit;
        $goods_cates[] = ['id'=>0,'parent_id'=>0,'name'=>'京西商品分类'];
        $cate = json_encode($goods_cates);
        return $this->render('add',['cates'=>$cates,'cate'=>$cate]);
    }

    public function actionEdit($id)
    {
        $oneCate = GoodsCategory::findOne($id);
        $old_name = $oneCate->name;
        //判断是否是post提交
        $request = \yii::$app->request;
        if($request->isPost){
                //接受数据
            $data = $request->post();
            if($oneCate->name != $data['GoodsCategory']['name']){
                \yii::$app->session->setFlash('danger','不能修改分类名称，如想修改请删除重新添加');
                return $this->redirect(['goods-category/edit','id'=>$oneCate->id]);
            }
//            var_dump($data);exit;
            //绑定数据
            $oneCate->load($data);

            //验证
            if($oneCate->validate()){
                $parent_id = $oneCate->parent_id;
                $parent = GoodsCategory::findOne($parent_id);
                    try{
                          $oneCate->prependTo($parent);
                    }catch (Exception $e){
                        \yii::$app->session->setFlash('danger','修改分类错误');
                        return $this->redirect(['goods-category/index','id'=>$id]);
                    }
                \yii::$app->session->setFlash('success','编辑分类成功');
                return $this->redirect(['goods-category/index']);
            }
        }



        //获取所有数据
        $goods_cates = GoodsCategory::find()->asArray()->all();
//        var_dump($goods_cates);exit;
        $goods_cates[] = ['id'=>0,'parent_id'=>0,'name'=>'京西商品分类'];
        $cate = json_encode($goods_cates);
        return $this->render('edit',['oneCate'=>$oneCate,'cate'=>$cate]);
    }

    public function actionDel($id)
    {
        //查询出对应id数据
        $one = GoodsCategory::findOne($id);
        //查询出所有这个对应id分类的子分类
        $query = new Query();
        $one_down = $query
            ->from('goods_category')
            ->where(['parent_id'=>$id])
            ->select('*')
            ->all();
//        var_dump($one_down);exit;
        if(!empty($one_down)){
            \yii::$app->session->setFlash('danger','此商品分类下有其他分类，请先删除其他分类！');
            return $this->redirect(['goods-category/index']);
        }else{
            try{
                //删除
                $one->delete();
            }catch (Exception $e){
                \yii::$app->session->setFlash('danger','根目录不能删除');
                return $this->redirect(['goods-category/index']);

            }

            \yii::$app->session->setFlash('success','删除分类成功');
            return $this->redirect(['goods-category/index']);
        }
    }

}
