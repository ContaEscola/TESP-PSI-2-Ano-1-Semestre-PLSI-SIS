<?php

namespace frontend\controllers;

use common\models\Client;
use common\models\FlightTicket;
use common\models\SupportTicket;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * SupportTicketController implements the CRUD actions for SupportTicket model.
 */
class SupportTicketController extends Controller
{

    /**
     * Lists all SupportTicket models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $client = Client::findOne(['client_id' => Yii::$app->user->getId()]);
        $dataProvider = new ActiveDataProvider([
            'query' => SupportTicket::find()->where(['client_id' => $client->client_id])->orderBy('state ASC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

}
