<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $article_category_id
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $content;
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['article_category_id', 'status', 'sort', 'inputtime'], 'integer'],
            [['intro'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['content'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文章名称',
            'article_category_id' => '文章分类',
            'intro' => '文章简介',
            'status' => '状态',
            'sort' => '排序',
            'inputtime' => '录入时间',
            'content'=>'文章内容'
        ];
    }

    public function getDetail()
    {
        return $this->hasOne(ArticleDetail::className(),['article_id'=>'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }
}
