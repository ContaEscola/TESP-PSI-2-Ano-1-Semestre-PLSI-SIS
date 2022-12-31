<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Restaurant $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="restaurant-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Ver menu', ['restaurant-item/index', 'restaurant_id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Apagar Logo', ['delete-logo', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que quer eliminar o logo?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a('Apagar Restaurante', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que quer eliminar o restaurante?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'phone',
            'open_time',
            'close_time',
            [
                'attribute' => 'logo',
                'value' => Url::to($model->getLogoPathUrl()),
                'format' => ['image', ['width' => '100', 'class' => 'img-fluid']],
            ],
            'website',
        ],
    ]) ?>

</div>