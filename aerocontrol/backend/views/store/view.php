<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Store $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lojas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="store-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Apagar Logo', ['delete-logo', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que quer eliminar o logo?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a('Apagar Loja', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que quer eliminar a loja?',
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
