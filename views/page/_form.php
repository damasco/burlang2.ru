<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use ijackua\lepture\Markdowneditor;
use app\widgets\ChartsInputWidget;

/* @var yii\web\View $this */
/* @var app\models\Page $model */
/* @var yii\widgets\ActiveForm $form */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'menu_name')->widget(ChartsInputWidget::className(), ['options' => ['maxlength' => true]]) ?>

    <?= $form->field($model, 'title')->widget(ChartsInputWidget::className(), ['options' => ['maxlength' => true]]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true, 'disabled' => $model->isNewRecord ? false : true]) ?>

    <?= $form->field($model, 'description')->widget(ChartsInputWidget::className(), ['options' => ['maxlength' => true]]) ?>

    <?= $form->field($model, 'content')->widget(Markdowneditor::className()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
