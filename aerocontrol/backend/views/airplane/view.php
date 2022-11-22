<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Airplane $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Airplanes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="airplane-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Nome',
                'value' => $model->name,
            ],
            [
                'label' => 'Capacidade',
                'value' => $model->capacity,
            ],
            [
                'label' => 'Estado',
                'value' => (($model->state == 0) ? "Inativo": "Ativo"),
            ],
            [
                'label' => 'Companhia',
                'value' => $model->company->name,
            ],
        ],
    ]) ?>

</div>
