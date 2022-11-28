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

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Aeroporto de Origem</th>
            <th>Terminal</th>
            <th>Aeroporto de Chegada</th>
            <th>Data de partida estimada</th>
            <th>Data de chegada estimada</th>
            <th>Data de partida</th>
            <th>Data de chegada</th>
            <th>Preço</th>
            <th>Distancia</th>
            <th>Estado</th>
            <th>Desconto</th>
            <th>Avião</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($flights as $flight) : ?>
            <tr>
                <th scope="row"><?= $flight->id ?></th>
                <td><?= $flight->originAirport->name ?></td>
                <td><?= $flight->terminal ?></td>
                <td><?= $flight->arrivalAirport->name ?></td>
                <td><?= $flight->estimated_departure_date ?></td>
                <td><?= $flight->estimated_arrival_date ?></td>
                <td><?= $flight->departure_date ?></td>
                <td><?= $flight->arrival_date ?></td>
                <td><?= $flight->price ?></td>
                <td><?= $flight->distance ?></td>
                <td><?= $flight->state ?></td>
                <td><?= $flight->discount_percentage."%" ?></td>
                <td><?= $flight->airplane->name ?></td>
                <td>
                    <a class="btn btn-primary" href="<?= Url::to(['flight/view', 'id' => $flight->id]) ?>">Visualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


</div>
