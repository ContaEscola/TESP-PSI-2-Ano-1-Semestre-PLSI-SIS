<?php

use common\models\LostItem;
use common\models\TicketItem;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\LostItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProviderShowItem */
/** @var yii\data\ActiveDataProvider $dataProviderShowMyItem */
/** @var int $ticket_id */

$this->registerJsFile('@web/js/scrolldown_chat.js');

if (TicketItem::findOne(['support_ticket_id' => $ticket_id])) {
    $this->title = "Ver Item";
}else{
    $this->title = "Associar Item";
}
$this->params['breadcrumbs'][] = ['label' => 'Tickets de Suporte', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-ticket-create">

    <?php

    //Verificar se existe um ticketItem com o mesmo id do ticket, mostrando o item associado ao mesmo
    //Caso não exista mostra todos os items perdidos

    if (TicketItem::findOne(['support_ticket_id' => $ticket_id])){
        echo GridView::widget([
            'summary' => '',
            'dataProvider' => $dataProviderShowMyItem,
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
                            return Html::a("Remover", ['remove-item-to-ticket', 'ticket_id' => $ticket_id, 'lost_item_id' => $model->id], ['class' => 'btn btn-danger']);
                        },
                    ],
                ],
            ],
        ]);
    }else{
        echo GridView::widget([
            'summary' => '',
            'dataProvider' => $dataProviderShowItem,
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
        ]);
    }

    ?>





</div>
