<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Manager $model */

$this->title = $model->manager_id;
$this->params['breadcrumbs'][] = ['label' => 'Gerentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="manager-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'manager_id' => $model->manager_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'manager_id' => $model->manager_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'manager_id',
            'restaurant_id',
        ],
    ]) ?>

</div>
