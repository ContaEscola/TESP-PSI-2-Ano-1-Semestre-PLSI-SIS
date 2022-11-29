<?php

use common\models\Airport;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AirportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Aeroportos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airport-index">
    <p>
        <?= Html::a('Criar aeroporto', ['create'], ['class' => 'btn btn-success']) ?>
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
                'label' => 'País',
                'value' => 'country'
            ],
            [
                'label' => 'Cidade',
                'value' => 'city'
            ],
            [
                'label' => 'Website',
                'value' => 'website'
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Airport $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>

</div>
