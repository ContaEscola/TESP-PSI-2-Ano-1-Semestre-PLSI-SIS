<?php

use common\models\RestaurantItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\RestaurantItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var int $restaurant_id */

$this->title = 'Menu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-item-index">

    <p>
        <?= Html::a('Criar item do menu', ['create','restaurant_id' => $restaurant_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => "Nenhum resultado encontrado!",
        'columns' => [
            'id',
            'item',
            [
                'attribute' => 'image',
                'value' => function ($model) {
                    return Url::to($model->getImagePathUrl());
                },
                'format' => ['image', ['width' => '100', 'class' => 'img-fluid']],
                'filter' => '',
            ],
            [
                'attribute' => 'state',
                'value' => function ($model) {
                    return $model->getState();
                },
                'filter' => [
                    0 => 'Inativo',
                    1 => 'Ativo'
                ],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RestaurantItem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
