<?php

namespace backend\controllers;

use backend\models\TicketMessageForm;
use common\models\SupportTicketSearch;
use common\models\SupportTicket;
use common\models\TicketMessage;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
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
        $searchModel = new SupportTicketSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SupportTicket model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ticket_id)
    {
        $model = new TicketMessageForm();

        $user = User::findOne(['id' => Yii::$app->user->getId()]);

        $dataProvider = new ActiveDataProvider([
            'query' => TicketMessage::find()->where(['support_ticket_id' => $this->findModel($ticket_id)])->orderBy('id ASC'),
        ]);

        $model->sender_id = $user->id;
        $model->support_ticket_id = $ticket_id;

        $ticket = SupportTicket::findOne($ticket_id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->create($ticket)) {
                $this->refresh();
            }
        }

        return $this->render('view', [
            'client_id' => $ticket->client_id,
            'ticket_title' => $ticket->title,
            'ticket_id' => $ticket_id,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SupportTicket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionFinish($id)
    {
        $model = SupportTicket::findOne($id);
        $model->state = SupportTicket::STATE_DONE;
        if ($model->save()){
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the SupportTicket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SupportTicket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SupportTicket::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
