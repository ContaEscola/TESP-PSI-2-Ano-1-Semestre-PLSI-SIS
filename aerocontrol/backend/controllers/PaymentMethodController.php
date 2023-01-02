<?php

namespace backend\controllers;

use common\models\PaymentMethod;
use common\models\PaymentMethodSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentMethodController implements the CRUD actions for PaymentMethod model.
 */
class PaymentMethodController extends Controller
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
                            'roles' => ['viewPaymentMethod'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewPaymentMethod'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['updatePaymentMethod'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['deletePaymentMethod'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PaymentMethod models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PaymentMethodSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PaymentMethod model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing PaymentMethod model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->state == PaymentMethod::STATE_ACTIVE) $model->state = PaymentMethod::STATE_INACTIVE;
        else $model->state = PaymentMethod::STATE_ACTIVE;

        if (!$model->save())
            Yii::$app->session->setFlash('error', 'Algo correu mal ao efetuar a operação!');


        return $this->redirect(['index']);
    }

    /**
     * Finds the PaymentMethod model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PaymentMethod the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaymentMethod::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
