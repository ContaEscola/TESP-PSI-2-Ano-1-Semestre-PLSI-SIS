<?php

namespace backend\modules\api\controllers;

use common\models\User;
use Psy\Util\Json;
use Yii;
use yii\base\Module;
use yii\base\UserException;
use yii\db\Exception;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

use yii\rest\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class AuthController extends Controller
{
    public $user;

    public function __construct($id, $module, $config = [])
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        parent::__construct($id, $module, $config);
    }

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
        $array['token'] = $this->user->auth_key;
        $array['id'] = $this->user->id;
        $array['username'] = $this->user->username;
        $array['first_name'] = $this->user->first_name;
        $array['last_name'] = $this->user->last_name;
        $array['gender'] = $this->user->gender;
        $array['country'] = $this->user->country;
        $array['city'] = $this->user->city;
        $array['birthdate'] = $this->user->birthdate;
        $array['email'] = $this->user->email;
        $array['phone'] = $this->user->phone;
        $array['phone_country_code'] = $this->user->phone_country_code;
        return $array;
    }

}