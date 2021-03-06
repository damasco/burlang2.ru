<?php

namespace test\unit\models;

use app\models\BuryatName;
use Codeception\Specify;
use Codeception\Test\Unit;
use app\modules\user\models\User;

class BuryatNameTest extends Unit
{
    use Specify;
    
    protected function setUp() 
    {
        parent::setUp();
        BuryatName::deleteAll([
            'or', 
            ['name' => 'Unique name']
        ]);
        \Yii::$app->user->login(new User(['id' => 1]));
    }

    public function testRules()
    {
        $model = new BuryatName([
            'name' => 'Given name',
            'description' => 'Description',
            'note' => 'Note',
            'male' => 1,
            'female' => 0
        ]);

        expect('model is valid', $model->validate())->true();

        $model->name = '';
        $model->description = '';
        $model->note = '';
        $model->male = '';
        $model->female = '';

        expect('model is not valid', $model->validate())->false();

        expect('name is required', $model->errors)->hasKey('name');
        expect('description is not required', $model->errors)->hasntKey('description');
        expect('note is not required', $model->errors)->hasntKey('note');
        expect('male is required', $model->errors)->hasKey('male');
        expect('female is required', $model->errors)->hasKey('female');
    }
    
    public function testUniqueName()
    {
        $model = new BuryatName([
            'name' => 'Unique name',
            'description' => 'Description',
            'note' => 'Note',
            'male' => 1,
            'female' => 0
        ]);
        
        expect('model is saved', $model->save())->true();
            
        $name = new BuryatName([
            'name' => 'Unique name',
            'description' => 'Other description',
            'note' => 'Other note',
            'male' => 0,
            'female' => 1
        ]);
        
        expect('model is not valid', $name->validate())->false();
        
        expect('model is deleted', $model->delete())->equals(1);
    }
}
