<?php

namespace backend\controllers;

use backend\models\ClientForm;
use common\models\Client;
use common\models\ClientSearch;
use common\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
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
                            'roles' => ['viewClient'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewClient'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['updateClient'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Client models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $clients = Client::find()->all();

        return $this->render('index', [
            'clients' => $clients,
        ]);
    }

    /**
     * Displays a single Client model.
     * @param int $client_id ID do Cliente
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($client_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($client_id),
        ]);
    }


    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $client_id ID do Cliente
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($client_id)
    {
        $validClient = $this->findModel($client_id);
        $model = new ClientForm($validClient->client_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->update()) {
            return $this->redirect(['view', 'client_id' => $model->client_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $client_id ID do Cliente
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($client_id)
    {
        if (($model = Client::findOne(['client_id' => $client_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
