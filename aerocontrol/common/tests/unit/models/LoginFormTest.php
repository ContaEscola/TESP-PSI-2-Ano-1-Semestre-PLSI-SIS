<?php

namespace common\tests\unit\models;

use common\models\User;
use Yii;
use common\models\LoginForm;
use common\fixtures\UserFixture;

/**
 * Login form test
 */
class LoginFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    public function testLoginNoUser()
    {
        $model = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        verify($model->login())->false();
        verify(Yii::$app->user->isGuest)->true();
    }

    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'username' => 'rafael',
            'password' => 'wrong_password',
        ]);

        verify($model->login())->false();
        verify($model->errors)->arrayHasKey('password');
        verify(Yii::$app->user->isGuest)->true();
    }

    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'username' => 'rafael',
            'password' => '12345678',
        ]);

        verify($model->login())->true();
        verify($model->errors)->arrayHasNotKey('password');
        verify(Yii::$app->user->isGuest)->false();
    }
}
