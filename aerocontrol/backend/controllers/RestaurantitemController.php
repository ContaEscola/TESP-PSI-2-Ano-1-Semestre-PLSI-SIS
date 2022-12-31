<?php

namespace backend\controllers;

use common\models\Manager;
use common\models\Restaurant;
use common\models\RestaurantItem;
use common\models\RestaurantItemSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RestaurantItemController implements the CRUD actions for RestaurantItem model.
 */
class RestaurantItemController extends Controller
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
                            'roles' => ['viewRestaurantItem'],
                            'roleParams' => function () {
                                return ['restaurant' => Restaurant::findOne(['id' => Yii::$app->request->get('restaurant_id')])];
                            },
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewRestaurantItem'],
                            'roleParams' => function () {
                                return ['restaurant' => RestaurantItem::findOne(['id' => Yii::$app->request->get('id')])->restaurant];
                            },
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['createRestaurantItem'],
                            'roleParams' => function () {
                                return ['restaurant' => Restaurant::findOne(['id' => Yii::$app->request->get('restaurant_id')])];
                            },
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['updateRestaurantItem'],
                            'roleParams' => function () {
                                return ['restaurant' => RestaurantItem::findOne(['id' => Yii::$app->request->get('id')])->restaurant];
                            },
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['deleteRestaurantItem'],
                            'roleParams' => function () {
                                return ['restaurant' => RestaurantItem::findOne(['id' => Yii::$app->request->get('id')])->restaurant];
                            },
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete-logo'],
                            'roles' => ['deleteRestaurantItemLogo'],
                            'roleParams' => function () {
                                return ['restaurant' => RestaurantItem::findOne(['id' => Yii::$app->request->get('id')])->restaurant];
                            },
                        ],
                    ],
                ]
            ]
        );
    }

    /**
     * Lists all RestaurantItem models.
     *
     * @return string
     */
    public function actionIndex($restaurant_id)
    {
        $searchModel = new RestaurantItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'restaurant_id' => $restaurant_id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RestaurantItem model.
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
     * Creates a new RestaurantItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($restaurant_id)
    {
        $model = new RestaurantItem();

        $model->restaurant_id = $restaurant_id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RestaurantItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RestaurantItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $restaurant_id = $model->restaurant_id;
        $model->delete();

        return $this->redirect(['index', 'restaurant_id' => $restaurant_id]);
    }

    //remover imagem do item do restaurante
    public function actionDeleteLogo($id)
    {
        $model = $this->findModel($id);
        if ($model->deleteImage())
            $model->image = null;

        if (!$model->save())
            Yii::$app->session->setFlash('error', 'Algo correu mal ao efetuar a operação!');

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the RestaurantItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return RestaurantItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RestaurantItem::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
