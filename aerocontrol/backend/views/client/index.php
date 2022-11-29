<?php

use common\models\Client;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ClientSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'columns' => [
            'client_id',
            [
                'label' => 'Username',
                'value' => function($model){
                    return $model->user->username;
                }
            ],
            [
                'label' => 'Nome',
                'value' => function($model){
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
                'label' => 'Telefone',
                'value' => function($model){
                    return $model->user->phone;
                }
            ],
            [
                'label' => 'Género',
                'value' => function($model){
                    return $model->user->gender;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Client $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'client_id' => $model->client_id]);
                }
            ],
        ],
    ]);
    ?>

</div>
