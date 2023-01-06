<?php

use common\models\SupportTicket;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;

/** @var yii\web\View $this */
/** @var \common\models\base\SupportTicketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tickets de Suporte';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-ticket-index">

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => "Nenhum resultado encontrado!",
        'columns' => [
            'id',
            'title',
            'state',
            'client_id',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model){
                        return Html::a("Responder", ['view', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>


</div>
