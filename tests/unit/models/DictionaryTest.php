<?php

namespace test\unit\models;

use app\models\Dictionary;
use Codeception\Specify;
use Codeception\Test\Unit;
use app\modules\user\models\User;

class DictionaryTest extends Unit
{
    use Specify;

    protected function setUp()
    {
        parent::setUp();
        \Yii::$app->user->login(new User(['id' => 1]));
    }

    public function testRules()
    {
        $model = new Dictionary([
            'name' => 'Given name',
            'info' => 'Information',
            'isbn' => 'Code',
        ]);

        expect('model is valid', $model->validate())->true();

        $model->name = '';
        $model->info = '';
        $model->isbn = '';

        expect('model is not valid', $model->validate())->false();
        expect('name is required', $model->errors)->hasKey('name');
        expect('info is required', $model->errors)->hasKey('info');
        expect('isbn is not required', $model->errors)->hasntKey('isbn');
    }
}
