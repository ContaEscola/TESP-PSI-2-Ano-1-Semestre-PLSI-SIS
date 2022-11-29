<?php

use common\models\Airplane;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AirplaneSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Aviões';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airplane-index">
    <p>
        <?= Html::a('Criar avião', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'label' => 'Nome',
                'value' => 'name'
            ],
            [
                'label' => 'Capacidade',
                'value' => 'capacity'
            ],
            [
                'label' => 'Estado',
                'value' => function($model){
                    return $model->state == 0 ? "Inativo" : "Ativo";
                }
            ],
            [
                'label' => 'Companhia',
                'value' => function($model){
                    return $model->company->name;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Airplane $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>

</div>