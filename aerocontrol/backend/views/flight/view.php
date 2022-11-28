<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Flight $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Flights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="flight-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'terminal',
            'estimated_departure_date',
            'estimated_arrival_date',
            'departure_date',
            'arrival_date',
            'price',
            'distance',
            'state',
            'discount_percentage',
            'origin_airport_id',
            'arrival_airport_id',
            'airplane_id',
        ],
    ]) ?>

</div>
