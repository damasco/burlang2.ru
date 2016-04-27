<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $translationForm mixed */
/* @var $dictionaries \app\models\Dictionaries[] */
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title"><?= Yii::t('app', 'Add translation') ?></h4>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin() ?>

        <?= $form->field($translationForm, 'name')->textInput() ?>

        <?= $form->field($translationForm, 'burword_id')->hiddenInput(['value' => $model->id])->label(false) ?>

        <?= $form->field($translationForm, 'dict_id')
            ->dropDownList(ArrayHelper::map($dictionaries, 'id', 'name'), ['prompt' => '-']) ?>

        <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'btn btn-success']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>