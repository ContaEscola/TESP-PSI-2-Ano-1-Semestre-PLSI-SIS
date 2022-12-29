<?php

namespace backend\modules\api\controllers;

use common\models\User;
use yii\filters\auth\HttpBasicAuth;

use yii\rest\Controller;
use yii\web\ForbiddenHttpException;

class AuthController extends Controller
{
    public $user;

    public function behaviors()
    {

        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => [$this, 'auth'],
        ];

        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'login' => ['POST'],
        ];
    }

    public function auth($username, $password)
    {
        $user = User::findByUsername($username);
        if ($user && $user->validatePassword($password)) {
            $this->user = $user;
            return $user;
        }
        throw new ForbiddenHttpException('No authentication.'); //403
    }


    public function actionLogin()
    {
        return [
            'token' => $this->user->auth_key,
            'id' => $this->user->id,
            'username' => $this->user->username,
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'gender' => $this->user->gender,
            'country' => $this->user->country,
            'city' => $this->user->city,
            'birthdate' => $this->user->birthdate,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'phone_country_code' => $this->user->phone_country_code,
        ];
    }
}
