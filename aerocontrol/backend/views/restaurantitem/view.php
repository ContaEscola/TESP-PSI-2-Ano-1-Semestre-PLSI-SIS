<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\RestaurantItem $model */

$this->title = $model->item;
$this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => ['index','restaurant_id'=>$model->restaurant_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="restaurant-item-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Apagar imagem', ['delete-logo', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que quer eliminar a imagem?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende eliminar o item do menu?',
                'method' => 'post',
            ],
        ]) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'item',
            [
                'attribute' => 'image',
                'value' => Url::to($model->getImagePathUrl()),
                'format' => ['image', ['width' => '100', 'class' => 'img-fluid']],
            ],
            [
                'attribute' => 'Estado',
                'value' => $model->getState(),
            ],
        ],
    ]) ?>

</div>
