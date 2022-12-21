<?php

namespace backend\modules\api\controllers;

use common\models\User;
use Yii;
use yii\base\UserException;
use yii\db\Exception;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class AuthController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionLogin(){
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $user = User::findByUsername($username);
        if ($user && $user->validatePassword($password)) return $user->auth_key;
        else return "Invalid credentials";
    }

}