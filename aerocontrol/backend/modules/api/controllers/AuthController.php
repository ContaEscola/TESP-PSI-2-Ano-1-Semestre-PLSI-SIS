<?php

namespace backend\modules\api\controllers;

use common\models\User;
use yii\base\UserException;
use yii\db\Exception;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class AuthController extends Controller
{
    public $user = null;

    /*
         COM HttpBasicAuth
    */

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class'=> HttpBasicAuth::className(),
            'auth'=> [$this,'auth']
        ];
        return $behaviors;
    }

    public function auth($username, $password)
    {
        $user = User::findByUsername($username);
        if ($user && $user->validatePassword($password))
        {
            $this->user = $user;
            return $user;
        }
        throw new ForbiddenHttpException('No authentication'); //403
    }


    public function actionLogin(){
        if($this->user != null)
            return $this->user->authkey;
    }

}