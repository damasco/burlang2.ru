<?php

namespace app\widgets;

use Yii;
use app\models\News;
use yii\base\Widget;

class NewsWidget extends Widget
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $query = News::find();

        if (!Yii::$app->user->can('adminNews')) {
            $query->where(['active' => 1]);
        }

        /** @var News $model */
        $model = $query->orderBy('created_at DESC')->limit(Yii::$app->params['widget.news.limit'])->all();

        return $this->render('news', [
            'model' => $model
        ]);
    }
}