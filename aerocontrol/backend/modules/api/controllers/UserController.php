<?php

namespace backend\modules\api\controllers;

use common\models\RestaurantItem;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    public function actionView($id){
        $user = new $this->modelClass;
        return $user->find()->where(['id'=>$id])->select(
            [
                'id',
                'username',
                'first_name',
                'last_name',
                'gender',
                'country',
                'city',
                'birthdate',
                'email',
                'phone',
                'phone_country_code'
            ])->one();
    }
}
