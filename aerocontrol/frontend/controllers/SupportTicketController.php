<?php

namespace frontend\controllers;

use common\models\Client;
use common\models\FlightTicket;
use common\models\SupportTicket;
use frontend\models\SupportTicketForm;
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
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['createSupportTicket'],
                        ],
                    ],
                ]
            ]
        );
    }


    /**
     * Lists all SupportTicket models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new SupportTicketForm();
        $client = Client::findOne(['client_id' => Yii::$app->user->getId()]);
        $dataProvider = new ActiveDataProvider([
            'query' => SupportTicket::find()->where(['client_id' => $client->client_id])->orderBy('state ASC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $model = new SupportTicketForm();

        $client = Client::findOne(['client_id' => Yii::$app->user->getId()]);
        $dataProvider = new ActiveDataProvider([
            'query' => SupportTicket::find()->where(['client_id' => $client->client_id])->orderBy('state ASC'),
        ]);

        $model->client_id = $client->client_id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->create()) {
                $model = new SupportTicketForm();
                return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model
                ]);
            }
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

}
