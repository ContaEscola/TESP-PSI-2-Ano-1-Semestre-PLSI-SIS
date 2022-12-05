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
                'label' => 'Origem - Data de Partida Estimada',
                'value' => function ($model) {
                    return $model->originAirport->name . " - " . $model->estimated_departure_date;
                },
            ],
            [
                'label' => 'Destino - Data de Chegada Estimada',
                'value' => function ($model) {
                    return $model->arrivalAirport->name . ' - ' . $model->estimated_arrival_date;
                },
            ],
            'terminal',
            'departure_date',
            'arrival_date',
            [
                'label' => 'Avião',
                'value' => function ($model) {
                    return $model->airplane->name;
                },
            ],
            'state',
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