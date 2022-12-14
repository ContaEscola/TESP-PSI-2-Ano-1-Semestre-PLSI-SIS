<?php

namespace backend\controllers;

use common\models\Restaurant;
use common\models\RestaurantSearch;
use yii\filters\AccessControl;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * RestaurantController implements the CRUD actions for Restaurant model.
 */
class RestaurantController extends Controller
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
                            'roles' => ['viewRestaurant'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewRestaurant'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['createRestaurant'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['updateRestaurant'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['deleteRestaurant'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete-logo'],
                            'roles' => ['deleteRestaurantLogo'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Restaurant models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $restaurants = Restaurant::find()->all();
        return $this->render('index', [
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * Displays a single Restaurant model.
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
     * Creates a new Restaurant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Restaurant();

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {
                // $image_name = date("d-m-Y-H-i") . '_' . $model->name . '.' . $model->logo->getExtension();
                // $image_path = Yii::getAlias('@uploadLogos') . $image_name;
                // $model->logo->saveAs($image_path);
                // $model->logo = $image_name;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Restaurant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // $current = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            // $model->logo = UploadedFile::getInstance($model, 'logo');
            // //atualizar a imagem do restaurante caso o utilizador altere
            // if ($model->logo != null) {

            //     if ($current->logo != null) {
            //         //retirar a imagem para meter a nova
            //         unlink(Yii::getAlias('@base') . '/images/restaurant/' . $current->logo);
            //     }

            //     $image_name = date("d-m-Y-H-i") . '_' . $model->name . '.' . $model->logo->getExtension();
            //     $image_path = Yii::getAlias('@base') . '/images/restaurant/' . $image_name;
            //     $model->logo->saveAs($image_path);
            //     $model->logo = $image_name;
            // } else {
            //     $model->logo = $current->logo;
            // }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Restaurant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }


    //remover logo do restaurante
    public function actionDeleteLogo($id)
    {
        $model = $this->findModel($id);
        if ($model->deleteLogo())
            $model->logo = null;

        if ($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Restaurant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Restaurant::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
