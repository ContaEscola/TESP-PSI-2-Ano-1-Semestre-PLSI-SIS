<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomQueryAuth;
use common\models\ClientForm;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use Yii;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\ServerErrorHttpException;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';
    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    public function behaviors()
    {
        Yii::$app->params['id'] = 0;
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomQueryAuth::class,
            'only' => ['update'],
        ];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === "update") {
            if (Yii::$app->params['id'] != $params['user_id'])
                throw new ForbiddenHttpException('Proibido');
        }
    }

    public function actionUpdate($id){
        $model = $this->modelClass;

        $this->checkAccess('update', $model, ['user_id' => $id]);

        $user = User::findOne($id);

        $confirmPassword = $this->request->post('confirm_password');
        if (isset($confirmPassword) && !empty($confirmPassword)) {
            if (!$user->validatePassword($confirmPassword)) {
                throw new ForbiddenHttpException("Esta password não corresponde à password atual.");
            }
        } else throw new ForbiddenHttpException("Tem de confirmar a password.");

        $clientForm = new ClientForm();
        $clientForm->user_id = $id;

        if($clientForm->load($this->request->post()) && $clientForm->update())
            return [
                'username' => $clientForm->username,
                'first_name' => $clientForm->first_name,
                'last_name' => $clientForm->last_name,
                'gender' => $clientForm->gender,
                'country' => $clientForm->country,
                'city' => $clientForm->city,
                'birthdate' => $clientForm->birthdate,
                'email' => $clientForm->email,
                'phone' => $clientForm->phone,
                'phone_country_code' => $clientForm->phone_country_code,
            ];
        throw new ServerErrorHttpException("Ocorreu ao efetuar a gravação");

    }

    public function actionResetPassword(){
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                return ['message' => 'Email enviado, verifique o email.'];
            } else throw new ServerErrorHttpException("Não foi possivel enviar o email para resetar a password.");
        } else return $model->errors;
    }

}