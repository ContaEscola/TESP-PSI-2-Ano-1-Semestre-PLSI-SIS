<?php

use common\models\EmployeeFunction;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\EmployeeFunctionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Funções de Trabalhadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-function-index">
    <p>
        <?= Html::a('Criar novo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => "Nenhum resultado encontrado!",
        'columns' => [
            'id',
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, EmployeeFunction $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>


</div>
