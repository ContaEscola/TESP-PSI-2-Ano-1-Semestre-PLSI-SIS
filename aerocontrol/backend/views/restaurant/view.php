<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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

        <?= Html::a('Apagar Imagem', ['deleteimage', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que quer eliminar imagem?',
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
                'attribute'=>'logo',
                'value'=> '../../../images/restaurant/' . $model->logo,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            'website',
        ],
    ]) ?>

</div>
