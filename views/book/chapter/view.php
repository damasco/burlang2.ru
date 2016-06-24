<?php

use yii\helpers\Html;
use yii\helpers\Markdown;
use yii\helpers\HtmlPurifier;
use app\widgets\ChapterMenuWidget;

/* @var yii\web\View $this */
/* @var app\models\BookChapter $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->book->title, 'url' => ['view', 'id' => $model->book_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="book-view">

    <h1 class="hidden-xs">
        <?= Html::encode($model->book->title) ?>
        <?php if (!$model->book->active): ?>
            <span class="label label-default"><?= Yii::t('app', 'Inactive') ?></span>
        <?php endif ?>
    </h1>

    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->book->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->book->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif ?>

    <div class="row">
        <div class="col-sm-3 hidden-xs">
            <?= ChapterMenuWidget::widget(['book' => $model->book, 'active_id' => $model->id]) ?>
        </div>
        <div class="col-sm-9 col-xs-12">
            <?php if (!Yii::$app->user->isGuest): ?>
                <p>
                    <?= Html::a(Yii::t('app', 'Edit chapter'), ['chapter-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Delete chapter'), ['chapter-delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            <?php endif ?>
            <div class="content">
                <?= HtmlPurifier::process(Markdown::process($model->content, 'gfm')) ?>
            </div>
        </div>
    </div>

</div>