<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\LostItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var int $ticket_id */

$this->registerJsFile('@web/js/scrolldown_chat.js');

$this->title = "Associar item";
$this->params['breadcrumbs'][] = ['label' => 'Tickets de Suporte', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-ticket-create">

    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => "Nenhum resultado encontrado!",
        'columns' => [
            'id',
            'description',
            [
                'attribute' => 'image',
                'value' => function ($model) {
                    return Url::to($model->getImagePathUrl());
                },
                'format' => ['image', ['width' => '100', 'class' => 'img-fluid']],
                'filter' => '',
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) use($ticket_id){
                        return Html::a("Associar", ['add-item-to-ticket', 'ticket_id' => $ticket_id, 'lost_item_id' => $model->id], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]);?>

</div>
