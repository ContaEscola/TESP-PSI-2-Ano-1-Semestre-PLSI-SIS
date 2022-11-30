<?php

namespace backend\controllers;

use backend\models\ManagerForm;
use common\models\Manager;
use common\models\ManagerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManagerController implements the CRUD actions for Manager model.
 */
class ManagerController extends Controller
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
     * Lists all Manager models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ManagerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Manager model.
     * @param int $manager_id ID do Gerente
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($manager_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($manager_id),
        ]);
    }

    /**
     * Creates a new Manager model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ManagerForm();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->create()) {
                return $this->redirect(['view', 'manager_id' => $model->manager_id]);
            }
        } else {
            $model->resetAttributesOnInvalid();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Manager model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $manager_id ID do Gerente
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($manager_id)
    {
        $validManager = $this->findModel($manager_id);
        $model = new ManagerForm($validManager->manager_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->update()) {
            return $this->redirect(['view', 'manager_id' => $model->manager_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Manager model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $manager_id ID do Gerente
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($manager_id)
    {
        $this->findModel($manager_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Manager model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $manager_id ID do Gerente
     * @return Manager the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($manager_id)
    {
        if (($model = Manager::findOne(['manager_id' => $manager_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
