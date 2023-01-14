<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomQueryAuth;
use common\models\SupportTicket;
use common\models\User;
use frontend\models\SupportTicketForm;
use Yii;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class SupportTicketController extends ActiveController
{
    public $modelClass = 'common\models\SupportTicket';

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
        ];
        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'my-support-tickets' => ['GET'],
        ];
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === "my-support-tickets") {
            if (!isset(Yii::$app->authManager->getRolesByUser($model->id)['client']))
                throw new ForbiddenHttpException('Proibido');
        } else if ($action === "update") {
            if (Yii::$app->params['id'] != $params['user_id'])
                throw new ForbiddenHttpException('Proibido');
        }
    }

    public function actionMySupportTickets()
    {
        $user = User::findOne(Yii::$app->params['id']);
        if (!$user)
            throw new NotFoundHttpException();

        $this->checkAccess('my-tickets', $user);
        $i = 0;
        $array = array();

        foreach ($user->client->supportTickets as $supportTicket){
            $array[$i]['id'] = $supportTicket->id;
            $array[$i]['title'] = $supportTicket->title;
            $array[$i]['state'] = $supportTicket->state;
            $j = 0;
            foreach ($supportTicket->ticketMessages as $message){
                $array[$i]['messages'][$j]['id'] = $message->id;
                $array[$i]['messages'][$j]['message'] = $message->message;
                $userSender = User::findOne($message->sender_id);
                $array[$i]['messages'][$j]['sender'] = $userSender->username;
                $j++;
            }
            $k = 0;
            foreach ($supportTicket->ticketItems as $lostItem){
                $array[$i]['items'][$k]['id'] = $lostItem->lostItem->id;
                $array[$i]['items'][$k]['description'] = $lostItem->lostItem->description;
                $array[$i]['items'][$k]['state'] = $lostItem->lostItem->state;
                $array[$i]['items'][$k]['image'] = $lostItem->lostItem->image;
                $k++;
            }
            $i++;
        }

        return $array;
    }

    public function actionCreate(){

        $user = User::findOne(Yii::$app->params['id']);
        if (!$user)
            throw new NotFoundHttpException("Utilizador não encontrado");

        $model = new SupportTicketForm();
        $model->client_id = $user->id;

        if ($model->load($this->request->post()) && $model->validate()){
            if ($model->create()) {
                return $model;
            } else throw new ServerErrorHttpException("Ocorreu um erro ao criar o ticket");
        } else return $model->errors;
    }

    public function actionUpdate($id){
        $model = $this->modelClass;
        $supportTicket = SupportTicket::findOne($id);

        $this->checkAccess('update', $model, ['user_id' => $supportTicket->client_id]);

        if ($supportTicket->concludeSupportTicket())
            return ['state' => $supportTicket->state];

        throw new ServerErrorHttpException("Algo correu mal ao tentar concluir o ticket");
    }

}