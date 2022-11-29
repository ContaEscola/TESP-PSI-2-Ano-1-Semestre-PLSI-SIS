<?php

use common\models\Flight;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\FlightSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Voos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flight-index">

    <p>
        <?= Html::a('Criar Voo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            'id',
            [
                'label' => 'Origem',
                'value' => function($model){
                    return $model->originAirport->name . " - " . $model->departure_date;
                },
            ],
            [
                'label' => 'Destino',
                'value' => function($model){
                    return $model->arrivalAirport->name;
                },
            ],
            [
                'label' => 'Terminal',
                'value' => 'terminal'
            ],
            [
                'label' => 'Hora de Partida',
                'value' => function($model){
                    return Yii::$app->formatter->asDatetime($model->departure_date,'dd-MM-yyyy HH:mm');
                },
            ],
            [
                'label' => 'Hora de Chegada',
                'value' => function($model){
                    return Yii::$app->formatter->asDatetime($model->arrival_date,'dd-MM-yyyy HH:mm');
                },
            ],
            [
                'label' => 'Avião',
                'value' => function($model){
                    return $model->airplane->name;
                },
            ],
            [
                'label' => 'Estado',
                'value' => 'state'
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Flight $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>

</div>
