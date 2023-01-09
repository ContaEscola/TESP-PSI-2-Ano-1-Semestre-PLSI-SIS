<?php

namespace backend\controllers;

use backend\models\TicketMessageForm;
use common\models\LostItem;
use common\models\LostItemSearch;
use common\models\SupportTicketSearch;
use common\models\SupportTicket;
use common\models\TicketItem;
use common\models\TicketMessage;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
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
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index'],
                            'roles' => ['viewTicket'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewMessage'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['createMessage'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['item'],
                            'roles' => ['viewTicketItem'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['add-item-to-ticket'],
                            'roles' => ['addTicketItem'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['remove-item-to-ticket'],
                            'roles' => ['deleteTicketItem'],
                        ],
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
     * @param int $ticket_id ID
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

    public function actionFinish($ticket_id)
    {
        $model = SupportTicket::findOne($ticket_id);
        $model->state = SupportTicket::STATE_DONE;

        $ticketItem = TicketItem::findOne($ticket_id);

        if ($ticketItem != null){
            $itemLost = LostItem::findOne($ticketItem->lost_item_id);
            $itemLost->state = LostItem::STATE_DELIVERED;
            $itemLost->save();
        }

        if ($model->save()){
            return $this->redirect(['index']);
        } else Yii::$app->session->setFlash("error","Não foi possivel alterar o estado para concluido, tente novamente mais tarde.");

        return $this->redirect(['view','ticket_id' => $ticket_id]);
    }

    public function actionItem($ticket_id){

        $searchModel = new LostItemSearch();

        $ticket = SupportTicket::findOne($ticket_id);

        if ($ticket->ticketItems)                           //  Se o ticket tiver item
            $query = LostItem::find()
                ->select('lost_item.*')
                ->leftJoin("ticket_item", '`ticket_item`.`lost_item_id` = `lost_item`.`id`')
                ->where(['support_ticket_id' => $ticket_id]);
        else $query = LostItem::find()->where(['state' => LostItem::STATE_LOST]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('item', [
            'ticket' => $ticket,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddItemToTicket($ticket_id, $lost_item_id){
        $itemLost = LostItem::findOne($lost_item_id);

        if (SupportTicket::addItemtoSupportTicket($ticket_id,$itemLost)) {
            Yii::$app->session->setFlash("success","O item foi adicionado ao ticket de suporte!");
        } else Yii::$app->session->setFlash("error","Ocorreu um erro e o item não foi adicionado!");

        return $this->redirect(['view','ticket_id' => $ticket_id]);
    }

    public function actionRemoveItemToTicket($ticket_id, $lost_item_id){

        $ticketItem = TicketItem::findOne(['lost_item_id' => $lost_item_id]);
        $itemLost = LostItem::findOne($lost_item_id);

        if (SupportTicket::removeItemtoSupportTicket($ticketItem,$itemLost)) {
            Yii::$app->session->setFlash("success","Item removido com sucesso!");
        } else Yii::$app->session->setFlash("error","Ocorreu um erro e o item não foi removido!");

        return $this->redirect(['view','ticket_id' => $ticket_id]);
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
