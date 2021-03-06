<?php

namespace app\widgets;

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\widgets\InputWidget;

class TextareaCharts extends InputWidget
{
    /** @var string */
    protected $selector;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->hasModel()) {
            $this->selector = Inflector::camel2id($this->model->formName()) . '-' . $this->attribute;
        } else {
            $this->selector = 'charts-textarea-' . $this->name;
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerScripts();

        $this->options['class'] = 'form-control';
        $this->options['id'] = $this->selector;

        if ($this->hasModel()) {
            $textarea = Html::activeTextArea($this->model, $this->attribute, $this->options);
        } else {
            $textarea = Html::textArea($this->name, $this->value, $this->options);
        }

        return $this->render('textarea-charts', [
            'textarea' => $textarea,
            'selector' => $this->selector,
        ]);
    }

    public function registerScripts()
    {
        $this->view->registerJs("
            $('body').on('click', '.add-letter-{$this->selector}', function() {
                $('#{$this->selector}').sendkeys($(this).text());
            });
        ");
    }
}
