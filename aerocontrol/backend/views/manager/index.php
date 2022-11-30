<?php

use common\models\Manager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ManagerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Gerentes de Restaurantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-index">

    <p>
        <?= Html::a('Criar Manager', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'Id',
                'value' => 'client_id',
            ],
            [
                'label' => 'Username',
                'value' => function ($model){
                    return $model->user->username;
                }
            ],
            [
                'label' => 'Nome',
                'value' => function ($model){
                    return $model->user->first_name.' '.$model->user->last_name;
                }
            ],
            [
                'label' => 'Email',
                'value' => function($model){
                    return $model->user->email;
                }
            ],
            [
                'label' => 'Restaurante',
                'value' => function ($model){
                    return $model->restaurant->name;
                }
            ],
            [
                'label' => 'Telefone',
                'value' => function($model){
                    return $model->user->phone;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Manager $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'manager_id' => $model->manager_id]);
                 }
            ],
        ],
    ]); ?>


</div>
