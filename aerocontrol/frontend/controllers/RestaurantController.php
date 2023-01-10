<?php

namespace frontend\controllers;

use common\models\Airport;
use common\models\Restaurant;
use frontend\models\FlightForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RestauntController implements the CRUD actions for Restaurant model.
 */
class RestaurantController extends Controller
{

    /**
     * Lists all Flight models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new FlightForm();
        $airports = Airport::find()->all();
        $model->loadDefaultValues();

        return $this->render('index', [
            'airports' => $airports,
            'model' => $model,
        ]);
    }

    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
